<?php


if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM usematerial  INNER JOIN user
                                      ON usematerial.user_id = user.user_id
                                       WHERE usematerial.usematerial_id=:id");
  $query->execute(['id'=>$_GET['id']]);

  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
  }
 }
?>

<!-- <div id="print"> -->
  <br>
  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
    </div>
<!-- <form class="" action="" method="post"> -->
<div class="row">

<div class="col-sm-12">
<form method="post">
<table class="table ">
  <tr><th class="text-right" width="20%">รหัสใบส่งซื้อ :</th><td><?=$data->usematerial_id?></td></tr>
  <tr><th class="text-right">ผู้สั่ง :</th><td><?=$data->name?> <?=$data->surname?> </td></tr>
    <tr><th class="text-right">วันที่ :</th><td><?=$data->date_use?></td></tr>
      <tr><th class="text-right">สถานะ : <td><select name="status">
          <option value="เบิกอุปกรณ์แล้ว">เบิกอุปกรณ์แล้ว</option>
          <option value="ยกเลิกการเบิก">ยกเลิกการเบิก</option></select>
      </tr>
  </table>

<?php

//==========================JOIN ตารางที่ต้องการเเสดงผล==============
if(isset($_GET['id'])){

  $query1 = $db->prepare("SELECT * FROM usematerial INNER JOIN material
  ON usematerial.material_id = material.material_id
  WHERE usematerial.usematerial_id = :id");
$query1->execute([
  'id'=> $_GET['id'],
]);
if($query1->rowCount()>0){
  $rows = $query1->fetchAll(PDO::FETCH_OBJ);
}
}

 ?>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รหัสอาหาร</th>
        <th>รายการ</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>รวม</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $total =0;
      foreach($rows as $key=> $val):
      $sum = $val->price*$val->quantity;
      $total+=$sum;
        ?>
      <tr>
          <td><?=++$i;?></td>
          <td>
          <?php $material_id = $val->material_id;
          $quantity = $val->quantity;
          ?>

            <input type="text" name="material_id[<?= $key ?>]" value="<?= $val->material_id; ?>" > <!-- ส่งค่า$key เเละ pill_idไปเพื่อจะอัพเดท-->
          </td>
          <td><?=$val->material_name?></td>
          <td ><?=number_format($val->price,2,'.',',');?></td>

          <td>
            <input type="text" name="quantity[<?= $key ?>]" value="<?= $val->quantity; ?>">
          </td>
          <td ><?=number_format($sum,2,'.',',');?></td>
      </tr>
      <?php endforeach;?>
      <tfoot>
        <tr>
          <td colspan="4" class="text-right">
            <b>รวมทั้งหมด</b>
          </td>
          <td><font color=""><?=number_format($total,2,'.',',');?></font> <b>บาท<b></td>
        </tr>
      </tfoot>
    </tbody>
  </table>
    <center><input type="submit" class="btn btn-info" name="ok" value="อัพเดต"></center>
</div>
</form>
</div>

<p><a href="?file=material/usematerial/index" class="btn btn-info" role="button">กลับ</a>

<?php
if(isset($_POST['ok'])){

  $status = $_POST['status'];
  // $quantity = $_POST['quantity'];
  print_r($quantity);

  $query = $db->prepare("UPDATE usematerial SET
  status = '$status'
  WHERE usematerial.usematerial_id = :id");
  $result = $query->execute([
  "id" => $_GET["id"],
//   "status" => $_POST["status"],
  ]);

//=======================update stock spare=======================
 
    $query2 = $db->prepare("UPDATE material SET
    amount = amount + '$quantity' WHERE material_id = '$material_id' ");

    $result2 = $query2->execute();

  echo "<script>
    alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=material/material-part/index';
  </script>";
    }
 ?>
