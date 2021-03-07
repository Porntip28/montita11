<?php
$row1 = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo WHERE status_mo = 2'); //สต๊อกหมูที่พร้อมขาย
$row1->execute();
$number_rows = $row1->fetchColumn();

?>
<button type="button" class="btn btn-outline-info">หมูที่พร้อมขาย <?=$number_rows?> ตัว</button>


<?php
// error_reporting(0); ?>
<center><h5>ข้อมูลหมู</h5></center>
<!-- <p><a href="?file=motorcycle/motor/insert" class="btn btn-success" role="button">เพิ่มข้อมูลหมู</a> -->
<br>
<table class="table table-striped">
<thead>
  <tr>
    <th>ลำดับ</th>
    <th>รุ่น</th>
    <th>เบอร์หู</th>
    <th>สถานะ</th>
    <th>เครื่องมือ</th>
  </tr>
</thead>
<tbody>
<?php

$status = include 'status_mo.php';
$query = $db->prepare('SELECT * FROM moo  WHERE status_mo = 2');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
$i=1;
while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
   ?>
  <tr>
    <td><?= $i++?></td>
    <td><?= $row["gene"]?></td>
    <td><?= $row["moo_number"]?></td>
    <td><?= $status[$row["status_mo"]]?></td>
    <td>
      <a  title="ดูข้อมูล"  href="?file=moo/mo/view&id=<?=$row["moo_id"]?>"><i class="far fa-eye"></i></a>
      <?php  if($row["status_mo"] == 0){ ?>
      <a  title="แก้ไขข้อมูล"href="?file=moo/mo/update&id=<?=$row["moo_id"]?>"><i class='fas fa-edit'></i></a>
    <?php } ?>
      <a  title="ลบข้อมูล"href="?file=moo/mo/delete&id=<?=$row["moo_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
      <?php if($row["status_mo"] == 2){ ?>
      <a  href="?file=moo/mo/cart&moo_id=<?=$row["moo_id"]?>" class="btn btn-outline-warning btn-sm" role="button" >ขาย</a>
  <?php   } ?>

    </td>
  </tr>
  <?php
}
}

?>
</tbody>
</table>

<p><a href="?file=salling/index" class="btn btn-info" role="button">กลับ</a>
