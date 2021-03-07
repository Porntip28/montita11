<?php
$status_send = include 'status_send.php';
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
<!-- สคริปต์ปริ้นรายงาน -->
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();

    document.body.innerHTML = originalContents;
}
</script>
<div id="print">
<br><br>
<div class="text-center">
  <img src="image/title2.png" width="130" class="pull-left">
  <h5>Ahamd Service ขายรถมอเตอร์ไซค์มือสอง</h5>
  100/2 หมู่2 ต.บานา อ.เมือง จ.ปัตตานี 94000

  <!-- <?php echo "data = ".print_r($data);?> -->
  <br>
  </div>
<div class="row">
<div class="col-sm-12">
<table class="table ">
<tr><th class="text-right" width="20%">รหัสการขาย :</th><td><?=$data['sale_id']?></td></tr>
  <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data['date_sale']))?></td></tr>
    <tr><th class="text-right">ชื่อลูกค้า : </th><td><?=$data['name']?> <?=$data['surname']?></td></tr>
    <tr><th class="text-right">ชื่อลูกค้า : </th><td><?=$data['status_send']?> <?=$data['status_send']?></td></tr>
    <!-- <tr><th class="text-right">สถานะ :</th><td><?=$status_send[$data->status_send]?></td></tr> -->
  </table>

<!--====================เเสดงผลใบเสร็จแบบปกติ======================-->
<?php
if($data['type_pay']==1){
$query1 = $db->prepare("SELECT * FROM salling INNER JOIN moo
                        ON salling.moo_id = moo.moo_id
                       INNER JOIN pay ON pay.sale_id = salling.sale_id
                       WHERE salling.sale_id = :sale_id");
  $query1->execute([
    'sale_id'=>$_REQUEST['id']
  ]);
  if($query1->rowCount()>0){
    $data1 = $query1->fetch(PDO::FETCH_ASSOC);
  // }else{ echo "0";}
  }

?>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รุ่นสุกร</th>
        <th>เบอร์หูสุกร</th>
        <th>เพศ</th>
        <th>น้ำหนัก</th>
        <th>จำนวน/ตัว</th>
      </tr>
    </thead>
    <tbody>

      <?php
      $i=0;
      $price_sale = 0;?>
      <tr >
        <?php $price_sale = $data1['price_sale'] ?>
        <td><?=++$i;?></td>
        <td><?=$data1['gene']?></td>
        <td><?=$data1['moo_number']?></td>
        <td><?=$data1['sex']?></td>
        <td><?=$data1['weight']?></td>
        <td><?=1;?></td>
        </td>
      </tr>
    <tr>
      <td colspan="10" class="text-right"><b>ราคาหมู</b><font color="red"> <?=number_format($price_sale);?> </font><b>บาท<b></td>
</tr>

      </tfoot>
    </tbody>
  </table>
</div>
 </table>
</div>
<!-- divปริ้นรายงาน -->
</div>
<center><button type="button" class="glyphicon glyphicon-print btn btn-white "  onClick=printDiv("print")> พิมพ์รายงาน</center>

<!--===============================เเบบผ่อน==================================================-->
<?php } else{

  $query2 = $db->prepare("SELECT * FROM salling INNER JOIN moo
                          ON salling.moo_id = moo.moo_id
                         INNER JOIN installment ON installment.sale_id = salling.sale_id
                         WHERE salling.sale_id = :sale_id");
    $query2->execute([
      'sale_id'=>$_REQUEST['id']
    ]);
    if($query2->rowCount()>0){
      $data2 = $query2->fetch(PDO::FETCH_ASSOC);
    // }else{ echo "0";}
}
  ?>
  <!-- สคริปต์ปริ้นรายงาน -->
  <script type="text/javascript">
  function printDiv(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = printContents;
      window.print();

      document.body.innerHTML = originalContents;
  }
  </script>
<div id="print">
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รุ่นสุกร</th>
        <th>เบอร์หูสุกร</th>
        <th>เพศ</th>
        <th>น้ำหนัก</th>
        <th>จำนวน/ตัว</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $sale = 0;
      $sale_price = 0; //ราคาขายหลังหักจากเงินดาวน์
      $price_all = 0;  //จำนวนเงินที่ต้องจ่ายทั้งหมด
      $sale_install = 0; //ดอกเบี้ยต่องวด
      $sum = 0;
      ?>
      <tr >
        <?php
              $sale = $data2['price_sale'];
              $sale_price = $data2['price_sale'] - $data2['down'];    //1 ราคาหลังหักจากเงินดาวน์ = ราคาขาย - เงินดาวน์
              $sale_install = ($sale_price * 0.5)/100;               //2 ดอกเบี้ต่องวด = (ราคาหลังหักจากเงินดาวน์ * 1.3)/100  (คำนวณดอกเบี้ยต่องวด)
              $sale_parice = $sale_price / $data2['month'];         //3 ราคาต่องวด = ราคาหลังหักจากเงินดาวน์ / จำนวนงวด
              $price_all = $sale_parice + $sale_install;          // 4  เงินที่ต้องจ่ายต่องวด = ราคาหลังหักจากเงินดาวน์ + ดอกเบี้ต่องวด
              $sum = $price_all * $data2['month']+ $data2['down'] //5 รวมค่ารถทั้งสิ้น = เงินที่ต้องจ่ายต่องวด * จำนวนงวด + เงินดาวน์
         ?>
        <td><?=++$i;?></td>
        <td><?=$data2['gene']?></td>
        <td><?=$data2['moo_number']?></td>
        <td><?=$data2['sex']?></td>
        <td><?=$data2['weight']?></td>
        <td><?=1;?></td>
        </td>
      </tr>
    <tr>
      <td colspan="10" class="text-right"><b>ราคาหมู</b><font color="red"> <?=number_format($sale);?> </font><b>บาท<b></td>
</tr>
      <table class="table ">
      *** คุณได้เลือกการชำระแบบผ่อน ***<p><p>
      ราคาหมูทั้งสิ้น : <?=number_format($sum);?>  บาท<p>
      ผ่อนจ่ายเป็นระยะเวลา : <?=$data2['month'];?>  เดือน<p>
      ผ่อนจ่ายเดือนละ : <?=number_format($price_all);?>  บาท<p>
      ดอกเบี้ยต่อเดือน : <?=number_format($sale_install);?>  บาท
    </table>
      </tfoot>
    </tbody>
  </table>
  <!-- divปริ้นรายงาน -->
</div><hr>
  <center><button type="button" class="glyphicon glyphicon-print btn btn-white "  onClick=printDiv("print")> พิมพ์รายงาน</center>
<?php } ?>
<?php  } ?>
<p><a href="?file=salling/sale/index" class="btn btn-info" role="button">กลับ</a>
