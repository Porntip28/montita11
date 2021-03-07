
<br>
<p><a href="?file=moo/order_mo/insert" class="btn btn-success" role="button">เพิ่มข้อมูลสั่งซื้อหมู</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>วันที่</th>
      <th>ผู้สั่ง</th>
      <th>นามสกุล</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
  $orderStatus = include 'status_m.php';
$query = $db->prepare('SELECT * FROM order_moo INNER JOIN user
                                ON order_moo.user_id = user.user_id');
$query->execute();

if($query->rowCount() > 0){ 
  $i=1;
  while($row = $query->fetch(PDO::FETCH_OBJ)){
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?php echo date("d-m-Y", strtotime ($row->date_order_m))?></td>
      <td><?= $row->name?></td>
      <td><?= $row->surname?></td>
      <td><?= $orderStatus[$row->status_m]?></td>



      <td>
        <a  title="ดูข้อมูล"  href="?file=moo/order_mo/view&id=<?=$row->order_m_id?>"><i class="far fa-eye"></i></a>
        <?php  if(($row->status_m)==1) {?>
        <a  title="แก้ไขข้อมูล"href="?file=moo/order_mo/update&id=<?=$row->order_m_id?>"><i class='fas fa-edit'></i></a>
        <?php }?>
        <a  title="ลบข้อมูล"href="?file=moo/order_mo/delete&id=<?=$row->order_m_id?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>

      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=moo/index" class="btn btn-info" role="button">กลับ</a>
