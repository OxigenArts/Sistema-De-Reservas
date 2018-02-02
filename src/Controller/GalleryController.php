<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Gallery Controller
 *
 * @property \App\Model\Table\GalleryTable $Gallery
 *
 * @method \App\Model\Entity\Gallery[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GalleryController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->loadModel('Profile');

        $profile_id = $this->Profile->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ])->first()->id;

        $gallery = $this->Gallery->find('all', [
            'conditions' => ['profile_id' => $profile_id]
        ]);

        $this->set([
            'gallery' => $gallery,
            '_serialize' => ['gallery']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gallery = $this->Gallery->get($id, [
            'contain' => ['Profile']
        ]);

        $this->set('gallery', $gallery);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $gallery = $this->Gallery->newEntity();
        if ($this->request->is('post')) {
            $gallery = $this->Gallery->patchEntity($gallery, $this->request->getData());
            if ($this->Gallery->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $profile = $this->Gallery->Profile->find('list', ['limit' => 200]);
        $this->set(compact('gallery', 'profile'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gallery = $this->Gallery->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gallery = $this->Gallery->patchEntity($gallery, $this->request->getData());
            if ($this->Gallery->save($gallery)) {
                $this->Flash->success(__('The gallery has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The gallery could not be saved. Please, try again.'));
        }
        $profile = $this->Gallery->Profile->find('list', ['limit' => 200]);
        $this->set(compact('gallery', 'profile'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Gallery id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gallery = $this->Gallery->get($id);
        if ($this->Gallery->delete($gallery)) {
            $this->Flash->success(__('The gallery has been deleted.'));
        } else {
            $this->Flash->error(__('The gallery could not be deleted. Please, try again.'));
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
