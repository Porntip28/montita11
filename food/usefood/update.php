<?php
$out_date = date("Y-m-d");
 date_default_timezone_set('Asia/Bangkok');
if(isset($_POST['ok'])){
    $query = $db->prepare("UPDATE usefood SET
                                stall_id = :stall_id,
                                food_id =  :food_id
                                WHERE usefood_id = :id");

                  $result_mo = $query->execute([
                  "id" => $_GET["id"],
                  "stall_id" => $_POST["stall_id"],
                  "food_id" => $_POST["food_id"],
                    ]);
    //=================================================
                  

      echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
      window.location = '?file=food/usefood/index';
            </script>";
                  }
  // }else{
  //     echo "<script>
  //     alert('Save fail! '".$query->errorInfo()[2].");
  //           </script>";
  //         }
        
        
      //ขั้น1========================================================
if(isset($_GET['id'])){
$query1 = $db->prepare("SELECT * FROM usefood WHERE usefood_id = :id");
$query1->execute([
'id'=>$_GET['id'],

]);

if($query1->rowCount()>0){
    $data = $query1->fetch(PDO::FETCH_ASSOC);

  }
}
?>
<form method="post" enctype="multipart/form-data" action="">
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


  <?php $sql = "SELECT * FROM stall";
      $query = $db->prepare($sql);
      $query->execute();
     ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ชื่อคอก :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="stall_id"  name="stall_id" required>
      <option selected>-- เลือกคอก --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->stall_id; ?>"><?php echo $row->stall_name?></option>
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
      style="width:250px; font-size:20px"  id="food_id"  name="food_id" required>
      <option selected>-- เลือกอาหาร --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->food_id; ?>"><?php echo $row->food_name?></option>
       <?php } ?>
      </select>
    </div>
    </div>
<p></p>

<br> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=food/usefood/index';">ยกเลิก</button>
</center>
</form>
<!--=================-->
 <script>
    $(document).ready(function(){

        $('#repeater').createRepeater();

        $('#repeater_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:"update.php",
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