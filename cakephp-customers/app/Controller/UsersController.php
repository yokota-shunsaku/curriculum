<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {



    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $options = array( 'conditions' => array( 'User.deleted' => 0 ));
        // 変数をビューへ渡す 
        $users_data = $this->User->find('all', $options); 
        $this->set('users_data', $users_data); 
        // app/View/Users/index.ctpを表示 
        $this->render('index'); 
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        // URLの末尾からタスクのIDを取得してメッセージを作成 
        $id = $this->request->pass[0];
        // $this->Task->delete($id); 
        // doneと同様の流れで大丈夫です 
        $this->User->id = $id;
        $this->User->saveField('deleted', 1);
        

        // $this->request->allowMethod('post');
        // $this->User->id = $id;
        // if (!$this->User->exists()) {
            // throw new NotFoundException(__('Invalid user'));
        // }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }

    public function beforeFilter() {
    parent::beforeFilter();
    // ユーザー自身による登録とログアウトを許可する
    $this->Auth->allow('add', 'logout');
}

public function login() {
    if ($this->request->is('post')) {
        if ($this->Auth->login()) {
            $this->redirect($this->Auth->redirect());
        } else {
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }
}

public function logout() {
    $this->redirect($this->Auth->logout());
}

}