<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO pill (pill_name, price, amount)
                                        VALUES (:pill_name, :price ,:amount ) ');
  $result = $query->execute([
  "pill_name"=>$_POST["pill_name"],
  "price"=>$_POST["price"],
  "amount"=>$_POST["amount"],
]); 
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=pill/pill-part/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h4>ข้อมูลยารักษา</h4></center><p>
<form method="post" >

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อยารักษา</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="pill_name" placeholder="ชื่อยา">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ราคา</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="price" placeholder="ราคา">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">จำนวน</label>
    <div class="col-sm-10">
      <input type="number" class="form-control form-control-sm"  name="amount" placeholder="จำนวน">
    </div>
  </div>
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=pill/pill-part/index';">ยกเลิก</button>
</center>
</form>
