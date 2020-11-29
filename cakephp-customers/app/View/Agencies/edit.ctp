<h3>代理店情報編集</h3>
<?php
echo $this->Form->create('Agency');
echo $this->Form->input('agency_name' ,array('label' => '代理店名'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>