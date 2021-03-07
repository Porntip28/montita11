<?php
$query = $db->prepare("SELECT * FROM gene WHERE gene_id=:id");
$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch();

?>
<div class="container">
  <center><h3>ข้อมูลสายพันธุ์</h3></center>
  <!-- <div class="card border-primary">
    <div class="card-body"> -->
<!-- <div class="row">
  <center>
  <div class="col-xs-12"><img src="images/<?=$row["images"]?>" alt="" width="200" /></div>
</div> -->
<br>
<div class="row justify-content-center">
  <div class="col-4" >รหัสสายพันธุ์</div>
  <div class="col-4">: <?=$row["gene_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >ชื่อสายพันธุ์</div>
  <div class="col-4">: <?=$row["gene_name"]?></div>
</div>

<hr>
<a  onclick="window.location.href=document.referrer;">Back</a>
</div>
</div>
</div>
