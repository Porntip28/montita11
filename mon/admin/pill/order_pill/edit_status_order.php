<?php
$orderStatus = include 'order_status.php';

if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM order_pill  INNER JOIN user
                                      ON order_pill.user_id = user.user_id
                                       WHERE order_pill.order_pill_id=:id");
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
  <tr><th class="text-right" width="20%">รหัสใบส่งซื้อ :</th><td><?=$data->order_pill_id?></td></tr>
  <tr><th class="text-right">ผู้สั่ง :</th><td><?=$data->name?> <?=$data->surname?> </td></tr>
    <tr><th class="text-right">วันที่ :</th><td><?=$data->date_order_pill?></td></tr>
      <tr><th class="text-right">สถานะ : <td><select name="order_status">
          <option value="1">ยังไม่ได้รับ</option>
          <option value="2">ได้รับเเล้ว</option></select>
      </tr>
  </table>

<?php

//==========================JOIN ตารางที่ต้องการเเสดงผล==============

  $query1 = $db->prepare("SELECT * FROM order_pill INNER JOIN detail_order_pill
  ON detail_order_pill.order_pill_id = order_pill.order_pill_id
  INNER JOIN pill ON pill.pill_id = detail_order_pill.pill_id
  WHERE detail_order_pill.order_pill_id = :order_pill_id");
$query1->execute([
  'order_pill_id'=> $_GET['id'],
]);
if($query1->rowCount()>0){
  $rows = $query1->fetchAll(PDO::FETCH_OBJ);
}
 ?>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รหัสยา</th>
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
            <input type="text" name="pill_id[<?= $key ?>]" value="<?= $val->pill_id; ?>" > <!-- ส่งค่า$key เเละ pill_idไปเพื่อจะอัพเดท-->
          </td>
          <td><?=$val->pill_name?></td>
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

<p><a href="?file=pill/order_pill/history_order_pill" class="btn btn-info" role="button">กลับ</a>

<?php
if(isset($_POST['ok'])){

  $status = $_POST['order_status'];
  // $quantity = $_POST['quantity'];
  print_r($quantity);

  $query = $db->prepare("UPDATE order_pill SET
  order_status = :order_status
  WHERE order_pill.order_pill_id = :id");

  $result = $query->execute([
  "id" => $_GET["id"],
  "order_status" => $_POST["order_status"]
  ]);

//=======================update stock spare=======================
  foreach ($_POST['pill_id'] as $key => $item) :
    $query2 = $db->prepare("UPDATE pill SET
    amount = amount + :quantity WHERE pill_id = :pill_id");

    $result2 = $query2->execute([
      'pill_id' => $_POST['pill_id'][$key],
      'quantity' => $_POST['quantity'][$key],

    ]);

  endforeach;
  echo "<script>
    alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=pill/order_pill/history_order_pill';
  </script>";
    }
 ?>
