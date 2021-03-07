<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO food (food_name, price, amount)
                                        VALUES (:food_name, :price ,:amount ) ');
  $result = $query->execute([
  "food_name"=>$_POST["food_name"],
  "price"=>$_POST["price"],
  "amount"=>$_POST["amount"],
]); 
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=food/food-part/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h4>ข้อมูลอาหาร</h4></center><p>
<form method="post" >

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่ออาหาร</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="food_name" placeholder="ชื่ออาหาร">
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
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=food/food-part/index';">ยกเลิก</button>
</center>
</form>
