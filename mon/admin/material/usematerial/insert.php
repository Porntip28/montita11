<?php
$out_date = date("Y-m-d");
 date_default_timezone_set('Asia/Bangkok');
if(isset($_POST['ok'])){
  foreach ($_POST['material_id'] as $key => $item) :
    $material_id = $_POST['material_id'];
    $con = 'เบิกอุปกรณ์แล้ว';
    $dup = true;
    $less = true;
  // print_r($_POST);
  $query = $db->prepare('INSERT INTO usematerial (material_id,date_use,user_id,quantity,status)
                                        VALUES (:material_id,:out_date,:user_id,:quantity,:status)');
  $result = $query->execute([
  "material_id"=>$_POST["material_id"][$key],
  "user_id"=>$_POST["user_id"][$key],
  "out_date"=>date('Y-m-d h:i:s'),
  'user_id' => $_SESSION['user']['id'],
  "quantity"=>$_POST["quantity"],
  "status" => $con,

]); 
endforeach;
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=material/usematerial/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }

  } ?>

<br />
<div class="text-center">
    <img src="image/title2.png" width="95" class="pull-left">
    <h5>Montita Farm ขายหมู</h5>
    30 หมู่4 ต.ย่านตาขาว อ.ย่านตาขาว จ.ตรัง 92120
    <br>
    </div>
  <hr>
<div class="">
    ชื่อผู้ใช้ : <?=$_SESSION['user']['name']; ?> &nbsp;&nbsp;<?=$_SESSION['user']['surname']; ?>  <br>
    วันที่เข้าใช้งาน :<?=date('d-m-Y h:i:s');?>
  </div><p><hr>
  <div class="container font_article" style="font-size:16px;">
<br>
  <form method="post" action="" >
  
    <?php $query = $db->prepare("SELECT * FROM material");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <div class="form-group row">
             <div class="col-5">
               <label for="id">ชื่ออุปกรณ์</label>
               <select class="form-control" name="material_id[]" id="material_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->material_id?>"><?=$value->material_name?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          </div>

          <?php $query = $db->prepare("SELECT * FROM user WHERE level='2'");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
              <div class="form-group row">
             <div class="col-5">
               <label for="id">ชื่อพนักงาน</label>
               <select class="form-control" name="user_id[]" id="user_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->user_id?>"><?=$value->name?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          </div>

  
<div class="form-group row">
<div class="col-5">
               <label for="id">จำนวน</label>
      <input type="number" class="form-control form-control-sm"  name="quantity" placeholder="จำนวน">
    </div>
  </div>

<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=material/usematerial/index';">ยกเลิก</button>
</center>
</form>
<!--=======================================-->

<?php
if(isset($_POST['ok'])){
 

//=======================update stock spare=======================
  foreach ($_POST['material_id'] as $key => $item) :
    $query1 = $db->prepare("UPDATE material SET
    amount = amount - :quantity WHERE material_id = :material_id");

    $result = $query1->execute([
      'material_id' => $_POST['material_id'][$key],
      'quantity' => $_POST['quantity'][$key],

    ]);

  endforeach;
 
          echo "<script>
            alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
                window.location = '?file=material/usematerial/index';
          </script>";
   }
 ?>
