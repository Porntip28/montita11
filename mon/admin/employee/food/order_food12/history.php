<?php
// $status = require('order_pill_status.php');
$orderStatus = include 'order_status.php';
if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM order_food INNER JOIN user
                                  ON order_food.user_id = user.user_id
                                  WHERE order_food.order_food_id=:id");
  $query->execute([
    'id'=>$_GET['id']
  ]);

  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
  }
 }

?>
<!-- <div id="print"> -->
  <br><br>
  <div class="text-center">
    <img src="image/ban_admin.png" width="130" class="pull-left">
    <h5>Ahamd Service ขายรถมอเตอร์ไซค์มือสอง</h5>
    100/2 หมู่2 ต.บานา อ.เมือง จ.ปัตตานี 94000
    <br>
    </div>
<div class="row">
<div class="col-sm-12">
<table class="table ">
  <tr><th class="text-right" width="20%">รหัสใบส่งซื้ออาหาร :</th><td><?=$data->order_food_id?></td></tr>
  <tr><th class="text-right">ผู้สั่ง :</th><td><?=$data->name?> <?=$data->surname?> </td></tr>
    <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data->date_order_food))?></td></tr>
    <form class="" action="?file=food/order_food/history_order_food" method="post">
      <tr><th class="text-right">สถานะ : </th><td><?=$orderStatus[$data->order_status]?></td></tr>
    </form>
  </table>
<?php
  $query1 = $db->prepare("SELECT * FROM order_food INNER JOIN detail_order_food
  ON detail_order_food.order_food_id = order_food.order_food_id
  INNER JOIN food ON food.food_id = detail_order_food.food_id
  WHERE detail_order_food.order_food_id = :order_food_id");
$query1->execute([
  'order_food_id'=> $_GET['id'],
]);
if($query1->rowCount()>0){
  $rows = $query1->fetchAll(PDO::FETCH_OBJ);
}
 ?>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
      <th>#</th>
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
      <tr >
          <td><?=++$i;?></td>
          <td><?=$val->food_name?></td>
          <td ><?=number_format($val->price,2,'.',',');?></td>
          <td><?=$val->quantity?></td>
          <td ><?=number_format($sum,2,'.',',');?></td>
      </tr>
      <?php endforeach;?>
      <tfoot>
        <tr>
          <td colspan="4" class="text-right">
            <b>รวมทั้งหมด</b>
          </td>
          <td><font color="red"><?=number_format($total,2,'.',',');?></font> <b>บาท<b></td>
        </tr>
      </tfoot>
    </tbody>
  </table>
</div>
</form>
 </table>
</div>
<!-- </div> -->
<p><a href="?file=food/order_food/history_order_food" class="btn btn-info" role="button">กลับ</a>

<!-- <center><button type="button" class="glyphicon glyphicon-print btn btn-white "  onClick=printDiv("print")> พิมพ์รายงาน</center> -->
