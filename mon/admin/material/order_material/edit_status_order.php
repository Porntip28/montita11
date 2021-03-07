<?php
$orderStatus = include 'order_status.php';

if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM order_material  INNER JOIN user
                                      ON order_material.user_id = user.user_id
                                       WHERE order_material.order_material_id=:id");
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
<form class="" action="" method="post">
<div class="row">

<div class="col-sm-12">
<table class="table ">
  <tr><th class="text-right" width="20%">รหัสใบส่งซื้อ :</th><td><?=$data->order_material_id?></td></tr>
  <tr><th class="text-right">ผู้สั่ง :</th><td><?=$data->name?> <?=$data->surname?> </td></tr>
    <tr><th class="text-right">วันที่ :</th><td><?=$data->date_order_material?></td></tr>
      <tr><th class="text-right">สถานะ : <td><select name="order_status">
          <option value="1">ยังไม่ได้รับ</option>
          <option value="2">ได้รับเเล้ว</option></select>
      </tr>
  </table>

<?php

//==========================JOIN ตารางที่ต้องการเเสดงผล==============

  $query1 = $db->prepare("SELECT * FROM order_material INNER JOIN detail_order_material
  ON detail_order_material.order_material_id = order_material.order_material_id
  INNER JOIN material ON material.material_id = detail_order_material.material_id
  WHERE detail_order_material.order_material_id = :order_material_id");
$query1->execute([
  'order_material_id'=> $_GET['id'],
]);
if($query1->rowCount()>0){
  $rows = $query1->fetchAll(PDO::FETCH_OBJ);
}
 ?>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รหัสอุปกรณ์</th>
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

<p><a href="?file=material/order_material/history_order_material" class="btn btn-info" role="button">กลับ</a>

<?php
if(isset($_POST['ok'])){

  $status = $_POST['order_status'];
  // $quantity = $_POST['quantity'];
  print_r($quantity);

  $query = $db->prepare("UPDATE order_material SET
  order_status = :order_status
  WHERE order_material.order_material_id = :id");

  $result = $query->execute([
  "id" => $_GET["id"],
  "order_status" => $_POST["order_status"]
  ]);

//=======================update stock spare=======================
  foreach ($_POST['material_id'] as $key => $item) :
    $query2 = $db->prepare("UPDATE material SET
    amount = amount + :quantity WHERE material_id = :material_id");

    $result2 = $query2->execute([
      'material_id' => $_POST['material_id'][$key],
      'quantity' => $_POST['quantity'][$key],

    ]);

  endforeach;
  echo "<script>
    alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=material/order_material/history_order_material';
  </script>";
    }
 ?>
