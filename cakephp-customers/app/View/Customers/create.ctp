<form action="<?php echo $this->Html->url('/Customers/create'); ?>" method="POST"> 

<h3>新規顧客登録</h3>

顧客氏名<input type="text" name="name" > 

回線タイプ<br>
<select name="line_type">
<option value='0'>Type-A</option>
<option value='1'>Type-D</option>
</select><br>

契約タイプ<br>
<select name="contract_type"> 
<option value='0'>データのみ3GB</option>
<option value='1'>データのみ6GB</option>
<option value='2'>データのみ10GB</option>
<option value='3'>SMS付き3GB</option>
<option value='4'>SMS付き6GB</option>
<option value='5'>SMS付き10GB</option>
<option value='6'>音声通話プラン3GB</option>
<option value='7'>音声通話プラン6GB</option>
<option value='8'>音声通話プラン10GB</option>
</select><br>

代理店<br>
<select name="agency_id">
<option value='0'>ヒトコム</option>
<option value='1'>ビックカメラ</option>
<option value='2'>ヨドバシカメラ</option>
<option value='3'>ヤマダ電機</option>
</select><br>

ステータス<br>
<select name="status"> 
<option value='0'>契約中</option>
<option value='1'>解約済み</option>
</select><br>

契約日<br>
<?php
echo $this->Form->input("contract_day", array(
        'type' => 'datetime',
        'dateFormat' => 'YMD',
        'monthNames' => false,
        'timeFormat' => '24',
        'separator' => '/',
    ));
    ?>

<input type="submit" value="登録">
</form>