<?php echo $this->Html->css('page_styles'); ?>
<h3>顧客一覧</h3>

<div class="container">
    <div class="sidebar">
        <div class="sidebar__item">
            <h1>各種情報</h1>
            回線タイプ
            <ul>
                <li>Type-A</li>
                <li>Type-D</li>
            </ul>
            契約タイプ
            <ul>
                <li>データのみ3GB</li>
                <li>データのみ6GB</li>
                <li>データのみ10GB</li>
                <li>SMS付き3GB</li>
                <li>SMS付き6GB</li>
                <li>SMS付き10GB</li>
                <li>音声通話プラン3GB</li>
                <li>音声通話プラン6GB</li>
                <li>音声通話プラン10GB</li>
            </ul>
            代理店
            <ul>
                <li>ヒトコム</li>
                <li>ビックカメラ</li>
                <li>ヨドバシカメラ</li>
                <li>ヤマダ電機</li>
            </ul>
            ステータス
            <ul>
                <li>契約中</li>
                <li>解約済み</li>
            </ul>
        </div>
        <div class="sidebar__item sidebar__item--fixed">
          <!-- 固定・追従させたいエリア -->
        </div>
    </div>
    <main class="main">
        <?php echo $this->Html->link('顧客登録', '/Customers/create'); ?>
        <p>該当件数:<?php echo count($cu_data); ?>件</p>

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
            <?php foreach($cu_data as $row): ?> 

            <tr>
                <td><?php echo h($row['Customer']['id']); ?></td>
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
                <span>キーワード(氏名)
                    <input type="text" name="keyword" value="<?php if(!empty($getform['keyword'])){ echo $getform['keyword']; } ?>">
                </span>
                <br><br>
                <input type="radio" name="selected_contract_type" value="0" id="0"><label for="0">データのみ3GB</label><br>
                <input type="radio" name="selected_contract_type" value="1" id="1"><label for="1">データのみ6GB</label><br>
                <input type="radio" name="selected_contract_type" value="2" id="2"><label for="2">データのみ10GB</label><br>
                <input type="radio" name="selected_contract_type" value="3" id="3"><label for="3">SMS付き3GB</label><br>
                <input type="radio" name="selected_contract_type" value="4" id="4"><label for="4">SMS付き6GB</label><br>
                <input type="radio" name="selected_contract_type" value="5" id="5"><label for="5">SMS付き10GB</label><br>
                <input type="radio" name="selected_contract_type" value="6" id="6"><label for="6">音声通話プラン3GB</label><br>
                <input type="radio" name="selected_contract_type" value="7" id="7"><label for="7">音声通話プラン6GB</label><br>
                <input type="radio" name="selected_contract_type" value="8" id="8"><label for="8">音声通話プラン10GB</label><br>
                
                <span>代理店<br>
                    <select name= "selected_agency_id">
                        <option value = "0">ヒトコム</option>
                        <option value = "1">ビックカメラ</option>
                        <option value = "2">ヨドバシカメラ</option>
                        <option value = "3">ヤマダ電機</option>
                    </select>
                </span>
                <br><br>
                <input type="radio" name="selected_status" value="0" id="契約中"><label for="契約中">契約中</label><br>
                <input type="radio" name="selected_status" value="1" id="解約済み"><label for="解約済み">解約済み</label><br>
                
                <input type="submit"name="submit"value="検索"/>
            </form>
        </div>
        <div class="sidebar__item sidebar__item--fixed">
          <!-- 固定・追従させたいエリア -->
        </div>
    </div>
</div>
<?php
    print $this->Paginator->counter('{:count}件中{:start}-{:end}件({:pages}ページ中{:page}ページ)<br>');
    if($this->Paginator->hasPrev()) print $this->Paginator->prev('≪' , array('class'=>'block'));
    print $this->Paginator->numbers(array());
    if($this->Paginator->hasNext()) print $this->Paginator->next(' ≫' , array('class'=>'block'));
?>