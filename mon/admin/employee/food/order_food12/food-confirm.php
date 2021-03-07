<?php
// $orderStatus = include 'order_status.php';
if(isset($_SESSION['cart'])){
      $query = $db->prepare("INSERT INTO order_food
         (date_order_food, order_status, user_id)
          VALUES (:date_order_food, :order_status, :user_id)");
          $result = $query->execute([
            'date_order_food'=>date('Y-m-d H:i:s'),
            'user_id' => $_SESSION['user']['id'],
            'order_status'=>1,

          ]);

  if($result){
    $lastId = $db->lastInsertId();
    foreach($_SESSION['cart'] as $key => $item){
      $query = $db->prepare("INSERT INTO detail_order_food
        (order_food_id, food_id, price, quantity)
       VALUES ( :order_food_id, :food_id, :price, :quantity)");

      $result = $query->execute([
        'order_food_id' => $lastId,
        'food_id' => $item['item']->pill_id,
        'price' => $item['item']->price,
        'quantity' => $item['amount'],
      ]);
    }
      unset($_SESSION['cart']);                     //clear ตะกร้า และสั่งให้มันกระโดดไปหน้าที่ต้องการ
      echo "<script>
            window.location = '?file=food/order_food/order_food_view&id=$lastId';
            </script>";
    }
}
?>
<div class="row">
<div class="col-sm-12">

<?php
if(isset($_SESSION['cart'])):
?>
<div class="text-center">
  <img src="image/ban_admin.png" width="130" class="pull-left">
  <h5>Ahamd Service ขายรถมอเตอร์ไซค์มือสอง</h5>
  100/2 หมู่2 ต.บานา อ.เมือง จ.ปัตตานี 94000
  <br>
  </div>
<hr>
  <div class="">
    ชื่อผู้สั่งซื้อ : <?=$_SESSION['user']['name']; ?> &nbsp;&nbsp;<?=$_SESSION['user']['surname']; ?>  <br>
    วันที่สั่ง :<?=date('d-m-Y h:i:s');?>
  </div>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>ลำดับ</th>
        <th>รายการ</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>รวม</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $price_total = 0;
      foreach($_SESSION['cart'] as $key=> $val):   ?> <!--ให้$_SESSION['cart']ชี้ไปที่ตัวเเปร$key=> $val   ($key แทน อะไหล่ ,$valแทนจ ำนวน )-->
      <?php $price_all = $val['item']->price * $val['amount']; //รวมราคาต่อชิ้น
            $price_total=$price_total+$price_all; //รวมราคาทั้งหมด
       ?>
      <tr >
        <td><?=++$i;?></td>
        <td><?=$val['item']->food_name?></td>
        <td><?=$val['item']->price?></td>
        <td><?=$val['amount']?></td>
        <td><?=number_format($price_all); ?></td>
      </tr>
    <?php endforeach;?>
    <tr>
      <td colspan="10" class="text-right">ราคารวมทั้งหมด  &nbsp;  &nbsp; <?=number_format($price_total);?>  &nbsp;  &nbsp;  บาท
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="10" class="text-right">
        <?php  if(isset($_SESSION['user'])){    ?>
          <input type="submit" name="confirm" value="เรียบร้อย" class="btn btn-success" >
        <?php }else{ ?>
          <input type="button" name="confirm" value="ยืนยัน" class="btn btn-success" disabled="">
          <a  class="btn btn-link" onclick="alert('กรุณาเข้าสู่ระบบก่อน'); $('#username').focus(); return false;">กรุณาเข้าสู่ระบบก่อน</a>
        <?php }?>
      </td>
    </tr>
  </tfoot>
</table>
<?php
endif;
 ?>
</div>
</div>
</div>
