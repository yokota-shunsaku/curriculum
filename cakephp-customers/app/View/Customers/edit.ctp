<h3>顧客情報編集</h3>
<?php
    echo $this->Form->create('Customer');
    echo $this->Form->input('name' ,array('label' => '顧客氏名'));
    echo $this->Form->input('line_type' ,array('options' => array('Type-A', 'Type-D'),'label' => '回線タイプ'));
    echo $this->Form->input('contract_type' ,array('options' => array('データのみ3GB', 'データのみ6GB', 'データのみ10GB', 'SMS付き3GB', 'SMS付き6GB', 'SMS付き10GB', '音声通話プラン3GB', '音声通話プラン6GB', '音声通話プラン10GB'),'label' => '契約タイプ'));
    echo $this->Form->input('agency_id' ,array('options' => array('ヒトコム', 'ビックカメラ', 'ヨドバシカメラ', 'ヤマダ電機'),'label' => '代理店'));
    echo $this->Form->input('status' ,array('options' => array('契約中', '解約済み'),'label' => 'ステータス'));
    echo $this->Form->input("contract_day", array(
        'type' => 'datetime',
        'dateFormat' => 'YMD',
        'monthNames' => false,
        'timeFormat' => '24',
        'separator' => '/',
        'label' => '契約日'
    ));
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end('登録');
?>