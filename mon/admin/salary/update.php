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
       <form method="post"  action="" >
         <div class="form-group row">
           <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อพนักงาน</label>
           <div class="col-6">
            <input type="text" name="<?= $value['user_id'] ?>" value="<?= $value['name'] ?>" class="form-control" disabled>
           </div>
         </div>
         <div class="form-group row">
           <label  class="col-sm-2 col-form-label col-form-label-sm">จำนวนเงิน/วัน</label>
           <div class="col-6">
            <input type="text" name="salary" value="<?=$value["salary"]?>" class="form-control">
           </div>
         </div>

         <div class="form-group row">
           <label  class="col-sm-2 col-form-label col-form-label-sm">วันทำงานทั้งหมด</label>
           <div class="col-6">
            <input type="text" name="total_work" value="<?=$value["total_work"]?>" class="form-control">
           </div>
         </div>
     <p></p>
    <?php }?>


 <center>
 <button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
 <button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=salary/index';">ยกเลิก</button>
 </center>
 </form>
<?php
}
} ?>
