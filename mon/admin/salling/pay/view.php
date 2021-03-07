<?php
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
  <!-- +++++++++++++++++++++++++++++++++++++++++++++ -->
  
  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
    </div>
  <br>
  </div>
<div class="row">
<div class="col-sm-12">
<table class="table ">
<tr><th class="text-right" width="20%">รหัสการขาย :</th><td><?=$data['sale_id']?></td></tr>
  <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data['date_sale']))?></td></tr>
    <tr><th class="text-right">ชื่อลูกค้า : </th><td><?=$data['name']?> <?=$data['surname']?></td></tr>
</table>


<!--====================เเสดงผลใบเสร็จแบบปกติ======================-->
<?php
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
        <th>รุ่น</th>
        <th>เบอร์หูสุกร</th>
        <th>น้ำหนัก</th>
        <th>เพศ</th>
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
        <td><?=$data1['gene'];?></td>
        <td><?=$data1['moo_number'];?></td>
        <td><?=$data1['weight'];?></td>
        <td><?=$data1['sex'];?></td>
        <td><?=1;?></td>
        </td>
      </tr>
    <tr>
      <td colspan="10" class="text-right"><b>ราคารถ</b><font color="red"> <?=number_format($price_sale);?> </font><b>บาท<b></td>
</tr>
    </tbody>
  </table>
</div>
</div>
<!-- divปริ้นรายงาน -->
</div>
<!-- <center><button type="button" class="glyphicon glyphicon-print btn btn-white "  onClick=printDiv("print")> พิมพ์รายงาน</center><p><p><p> -->
<a href="?file=salling/pay/index" class="btn btn-info" role="button">กลับ</a>
