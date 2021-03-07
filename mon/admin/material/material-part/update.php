<?php
if(isset($_POST['ok'])){
  $query = $db->prepare("UPDATE material SET
  material_name = :material_name,
  price = :price,
  amount = :amount


  WHERE material.material_id = :id;"); //ชื่อตารางตามด้วยชื่อคอลัม

  $result = $query->execute([
  "id" => $_GET["id"],
  "material_name" => $_POST["material_name"],
  "price" => $_POST["price"],
  "amount" => $_POST["amount"],


  ]);
if($result){
echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
window.location = '?file=material/material-part/index';
      </script>";
}else{
echo "<script>
alert('Save fail! '".$query->errorInfo()[2].");
      </script>";
}
}




if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM material WHERE material_id = :id");
$query->execute([
'id'=>$_GET['id']
]);//รัน sql
    $data = $query->fetch(PDO::FETCH_ASSOC);
  }
?>
<form method="post">
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่ออุปกรณ์</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="material_name" value="<?=$data["material_name"]?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ราคา</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="price" value="<?=$data["price"]?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">จำนวน</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="amount" value="<?=$data["amount"]?>">
    </div>
  </div>
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=material/material-part/index';">ยกเลิก</button>
</center>
</form>
