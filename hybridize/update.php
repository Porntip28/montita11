<?php
if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM hybridize INNER JOIN user  ON hybridize.user_id = user.user_id
  INNER JOIN moo  ON hybridize.moo_id = moo.moo_id

                         WHERE hybridize.user_id=:id");
  $query->execute([
    'id'=>$_GET['id'],
  ]);

  if($query->rowCount()>0){
    $data1 = $query->fetchAll(PDO::FETCH_ASSOC);

 ?>

 <center><h5>ข้อมูลการบันทึกการผสมพันธุ์</h5></center><p>
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
           <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์หูแม่</label>
           <div class="col-6">
            <input type="text" name="<?= $value['hybridize_m'] ?>" value="<?= $value['hybridize_m'] ?>" class="form-control" disabled>
           </div>
         </div>
         <div class="form-group row">
           <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์หูพ่อ</label>
           <div class="col-6">
            <input type="text" name="<?= $value['hybridize_f'] ?>" value="<?= $value['hybridize_f'] ?>" class="form-control" disabled>
           </div>
         </div>
     <p></p>
    <?php }?>


 <center>
 <button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
 <button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=hybridize/index';">ยกเลิก</button>
 </center>
 </form>
<?php
}
} ?>
