<?php
$query = $db->prepare("SELECT * FROM spare WHERE spare_id=:id");
$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch();

?>
<div class="container">
  <center><h3>ข้อมูลอะไหล่</h3></center>
  <!-- <div class="card border-primary"> -->

      <div class="row justify-content-center">
        <div class="col-4" >ชื่ออะไหล่</div>
        <div class="col-4">: <?= $row["spare_name"]?></div>
      </div>
        <div class="row justify-content-center">
          <div class="col-4" >ราคา</div>
          <div class="col-4">: <?= $row["price"]?></div>
        </div>
      <div class="row justify-content-center">
        <div class="col-4" >จำนวน</div>
        <div class="col-4">: <?=$row["amount"]?></div>
      </div>
        
      <hr>


<a  onclick="window.location.href=document.referrer;">Back</a>
</div>
</div>
</div>
