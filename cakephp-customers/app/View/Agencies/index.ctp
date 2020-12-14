<?php echo $this->Html->css('page_styles'); ?>

<h3>代理店一覧</h3>
<?php echo $this->Html->link('登録', '/Agencies/create'); ?>
<p>該当件数:<?php echo count($agencies_data); ?>件</p>

<table> 
    <tr> 
        <th>ID</th> 
        <th>代理店名</th> 
        <th>作成日</th> 
        <th>更新日</th> 
        <th>操作</th> 
        <th></th> 
    </tr> 
    <?php foreach($agencies_data as $row): ?> 
    <tr>
        <td><?php echo h($row['Agency']['id']); ?></td>
        <td><?php echo h($row['Agency']['agency_name']); ?></td>
        <td><?php echo h($row['Agency']['created']); ?></td>
        <td><?php echo h($row['Agency']['modified']); ?></td>
        <td><?php echo $this->Html->link('編集',array('action'=>'edit',$row['Agency']['id'])); ?></td>
        <td><?php echo $this->Html->link( '削除', '/Agencies/delete/' . $row['Agency']['id'], array('class' => 'button') ); ?></td>
    </tr>
    <?php endforeach; ?>
</table>