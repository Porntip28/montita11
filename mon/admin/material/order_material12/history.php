<?php
// $status = require('order_material_status.php');
$orderStatus = include 'order_status.php';
if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM order_material INNER JOIN user
                                  ON order_material.user_id = user.user_id
                                  WHERE order_material.order_material_id=:id");
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
    <img src="image/title2.png" width="130" class="pull-left">
    <h5>Ahamd Service ขายรถมอเตอร์ไซค์มือสอง</h5>
    100/2 หมู่2 ต.บานา อ.เมือง จ.ปัตตานี 94000
    <br>
    </div>
<div class="row">
<div class="col-sm-12">
<table class="table ">
  <tr><th class="text-right" width="20%">รหัสใบส่งซื้ออะไหล่ :</th><td><?=$data->order_material_id?></td></tr>
  <tr><th class="text-right">ผู้สั่ง :</th><td><?=$data->name?> <?=$data->surname?> </td></tr>
    <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data->date_order_material))?></td></tr>
    <form class="" action="?file=material/order_material/history_order_material" method="post">
      <tr><th class="text-right">สถานะ : </th><td><?=$orderStatus[$data->order_status]?></td></tr>
    </form>
  </table>
<?php
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
          <td><?=$val->material_name?></td>
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
<p><a href="?file=material/order_material/history_order_material" class="btn btn-info" role="button">กลับ</a>

<!-- <center><button type="button" class="glyphicon glyphicon-print btn btn-white "  onClick=printDiv("print")> พิมพ์รายงาน</center> -->
