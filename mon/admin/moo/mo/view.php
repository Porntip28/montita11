      <?php
      $orderStatus = include 'status_mo.php';
      $query = $db->prepare("SELECT * FROM moo WHERE moo_id=:id");
      $query->execute(['id'=>$_GET['id']]);
      $row = $query->fetch();

      ?>
      <div class="container">
        <center><h3>ข้อมูลหมู</h3></center><br>
        <!-- <div class="card border-primary"> -->
    <center><div class="col-xs-12"><img src="image/<?=$row["image"]?>" alt="" width="200" /></div></center>

      <br>
      <div class="row justify-content-center">
        <div class="col-4" >รหัสหมู</div>
        <div class="col-4">:&nbsp; <?=$row["moo_id"]?></div>
      </div>
      <div class="row justify-content-center">
        <div class="col-4" >เบอร์หูสุกร</div>
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
        <div class="col-4" >ระยะสุกร</div>
        <div class="col-4">:&nbsp; <?=$row["statusmoo_id"]?></div>
      </div>
      <div class="row justify-content-center">
        <div class="col-4" >คอก</div>
        <div class="col-4">:&nbsp; <?=$row["stall_id"]?></div>
      </div>
      <div class="row justify-content-center">
        <div class="col-4" >ราคาขาย</div>
        <div class="col-4">:&nbsp; <?=number_format($row["price_sale"])?>&nbsp;บาท</div>
      </div>
      <div class="row justify-content-center">
        <div class="col-4" >สถานะ</div>
        <div class="col-4">:&nbsp; <?=$orderStatus[$row["status_mo"]]?></div>
      </div>
      <hr>


      <a  onclick="window.location.href=document.referrer;">Back</a>
      </div>
      </div>
      </div>
