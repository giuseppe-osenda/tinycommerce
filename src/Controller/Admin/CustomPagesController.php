<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CustomPages Controller
 *
 * @property \App\Model\Table\CustomPagesTable $CustomPages
 */

class CustomPagesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->CustomPages->find();
        $customPages = $this->paginate($query);

        $this->set(compact('customPages'));
    }

    /**
     * View method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $customPage = $this->CustomPages->get($id, contain: []);
        $this->set(compact('customPage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customPage = $this->CustomPages->newEmptyEntity();
        if ($this->request->is('post')) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->getData());
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The custom page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The custom page could not be saved. Please, try again.'));
        }
        $this->set(compact('customPage'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $customPage = $this->CustomPages->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customPage = $this->CustomPages->patchEntity($customPage, $this->request->getData());
            if ($this->CustomPages->save($customPage)) {
                $this->Flash->success(__('The custom page has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The custom page could not be saved. Please, try again.'));
        }
        $this->set(compact('customPage'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Custom Page id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customPage = $this->CustomPages->get($id);
        if ($this->CustomPages->delete($customPage)) {
            $this->Flash->success(__('The custom page has been deleted.'));
        } else {
            $this->Flash->error(__('The custom page could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
