<?php
if(isset($_POST['ok'])){
  $query = $db->prepare("UPDATE stall SET
  stall_name = :stall_name

  WHERE stall.stall_id = :id;");

  $result = $query->execute([
  "id" => $_GET["id"],
  "stall_name" => $_POST["stall_name"]
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
}
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM stall WHERE stall_id = :id");
$query->execute([
'id'=>$_GET['id']
]);//รัน sql
    $data = $query->fetch(PDO::FETCH_OBJ);
  }
?>
<form method="post">
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อคอก</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="stall_name" value="<?=$data->stall_name?>">
    </div>
  </div>
  
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=moo/stall/index';">ยกเลิก</button>
</center>
</form>
