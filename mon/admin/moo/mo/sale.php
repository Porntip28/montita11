<?php
if(isset($_GET['moo_id'])){
  $query_mo = $db->prepare("SELECT * FROM moo WHERE moo_id= :moo_id");
  $query_mo->execute([
    'moo_id'=>$_GET['moo_id']
  ]);
  if($query_mo->rowCount()>0){                    
    $data1 = $query_mo->fetch(PDO::FETCH_OBJ);
     $_SESSION['cart-mo'][$data1->moo_id]=[
      'item'=>$data1,
      'amount'=>1
    ];
    // echo "<script>
    //       window.location = '?file=spare/order_spare/spare-cart';
    //       </script>";
  }
}
?>
<form class="" action="" method="post">
  <div class="text-center">
    <img src="image/title2.png" width="130" class="pull-left">
    <h5>Ahamd Service ขายรถมอเตอร์ไซค์มือสอง</h5>
    100/2 หมู่2 ต.บานา อ.เมือง จ.ปัตตานี 94000
    <br>
    </div>
<hr>
<div class="">
  ชื่อผู้ขาย : <?=$_SESSION['user']['name']; ?> &nbsp;&nbsp;<?=$_SESSION['user']['surname']; ?>  <br>
  วันที่ขาย :<?=date('d-m-Y h:i:s');?>
</div>

<?php $query = $db->prepare("SELECT * FROM user WHERE level = 3");
     $query->execute();
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<br>
<div class="form-group row">
  <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อลูกค้า</label>
  <select class="form-control col-3" name="name">
    <?php foreach ($data as $key => $value): ?>
        <option  value="<?=$value["user_id"]?>"><?=$value["name"]?></option>
    <?php endforeach; ?>
  </select>
</div>

<table class="table table-striped table-bordered cart">
  <thead>
    <tr>
      <th>ยี่ห้อ-รุ่น</th>
      <th>ประเภทเกียร์</th>
      <th>สี</th>
      <th>เลขทะเบียน</th>

    </tr>
  </thead>
  <tbody>
    <?php
    foreach($_SESSION['cart-motor'] as $key=> $val):   ?>
    <tr>
      <td><?=$val['item']->gene?></td>
      <td><?=$val['item']->weight?></td>
      <td><?=$val['item']->sex?></td>
      <td><?=$val['item']->moo_number?></td>
      </td>
    </tr>
  <tr>
    <td colspan="10" class="text-right" name="" value="<?=$val['item']->price_sale?>">ราคารวมทั้งหมด  &nbsp;  &nbsp; <?=number_format($price_total);?>  &nbsp;  &nbsp;  บาท
<?php endforeach;?>
  </tr>
</tbody>
<tfoot>
  <tr>
    </td>
  </tr>
</tfoot>

</table>
</div>
<div class="form-group row">
  <label  class="col-sm-2 col-form-label col-form-label-sm">&nbsp;&nbsp;เลือกประเภทชำระ</label>
  <div class="col-sm-10">
  <div class="form-check">
    <input type="radio" name="pay" value="1" class="form-check-input"> จ่ายสด<br>
    <input type="radio" name="pay" value="2" data-target="motorrepair" class="form-check-input pay" > ผ่อนจ่าย
    <input type="text" name="down" value="" style="display:none;" placeholder="เงินดาวน์" class="form-control detailForm col-3"><br>
    <input type="text" name="month" value="" style="display:none;" placeholder="จำนวนงวด"  class="form-control detailForm col-3"><br>
    <input type="text" name="interest" value="" style="display:none;" placeholder="ดอกเบี้ย" class="form-control detailForm col-3"><br>
  </div>
  </div>
</div>
<p>&nbsp; &nbsp; <a href="?file=moo/moindex" class="btn btn-info" role="button">กลับ</a>

</div>

</form>

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
