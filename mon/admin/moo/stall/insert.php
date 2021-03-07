<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO stall (stall_name)
                                    VALUES (:stall_name)');
  $result = $query->execute([
  "stall_name"=>$_POST["stall_name"],
  ]);
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=moo/stall/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h4>ข้อมูลคอกสุกร</h4></center><p>
<form method="post"  >
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อคอก</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="stall_name" placeholder="ชื่อ">
    </div>
  </div>
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="reset" class="btn btn-warning">ล้างข้อมูล</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=moo/stall/index';">ยกเลิก</button>
</center>
</form>
