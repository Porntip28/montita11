<?php
if(isset($_SESSION['cart-pill'])){
  foreach ($_SESSION['cart-pill'] as $key => $value) {
    $query = $db->prepare("INSERT INTO detail_use_pill
       (treat_id, pill_id, 	quantity)
        VALUES (:treat_id, :pill_id, :quantity)");
        $result = $query->execute([
          'treat_id'=>$_POST['treat_id'],
          'pill_id' => $value['item']->pill_id,
          'quantity' => $value['quantity'],

        ]);
        }
    }
      unset($_SESSION['cart-pill']);                     //clear ตะกร้า และสั่งให้มันกระโดดไปหน้าที่ต้องการ
      echo "<script>
            window.location = '?file=manage/use-pill/index';
            </script>";
?>
<div class="row">
<div class="col-sm-12">

<?php
if(isset($_SESSION['cart-pill'])):
  //echo "<pre>";
  //print_r($_SESSION['cart']);
?>

<hr>
<form class="" action="" method="post">
  <input type="hidden" name="treat_id">
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
      $price_total = 0;

      foreach($_SESSION['cart-pill'] as $key=> $val):   ?> <!--ให้$_SESSION['cart']ชี้ไปที่ตัวเเปร$key=> $val   ($key แทน อะไหล่ ,$valแทนจ ำนวน )-->

      <!-- <?php $price_all = $val['item']->price * $val['amount']; //รวมราคาต่อชิ้น
            $price_total=$price_total+$price_all; //รวมราคาทั้งหมด
       ?> -->

      <tr >
        <td><?=++$i;?></td>
        <td><?=$val['item']->pill_name?></td>
        <!-- <td><?=$val['item']->price?></td> -->
        <td><?=$val['amount']?></td>
        <!-- <td><?=number_format($price_all); ?></td> -->

      </tr>
    <?php endforeach;?>
    <tr>
    </tr>
  </tbody>
  <tfoot>

        <tr>
          <td colspan="10" class="text-right">

            <?php  if(isset($_SESSION['user'])){    ?>  <!--เช็คว่า session มีค่าไหม -->
              <input type="submit" name="confirm" value="เรียบร้อย" class="btn btn-success" >
            <?php }else{ ?>
              <input type="button" name="confirm" value="ยืนยัน" class="btn btn-success" disabled="">
              <a  class="btn btn-link" onclick="alert('กรุณาเข้าสู่ระบบก่อน'); $('#username').focus(); return false;">กรุณาเข้าสู่ระบบก่อน</a>

            <?php }?>
          </td>
        </tr>
      </tfoot>
</form>

</table>
<?php
endif;
 ?>
</div>
</div>
</div>
