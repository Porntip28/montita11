<?php
if(isset($_POST['submit'])){
  // print_r($_POST);
  $query = $db->prepare('INSERT INTO install_pay (installment_id,month_pay, amount_pay ,install_date)
                                        VALUES (:installment_id,:month_pay, :amount_pay ,:install_date)');
  $result = $query->execute([
  'installment_id' =>$_POST['installment_id'],
  'month_pay' =>$_POST['month_pay'],
  'amount_pay' =>$_POST['amount_pay'],
  'install_date' =>date('Y-m-d h:i:s'),

]);
echo "<script>
      alert('บันทึกข้อมูลเรียบร้อยแล้ว')
      window.location = '?file=salling/install/update&id=".$_GET['id']."'
      </script>";
}
  //===========================================
if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM salling  INNER JOIN user
                          ON salling.user_id = user.user_id
                          WHERE salling.sale_id = :id");
  $query->execute([
    'id'=>$_GET['id']
  ]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_ASSOC);
  }
?>
<br>
<div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
  </div>
<table class="table ">
<tr><th class="text-right" width="20%">รหัสการขาย :</th><td><?=$data['sale_id']?></td></tr>
  <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data['date_sale']))?></td></tr>
    <tr><th class="text-right">ชื่อลูกค้า : </th><td><?=$data['name']?> <?=$data['surname']?></td></tr>
</table>
<!--===================เเสดงผล=======================-->
<?php
  $query2 = $db->prepare("SELECT * FROM salling INNER JOIN moo
                          ON salling.moo_id = moo.moo_id
                         INNER JOIN installment ON installment.sale_id = salling.sale_id
                         WHERE salling.sale_id = :sale_id");
    $query2->execute([
      'sale_id'=>$_GET['id']
    ]);
    if($query2->rowCount()>0){
      $data2 = $query2->fetch(PDO::FETCH_ASSOC);
}
  ?>
      <?php
      $i=0;
      $sale = 0;
      $sale_price = 0; //ราคาขายหลังหักจากเงินดาวน์
      $price_all = 0;  //จำนวนเงินที่ต้องจ่ายทั้งหมด
      $sale_install = 0; //ดอกเบี้ยต่องวด
      $sum = 0;
      $Profit = 0;
              $sale = $data2['price_sale'];
              $sale_price = $data2['price_sale'] - $data2['down'];    //1 ราคาหลังหักจากเงินดาวน์ = ราคาขาย - เงินดาวน์
              $sale_install = ($sale_price * 0.5)/100;               //2 ดอกเบี้ต่องวด = (ราคาหลังหักจากเงินดาวน์ * 0.5)/100  (คำนวณดอกเบี้ยต่องวด)
              $sale_parice = $sale_price / $data2['month'];         //3 ราคาต่องวด = ราคาหลังหักจากเงินดาวน์ / จำนวนงวด
              $price_all = $sale_parice + $sale_install;            // 4  เงินที่ต้องจ่ายต่องวด = ราคาหลังหักจากเงินดาวน์ + ดอกเบี้ต่องวด
              $sum = $price_all * $data2['month']+ $data2['down'];  //5 รวมค่าหมูทั้งสิ้น = เงินที่ต้องจ่ายต่องวด * จำนวนงวด + เงินดาวน์
              $Profit = $sum- $data2['buy_price'];             //กำไร
         ?>
<table>
  <tr>
    <td>
      <center><b><font color="red">*** คุณได้เลือกการชำระแบบแบ่งชำระ ***</font></b></center>
      <div class="text-left" style="border:1px solid;padding: 10px;border-radius: 20px;">

        <b>รุ่นสุกร :</b> &nbsp;&nbsp;<?=$data2['gene']?>&nbsp;&nbsp;&nbsp;&nbsp;
        <b>น้ำหนัก :</b> &nbsp;&nbsp; <?=$data2['weight']?><br>
        <b>เบอร์หูสุกร:</b>&nbsp;&nbsp;  <?=$data2['moo_number']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>เพศ:</b>&nbsp;&nbsp;<?=$data2['sex']?><br>
      <hr>
      <b>ราคาหมู :</b> <?=number_format($sale,2,'.',',');?><b>  บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
      <b>ราคาหมูที่ต้องแบ่งจ่าย :</b> <?=number_format($sum,2,'.',',');?><b>  บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <b>แบ่งจ่ายเป็นระยะเวลา :</b> <?=$data2['month'];?> <b> เดือน</b>&nbsp;&nbsp;
      <b>ดอกเบี้ยต่อเดือน : </b><?=number_format($sale_install,2,'.',',');?>&nbsp; <b>บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
      <b>ชำระครั้งแรก :</b> <?=number_format($data2['down'],2,'.',',');?><b>  บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
     <b>ชำระเดือนละ : </b><font color="red"><?=number_format($price_all,2,'.',',');?></font><b>&nbsp;บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <b>กำไร : </b><font color="green"><?=number_format($Profit,2,'.',',');?></font><b>&nbsp;บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
    <br>
    </div>
    </td>
  </tr>
</table>
<p><p><p>
  <!--=======================================--->
  <?php
    $query_count = $db->prepare("SELECT COUNT(install_pay.amount_pay) as rowAmount,installment.month FROM install_pay
                            INNER JOIN installment ON installment.installment_id = install_pay.installment_id
                            INNER JOIN salling ON salling.sale_id = installment.sale_id
                            WHERE installment.sale_id = :sale_id");
      $query_count->execute([
        'sale_id'=>$_GET['id']
      ]);
        $data_count = $query_count->fetch(PDO::FETCH_ASSOC);
  if($data_count['rowAmount'] == 0 || $data_count['rowAmount'] != $data_count['month']){?>
  <hr><br>
  <?php $a = $data_count['month']-$data_count['rowAmount'] ?>
  <center><font color="red">จำนวนงวดคงเหลือที่คุณต้องจ่าย&nbsp;&nbsp;<?=$a?>&nbsp;&nbsp;งวด</font></center>
  <form method="post" action="" >
    <div class="" id="install" name="installment_id">
            <div class="row">
              <div class="col-9">
                <label for="id">เพิ่มรายการแบ่งจ่ายในแต่ละงวด</label>
                <div class="row">
                  <div class="col-3">
                  <input type="number" class="form-control" value="" style="display:none;" id="month_pay" name="month_pay">
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-3">
                  <input type="text" class="form-control" value="" style="display:none;" placeholder="ราคาต่องวด" name="amount_pay">
                 </div>
                </div>
              </div>
               </div>
               <input type="hidden" name="installment_id" value="<?=$data2['installment_id']?>">
            <p><p>
      </div>
      <button class="btn btn-success" value="add" id="add">+</button>
      <button type="submit" value="submit" name="submit"  class="btn btn-success">บันทึกรายการ</button><p>

  </form>
<?php
}else { ?>
  <!--=============================-->
    <b><center><font color="green">ชำระหมดแล้ว  ยินดีด้วยนะคะ !!!</font></center></b><br>

 <?php
 $query_pay = $db->prepare("UPDATE installment SET
  status_pay = :status_pay
  WHERE sale_id = :id");

  $result_pay = $query_pay->execute([
  "id" => $_GET["id"],
  'status_pay' => 2,
  ]);
}?>
<!--=======================================--->
<?php
  $query3 = $db->prepare("SELECT * FROM install_pay INNER JOIN installment
                          ON install_pay.installment_id = installment.installment_id
                          INNER JOIN salling ON salling.sale_id = installment.sale_id
                          WHERE installment.sale_id= :sale_id");
    $query3->execute([
      'sale_id'=>$_GET['id']
    ]);
    if($query3->rowCount()>0){
  ?>
<table class="table table-striped table-bordered cart">
  <thead>
    <tr>
      <th>ครั้งที่</th>
      <th>วันที่จ่าย</th>
      <th>จำนวนเงิน/ครั้ง</th>
    </tr>
  </thead>
<tbody>
  <?php
$sum = 0;
  while($value = $query3->fetch(PDO::FETCH_ASSOC)){
    $sum = $sum + $value['amount_pay'];
    ?>
  <tr>
    <td><?= $value['month_pay']?></td>
    <td><?php echo date("d-m-Y", strtotime ($value['install_date']))?></td>
    <td><?=number_format($value['amount_pay'],2,'.',',')?></td>
  </tr>
<?php  }
} ?>
</tbody>
  <tfoot>
    <tr>
      <td colspan="2" class="text-right">
        <b>รวมทั้งหมด</b>
      </td>
      <td><font color="red"><?=number_format($sum,2,'.',',');?></font> <b>บาท<b></td>
    </tr>
  </tfoot>
    <table>
<?php } ?>
  <p><center>
  <button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=salling/install/index';">กลับ</button>
</center>
<!--==============-->
<script>
  $(document).ready(function(){
    var i = 0;
    $('#add').click(function(e){
    i++;
      $('#install').append(
        '<div class="row"><div class="col-3"><input type="number" class="form-control" value="" id="month_pay" name="month_pay"'
        + i +'"></div><div class="col-3"><input type="text" class="form-control" id="amount_pay" placeholder="ราคาต่องวด" name="amount_pay"'
        + i +'"><p></div><p></div>')

      e.preventDefault();
    });
});

</script>
