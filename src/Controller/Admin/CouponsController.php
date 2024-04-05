<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Coupons Controller
 *
 * @property \App\Model\Table\CouponsTable $Coupons
 */
class CouponsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Coupons->find();
        $coupons = $this->paginate($query);

        $this->set(compact('coupons'));
    }

    /**
     * View method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coupon = $this->Coupons->get($id, contain: []);
        $this->set(compact('coupon'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coupon = $this->Coupons->newEmptyEntity();
        if ($this->request->is('post')) {
            $coupon = $this->Coupons->patchEntity($coupon, $this->request->getData());
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->set(compact('coupon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coupon = $this->Coupons->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coupon = $this->Coupons->patchEntity($coupon, $this->request->getData());
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->set(compact('coupon'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->Coupons->get($id);
        if ($this->Coupons->delete($coupon)) {
            $this->Flash->success(__('The coupon has been deleted.'));
        } else {
            $this->Flash->error(__('The coupon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
