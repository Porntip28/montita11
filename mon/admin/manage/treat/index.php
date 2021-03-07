<br>
<center><h5>ข้อมูลการรักษา</h5></center>

<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <!-- <th>รหัสการรักษา</th> -->
      <th>เบอร์สุกร</th>
      <th>รายละเอียดการป่วย</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$orderStatus = include 'status_treat.php';
$query = $db->prepare('SELECT * FROM treat  INNER JOIN moo
                                ON treat.moo_id = moo.moo_id');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["moo_number"]?></td>
      <td><?= $row["detail_treat"]?></td>
      <td><?= $orderStatus[$row["status_treat"]]?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=manage/treat/view&id=<?=$row["treat_id"]?>"><i class="far fa-eye"></i></a>
      <?php  if($row["status_treat"]!=2){?>
        <a  title="แก้ไขข้อมูล"href="?file=manage/treat/update&id=<?=$row["treat_id"]?>"><i class='fas fa-edit'></i></a>
<?php } ?>
      </td>
    </tr>
    <?php
  }
}
?>
</tbody>
</table>
<p><a href="?file=manage/index" class="btn btn-info" role="button">กลับ</a>
