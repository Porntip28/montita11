<?php
if(isset($_GET['del'])){
  unset($_SESSION['cart'][$_GET['del']]);
  echo "<script>
    alert('ลบข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=material/order_material/material-cart';
  </script>";
}
//======================================
if(isset($_POST['update']) || isset($_POST['confirm'])){

  foreach($_POST['amount'] as $key => $val){
    $_SESSION['cart'][$key]['amount'] = $val;
  }
  if(isset($_POST['confirm'])){
    echo "<script>
          window.location = '?file=material/order_material/material-confirm';
          </script>";

  }else{
    echo "<script>
    window.location = '?file=material/order_material/material-cart';
    </script>";
  }
}
if(isset($_GET['material_id'])){              //ตรวจสอบว่าถ้ามีรายการอะไหล่ที่เลือกเเล้ว พอกดอีกครั้งก็มไม่ให้ขึ้น
  $query = $db->prepare("SELECT * FROM material WHERE material_id= :material_id");
  $query->execute([ //เตรียมปฏิบัติการที่จะselectข้อมูล
    'material_id'=>$_GET['material_id']
  ]);
  if($query->rowCount()>0){                    //ตรวจสอบว่าค่าที่มีจากการselectมีกี่เเถว
    $data = $query->fetch(PDO::FETCH_OBJ);
     $_SESSION['cart'][$data->material_id]=[
      'item'=>$data,
      'amount'=>1
    ];
    echo "<script>
          window.location = '?file=material/order_material/material-cart';
          </script>";
  }
}
?>
<div class="row">
<div class="col-sm-12">
<?php
if(isset($_SESSION['cart'])):

?>
<form class="" action="" method="post">
<br><br>
<p><a href="?file=material/material-part/index" class="btn btn-info" role="button">เลือกอะไหล่เพิ่ม</a>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รายการ</th>
        <th>ราคา</th>
        <th>จำนวน</th>
        <th>รวม</th>
        <th>...</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $price_total = 0;

      foreach($_SESSION['cart'] as $key=> $val):   ?>              <!--ให้$_SESSION['cart']ชี้ไปที่ตัวเเปร$key=> $val   ($key แทน อะไหล่ ,$valแทนจ ำนวน )-->
      <?php $price_all = $val['item']->price * $val['amount'];    //รวมราคาต่อชิ้น
            $price_total=$price_total+$price_all;                 //รวมราคาทั้งหมด
       ?>

      <tr >
        <td><?=++$i;?></td>                                      <!--ส่วนของการเเสดงรายการอะไหล่ที่เลือก -->
        <td><?=$val['item']->material_name?></td>
        <td><?=$val['item']->price?></td>
        <td><input type="number" value="<?=$val['amount']?>" min="1" name="amount[<?=$key?>]"/></td>
        <td><?=number_format($price_all); ?>
          <!-- ตรวจสอบให้เซ็ตค่าที่คำนวณ -->
        </td>
        <td><a href="?file=material/order_material/material-cart&del=<?=$key?>" class="text-danger"><i class="fas fa-trash-alt "></i></a></td>
      </tr>
    <?php endforeach;?>
    <tr>
      <td colspan="10" class="text-right" name="price" value="<?=number_format($price_total);?> ">ราคารวมทั้งหมด  &nbsp;  &nbsp; <?=number_format($price_total);?>  &nbsp;  &nbsp;  บาท
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="10" class="text-right">
        <input type="submit"  name="update" value="บันทึก" class="btn btn-danger">
        <?php  if(isset($_SESSION['user'])){   ?>      <!--เช็คว่า session มีค่าไหม -->
          <input type="submit" name="confirm" value="ยืนยันการสั่งซื้อ" class="btn btn-success">
        <?php }else{ ?>
          <input type="button" name="confirm" value="ยืนยัน" class="btn btn-success" disabled="">
          <a  class="btn btn-link" onclick="alert('กรุณาเข้าสู่ระบบก่อน'); $('#username').focus(); return false;">กรุณาเข้าสู่ระบบก่อน</a>

        <?php }?>
      </td>
    </tr>
  </tfoot>
</table>
</form>
<?php
endif;
 ?>
</div>
</div>

<p>&nbsp; &nbsp; <a href="?file=material/material-part/index" class="btn btn-info" role="button">กลับ</a>
