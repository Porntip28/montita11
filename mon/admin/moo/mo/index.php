  <?php 
$row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo'); //สต๊อกหมูทั้งหมด
$row->execute();
$rowall = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo WHERE status_mo = 2'); //สต๊อกหมูที่พร้อมขาย
$row->execute();
$row2 = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(motor_id) as amountrow FROM motorcycle WHERE status_mo = 3'); //สต๊อกหมูที่ขายเเล้ว
$row->execute();
$row3 = $row->fetchColumn();


 ?>

<button type="button" class="btn btn-outline-primary">หมูทั้งหมด <?=$rowall?> ตัว</button>
<button type="button" class="btn btn-outline-warning">หมูที่พร้อมขาย <?=$row2?> ตัว</button>

<center><h5>ข้อมูลหมู</h5></center>
<br>
<!-- ตารางอ้างไอดีค้นหา -->


<table id="mydata" class="table table-bordered table-striped" >
  

  <thead>
    <tr>
      <th >ลำดับ</th>
      <th>รุ่น</th>
      <th>เบอร์สุกร</th>
      <th>น้ำหนัก</th>
      <th>คอก</th>
      <th>เพศ</th>
      <th>เบอร์หูแม่</th>
      <th>เบอร์หูพ่อ</th>
      <th>ราคาขาย</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<!-- SELECT * FROM moo INNER JOIN salling ON salling.moo_id = moo.moo_id INNER JOIN user ON user.user_id = salling.user_id -->
<!-- SELECT * FROM moo INNER JOIN stall ON stall.stall_id = moo.stall_id -->
<?php

$status = include 'status_mo.php';
$query = $db->prepare('SELECT * FROM moo ');

$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["gene"]?></td>
      <td><?= $row["moo_number"]?></td>
      <td><?= $row["weight"]?></td>
      <td><?= $row["stall_id"]?></td>
      <td><?= $row["sex"]?></td>
      <td><?= $row["ma_number"]?></td>
      <td><?= $row["fa_number"]?></td>
      <td><?= $row["price_sale"]?></td>
      <td><?= $status[$row["status_mo"]]?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=moo/mo/view&id=<?=$row["moo_id"]?>"><i class="far fa-eye"></i></a>
        <?php  if($row["status_mo"] == 7){ ?>
        <a  title="แก้ไขข้อมูล"href="?file=moo/mo/update&id=<?=$row["moo_id"]?>"><i class='fas fa-edit'></i></a>
      <?php } ?>
        <!-- <a  title="ลบข้อมูล"href="?file=moo/mo/delete&id=<?=$row["moo_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a> -->
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
<p><p><p><p><a href="?file=moo/index" class="btn btn-info" role="button">กลับ</a>
