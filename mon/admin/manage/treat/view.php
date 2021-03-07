<?php
$status_treat= include 'status_treat.php';
$query1 = $db->prepare("SELECT * FROM treat INNER JOIN moo
                        ON treat.moo_id = moo.moo_id
                        WHERE treat.treat_id = :id ");

                        $query1->execute(['id'=>$_GET['id']]);
                        $row1 = $query1->fetch(PDO::FETCH_ASSOC);
    if($row1['status_treat'] == 0){ ?>

      <div class="container">
        <center><h5>ข้อมูลการให้ยา</h5></center><br>
        <div class="row justify-content-center">
    <div class="col-4" >รหัสการให้ยา</div>
    <div class="col-4">:&nbsp; <?=$row1["treat_id"]?></div>
  </div>
      <div class="row justify-content-center">
  <div class="col-4" >วันที่ให้ยา</div>
  <div class="col-4">:&nbsp; <?= date("d-m-Y", strtotime ($row1["treat_date"]))?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เบอร์สุกร</div>
  <div class="col-4">:&nbsp; <?=$row1["moo_number"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รุ่น</div>
  <div class="col-4">:&nbsp; <?=$row1["gene"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >น้ำหนัก</div>
  <div class="col-4">:&nbsp; <?=$row1["weight"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เพศ</div>
  <div class="col-4">:&nbsp; <?=$row1["sex"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รายละเอียดที่ต้องรักษา</div>
  <div class="col-4">:&nbsp; <?=$row1["detail_treat"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >คอก</div>
  <div class="col-4">:&nbsp; <?=$row1["stall_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >สถานะการรักษา</div>
  <div class="col-4">:&nbsp; <?=$status_treat[$row1["status_treat"]]?></div>
</div>

<?php  }else {

$query = $db->prepare("SELECT * FROM treat INNER JOIN moo
                        ON treat.moo_id = moo.moo_id
                        INNER JOIN detail_use_pill
                        ON detail_use_pill.treat_id = treat.treat_id
                        INNER JOIN pill
                        ON detail_use_pill.pill_id = pill.pill_id
                        WHERE treat.treat_id = :id ");

$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch(PDO::FETCH_ASSOC);

?>
<div class="container">
  <center><h5>ข้อมูลการให้ยา</h5></center><br>
  <!-- <div class="card border-primary"> -->

<br>
<div class="row justify-content-center">
<div class="col-4" >รหัสการให้ยา</div>
<div class="col-4">:&nbsp; <?=$row1["treat_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >วันที่ให้ยา</div>
  <div class="col-4">:&nbsp; <?= date("d-m-Y", strtotime ($row["treat_date"]))?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เบอร์สุกร</div>
  <div class="col-4">:&nbsp; <?=$row["moo_number"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รุ่น</div>
  <div class="col-4">:&nbsp; <?=$row["gene"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >น้ำหนัก</div>
  <div class="col-4">:&nbsp; <?=$row["weight"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เพศ</div>
  <div class="col-4">:&nbsp; <?=$row["sex"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รายละเอียดที่ต้องรักษา</div>
  <div class="col-4">:&nbsp; <?=$row["detail_treat"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4" >สถานะการรักษา</div>
  <div class="col-4">:&nbsp; <?=$status_treat[$row["status_treat"]]?></div>
</div><hr>

<div class="row justify-content-center">
  <div class="col-4" >คอก</div>
  <div class="col-4">:&nbsp; <?=$row1["stall_id"]?></div>
</div>

<?php
 $query3 = $db->prepare("SELECT * FROM treat INNER JOIN moo
                        ON treat.moo_id = moo.moo_id
                        INNER JOIN detail_use_pill
                        ON detail_use_pill.treat_id = treat.treat_id
                        INNER JOIN pill
                        ON detail_use_pill.pill_id = pill.pill_id
                        WHERE treat.treat_id = :id ");

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
    <div class="col-4" >ยาที่ใช้</div>
    <div class="col-4">:&nbsp; <?=$value["pill_name"]?>&nbsp;<?=$value["quantity"]?> ชิ้น ราคาชิ้นละ<?=$value["price"]?></div>
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
