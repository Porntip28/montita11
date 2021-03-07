<?php
  $errors = [];
  if ($_POST) {

   if($_POST['amount_ream'] == "") {
     $errors['amount_ream'] = 'กรุณากรอกข้อมูล';
   }
   if($_POST['date_ream'] == "") {
    $errors['date_ream'] = 'กรุณากรอกข้อมูล';
   }
   $id_material = $_POST['id_material'];
   $con = 'เบิกอุปกรณ์แล้ว';
   $dup = true;
   $less = true;
   if ($dup) {

        $query1 = $db->prepare("SELECT * FROM material WHERE material_id = '$id_material'");
                      $query1->execute();
                      while($row = $query1->fetch(PDO::FETCH_OBJ))
                			{
                          if ($row->amount< $_POST['amount_ream']) {
                            $less = false;
                          }
                          ?>
                         <script type="text/javascript">
                             alert("อุปกรณ์ไม่พอ");
                         </script>
                          <?php
                      }
  if ($less) {
  if(!$errors){
    $query = $db->prepare("INSERT INTO ream_material(id_ream, amount_ream, date_ream, em_id, id_material, status)
    VALUES (NULL,:amount_ream, :date_ream, :em_id, :id_material, :status);");
    $result = $query->execute([

    "amount_ream"=> $_POST['amount_ream'],
    "date_ream" => $_POST['date_ream'],
    "em_id" => $_POST['em_id'],
    "id_material" => $id_material,
    "status" => $con,

  ]);

  $id_material = $_POST['id_material'];
  $amount_ream = $_POST['amount_ream'];

  $query = $db->prepare("UPDATE material
  SET amount = amount - $amount_ream
  WHERE material_id = $id_material");
  $query->execute();
  header('Location: ?route=s_reammaterial'); //ล๊อกอิินเสร็จไปหน้าแรก
    exit();

  }else {

  }

  }
}
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>เพิ่มข้อมูลการเบิกอุปกรณ์</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">!-->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
  <style>

  form{
    margin-top: 40px;margin-left: 300px;
  }
  ::-webkit-datetime-edit-text { color: red; padding: 0 0.3em; }
  ::-webkit-inner-spin-button { display: none; }
  ::-webkit-calendar-picker-indicator { background: orange; }
  </style>

</head>

<body>

<div class="container font_article">
<br><br>
  <p class ="text-center font_article " style="font-size:40px;">เพิ่มข้อมูลการเบิกอุปกรณ์</p>
  <form action="?route=f_reammaterial" method="post" >
    <?php $sql = "SELECT * FROM employee";
      $query = $db->prepare($sql);
      $query->execute();
    ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ชื่อพนักงาน :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="em_id"  name="em_id">
      <option selected>-- เลือกชื่อพนักงาน --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
          <script>
          console.log("<?php echo $row->em_name ?>");
          </script>
         <option value="<?php echo $row->em_id; ?>"><?php echo $row->em_name?></option>
       <?php } ?>
      </select>
    </div>
    </div>

    <?php $sql = "SELECT * FROM material";
      $query = $db->prepare($sql);
      $query->execute();
    ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ชื่ออุปกรณ์ :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="id_material"  name="id_material">
      <option selected>-- เลือกชื่ออุปกรณ์ --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
          <script>
          console.log("<?php echo $row->name_staff ?>");
          </script>
         <option value="<?php echo $row->material_id; ?>"><?php echo $row->material_name?></option>
       <?php } ?>
      </select>
    </div>
    </div>

   <div class="form-group row ">
   <label class="col-sm-2 " >จำนวน :</label>
   <div class="col-sm-10">
     <input type="number" class="form-control form-control-sm border border-secondary <?php if(isset($errors['amount_ream'])){ echo " is-invalid";}?>" style="width:250px; font-size:20px" id="amount_ream"  name="amount_ream" value="<?= @$_POST['amount_ream'] ?>" >
     <div class="invalid-feedback"><?php if(isset($errors['amount_ream'])){ echo $errors['amount_ream'];}?></div>
   </div>
   </div>

    <div class="form-group row">
    <label class="col-sm-2 ">วันที่เบิก :</label>
    <div class="col-sm-10">
      <input type="date" class="form-control-sm border border-secondary
      <?php if(isset($errors['date_ream'])){ echo " is-invalid";}?>"
      style="font-size:20px;padding:0px;" id="date_ream"  name="date_ream" value="<?= @$_POST['date_ream'] ?>" >
      <div class="invalid-feedback"><?php if(isset($errors['date_ream'])){ echo $errors['date_ream'];}?></div>
    </div>
    </div>

    <div class="form-group">
      <div class="col-sm-7 text-center ">
        <button type="submit" class="btn btn-primary">เพิ่มข้อมูล</button>
        <a href="?route=s_reammaterial" <button type ="cancle"class="btn btn-warning" >ยกเลิก</button> </a>
      </div>
    </div>

  </form>
</div>

</body>
</html>
