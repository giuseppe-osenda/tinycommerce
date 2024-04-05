<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

class UsersController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event) // This function is called before every action in the controller
    {
        parent::beforeFilter($event); // Call the parent beforeFilter function

        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function beforeRender(\Cake\Event\EventInterface $event) // This function is called before rendering the view
    {
        parent::beforeRender($event);
        $this->viewBuilder()->setlayout('CakeLte.default'); // Use the CakeLte layout
        $roles = $this->Users->Roles->find('list')->toArray(); // Get the list of roles
        $this->set(compact('roles')); // Pass the list of roles to the view
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Pages',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->getRequest()->getAttribute('identity')?->getOriginalData()?->role_id != 1){ // Check if the user is an admin
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home', 'plugin' => false, 'prefix' => false]); // Redirect to the home page if the user is not an admin
        }
        
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        if($this->getRequest()->getAttribute('identity')?->getOriginalData()?->role_id != 1){ // Check if the user is an admin
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home', 'plugin' => false, 'prefix' => false]); // Redirect to the home page if the user is not an admin
        }

        $user = $this->Users->get($id, contain: []);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
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
        if($this->getRequest()->getAttribute('identity')?->getOriginalData()?->role_id != 1){ // Check if the user is an admin
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home', 'plugin' => false, 'prefix' => false]); // Redirect to the home page if the user is not an admin
        }
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if($this->getRequest()->getAttribute('identity')?->getOriginalData()?->role_id != 1){ // Check if the user is an admin
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home', 'plugin' => false, 'prefix' => false]); // Redirect to the home page if the user is not an admin
        }
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if($this->getRequest()->getAttribute('identity')?->getOriginalData()?->role_id != 1){ // Check if the user is an admin
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home', 'plugin' => false, 'prefix' => false]); // Redirect to the home page if the user is not an admin
        }
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }
}
