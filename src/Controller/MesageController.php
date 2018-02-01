<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Mesage Controller
 *
 *
 * @method \App\Model\Entity\Mesage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MesageController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mesage = $this->Mesage->find('all',['conditions' => ['user_id' => $this->Auth->user('id')],
                                            'contain' => ['Users']
        ]);

        $this->set(['mesage' => $mesage, '_serialize' => 'mesage']);
    }

    /**
     * View method
     *
     * @param string|null $id Mesage id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mesage = $this->Mesage->get($id, [
            'contain' => []
        ]);

        $this->set('mesage', $mesage);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mesage = $this->Mesage->newEntity();
        if ($this->request->is('post')) {
            $mesage = $this->Mesage->patchEntity($mesage, $this->request->getData());
            if ($this->Mesage->save($mesage)) {
                $this->Flash->success(__('The mesage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mesage could not be saved. Please, try again.'));
        }
        $this->set(compact('mesage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Mesage id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mesage = $this->Mesage->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']) && ($mesage->user_id == $this->Auth->user('id') || $this->Auth->user('role') == "admin")) {
            $mesage = $this->Mesage->patchEntity($mesage, $this->request->getData());
            if ($this->Mesage->save($mesage)) {
                $this->Flash->success(__('The mesage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The mesage could not be saved. Please, try again.'));
        }
        $this->set(['mesage' => $mesage, '_serialize' => 'mesage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Mesage id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mesage = $this->Mesage->get($id);
        if ($this->Auth->user('role') == "admin" || $this->Auth->user('id') == $mesage->user_id) {
            if ($this->Mesage->delete($mesage)) {
                $this->Flash->success(__('The mesage has been deleted.'));
            } else {
                $this->Flash->error(__('The mesage could not be deleted. Please, try again.'));
            }
        }
        
        $this->set([
            'mesage' => $mesage,
            '_serialize' => ['mesage']
        ]);
        
        //return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }

        if($this->Auth->user('role') == 'user'){
            if (in_array($this->request->action, ['index', 'delete'])) {
                return true;
            }
            
        }else{
            return parent::isAuthorized($user);
        }
        // By default deny access.
        
    }

}
