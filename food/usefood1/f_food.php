<?php

if(isset($_GET['id'])){


if($query1->rowCount()>0){
    $data = $query1->fetch(PDO::FETCH_ASSOC);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>เพิ่มข้อมูลการให้อาหาร</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">!-->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- objecttom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
  <style>

  form{ margin-top: 40px;margin-left: 300px;}
  ::-webkit-datetime-edit-text { color: red; padding: 0 0.3em; }
  ::-webkit-inner-spin-button { display: none; }
  ::-webkit-calendar-picker-indicator { background: orange; }
  </style>
  

</head>

<body>

<div class="container font_article" style="font-size:16px;">
<br><br>
  <p class ="text-center font_article " style="font-size:40px;">เพิ่มข้อมูลการให้อาหาร</p>
  <form action="?route=f_food" method="post" >

    <?php $sql = "SELECT moo.*, stall.stall_name
    FROM moo
       INNER JOIN stall ON moo.stall_id = stall.stall_id ";
      $query = $db->prepare($sql);
      $query->execute();
    ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ชื่อสุกร :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="stall_id"  name="stall_id">
      <option selected>-- เลือกชื่อสุกร --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->stall_id; ?>"><?php echo $row->stall_name?><?php echo $row->stall_name?></option>
       <?php } ?>
      </select>
    </div>
    </div>

    <?php $sql = "SELECT * FROM food";
      $query = $db->prepare($sql);
      $query->execute();
    ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ชื่ออาหาร :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="food_id"  name="food_id">
      <option selected>-- เลือกชื่ออาหาร --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
          <script>
          console.log("<?php echo $row->food_name ?>");
          </script>
         <option value="<?php echo $row->food_id; ?>"><?php echo $row->food_name?><?php echo $row->amount ?></option>
       <?php } ?>
      </select>
    </div>
    </div>
  
   <div class="form-group row ">
   <label class="col-sm-2 " >จำนวน :</label>
   <div class="col-sm-10">
     <input type="number" class="form-control form-control-sm border border-secondary <?php if(isset($errors['amount']))
     { echo " is-invalid";}?>" style="width:250px; font-size:20px" id="amount"  name="amount" value="<?= @$_POST['amount'] ?>" >
     <div class="invalid-feedback"><?php if(isset($errors['amount'])){ echo $errors['amount'];}?></div>
   </div>
   </div>


   <div class="form-group row">
   <label class="col-sm-2 ">วันที่ผลิต :</label>
   <div class="col-sm-10">
     <input type="date" class="form-control-sm border border-secondary
     <?php if(isset($errors['date_use'])){ echo " is-invalid";}?>"
     style="font-size:20px;padding:0px;" id="date_use"  name="date_use" value="<?= @$_POST['date_use'] ?>" >
     <div class="invalid-feedback"><?php if(isset($errors['date_use'])){ echo $errors['date_use'];}?></div>
   </div>
   </div>




   <?php $sql = "SELECT * FROM employee";
      $query = $db->prepare($sql);
      $query->execute();
     ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ชื่อพนักงาน :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:16px"  id="em_id"  name="em_id" required>
      <option selected>-- เลือกชื่อพนักงาน --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->em_staff; ?>"><?php echo $row->em_name?></option>
       <?php } ?>
      </select>
    </div>
    </div>
    <div class="form-group">
      <div class="col-sm-7 text-center ">
        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
        <a href="?route=s_food" <button type ="cancle"class="btn btn-warning" >ยกเลิก</button> </a>
      </div>
    </div>

  </form>
</div>

</body>
</html>

