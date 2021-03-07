<?php

if(isset($_GET['del'])){
  unset($_SESSION['cart-food'][$_GET['del']]);
  echo "<script>
    alert('ลบข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=food/use-food/use-cart';
  </script>";
}
//======================================

if(isset($_POST['update']) || isset($_POST['confirm'])){
  // echo "<pre>";
  // print_r($_POST);
  // print_r($_SESSION['cart']);
  // echo "</pre>";
  foreach($_POST['amount'] as $key => $val){
    $_SESSION['cart-food'][$key]['amount'] = $val;

  }

  if(isset($_POST['confirm'])){

    // echo "<script>
    //     alert('สำเร็จ');
    //       window.location = '?file=food/use-food/confirm';
    //       </script>";


  }else{
    echo "<script>
    alert('ไม่สำเร็จ');
    window.location = '?file=food/use-food/index';
    </script>";

  }

}
if(isset($_GET['food_id'])){              //ตรวจสอบว่าถ้ามีรายการอะไหล่ที่เลือกเเล้ว พอกดอีกครั้งก็มไม่ให้ขึ้น
  $query = $db->prepare("SELECT * FROM food WHERE food_id= :food_id");
  $query->execute([ //เตรียมปฏิบัติการที่จะselectข้อมูล
    'food_id'=>$_GET['food_id']
  ]);
  if($query->rowCount()>0){                    //ตรวจสอบว่าค่าที่มีจากการselectมีกี่เเถว
    $data = $query->fetch(PDO::FETCH_OBJ);
     $_SESSION['cart-food'][$data->food_id]=[
      'item'=>$data,
      'amount'=>1
    ];
    // echo "<script>
    //       window.location = '?file=food/use-food/use-cart';
    //       </script>";
  }
}
?>


<div class="row">
<div class="col-sm-12">
<?php
if(isset($_SESSION['cart-food'])):
  // print_r($_SESSION['cart-food']);
?>
<form class="" action="" method="post">
<br><br>
<p><a href="?file=food/use-food/food" class="btn btn-info" role="button">เลือกอะไหล่ที่ต้องการ</a>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รายการ</th>
        <th>จำนวน</th>
        <th>...</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $price_total = 0;
      foreach($_SESSION['cart-food'] as $key=> $val):   ?>              <!--ให้$_SESSION['cart']ชี้ไปที่ตัวเเปร$key=> $val   ($key แทน อะไหล่ ,$valแทนจ ำนวน )-->

      <tr >
        <td><?=++$i?></td>                                      <!--ส่วนของการเเสดงรายการอะไหล่ที่เลือก -->
        <td><?=$val['item']->food_name?></td>
        <input type="hidden" name="food_id[<?=$key?>]" value="<?=$val['food_id']?>">
        <td><input type="number" value="<?=$val['amount']?>" min="1" name="amount[<?=$key?>]"/></td>

        </td>
        <td><a href="?file=food/use-food/use-cart&del=<?=$key?>" class="text-danger"><i class="fas fa-trash-alt "></i></a></td>
      </tr>
    <?php endforeach;?>
    <tr>
    </tr>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="10" class="text-right">
        <input type="submit"  name="update" value="บันทึก" class="btn btn-danger">
        <?php  if(isset($_SESSION['user'])){   ?>      <!--เช็คว่า session มีค่าไหม -->
          <input type="submit" name="confirm" value="เบิกอะไหล่" class="btn btn-success">
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

<p>&nbsp; &nbsp; <a href="?file=food/usefood/index" class="btn btn-info" role="button">กลับ</a>
