<br>
<center><h5>ข้อมูลการซ่อม</h5></center>
<a  title="แก้ไขข้อมูล"href="?file=insurance/repair/update&id=<?=$row["repair_id"]?>"><i class='fas fa-edit'></i></a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <!-- <th>รหัสการซ่อม</th> -->
      <th>เลขทะเบียน</th>
      <th>รายละเอียดที่ต้องซ่อม</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$orderStatus = include 'status_repair.php';
$query = $db->prepare('SELECT * FROM repair INNER JOIN motorcycle
                                ON repair.motor_id = motorcycle.motor_id');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["motor_number"]?></td>
      <td><?= $row["detail_repair"]?></td>
      <td><?= $orderStatus[$row["status_repair"]]?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=insurance/repair/view&id=<?=$row["repair_id"]?>"><i class="far fa-eye"></i></a>
      <?php  if($row["status_repair"]!=2){?>
        <a  title="แก้ไขข้อมูล"href="?file=insurance/repair/update&id=<?=$row["repair_id"]?>"><i class='fas fa-edit'></i></a>
<?php } ?>
      </td>
    </tr>
    <?php
  }
}
?>
</tbody>
</table>
<p><a href="?file=insurance/index" class="btn btn-info" role="button">กลับ</a>
