<?php
$query = $db->prepare("SELECT * FROM food WHERE food_id=:id");
$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch();

?>
<div class="container">
  <center><h3>ข้อมูลอาหาร</h3></center>
  <!-- <div class="card border-primary"> -->

      <div class="row justify-content-center">
        <div class="col-4" >ชื่ออาหาร</div>
        <div class="col-4">: <?= $row["food_name"]?></div>
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
