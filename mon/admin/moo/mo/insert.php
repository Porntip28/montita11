
<br />
<center><h4>ข้อมูลหมู</h4></center><p>
<form method="post"  >

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์หูสุกร</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="moo_number" placeholder="เบอร์หูสุกร">
    </div>
  </div>
  
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ราคาขาย</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="price_sale" placeholder="ราคาขาย">
    </div>
  </div>



<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=moo/mo/index';">ยกเลิก</button>
</center>
</form>

<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO moo (moo_number, price_sal)
                                        VALUES (:moo_number, :price_sale)');
  $result = $query->execute([
  "moo_number"=>$_POST["moo_number"],
  "price_sale"=>$_POST["price_sale"],


  
]);
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=moo/mo/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>
