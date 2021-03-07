<?php
if(isset($_POST['ok'])){
  $query = $db->prepare("UPDATE gene SET
  gene_name = :gene_name

  WHERE gene.gene_id = :id;");

  $result = $query->execute([
  "id" => $_GET["id"],
  "gene_name" => $_POST["gene_name"]
  ]);
if($result){
echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
window.location = '?file=moo/gene/index';
      </script>";
}else{
echo "<script>
alert('Save fail! '".$query->errorInfo()[2].");
      </script>";
}
}
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM gene WHERE gene_id = :id");
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
      <input type="text" class="form-control form-control-sm"  name="gene_name" value="<?=$data->gene_name?>">
    </div>
  </div>
  
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=moo/gene/index';">ยกเลิก</button>
</center>
</form>
