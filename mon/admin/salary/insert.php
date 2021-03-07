<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO salary (user_id, salary,total_work ,salary_date)
                                    VALUES (:user_id, :salary,:total_work ,:salary_date) ');
  $result = $query->execute([
  "user_id"=>$_POST["name"],
  "salary"=>$_POST["salary"],
  "total_work"=>$_POST["total_work"],
  "salary_date" => $_POST["salary_date"],

  ]);
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=salary/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h5>ข้อมูลค่าตอบแทน</h5></center><p>
<form method="post"  >
  <?php $query = $db->prepare("SELECT * FROM user WHERE level = 2");
       $query->execute();
      $data = $query->fetchAll(PDO::FETCH_ASSOC);
  ?>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ชื่อพนักงาน</label>
    <select class="form-control col-6" name="name">
      <?php foreach ($data as $key => $value): ?>
          <option  value="<?=$value["user_id"]?>"><?=$value["name"]?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">วันที่ให้เงิน</label>
    <div class="col-6">
     <input type="date" name="salary_date" placeholder="วันที่ให้ค่าตอบแทน" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">จำนวนเงิน/วัน</label>
    <div class="col-6">
     <input type="text" name="salary" placeholder="จำนวนเงิน/วัน" class="form-control">
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">จำนวนวันทำงาน</label>
    <div class="col-6">
     <input type="text"  name="total_work" placeholder="วันทำงานทั้งหมด" class="form-control">
    </div>
  </div>

<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=salary/index';">ยกเลิก</button>
</center>
</form>
