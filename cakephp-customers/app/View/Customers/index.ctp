<?php echo $this->Html->css('page_styles'); ?>

<?php
if(isset($_GET["contract_type"],$_GET["agency_id"],$_GET["status"],$_GET["keyword"])) {
  // セレクトボックスで選択された値を受け取る
  $contract_type = $_GET["contract_type"];
  $agency_id = $_GET["agency_id"];
  $status = $_GET["status"];
  $keyword = $_GET["keyword"];

  // 受け取った値を画面に出力
  echo $contract_type;
  echo $agency_id;
  echo $status;
  echo $keyword;
}

?>
<?php // var_dump($cus_data) ?>


<div class="container">
    <?php // Htmlヘルパーを使い、<a>タグ（リンク）を生成する ?>
    <div class="sidebar">
    <div class="sidebar__item">
<h3>顧客一覧</h3>
各種情報
回線タイプ
契約タイプ
代理店
ステータス
    </div>
    <div class="sidebar__item sidebar__item--fixed">
      <!-- 固定・追従させたいエリア -->
    </div>
</div>
<main class="main">
<?php echo $this->Html->link('新規タスク', '/Customers/create'); ?>
<p>該当件数:<?php echo count($cus_data); ?>件</p>

<table> 
    <tr> 
        <th>会員ID</th> 
        <th>契約者氏名</th> 
        <th>回線タイプ</th> 
        <th>契約タイプ</th> 
        <th>代理店</th> 
        <th>ステータス</th> 
        <th>契約日</th> 
    </tr> 
<?php foreach($cus_data as $row): ?> 

<tr>
<td><?php echo $this->Html->link($row['Customer']['id'], '/Customers/view/' . $row['Customer']['id']); ?></td>
        <td><?php echo h($row['Customer']['name']); ?></td>
        <td><?php 
            if(($row['Customer']['line_type']) == 0){
            echo 'Type-A';
            }
            if(($row['Customer']['line_type']) == 1){
            echo 'Type-D';
            }
        ?></td> 
        <td><?php 
            if(($row['Customer']['contract_type']) == 0){
            echo 'データのみ3GB';
            }
            if(($row['Customer']['contract_type']) == 1){
            echo 'データのみ6GB';
            }
            if(($row['Customer']['contract_type']) == 2){
            echo 'データのみ10GB';
            }
            if(($row['Customer']['contract_type']) == 3){
            echo 'SMS付き3GB';
            }
            if(($row['Customer']['contract_type']) == 4){
            echo 'SMS付き6GB';
            }
            if(($row['Customer']['contract_type']) == 5){
            echo 'SMS付き10GB';
            }
            if(($row['Customer']['contract_type']) == 6){
            echo '音声通話プラン3GB';
            }
            if(($row['Customer']['contract_type']) == 7){
            echo '音声通話プラン6GB';
            }
            if(($row['Customer']['contract_type']) == 8){
            echo '音声通話プラン10GB';
            }
        ?></td>
        <td><?php 
            if(($row['Customer']['agency_id']) == 0){
            echo 'ヒトコム';
            }
            if(($row['Customer']['agency_id']) == 1){
            echo 'ビックカメラ';
            }
            if(($row['Customer']['agency_id']) == 2){
            echo 'ヨドバシカメラ';
            }
            if(($row['Customer']['agency_id']) == 3){
            echo 'ヤマダ電機';
            }
        ?></td>
        <td><?php
            if(($row['Customer']['status']) == 0){
            echo '契約中';
            }
            if(($row['Customer']['status']) == 1){
            echo '解約済み';
            }
        ?></td>
        <td><?php echo h($row['Customer']['contract_day']); ?></td> 
        <?php //echo $this->Html->link( '編集', '/Customers/edit/' . $row['Customer']['id'], array('class' => 'button left') ); ?> 
        <td><?php echo $this->Html->link('編集',array('action'=>'edit',$row['Customer']['id'])); ?></td>
        </tr>

        
<?php endforeach; ?>
</table>
</main>
<div class="sidebar">
    <div class="sidebar__item">
<h1>検索フォーム</h1>

  <form action="index" method = "GET" name="search" id="search">
  <input type="hidden" name="mode" value="search">

    <input type="radio" name="contract_type" value="0" id="0"><label for="0">データのみ3GB</label><br>
    <input type="radio" name="contract_type" value="1" id="1"><label for="1">データのみ6GB</label><br>
    <input type="radio" name="contract_type" value="2" id="2"><label for="2">データのみ10GB</label><br>
    <input type="radio" name="contract_type" value="3" id="3"><label for="3">SMS付き3GB</label><br>
    <input type="radio" name="contract_type" value="4" id="4"><label for="4">SMS付き6GB</label><br>
    <input type="radio" name="contract_type" value="5" id="5"><label for="5">SMS付き10GB</label><br>
    <input type="radio" name="contract_type" value="6" id="6"><label for="6">音声通話プラン3GB</label><br>
    <input type="radio" name="contract_type" value="7" id="7"><label for="7">音声通話プラン6GB</label><br>
    <input type="radio" name="contract_type" value="8" id="8"><label for="8">音声通話プラン10GB</label><br>
    
    <select name= "agency_id">
      <option value = "0">ヒトコム</option>
      <option value = "1">ビックカメラ</option>
      <option value = "2">ヨドバシカメラ</option>
      <option value = "3">ヤマダ電機</option>
    </select>
    <br>
    <input type="radio" name="selected_status" value="0" id="契約中"><label for="契約中">契約中</label><br>
    <input type="radio" name="selected_status" value="1" id="解約済み"><label for="解約済み">解約済み</label><br>
    <br>
    <span>キーワード：
    <input type="text" name="keyword" value="<?php if(!empty($getform['keyword'])){ echo $getform['keyword']; } ?>">
  </span>
  <br>
    <input type="submit"name="submit"value="検索"/>
  </form>

<?php // var_dump($_GET['status']) ?>
  <?php // var_dump($_GET['search']) ?>

        </div>
    <div class="sidebar__item sidebar__item--fixed">
      <!-- 固定・追従させたいエリア -->
    </div>
  </div>
</div>
<?php
    print $this->Paginator->counter('{:count}件中{:start}-{:end}件({:pages}ページ中{:page}ページ)<br>');
    if($this->Paginator->hasPrev()) print $this->Paginator->prev('≪' , array('class'=>'block'));
    print $this->Paginator->numbers(array(
    'class'=>'block',
    'modules' => 6 ,
    'first'=>2,
    'last'=>2,
    'currentClass'=>'red',
    'separator'=>null
    ));
    if($this->Paginator->hasNext()) print $this->Paginator->next(' ≫' , array('class'=>'block'));
?>