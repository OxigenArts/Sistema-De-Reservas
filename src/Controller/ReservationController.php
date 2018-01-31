<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $this->set([
            "reservation" => $reservation,
            "_serialize" => "reservation"
        ]);
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
        $date = $this->Reservation->get($id, [
            'contain' => []
        ]);

        $data = $this->request->getData();
        if ($this->request->is(['patch', 'post', 'put']) && $this->request->getData()["status"]) {
            $date = $this->Reservation->patchEntity($date, $this->request->getData());
            if ($this->Auth->user('id') == $date->user_id || $this->Auth->user('role') == "admin") {
                if ($this->Reservation->save($date)) {

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
            '_serialize' => ['data', 'date']
        ]);
    }

}
