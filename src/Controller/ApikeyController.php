<?php
namespace App\Controller;
use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;
use Cake\Utility\Security;
/**
 * Apikey Controller
 *
 * @property \App\Model\Table\ApikeyTable $Apikey
 *
 * @method \App\Model\Entity\Apikey[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApikeyController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {	
        $this->loadModel('Profile');
        $this->loadModel('Forms');
        $this->loadModel("Users");

        $data = [];
        $apikey = '';
        if ($this->request->is('post')) {
            $formData = $this->request->getData();

            $apiKey_external = $formData['apikey'];
            $apikey = $apiKey_external;
            if ($apiKey_external) {
                $keyRecord = $this->Apikey->find('all', [
                    'conditions' => ['api_key' => $apiKey_external]
                ])->first();
                
                
                if ($keyRecord && $apiKey_external != "not generated") {
                    
                    $profile = $this->Profile->find('all', [
                        'contain' => ['Photos'],
                        'conditions' => ['Profile.user_id' => $keyRecord->user_id]
                    ])->first();
                    
                    $form = $this->Forms->find('all', [
                        'conditions' => ['user_id' => $keyRecord->user_id]
                    ])->first();

                    $user = $this->Users->get($keyRecord->user_id);

                    $data['profile'] = $profile;
                    $data['form'] = $form;
                    $data['user'] = $user;
                    
                } else {
                    $data[] = ['error' => 'Invalid api key'];
                }
            } else {
                $data[] = ['error' => 'No api key defined (invalid_api)', 'test_data' => $this->request->getData()];
            }
            
        

        } else {
            if ($this->Auth->user('role') == "admin") {
                $apikey = $this->paginate($this->Apikey);
            } else {
                $apikey = $this->Apikey->find('all', [
                    'conditions' => ['user_id' => $this->Auth->user('id')]
                ]);
            }
        }

        
        
        $this->set(['data' => $data,
                    'apikey' => $apikey,
                    'title' => "Llave de acceso",
                    '_serialize' => ['data', 'apikey']]);
    
    }

    public function apirequest() {
        $this->loadModel('Profile');
        $this->loadModel('Forms');
        $this->loadModel("Users");
        $this->loadModel("Routines");
        $this->loadModel("Backgroundphotos");
        $data = [];
        $apikey = '';
        if ($this->request->is('post')) {
            $formData = $this->request->getData();

            $apiKey_external = $formData['apikey'];
            
            if ($apiKey_external) {
                $keyRecord = $this->Apikey->find('all', [
                    'conditions' => ['api_key' => $apiKey_external]
                ])->first();
                

                $user = $this->Users->get($keyRecord->user_id);
                
                
                if ($keyRecord) {
                    
                    $profile = $this->Profile->find('all', [
                        'contain' => ['Photos', 'Gallery'],
                        'conditions' => ['Profile.user_id' => $keyRecord->user_id]
                    ])->first();
    
                    $form = $this->Forms->find('all', [
                        'conditions' => ['user_id' => $keyRecord->user_id]
                    ])->first();

                    $routine = $this->Routines->find('all', [
                        'conditions' => ['user_id' => $keyRecord->user_id]
                    ])->first();

                    $profile->bgphoto = $this->Backgroundphotos->find('all', [
                        'conditions' => ['user_id' => $keyRecord->user_id]
                    ])->first();

                    $data['profile'] = $profile;
                    $data['form'] = $form;
                    $data['routine'] = $routine;
                    
                } else {
                    $data[] = ['error' => 'Invalid api key'];
                }
            } else {
                $data[] = ['error' => 'No api key defined (invalid_api)', 'test_data' => $this->request->getData()];
            }
            
        

        } else {
            if ($this->Auth->user('role') == "admin") {
                $apikey = $this->paginate($this->Apikey);
            } else {
                $apikey = $this->find('all', [
                    'conditions' => ['user_id' => $this->Auth->user('id')]
                ]);
            }
        }

        
        
        //debug($data['profile']);
        $this->set(['data' => $data,
                    'apikey' => $apikey,
                    '_serialize' => ['data', 'apikey']]);
    }

    public function message() {
        $this->loadModel('Mesage');
        $status = [];
        if ($this->request->is('post')) {
            $formData = $this->request->getData();

            $apiKey_external = $formData['apikey'];
            
            if ($apiKey_external) {

                $keyRecord = $this->Apikey->find('all', [
                    'conditions' => ['api_key' => $apiKey_external]
                ])->first();
            
                $newMessage = $this->Mesage->newEntity();

                $newMessage->user_id = $keyRecord->user_id;
                $newMessage->json = json_encode($formData['data']);

                $this->Mesage->save($newMessage);
                $status[] = ['success' => true];
            
                } else {
                    $status[] = ['error' => true, 'message' => 'No api key provided.'];
                }

        
    } else {
        $status[] = ['error' => true, 'message' => 'Invalid operation'];
    }

    $this->set([
        'status' => $status,
        '_serialize' => ['status']
    ]);
}

    public function send() {
        $this->loadModel("Reservation");
        $response = [];
        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $apikey = $data['apikey'];

            if ($apikey) {
                $apikeyRecord = $this->Apikey->find('all', [
                    'conditions' => ['api_key' => $apikey]
                ])->first();

                if ($apikeyRecord) {
                    $newReservation = $this->Reservation->newEntity();

                    $requestJson = $data['json'];

                    $newReservation->name = json_encode($requestJson);

                    $newReservation->user_id = $apikeyRecord->user_id;

                    $newReservation->status = "pending";

                    $this->Reservation->save($newReservation);

                    $response[] = ["success" => true, $newReservation];
                    
                } else {
                    $response[] = ["error" => true, "message" => "Invalid apikey."];
                }
            } else {
                $response[] = ["error" => true, "message" => "No apikey defined."];
            }
        } else {
            $response[] = ["error" => true, "message" => "Invalid method."];
        }

        $this->set([
            'reservation' => $response,
            '_serialize' => ['reservation']
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Apikey id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apikey = $this->Apikey->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('apikey', $apikey);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apikey = $this->Apikey->newEntity();
        if ($this->request->is('post')) {
            $hasher  = new DefaultPasswordHasher();
            $api_key_plain = Security::hash(Security::randomBytes(32), 'sha256', false);
           $key = $hasher->hash($api_key_plain);
           $apikey->api_key = $key;
           $apikey->user_id = $this->Auth->user('id');
            if ($this->Apikey->save($apikey)) {
                $this->Flash->success(__('The apikey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apikey could not be saved. Please, try again.'));
        }
        $users = $this->Apikey->Users->find('list', ['limit' => 200]);
        $this->set(compact('apikey', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Apikey id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit()
    {

        $apikey = $this->Apikey->find('all', [
            'contain' => ['Users'],
            'conditions' => ["user_id" => $this->Auth->user('id')]
        ])->first();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $hasher  = new DefaultPasswordHasher();
            $api_key_plain = Security::hash(Security::randomBytes(32), 'sha256', false);
            $key = $hasher->hash($api_key_plain);
           $apikey->api_key = $key;
            if ($this->Apikey->save($apikey)) {
                $this->Flash->success(__('The apikey has been saved.'));

                //return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apikey could not be saved. Please, try again.'));
        } else {
            return $this->redirect(['action' => 'index']);
        }
        //$users = $this->Apikey->Users->find('all', ['limit' => 200]);
        //debug($apikey);
        $this->set(['apikey' => $apikey, '_serialize' => 'apikey'//, 'users' => $users, '_serialize' => 'users'
    ]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Apikey id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $apikey = $this->Apikey->get($id);
        if ($this->Apikey->delete($apikey)) {
            $this->Flash->success(__('The apikey has been deleted.'));
        } else {
            $this->Flash->error(__('The apikey could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {

        if ($this->Auth->user('role') == 'admin') {
            return true;
        }

        if($this->Auth->user('role') == 'user'){
            if (in_array($this->request->action, ['index', 'edit','message', 'apirequest'])) {
                return true;
            }
            
        }else{
            return parent::isAuthorized($user);
        }
        
    }
}
