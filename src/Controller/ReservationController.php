<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
/**
 * Reservation Controller
 *
 *
 * @method \App\Model\Entity\Reservation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReservationController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        
        $reservations = $this->Reservation->find('all', [
            'conditions' => ['user_id' => $this->Auth->user('id')]
        ]);

        //debug();

        $this->set(['reservation' => $reservations, '_serialize' => 'reservation']);
    }

    /**
     * View method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reservation = $this->Reservation->get($id, [
            'contain' => []
        ]);

        $this->set('reservation', $reservation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reservation = $this->Reservation->newEntity();
        if ($this->request->is('post')) {
            $reservation = $this->Reservation->patchEntity($reservation, $this->request->getData());
            if ($this->Reservation->save($reservation)) {
                $this->Flash->success(__('The reservation has been saved.'));

            }
            $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
        }
        $this->set(compact('reservation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reservation = $this->Reservation->get($id, [
            'contain' => []
        ]);


        if ($this->request->is(['patch', 'post', 'put'])) {
            $reservation = $this->Reservation->patchEntity($reservation, $this->request->getData());
            if ($this->Auth->user('id') == $reservation->user_id || $this->Auth->user('role') == "admin") {
                if ($this->Reservation->save($reservation)) {
                    $this->Flash->success(__('The reservation has been saved.'));
                } else {
                    $this->Flash->error(__('The reservation could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('This reservation is not yours!.'));
                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(['reservation' => $reservation, '_serialize' => 'reservation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reservation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reservation = $this->Reservation->get($id);
        if ($this->Auth->user('id') == $reservation->user_id || $this->Auth->user('role') == "admin") {
            if ($this->Reservation->delete($reservation)) {
                $this->Flash->success(__('The reservation has been deleted.'));
            } else {
                $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('The reservation could not be deleted. Please, try again.'));
        }

        $this->set([
            'reservation' => $reservation,
            '_serialize' => ['reservation']
        ]);

    }

    public function setStatus($id = null)
    {
        $this->loadModel('Routines');
        $this->loadModel("Forms");
        $this->loadModel("Profile");
        $date = $this->Reservation->get($id, [
            'contain' => []
        ]);
        $debug = [];
        $data = $this->request->getData();
        $mailer = new Email();
        if ($this->request->is(['patch', 'post', 'put']) && $this->request->getData()["status"]) {
            $date = $this->Reservation->patchEntity($date, $this->request->getData());

            if ($date->user_id != $this->Auth->user('id')) {
                return;
            }

            $routine = $this->Routines->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id')]
            ])->first();

            $form = $this->Forms->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id')]
            ])->first();

            $profile = $this->Profile->find('all', [
                'conditions' => ['user_id' => $this->Auth->user('id')]
            ])->first();

            
            
            $routineJson = [];
            $formJson = [];
            $profileJson = [];
            if ($routine->json != "") {
                $routineJson = json_decode($routine->json, true);
            }

            if ($form->json != "") {
                $formJson = json_decode($form->json, true);
            }

            if ($profileJson != "") {
                $profileJson = json_decode($profile->json, true);
            }

            

            if (!array_key_exists("blocked", $routineJson)) {
                $routineJson['blocked'] = [];
            }

            $reservationData = json_decode($date->name, true);

            $status = $this->request->getData()['status'];
            $email_added_1 = array_search('Email', array_column($formJson, 'placeholder'));
            $email_added_2 = array_search('Correo', array_column($formJson, 'placeholder'));
            $owner_email_1 = array_search('Email', array_column($profileJson['contact'], 'key'));
            $owner_email_2 = array_search('Correo', array_column($profileJson['contact'], 'key'));
            if ($status == "accepted") {
                $date_blocked = array_search($reservationData['date'], array_column($routineJson['blocked'], 'date'));
                $debug[] = $date_blocked;
                if ($date_blocked == NULL) {
                    $debug[] = "entering to if";
                        array_push($routineJson['blocked'], [
                            'date' => $reservationData['date'],
                            'time' => [
                                'hour' => $reservationData['time']['hour'],
                                'minute' => $reservationData['time']['minute']
                            ]
                        ]);
                    
                }

                


                if ($email_added_1 != NULL) {
                    $mail = $reservationData['Email'];
                    $email->from(['test@oxigenarts.net' => 'TestMessage'])
                    ->to("$mail")
                    ->subject('Solicitud aceptada')
                    ->send(json_encode($routineJson['blocked']));
                }

                if ($email_added_2 != NULL) {
                    $mail = $reservationData['Correo'];
                    $email->from(['test@oxigenarts.net' => 'TestMessage'])
                    ->to("$mail")
                    ->subject('Solicitud aceptada')
                    ->send(json_encode($routineJson['blocked']));
                }
               
                    
                
            } else {
                $removedDate = array_search($reservationData['date'], array_column($routineJson['blocked'], 'date'));
                $debug['removedDate'] = $removedDate;
                if ($removedDate >= 0) {
                    $debug[] = "entering to removeddate";
                    unset($routineJson['blocked'][$removedDate]);
                    $routineJson['blocked'] = array_values($routineJson['blocked']);
                }
            }
            

            $routine->json = json_encode($routineJson);


            
            if ($this->Auth->user('id') == $date->user_id || $this->Auth->user('role') == "admin") {
                if ($this->Reservation->save($date) && $this->Routines->save($routine)) {

                    $this->Flash->success(__('La reserva ha sido aceptada.'));
                } else {
                    $this->Flash->error(__('La reserva no pudo ser aceptada, intentelo denuevo.'));
                }
            } else {
                $this->Flash->error(__('La reserva no pudo ser aceptada, intentelo denuevo.'));
            }
            
            
        }
        $this->set([
            'data' => $data,
            'date' => $date,
            'debug' => $debug,
            '_serialize' => ['data', 'date', 'debug']
        ]);
    }

    public function isAuthorized($user)
    {
        if ($this->Auth->user('role') == 'admin') {
            return true;
        }

        if($this->Auth->user('role') == 'user'){
            if (in_array($this->request->action, ['setstatus', 'delete', 'edit', 'index'])) {
                return true;
            }
            
        }else{
            return parent::isAuthorized($user);
        }
        // By default deny access.
        
    }


}
