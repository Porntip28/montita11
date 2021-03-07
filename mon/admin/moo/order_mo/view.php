<?php
  $orderStatus = include 'status_m.php';
if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM order_moo INNER JOIN user
                                  ON order_moo.user_id = user.user_id
                                WHERE order_moo.order_m_id=:id");
  $query->execute([
    'id'=>$_GET['id']
  ]);

  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_ASSOC);
  }
 }
?>

  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
    </div>
  <table class="table ">
   <tr><th class="text-right" width="20%">รหัสใบส่งซื้อ :</th><td><?=$data["order_m_id"];?></td></tr>
   <tr><th class="text-right">ผู้สั่ง :</th><td><?=$data['name'];?> <?=$data['surname'];?> </td></tr>
     <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data["date_order_m"]));?></td></tr>
       <tr><th class="text-right">สถานะ :</th><td><?=$orderStatus[$data["status_m"]];?></td></tr>
   </table>
 <!--=================JOIN================ เพื่อเเสดงผล-->
<?php
  $query2 = $db->prepare("SELECT * FROM order_moo INNER JOIN detail_order_m
  ON detail_order_m.order_m_id = order_moo.order_m_id
  INNER JOIN suplier ON suplier.sup_id = detail_order_m.sup_id
  INNER JOIN gene ON gene.gene_id = detail_order_m.gene_id
  WHERE detail_order_m.order_m_id = :order_m_id");

$query2->execute([
  'order_m_id'=> $_GET['id'],

]);
if($query2->rowCount()>0){
  $data1 = $query2->fetchAll(PDO::FETCH_ASSOC);
}
 ?>

<!-- ====================================================-->
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รุ่น</th>
        <th>สายพันธุ์</th>
        <th>น้ำหนัก</th>
        <th>เพศ</th>
        <th>ราคาซื้อ</th>
        <th>ร้านคู่ค้า</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sum_m=0;
      $i=0;
      foreach($data1 as $key=> $val):
        $sum_m = $sum_m + $val["buy_price"] * $val["weight"];
        ?>
      <tr >
          <td><?=++$i;?></td>
          <td><?=$val["gene"];?></td>
          <td><?=$val["gene_name"];?></td>
          <td ><?=$val["weight"];?></td>
          <td><?=$val["sex"];?></td>
          <td ><?=$val["buy_price"];?></td>
          <td ><?=$val["sup_name"];?></td>
      </tr>
<?php endforeach; ?>
      <tfoot>
        <tr>
          <td colspan="6" class="text-right">
            <b>รวมเป็นเงินทั้งสิ้น</b>
          </td>
          <td><font color="red"><?=number_format($sum_m,2,'.',',');?></font> <b>บาท<b></td>
        </tr>
      </tfoot>
    </tbody>
  </table>
<p><a href="?file=moo/order_mo/index" class="btn btn-info" role="button">กลับ</a>
