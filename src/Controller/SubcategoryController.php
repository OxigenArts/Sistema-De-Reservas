<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Subcategory Controller
 *
 *
 * @method \App\Model\Entity\Subcategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubcategoryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if($this->Auth->user('role')  == 'admin'){
            $subcategory = $this->Subcategory->find('all');
        }else{
            $subcategory = $this->Subcategory->find('all',
                ['conditions' => ['id' => $this->Auth->user('category_id')]]
            );
        }

        
        $this->set(['subcategory' => $subcategory,
            '_serialize' => 'subcategory'
    ]);
    }

    /**
     * View method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subcategory = $this->Subcategory->get($id, [
            'contain' => []
        ]);

        $this->set('subcategory', $subcategory);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subcategory = $this->Subcategory->newEntity();
        if ($this->request->is('post')) {
            $subcategory = $this->Subcategory->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategory->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
        }
        $this->set(compact('subcategory'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
       
        $subcategory = $this->Subcategory->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subcategory = $this->Subcategory->patchEntity($subcategory, $this->request->getData());
            if ($this->Subcategory->save($subcategory)) {
                $this->Flash->success(__('The subcategory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subcategory could not be saved. Please, try again.'));
        }
        $this->set(['subcategory' => $subcategory,
            '_serialize' => 'subcategory'
    ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Subcategory id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subcategory = $this->Subcategory->get($id);
        if ($this->Subcategory->delete($subcategory)) {
            $this->Flash->success(__('The subcategory has been deleted.'));
        } else {
            $this->Flash->error(__('The subcategory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }
            
        // By default deny access.
        
    }

}
