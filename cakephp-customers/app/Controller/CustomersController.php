<?php
class CustomersController extends AppController { 
    public $components = array('Paginator'); 
    public $helpers = array('Flash');
    public $paginate = array (
        'limit' => 10,
        'sort' => 'id'
    );

    public function index() { 
        if(isset($this->request->query['submit'])){
            $this->Paginator->settings = $this->paginate;
            $param = [
                ['Customer.deleted' => 0]
            ];
            if (isset($this->request->query['selected_contract_type'])) {
                $param[] = ['Customer.contract_type' => array( 'contract_type' => $this->request->query['selected_contract_type'])];
            }
            if (isset($this->request->query['selected_agency_id'])) {
                $param[] = ['Customer.agency_id' => array( 'agency_id' => $this->request->query['selected_agency_id'])];
            }
            if (isset($this->request->query['selected_status'])) {
                $param[] = ['Customer.status' => array( 'status' => $this->request->query['selected_status'])];
            }
            if (isset($this->request->query['keyword'])) {
                $search = $this->request->query['keyword'];
                $param[] = ['Customer.name LIKE' => "%{$search}%"];
            }
            $conditions = array(
                'and' => $param
            );
            $data = $this->paginate($conditions);
            $this->set('cu_data', $data);
        }
        else{
            $this->Paginator->settings = $this->paginate;
            $conditions = array('Customer.deleted' => 0);
            $data = $this->paginate($conditions);
            $this->set('cu_data', $data);
        }
    } 

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Customer'));
        }

        $post = $this->Customer->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid customer'));
        }

        if ($this->request->is(array('customer', 'put'))) {
            $this->Customer->id = $id;
            if ($this->Customer->save($this->request->data)) {
                $this->Flash->success(__('updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update.'));
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
                'name' => $this->request->data['name'],
                'line_type' => $this->request->data['line_type'],
                'contract_type' => $this->request->data['contract_type'],
                'agency_id' => $this->request->data['agency_id'],
                'status' => $this->request->data['status'],
                'contract_day' => $this->request->data['contract_day'] 
            );
            // データを登録 
            $id = $this->Customer->save($data);
            $msg = sprintf('タスク %s を登録しました。', $this->Customer->id); 
            // メッセージを表示してリダイレクト 
            $this->Flash->set($msg);
            $this->redirect(['controller'=>'customers','action'=>'index']);
            return;
        }
        // POSTされたデータがなければ普通にcreate.ctpを表示 
        $this->render('create');
    }

    public function delete() { 
        $id = $this->request->pass[0];
        $this->Customer->id = $id;
        $this->Customer->saveField('deleted', 1);
        $msg = sprintf( '顧客 %s を削除しました。', $id ); 
        $this->Flash->set($msg); 
        // indexへリダイレクト 
        $this->redirect(['controller'=>'customers','action'=>'index']); 
        return; 
    }
    
}