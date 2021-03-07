<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO user (name, surname,email, tel, address, username, password, level, status)
                                    VALUES (:name, :surname,:email, :tel, :address, :username, :password, :level, :status ) ');
  $result = $query->execute([
  "name"=>$_POST["name"],
  "surname"=>$_POST["surname"],
  "email"=>$_POST["email"],
  "tel"=>$_POST["tel"],
  "address"=>$_POST["address"],
  "username"=>$_POST["username"],
  "password"=>$_POST["password"],
  "level"=> 2,
  "status"=> 1,
  ]);
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=employee/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h4>ข้อมูลลูกค้า</h4></center><p>
<form method="post"  >
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="name" placeholder="ชื่อ">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">นามสกุล</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="surname" placeholder="นามสกุล">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control form-control-sm" name="email"  placeholder="Email">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ที่อยู่</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="address" placeholder="ที่อยู่">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์ติดต่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="tel" placeholder="เบอร์ติดต่อ">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control form-control-sm"  name="password" placeholder="Password">
    </div>
  </div>
<p></p>
<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="reset" class="btn btn-warning">ล้างข้อมูล</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=employee/index';">ยกเลิก</button>
</center>
</form>
