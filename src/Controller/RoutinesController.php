<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Routines Controller
 *
 *
 * @method \App\Model\Entity\Routine[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoutinesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->Auth->user('role')  == 'admin'){
            $routines = $this->Routines->find('all');
        }else{
            $routines = $this->Routines->find('all',
                ['conditions' => ['user_id' => $this->Auth->user('id')]]
            );
        }

        if ($this->request->is('post')) {
            $userRoutine = $this->Routines->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id')]
            ])->first();

            if (!$userRoutine) {
                $userRoutine = $this->Routines->newEntity();
                $userRoutine->user_id = $this->Auth->user('id');
                $userRoutine->json = "";
            }
            
            
            $requestData = $this->request->getData();

            $json = $requestData['json'];
            
            $routineJson = "";

            if ($userRoutine->json != "" && $userRoutine->json != NULL) {
                $routineJson = json_decode($userRoutine->json, true);
            } else {
                $routineJson = ['routine' => []];
            }

            $routineJson['routine'] = $json;

            $userRoutine->json = json_encode($routineJson);
            
            $this->Routines->save($userRoutine);

        }


        
        $this->set(['routine' => $routines->first(),
        'vue_disabled' => true,
            '_serialize' => 'routine'
    ]);
    }

    /**
     * View method
     *
     * @param string|null $id Routine id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $routine = $this->Routines->get($id, [
            'contain' => []
        ]);

        $this->set('routine', $routine);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $routine = $this->Routines->newEntity();
        if ($this->request->is('post')) {
            $routine = $this->Routines->patchEntity($routine, $this->request->getData());
            if ($this->Routines->save($routine)) {
                $this->Flash->success(__('The routine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The routine could not be saved. Please, try again.'));
        }
        $this->set(compact('routine'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Routine id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $routine = $this->Routines->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $routine = $this->Routines->patchEntity($routine, $this->request->getData());
            if ($this->Routines->save($routine)) {
                $this->Flash->success(__('The routine has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The routine could not be saved. Please, try again.'));
        }
        $this->set(['routines' => $routines,
            '_serialize' => 'routines'
    ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Routine id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $routine = $this->Routines->get($id);
        if ($this->Routines->delete($routine)) {
            $this->Flash->success(__('The routine has been deleted.'));
        } else {
            $this->Flash->error(__('The routine could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }

        if($this->Auth->user('role') == 'user'){
            if (in_array($this->request->action, ['index', 'edit'])) {
                return true;
            }
            
        }else{
            return parent::isAuthorized($user);
        }
        // By default deny access.
        
    }

}
