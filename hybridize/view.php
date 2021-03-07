<?php
if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM salary INNER JOIN user  ON salary.user_id = user.user_id
                         WHERE salary.user_id=:id");
  $query->execute([
    'id'=>$_GET['id'],
  ]);

  if($query->rowCount()>0){
    $data1 = $query->fetchAll(PDO::FETCH_ASSOC);

 ?>

 <center><h5>ข้อมูลค่าตอบแทน</h5></center><p>
   <?php

     foreach ($data1 as $key => $value) {?>
       <form method="post"  >
         <div class="row justify-content-center">
           <div class="col-4" >รหัสพนักงาน</div>
           <div class="col-4">: <?=$value["user_id"]?></div>
         </div>
         <div class="row justify-content-center">
           <div class="col-4" >ชื่อพนักงาน</div>
           <div class="col-4">: <?=$value["name"]?></div>
         </div>
         <div class="row justify-content-center">
           <div class="col-4" >นามสกุล</div>
           <div class="col-4">: <?=$value["surname"]?></div>
         </div>
         <div class="row justify-content-center">
           <div class="col-4" >วันที่จ่ายเงิน</div>
           <div class="col-4">: <?= $value["salary_date"]?></div>
         </div>
         <div class="row justify-content-center">
           <div class="col-4" >ค่าตอบแทน/วัน</div>
           <div class="col-4">: <?=$value["salary"]?></div>
         </div>
         <div class="row justify-content-center">
           <div class="col-4" >จำนวนวันที่ทำงานวัน</div>
           <div class="col-4">: <?=$value["total_work"]?></div>
         </div>
        <?php $salary=$value["total_work"] * $value["salary"] ?>

         <div class="row justify-content-center">
           <div class="col-4" >จำนวนเงิน</div>
           <font color="red"><div class="col-4">: <?=number_format($salary);?></font>&nbsp;&nbsp;บาท</div>
         </div>
     <p></p>
     <hr>
    <?php }?>


 <center>
 <button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=salary/index';">กลับ</button>
 </center>
 </form>
<?php
}
} ?>




