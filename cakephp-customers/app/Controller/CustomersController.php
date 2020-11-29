<?php
class CustomersController extends AppController { 
    public $components = array('Paginator'); 
    public $helpers = array('Flash');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Post.title' => 'asc'
        )
    );

public function index() { 
        if(isset($this->request->query['selected_status'])){
        $options = array( 'conditions' => array( 'Customer.deleted' => 0 ));
        $options->where([
                'status' => $this->request->query['selected_status']
            ]);
        $options->all();
        $this->set('cus_data', $options);
        }
        else{
        $options = array( 'conditions' => array( 'Customer.deleted' => 0 ));
        $customers_data = $this->Customer->find('all', $options);
        $this->set('cus_data', $customers_data); 
    }
        

$this->paginate=array(
            'page'=>1,
            'conditions'=>array('Model.id'=>7),
            'fields'=>array('id','name'),
            'sort'=>'id',
            'limit'=>10,
            'direction'=>'asc',
            'recursive'=>0
            );
        $this->set('cus_data',$this->paginate());

        // app/View/Customers/index.ctpを表示 
        

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
'contract_day' => $this->request->data['contract_day'] );
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
// URLの末尾からタスクのIDを取得してメッセージを作成 
$id = $this->request->pass[0];
// $this->Task->delete($id); 
// doneと同様の流れで大丈夫です 
$this->Customer->id = $id;
$this->Customer->saveField('deleted', 1);
$msg = sprintf( '顧客 %s を削除しました。', $id ); 
$this->Flash->set($msg); 
// indexへリダイレクト 
$this->redirect(['controller'=>'customers','action'=>'index']); 
return; 
}
}