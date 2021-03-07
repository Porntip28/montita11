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
?>
<br><br>
<div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
  </div>
<div class="row">
<div class="col-sm-12">
<table class="table ">
<tr><th class="text-right" width="20%">รหัสการขาย :</th><td><?=$data['sale_id']?></td></tr>
  <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data['date_sale']))?></td></tr>
    <tr><th class="text-right">ชื่อลูกค้า : </th><td><?=$data['name']?> <?=$data['surname']?></td></tr>
</table>


<?php
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
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>ยี่ห้อ-รุ่น</th>
        <th>ระบบเกียร์</th>
        <th>สี</th>
        <th>เลขทะเบียน</th>
        <th>จำนวน/คัน</th>
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
              $sale_install = ($sale_price * 1.3)/100;               //2 ดอกเบี้ต่องวด = (ราคาหลังหักจากเงินดาวน์ * 1.3)/100  (คำนวณดอกเบี้ยต่องวด)
              $sale_parice = $sale_price / $data2['month'];         //3 ราคาต่องวด = ราคาหลังหักจากเงินดาวน์ / จำนวนงวด
              $price_all = $sale_parice + $sale_install;          // 4  เงินที่ต้องจ่ายต่องวด = ราคาหลังหักจากเงินดาวน์ + ดอกเบี้ต่องวด
              $sum = $price_all * $data2['month']+ $data2['down'] //5 รวมค่ารถทั้งสิ้น = เงินที่ต้องจ่ายต่องวด * จำนวนงวด + เงินดาวน์
         ?>
        <td><?=++$i;?></td>
        <td><?=$data2['gene']?></td>
        <td><?=$data2['weight']?></td>
        <td><?=$data2['sex']?></td>
        <td><?=$data2['moo_number']?></td>
        <td><?=1;?></td>
      </tr>
    <tr>
      <td colspan="10" class="text-right"><b>ราคารถ</b><font color="red"> <?=number_format($sale);?> </font><b>บาท<b></td>
      </tr>
      <table>
        <tr>
          <td>
            <center><b><font color="red">*** คุณได้เลือกการชำระแบบผ่อน ***</font></b></center><br>
            <div class="text-left" style="border:1px solid;padding: 10px;border-radius: 20px;">

              <b>ยี่ห้อ-รุ่น :</b> &nbsp;&nbsp;<?=$data2['gene']?>&nbsp;&nbsp;&nbsp;&nbsp;
              <b>ระบบเกียร์ :</b> &nbsp;&nbsp; <?=$data2['weight']?><br>
              <b>เลขทะเบียน :</b>&nbsp;&nbsp;  <?=$data2['moo_number']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <b>สี :</b>&nbsp;&nbsp;<?=$data2['sex']?><br>
            <hr>
            <b>ราคารถที่ต้องผ่อน :</b> <?=number_format($sum,2,'.',',');?><b>  บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ผ่อนเป็นระยะเวลา :</b> <?=$data2['month'];?> <b> เดือน</b>&nbsp;&nbsp;&nbsp;&nbsp;
            <b>ดอกเบี้ยต่อเดือน : </b><?=number_format($sale_install,2,'.',',');?>&nbsp; <b>บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b>เงินดาวน์ :</b> <?=number_format($data2['down'],2,'.',',');?><b>  บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
           <b>ผ่อนเดือนละ : </b><font color="red"><?=number_format($price_all,2,'.',',');?></font><b>&nbsp;บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;
          <br>
          </div>
          </td>
        </tr>
      </table>
    </tbody>
  </table>
<?php } ?>



<p><p><p><a href="?file=salling/install/index" class="btn btn-info" role="button">กลับ</a>
