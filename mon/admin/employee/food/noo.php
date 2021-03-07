<?php
if(isset($_POST['submit'])){
  // print_r($_POST);
  $query = $db->prepare('INSERT INTO usefood (food_id, moo_id,stall_id,em_id,date_use, amount)
                                        VALUES (:food_id, :moo_id, :stall_id,:em_id,:date_use ,:amount ) ');
  $result = $query->execute([
  "food_id"=>$_POST["food_id"],
  "moo_id"=>$_POST["moo_id"],
  "stall_id"=>$_POST["stall_id"],
  "em_id"=>$_POST["em_id"],
  "date_use"=>date('Y-m-d h:i:s'),
  'user_id' => $_SESSION['user']['id'],
  "amount"=>$_POST["amount"],
]); 
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
    ชื่อผู้สั่งซื้อ : <?=$_SESSION['user']['name']; ?> &nbsp;&nbsp;<?=$_SESSION['user']['surname']; ?>  <br>
    วันที่สั่ง :<?=date('d-m-Y h:i:s');?>
  </div><p><hr>
  <div class="container font_article" style="font-size:16px;">
<br>
  <form method="post" action="" >
  

    <?php $sql = "SELECT moo.*, stall.stall_name FROM moo
       INNER JOIN stall ON moo.stall_id = stall.stall_id ";
                $query = $db->prepare($sql);
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
            <div class="form-group row" >
             <div class="col-5">
               <label for="id">ชื่อสุกร</label>
               <select class="form-control" name="moo_id[]" id="moo_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->stall_id?>"><?=$value->stall_name?>"<?=$value->moo_id?>"><?=$value->moo_number?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          </div>
          <?php $query = $db->prepare("SELECT * FROM stall.*,moo.moo_number FROM stall
           INNER JOIN moo ON stall.moo_id = moo.moo_id
          ");
                  $query = $db->prepare($sql);
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
             <div class="form-group row">
             <div class="col-5">
               <label for="id">ชื่ออาหาร</label>
               <select class="form-control" name="moo_id[]" id="moo_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->moo_id?>"><?=$value->moo_number?></option>
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

          <?php $query = $db->prepare("SELECT * FROM employee");
                  $query->execute();
                 $data = $query->fetchAll(PDO::FETCH_OBJ);
             ?>
              <div class="form-group row">
             <div class="col-5">
               <label for="id">ชื่อคู่ค้า</label>
               <select class="form-control" name="em_id[]" id="em_id">
                 <?php foreach ($data as $key => $value): ?>
                     <option value="<?=$value->em_id?>"><?=$value->em_name?></option>
                 <?php endforeach; ?>

               </select>
             </div>
          </div>

  
<div class="form-group row">
<div class="col-5">
               <label for="id">ชื่อคู่ค้า</label>
      <input type="number" class="form-control form-control-sm"  name="amount" placeholder="จำนวน">
    </div>
  </div>

<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=food/food-part/index';">ยกเลิก</button>
</center>
</form>



<?php
if(isset($_POST['ok'])){


//=======================update stock spare=======================
  foreach ($_POST['food_id'] as $key => $item) :
    $query2 = $db->prepare("UPDATE food SET
    amount = amount - :quantity WHERE food_id = :food_id");

    $result2 = $query2->execute([
      'food_id' => $_POST['food_id'][$key],
      'quantity' => $_POST['quantity'][$key],

    ]);

  endforeach;
  echo "<script>
    alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=food/usefood';
  </script>";
    }
 ?>