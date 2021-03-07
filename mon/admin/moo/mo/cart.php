<?php

if(isset($_GET['moo_id'])){
  $query1 = $db->prepare("SELECT * FROM moo WHERE moo_id= :moo_id");
  $query1->execute([
    'moo_id'=>$_GET['moo_id']
  ]);
  if($query1->rowCount()>0){
    $data1 = $query1->fetch(PDO::FETCH_ASSOC);

?>
<div class="row">
<div class="col-sm-12">
<?php $moo_id = $_GET['moo_id']; ?>
<form class="" action="?file=moo/mo/confirm&id=<?=$moo_id?>" method="post">

  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    </div>
<hr>
  <tr><th class="text-right">วันที่ขาย :&nbsp;&nbsp;<?=date('d-m-Y h:i:s');?></td></tr>
<hr>

<div class="form-group row">
  <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อลูกค้า</label>
  <div class="col-4">
   <input type="text" name="name" placeholder="ชื่อลูกค้า" class="form-control" required>
  </div>
  <div class="col-4">
   <input type="text" name="surname" placeholder="นามสกุล" class="form-control" required>
  </div>
</div>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รุ่น</th>
        <th>น้ำหนัก</th>
        <th>เพศ</th>
        <th>เบอร์สุกร</th>
        <th>จำนวน/ตัว</th>
        <!-- <th>...</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
      $i=0;
      $price_sale = 0;?>
      <tr >
        <?php $price_sale = $data1['price_sale']; ?>
        <td><?=++$i;?></td>
        <td><?=$data1['gene']?></td>
        <td><?=$data1['weight']?></td>
        <td><?=$data1['sex']?></td>
        <td><?=$data1['moo_number']?></td>
        <td><?=1;?></td>
        </td>
      </tr>
    <tr>
      <input type="hidden" name="price_sale" value="<?=$price_sale?> ">
      <td colspan="10" class="text-right"><b>ราคาหมู</b><font color="red"> <?=number_format($price_sale);?> </font><b>บาท<b></td>
</tr>
<div class="form-group row">
  <label  class="col-sm-2 col-form-label col-form-label-sm">&nbsp;&nbsp;เลือกประเภทชำระ</label>
  <div class="col-sm-4">
  <div class="form-check">
    <input type="radio" name="pay" value="1" class="form-check-input"> จ่ายสด<br>
    <input type="radio" name="pay" value="2" data-target="motor_pay" class="form-check-input pay"> ผ่อนจ่าย
    <input type="text" name="down" value="" style="display:none;" placeholder="เงินดาวน์" class="form-control detailForm col-6"><br>
    <input type="text" name="month" value="" style="display:none;" placeholder="จำนวนงวด"  class="form-control detailForm col-6"><br>
  </div> </div>
  </div>
  <div class="form-group row">
  <label  class="col-sm-2 col-form-label col-form-label-sm">&nbsp;&nbsp;สถานะการจัดส่ง</label>
  <div class="col-sm-4">
  <div class="form-check">
    <input type="radio" name="send" value="1" class="form-check-input"> จัดส่งแล้ว<br>
    <input type="radio" name="send" value="2" class="form-check-input"> ยังไม่จัดส่ง<br>
   
  </div>
  </div>
</div>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="10" class="text-right">
        <input type="submit"  name="confirm" value="บันทึก" class="btn btn-success">
      </td>
    </tr>
  </tfoot>
</table>
<p>&nbsp; &nbsp; <a href="?file=moo/mo/index" class="btn btn-info" role="button">กลับ</a>
</form>
<?php
  }
} ?>
 <script type="text/javascript">
   $('.pay').change(function(){
     var chk = $(this)
     var inp = chk.closest('.form-check').find('.detailForm')
     if(chk.is(':checked'))
         inp.show();
     else
       inp.hide();
   });
   </script>
<script type="text/javascript">
   $('.send').change(function(){
     var chk = $(this)
     var inp = chk.closest('.form-check').find('.detailForm')
     if(chk.is(':checked'))
         inp.show();
     else
       inp.hide();
   });
   </script>
