<?php
// session_start();
require_once('connect.php');
if(isset($_POST['logout'])){ //check ปุ่ม logout
  session_start();
  unset($_SESSION['user']); // reset ค่าใน session
  header('location: index.php');
}


if(isset($_POST['login'])){  // check ปุ่ม login
  $query = $db->prepare("SELECT * FROM user WHERE username = :user AND password = :pass");
  $query->execute([
    'user'=>$_POST['username'],
    'pass'=>$_POST['password'],
  ]);
  if($query->rowCount()>0){ #กรณีมีค่ามากว่า 0 = ล็อกอินผ่าน
    $data = $query->fetch(PDO::FETCH_OBJ);
    if($data->status==1){
      $_SESSION['user'] = [
        'id'=>$data->user_id,
        'name'=>$data->name,
        'surname'=>$data->surname,
        'address'=>$data->address,
        'tel'=>$data->tel,
        'email'=>$data->email,
        'username'=>$data->username,
        'level'=>$data->level,
        'status'=>$data->status,
      ];
     header('location: index.php');
    }else{
      echo "<script>
        alert('ผู้ใช้นี้ยังไม่ได้รับอนุญาตให้ใช้งาน !');
        </script>";
    }
  }else{
    echo "<script>
      alert('ล็อกอินไม่ผ่าน !');
      </script>";
  }
}
################################################################
/*
* การแสดงผล
*/
if(isset($_SESSION['user'])){//เช็คว่า session มีค่าไหม
 #### ดึงข้อมูลมาใหม่ #########
  $query = $db->prepare("SELECT * FROM user WHERE user_id=:id");
  $query->execute([
    'id'=>$_SESSION['user']['id']
  ]);//รัน sql
  $row = $query->fetch(PDO::FETCH_OBJ);
  #### แสดงค่าที่ดึงได้ #########
?>
 <!-- แสดงฟอร์มปุ่ม logout -->
 <form class="form-inline my-2 my-lg-0" method="post">
   <button class="btn btn-outline-light my-2 my-sm-0"> <?php echo $_SESSION["user"]["username"]?></button> &nbsp;
   <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="logout">Logout</button>
 </form>
  <?php
}else{ //กรณึยังไม่ได้ login หรือ $_SESSION['user'] ไม่มีค่าอะไรอยู่
?>
<form class="form-inline my-2 my-lg-0"  method="post">
  <input class="form-control mr-sm-2" type="text" placeholder="username"  name="username" required>
  <input class="form-control mr-sm-2" type="password" placeholder="password"  name="password" required>
  <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="login">Login</button>
</form>
<?php } ?>
