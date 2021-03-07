<?php
if(isset($_POST['ok'])){
  $query = $db->prepare("UPDATE user SET
  name = :name,
  surname = :surname,
  email = :email,
  tel = :tel,
  address = :address,
  username = :username,
  password = :password
  WHERE user.user_id = :id;");

  $result = $query->execute([
  "id" => $_GET["id"],
  "name" => $_POST["name"],
  "surname" => $_POST["surname"],
  "email" => $_POST["email"],
  "tel" => $_POST["tel"],
  "address" => $_POST["address"],
  "username" => $_POST["username"],
  "password" => $_POST["password"]
  ]);
if($result){
echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
window.location = '?file=user/index';
      </script>";
}else{
echo "<script>
alert('Save fail! '".$query->errorInfo()[2].");
      </script>";
}
}
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM user WHERE user_id = :id");
$query->execute([
'id'=>$_GET['id']
]);
    $data = $query->fetch(PDO::FETCH_OBJ);
  }
?>
<form method="post">
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="name" value="<?=$data->name?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">นามสกุล</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="surname" placeholder="นามสกุล" value="<?=$data->surname?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control form-control-sm" name="email"  placeholder="Email" value="<?=$data->email?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ที่อยู่</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="address" placeholder="ที่อยู่" value="<?=$data->address?>">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์ติดต่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="tel" placeholder="เบอร์ติดต่อ" value="<?=$data->tel?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="username" placeholder="Username" value="<?=$data->username?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control form-control-sm"  name="password" placeholder="Password" value="<?=$data->password?>">
    </div>
  </div>



<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=user/index';">ยกเลิก</button>
</center>
</form>
