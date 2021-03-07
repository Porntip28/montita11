<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO suplier (sup_name, sup_tel, sup_address)
                                    VALUES (:sup_name,:sup_tel, :sup_address )');
  $result = $query->execute([
  "sup_name"=>$_POST["sup_name"],

  "sup_tel"=>$_POST["sup_tel"],
  "sup_address"=>$_POST["sup_address"],
  ]);
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=motorcycle/suplier/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h4>ข้อมูลซัพพลายเออร์</h4></center><p>
<form method="post"  >
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="sup_name" placeholder="ชื่อ">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์ติดต่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="sup_tel" placeholder="เบอร์ติดต่อ">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ที่อยู่</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="sup_address" placeholder="ที่อยู่">
    </div>
  </div>
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="reset" class="btn btn-warning">ล้างข้อมูล</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=motorcycle/suplier/index';">ยกเลิก</button>
</center>
</form>
