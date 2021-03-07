<?php
$status_repair = include 'status_repair.php';
$query1 = $db->prepare("SELECT * FROM repair INNER JOIN motorcycle
                        ON repair.motor_id = motorcycle.motor_id
                        WHERE repair.repair_id = :id ");

                        $query1->execute(['id'=>$_GET['id']]);
                        $row1 = $query1->fetch(PDO::FETCH_ASSOC);
    if($row1['status_repair'] == 0){ ?>

      <div class="container">
        <center><h5>ข้อมูลการให้อาหาร</h5></center><br>
        <div class="row justify-content-center">
    <div class="col-4" >รหัสการให้อาหาร</div>
    <div class="col-4">:&nbsp; <?=$row1["repair_id"]?></div>
  </div>
      <div class="row justify-content-center">
  <div class="col-4" >วันที่ซ่อม</div>
  <div class="col-4">:&nbsp; <?= date("d-m-Y", strtotime ($row1["repair_date"]))?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เลขทะเบียน</div>
  <div class="col-4">:&nbsp; <?=$row1["motor_number"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >ยี่ห้อ-รุ่น</div>
  <div class="col-4">:&nbsp; <?=$row1["brand"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >ประเภทเกียร์</div>
  <div class="col-4">:&nbsp; <?=$row1["model"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >สี</div>
  <div class="col-4">:&nbsp; <?=$row1["color"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รายละเอียดที่ต้องซ่อม</div>
  <div class="col-4">:&nbsp; <?=$row1["detail_repair"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >สถานะการซ่อม</div>
  <div class="col-4">:&nbsp; <?=$status_repair[$row1["status_repair"]]?></div>
</div>

<?php  }else {

$query = $db->prepare("SELECT * FROM repair INNER JOIN motorcycle
                        ON repair.motor_id = motorcycle.motor_id
                        INNER JOIN detail_use_spare
                        ON detail_use_spare.repair_id = repair.repair_id
                        INNER JOIN spare
                        ON detail_use_spare.spare_id = spare.spare_id
                        WHERE repair.repair_id = :id ");

$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
  <center><h5>ข้อมูลการซ่อม</h5></center><br>
  <!-- <div class="card border-primary"> -->

<br>
<div class="row justify-content-center">
<div class="col-4" >รหัสการซ่อม</div>
<div class="col-4">:&nbsp; <?=$row1["repair_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >วันที่ซ่อม</div>
  <div class="col-4">:&nbsp; <?= date("d-m-Y", strtotime ($row["repair_date"]))?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เลขทะเบียน</div>
  <div class="col-4">:&nbsp; <?=$row["motor_number"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >ยี่ห้อ-รุ่น</div>
  <div class="col-4">:&nbsp; <?=$row["brand"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >ประเภทเกียร์</div>
  <div class="col-4">:&nbsp; <?=$row["model"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >สี</div>
  <div class="col-4">:&nbsp; <?=$row["color"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รายละเอียดที่ต้องซ่อม</div>
  <div class="col-4">:&nbsp; <?=$row["detail_repair"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >สถานะการซ่อม</div>
  <div class="col-4">:&nbsp; <?=$status_repair[$row["status_repair"]]?></div>
</div><hr>
<?php
 $query3 = $db->prepare("SELECT * FROM repair INNER JOIN motorcycle
                        ON repair.motor_id = motorcycle.motor_id
                        INNER JOIN detail_use_spare
                        ON detail_use_spare.repair_id = repair.repair_id
                        INNER JOIN spare
                        ON detail_use_spare.spare_id = spare.spare_id
                        WHERE repair.repair_id = :id ");

$query3->execute(['id'=>$_GET['id']]);
if($query3->rowCount()>0){
  $row3 = $query3->fetchAll(PDO::FETCH_ASSOC);
}
 ?>
<?php
foreach ($row3 as $key => $value):
  $sum = 0;

   ?>
  <div class="row justify-content-center">
    <div class="col-4" >อะไหล่ที่ใช้</div>
    <div class="col-4">:&nbsp; <?=$value["spare_name"]?>&nbsp;<?=$value["quantity"]?> ชิ้น ราคาชิ้นละ<?=$value["price"]?></div>
  </div>
<?php $sum = $value["price"]*$value["quantity"];
echo ''.$sum;
 ?>
<?php endforeach; ?>
<?php } ?>
<hr>
<a  onclick="window.location.href=document.referrer;">Back</a>
</div>
</div>
</div>
