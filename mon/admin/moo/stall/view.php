<?php
$query = $db->prepare("SELECT * FROM stall INNER JOIN moo ON moo.stall_id=stall.stall_id");
$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch();

?>
<div class="container">
  <center><h3>ข้อมูลคอกสุกร</h3></center>
  <!-- <div class="card border-primary">
    <div class="card-body"> -->
<!-- <div class="row">
  <center>
  <div class="col-xs-12"><img src="images/<?=$row["images"]?>" alt="" width="200" /></div>
</div> -->
<br>
<div class="row justify-content-center">
  <div class="col-4" >รหัสคอก</div>
  <div class="col-4">: <?=$row["stall_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >ชื่อคอก</div>
  <div class="col-4">: <?=$row["stall_name"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >รหัสสุกร</div>
  <div class="col-4">: <?=$row["moo_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >เบอร์หูสุกร</div>
  <div class="col-4">: <?=$row["moo_number"]?></div>
</div>

<hr>
<a  onclick="window.location.href=document.referrer;">Back</a>
</div>
</div>
</div>
