
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>วันที่สั่ง</th>
      <th>ชื่อพนักงาน</th>
      <th>นามสกุล</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$status = include 'order_status.php';
$query = $db->prepare('SELECT * FROM order_food INNER JOIN user
                                    ON order_food.user_id = user.user_id ');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= date("d-m-Y", strtotime ($row->date_order_food))?></td>
      <td><?= $row->name?></td>
      <td><?= $row->surname?></td>
      <td><?=$status[$row->order_status]?></td>

      <td>
          <a  title="ดูข้อมูล"  href="?file=food/order_food/history&id=<?=$row->order_food_id?>"><i class="far fa-eye"></i></a>
  <?php  if(($row->order_status)==1) {?>
    <a  title="เเก้ไข"  href="?file=food/order_food/edit_status_order&id=<?=$row->order_food_id?>"><i class="far fa-edit"></i></a>
  <?php }?>
      </td>
    </tr>
    <?php
  }
}

?>
</tbody>

</table>
<p><a href="?file=food/index" class="btn btn-info" role="button">กลับ</a>
