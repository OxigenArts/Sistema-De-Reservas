<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Profile Controller
 *
 * @property \App\Model\Table\ProfileTable $Profile
 *
 * @method \App\Model\Entity\Profile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProfileController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => ['Profile.user_id' => $this->Auth->user('id')],
            'contain' => ['Photos']
        ];
        $photo = [];
        $profile = $this->paginate($this->Profile);
        foreach ($profile as $key) {
            if($key->user_id = $this->Auth->user('id')){
                array_push($photo, $key->photo->url);
            }
        }
        debug($key->photo->url);
        $this->set(['profile' => $profile,
            '_serialize' => 'profile',
            'photos' => $photo,
            '_serialize' => 'photos'
    ]);
    }

    /**
     * View method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if ($this->Auth->user('role') == "admin") {
            $profile = $this->Profile->get($id, [
                'contain' => ['Photos', 'Users']
            ]);
        } else {
            $profile = $this->Profile->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id')],
                'contain' => ['Photos', 'Users']
            ]);
        }
        

        $this->set([
            "profile" => $profile->first(),
            "_serialize" => ['profile']
        ]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $profile = $this->Profile->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profile->patchEntity($profile, $this->request->getData());
            $profile->user_id = $this->Auth->user('id');
            if ($this->Profile->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $photos = $this->Profile->Photos->find('list', ['limit' => 200]);
        $this->set(compact('profile', 'photos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if ($this->Auth->user('role') == "admin" && $id != null) {
            $profile = $this->Profile->get($id, [
                "contain" => ['Users', 'Photos']
            ]);
        } else {
            $profile = $this->Profile->find('all', [
                'contain' => ['Users', 'Photos'],
                'conditions' => ['profile.user_id' => $this->Auth->user('id')]
            ])->first();
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profile->patchEntity($profile, $this->request->getData());
            if ($this->Profile->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be saved. Please, try again.'));
        }
        $photos = $this->Profile->Photos->find('list', ['limit' => 200]);
        //$this->set(compact('profile', 'photos'));
        $this->set(['profile' => $profile,
            '_serialize' => 'profile'
    ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Profile id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profile->get($id);
        if ($this->Profile->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    

    public function uploadprofilephoto() {
        $this->loadModel("Photos");
        if ($this->request->is('post')) {
            $rData = $this->request->getData();
            if (move_uploaded_file($rData['url']['tmp_name'], WWW_ROOT . "img/users/".$rData['url']['name'])) {

                $userProfile = $this->Profile->find("all", [
                    "conditions" => ["profile.user_id" => $this->Auth->user('id')],
                    "contain" => ['Photos']
                ])->first();
                
                $userProfile->photo->url = "img/users/".$rData['url']['name'];

                $this->Profile->save($userProfile);
                $this->Photos->save($userProfile->photo);
            }
            
        }
        debug($userProfile->photo);
        $this->set([
            'data' => $userProfile,
            '_serialize' => ['data']
        ]);
        

    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }

        if($this->Auth->user('role') == 'user'){
            if (in_array($this->request->action, ['edit'])) {
                return true;
            }
            
        }else{
            return parent::isAuthorized($user);
        }
        // By default deny access.
        
    }

    
}
