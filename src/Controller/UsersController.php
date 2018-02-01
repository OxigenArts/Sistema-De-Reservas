<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\EntityInterface;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Category', 'Subcategory']
        ];
        $users = $this->paginate($this->Users);
        //debug($users);
        $this->set(['users' => $users, '_serialize' => 'users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Category', 'Subcategory', 'Profile', 'Apikey', 'Date', 'Directory', 'Forms', 'Photos', 'Reservation', 'Routines', 'Subcategory']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   $this->loadModel('Photos');
        $this->loadModel('Profile');
        $this->loadModel('Forms');
        $this->loadModel('Apikey');

        $user = $this->Users->newEntity();
        $nuevaFoto = $this->Photos->newEntity();
        $newProfile = $this->Profile->newEntity();
        $newForm = $this->Forms->newEntity();
        $newApikey = $this->Apikey->newEntity();


        //$photo = $this->Photos->find('all')->first();
        $nuevaFoto->url = 'img/users/user-placeholder.png';
        $newApikey->api_key = "not generated";

        
                
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->role = 'user';
            $user->status = 'pending';
            $user->category_id = 1;
            //debug($user);
            if ($nuevoUsuario = $this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                $nuevaFoto->user_id = $nuevoUsuario->id;
                $newProfile->user_id = $nuevoUsuario->id;
                $newForm->user_id = $nuevoUsuario->id;
                $this->Forms->save($newForm);
                $foto_id = $this->Photos->save($nuevaFoto);
                $newProfile->photo_id = $foto_id->id;
                $newApikey->user_id = $nuevoUsuario->id;
                $this->Profile->save($newProfile);
                $this->Apikey->save($newApikey);
                //return $this->redirect(['action' => 'index']);
            }else{
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            
        }
        $category = $this->Users->Category->find('list', ['limit' => 200]);
        $subcategory = $this->Users->Subcategory->find('list', ['limit' => 200]);
        $this->set(compact('user', 'category', 'subcategory'));
    }


    public function login()
    {
        $this->viewBuilder()->setLayout(false);
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Your username or password is incorrect.');
        }

        if ($this->Auth->user('role') == "admin" || $this->Auth->user('role') == "user") {
            return $this->redirect($this->Auth->redirectUrl());
        }
    }
    public function logout()
{
    $this->Flash->success('You are now logged out.');
    return $this->redirect($this->Auth->logout());
}
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $category = $this->Users->Category->find('list', ['limit' => 200]);
        $subcategory = $this->Users->Subcategory->find('list', ['limit' => 200]);
        //$this->set(compact('user', 'category', 'subcategories'));
        $this->set(['user' => $user, '_serialize' => 'user',
                    'category' => $category, '_serialize' => 'category',
                    'subcategory' => $subcategory, '_serialize' => 'subcategory'
    ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }

        if($this->Auth->user('role') == 'user'){
            if (in_array($this->request->action, ['login', 'logout'])) {
                return true;
            }
            
        }else{
            return parent::isAuthorized($user);
        }
        // By default deny access.
        
    }
}
