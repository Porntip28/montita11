<?php
if(isset($_POST['ok'])){
  $query = $db->prepare('INSERT INTO hybridize (user_id, hybridize_f,hybridize_m ,hybridize_date)
                                    VALUES (:user_id, :hybridize_f,:hybridize_m ,:hybridize_date) ');
  $result = $query->execute([
  "user_id"=>$_POST["name"],
  "hybridize_f"=>$_POST["hybridize_f"],
  "hybridize_m"=>$_POST["hybridize_m"],
  "hybridize_date" => $_POST["hybridize_date"],

  ]);
  if($result){
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
          window.location = '?file=hybridize/index';
          </script>";
  }else{
    echo "<script>
          alert('Save fail! '".$query->errorInfo()[2].");
          </script>";
  }
  } ?>

<br />
<center><h5>ข้อมูลการผสมพันธุ์</h5></center><p>
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
    <label  class="col-sm-2 col-form-label col-form-label-sm">วันที่บันทึกการผสมพันธุ์</label>
    <div class="col-6">
     <input type="date" name="hybridize_date" placeholder="วันที่บันทึก" class="form-control">
    </div>
  </div>

  <?php $sql = "SELECT * FROM moo";
      $query = $db->prepare($sql);
      $query->execute();
     ?>
    <div class="form-group row">
    <label class="col-sm-2 ">เบอร์หูแม่: </label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="hybridize_m"  name="hybridize_m" required>
      <option selected>-- เลือกเบอร์หูแม่ --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->moo_number; ?>"><?php echo $row->moo_number?></option>
       <?php } ?>
      </select>
    </div>
    </div>

    <?php $sql = "SELECT * FROM moo";
      $query = $db->prepare($sql);
      $query->execute();
     ?>
    <div class="form-group row">
    <label class="col-sm-2 ">เบอร์หูพ่อ: </label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="hybridize_f"  name="hybridize_f" required>
      <option selected>-- เลือกเบอร์หูพ่อ --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->moo_number; ?>"><?php echo $row->moo_number?></option>
       <?php } ?>
      </select>
    </div>
    </div>

<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=hybridize/index';">ยกเลิก</button>
</center>
</form>
<!--=================-->
<script type="text/javascript">
  $('.treat').change(function(){
    var chk = $(this)
    var inp = chk.closest('.form-check').find('.detailForm')
    if(chk.is(':checked'))
        inp.show();
    else
      inp.hide();
  });

  // $('.treat').change(function(){
  // $('.detailForm').show() //Close all div.fabricFrom
  // $('.detailForm').hide()
  // //var s = $(this).val() //s=fabricOfShop or fabricOfOwn
  // var s = $(this).data('target')
  // $('#'+s).show('fast')
// });
  </script>
 <script>
    $(document).ready(function(){

        $('#repeater').createRepeater();

        $('#repeater_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:$(this).serialize(),
                success:function(data)
                {
                    $('#repeater_form')[0].reset();
                    $('#repeater').createRepeater();
                    $('#success_result').html(data);
                }
            })
        });

    });

    </script>