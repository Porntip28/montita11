<?php
if(isset($_POST['submit'])){
  // print_r($_POST);
  $query = $db->prepare('INSERT INTO order_moo (date_order_m,status_m, user_id )
                                        VALUES (:date_order_m,:status_m, :user_id)');
  $result = $query->execute([
  "date_order_m"=>date('Y-m-d h:i:s'),
  'status_m'=>1,
  'user_id' => $_SESSION['user']['id'],

]);
if($result){
  $lastId = $db->lastInsertId();
$number = count($_POST["gene"]);
 if($number > 0)
 {
      for($i=0; $i<$number; $i++)
      {
           if(trim($_POST["gene"][$i] != ''))
           {
             $query = $db->prepare("INSERT INTO detail_order_m
                   (order_m_id, gene,gene_id, weight, buy_price, sex, sup_id )
                   VALUES ( :order_m_id, :gene, :gene_id, :weight, :buy_price, :sex ,:sup_id)");

                 $result1 = $query->execute([
                   'order_m_id' => $lastId,
                   'gene' => $_POST['gene'][$i] ,
                   'gene_id' => $_POST['gene_id'][$i] ,
                   'weight' => $_POST['weight'][$i] ,
                   'buy_price' => $_POST['buy_price'][$i] ,
                   'sex' => $_POST['sex'][$i] ,
                   'sup_id' => $_POST['sup_id'][$i] ,
                 ]);
           }
      }
          echo "<script>
                window.location = '?file=moo/order_mo/index';
                </script>";
 }
 else{
      echo "Feiled";
    }
  }
}
  ?>
  <!--==========================================-->
<br/>
  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
    </div>
  <hr>
  <div class="">
    ชื่อผู้สั่งซื้อ : <?=$_SESSION['user']['name']; ?> &nbsp;&nbsp;<?=$_SESSION['user']['surname']; ?>  <br>
    วันที่สั่ง :<?=date('d-m-Y h:i:s');?>
  </div><p><hr>

<form method="post" action="" >
  <div class="" id="ord_mo" name="ordermo">
          <div class="row">
            <div class="col-6">
              <label for="id">รุ่นสุกร</label>
                <input type="text" class="form-control"  placeholder="รุ่นสุกร" name="gene[]">
            </div>
            <?php $query = $db->prepare("SELECT * FROM gene");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <div class="col-3">
               <label for="id">สายพันธุ์</label>
               <select class="form-control" name="gene_id[]" id="gene_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->gene_id?>"><?=$value->gene_name?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          <div class="col-6">
              <label for="id">น้ำหนัก</label>
                <input type="text" class="form-control" placeholder="น้ำหนัก" name="weight[]">
            </div>
          <div class="col-3">
                <label for="id">ราคาซื้อ</label>
               <input type="text"  class="form-control"  placeholder="ราคาซื้อ" name="buy_price[]">
              </div>
          <div class="col-3">
            <label for="id">เพศ</label>
               <input type="text"  class="form-control"  placeholder="เพศ" name="sex[]">
             </div>

             <?php $query = $db->prepare("SELECT * FROM suplier");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <div class="col-3">
               <label for="id">ชื่อคู่ค้า</label>
               <select class="form-control" name="sup_id[]" id="sup_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->sup_id?>"><?=$value->sup_name?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          </div>
          <p><p>
    </div>
    <button class="btn btn-success" value="add" id="add">+</button>
    <button type="submit" value="submit" name="submit"  class="btn btn-success">บันทึกรายการ</button>
</form>
<center>
<!-- <button type="submit" class="btn btn-success" name='ok'>บันทึก</button> -->
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=moo/order_moo/index';">ยกเลิก</button>
</center>

<script>
  $(document).ready(function(){
    var i = 0;
    $('#add').click(function(e){
    i++;
      $('#ord_mo').append(
        '<div class="row"><div class="col-6"><input type="text" class="form-control" id="gene" placeholder="ยี่ห้อ" name="gene[]"'
        + i +'"></div><div class="col-3"><br><select class="form-control" id="gene_id" name="gene_id[]"'+ i +'"><?php foreach($data as $key => $value1):?><option value="<?=$value1->gene_id?>" ><?=$value1->gene_name?></option><?php endforeach;?></select><p></div>')
        + i +'"></div><div class="col-6"><input type="text" class="form-control" id="weight" placeholder="แบบ" name="weight[]"'
        + i +'"></div><div class="col-3"><br><input type="text"  class="form-control" id="buy_price" placeholder="ราคาซื้อ" name="buy_price[]"'
        + i +'"></div><div class="col-3"><br><input type="text"  class="form-control" id="sex" placeholder="สี" name="sex[]"'
        + i +'"></div><div class="col-3"><br><select class="form-control" id="sup_id" name="sup_id[]"'+ i +'"><?php foreach($data as $key => $value1):?><option value="<?=$value1->sup_id?>" ><?=$value1->sup_name?></option><?php endforeach;?></select><p></div>')


      e.preventDefault();
    });

});

</script>
