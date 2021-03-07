<?php
$out_date = date("Y-m-d");
 date_default_timezone_set('Asia/Bangkok');
if(isset($_POST['ok'])){
  foreach ($_POST['food_id'] as $key => $item) :
  // print_r($_POST);
  $query = $db->prepare('INSERT INTO usefood (food_id,stall_id,date_use,user_id,quantity)
                                        VALUES (:food_id,:stall_id,:out_date,:user_id,:quantity)');
  $result = $query->execute([
  "food_id"=>$_POST["food_id"][$key],
  "stall_id"=>$_POST["stall_id"][$key],
  "user_id"=>$_POST["user_id"][$key],
  "out_date"=>date('Y-m-d h:i:s'),
  "quantity"=>$_POST["quantity"],
]); 
endforeach;
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=food/usefood/index';
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
  
  <?php $query = $db->prepare("SELECT * FROM stall");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <div class="form-group row">
             <div class="col-5">
               <label for="id">ชื่ออาหาร</label>
               <select class="form-control" name="stall_id[]" id="stall_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->stall_id?>"><?=$value->stall_name?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          </div>





    <?php $query = $db->prepare("SELECT * FROM food");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <div class="form-group row">
             <div class="col-5">
               <label for="id">ชื่ออาหาร</label>
               <select class="form-control" name="food_id[]" id="food_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->food_id?>"><?=$value->food_name?></option>
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
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=food/usefood/index';">ยกเลิก</button>
</center>
</form>
<!--=======================================-->

<?php
if(isset($_POST['ok'])){
 

//=======================update stock spare=======================
  foreach ($_POST['food_id'] as $key => $item) :
    $query1 = $db->prepare("UPDATE food SET
    amount = amount - :quantity WHERE food_id = :food_id");

    $result = $query1->execute([
      'food_id' => $_POST['food_id'][$key],
      'quantity' => $_POST['quantity'][$key],

    ]);

  endforeach;
 
          echo "<script>
            alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
                window.location = '?file=food/usefood/index';
          </script>";
   }
 ?>
