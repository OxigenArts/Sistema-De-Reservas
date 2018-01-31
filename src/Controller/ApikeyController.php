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
        $this->paginate = [
            'contain' => ['Users']
        ];
        $apikey = $this->paginate($this->Apikey);
        $users = $this->Apikey->Users->find('all', ['limit' => 200]);
        $this->set(['apikey' => $apikey, '_serialize' => 'apikey'//, 'users' => $users, '_serialize' => 'users'
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
    public function edit($id = null)
    {
        $apikey = $this->Apikey->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hasher  = new DefaultPasswordHasher();
            $api_key_plain = Security::hash(Security::randomBytes(32), 'sha256', false);
            $key = $hasher->hash($api_key_plain);
           $apikey->api_key = $key;
            if ($this->Apikey->save($apikey)) {
                $this->Flash->success(__('The apikey has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apikey could not be saved. Please, try again.'));
        }
        $users = $this->Apikey->Users->find('all', ['limit' => 200]);
        debug($apikey);
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
}
