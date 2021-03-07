<?php
if(isset($_POST['ok'])){
  $query = $db->prepare("UPDATE suplier SET
  sup_name = :sup_name,
  sup_tel = :sup_tel,
  sup_address = :sup_address

  WHERE suplier.sup_id = :id;");

  $result = $query->execute([
  "id" => $_GET["id"],
  "sup_name" => $_POST["sup_name"],
  "sup_tel" => $_POST["sup_tel"],
  "sup_address" => $_POST["sup_address"]
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
}
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM suplier WHERE sup_id = :id");
$query->execute([
'id'=>$_GET['id']
]);//รัน sql
    $data = $query->fetch(PDO::FETCH_OBJ);
  }
?>
<form method="post">
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="sup_name" value="<?=$data->sup_name?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์ติดต่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="sup_tel" placeholder="เบอร์ติดต่อ" value="<?=$data->sup_tel?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ที่อยู่</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="sup_address" placeholder="ที่อยู่" value="<?=$data->sup_address?>">
    </div>
  </div>
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=motorcycle/suplier/index';">ยกเลิก</button>
</center>
</form>
