<?php
class AgenciesController extends AppController { 
    public $components = array('Flash'); 
    public $helpers = array('Flash');

    public function index() { 
        $options = array( 'conditions' => array( 'Agency.deleted' => 0 ));
        $agencies_data = $this->Agency->find('all', $options);
        $this->set('agencies_data', $agencies_data); 
        $this->render('index');
    } 

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Agency'));
        }

        $post = $this->Agency->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid agency'));
        }

        if ($this->request->is(array('agency', 'put'))) {
            $this->Agency->id = $id;
            if ($this->Agency->save($this->request->data)) {
                $this->Flash->success(__('Agency has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update agency.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function create() {
        // POSTされた場合のみ処理を行う 
        if($this->request->is('post')) {
            $data = array(
                // 渡ってきたデータの中からnameという名前のついた値を取り出す
                'agency_name' => $this->request->data['agency_name'] 
            );
            // データを登録 
            $id = $this->Agency->save($data);
            $msg = sprintf('代理店 %s を登録しました。', $this->Agency->id); 
            // メッセージを表示してリダイレクト 
            $this->Flash->set($msg);
            $this->redirect(['controller'=>'agencies','action'=>'index']);
            return;
        }
        // POSTされたデータがなければ普通にcreate.ctpを表示 
        $this->render('create');
    }

    public function delete() { 
    $id = $this->request->pass[0];
    $this->Agency->id = $id;
    $this->Agency->saveField('deleted', 1);
    $msg = sprintf( '顧客 %s を削除しました。', $id ); 
    $this->Flash->set($msg); 
    // indexへリダイレクト 
    $this->redirect(['controller'=>'agencies','action'=>'index']); 
    return; 
    }

}