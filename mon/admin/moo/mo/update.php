
<?php
if(isset($_POST['ok'])){

  $buyPrice = $_POST['buy_price'];
  $Weight= $_POST['weight'];
  $salePrice = 0;

  if($buyPrice >= 0 && $buyPrice <= 1500){
    $salePrice = $buyPrice *$Weight  + 1950;
  }elseif ($buyPrice >= 1501 && $buyPrice <= 3500) {
    $salePrice = $buyPrice *$Weight  + 2450;
  }elseif ($buyPrice >= 3001 && $buyPrice <= 5000){
    $salePrice = $buyPrice * $Weight + 3000;
  }else {
      $salePrice = $buyPrice *$Weight  + 3450;
  }

  $file= $_FILES['image']['name'];
  $file_tmp_name = $_FILES['image']['tmp_name'];
  $folder = "C:/xampp/htdocs/montita/mon/image/".$file;
// print_r($_POST);
// print_r($_FILES);
if(move_uploaded_file($file_tmp_name,$folder)){
    $query = $db->prepare("UPDATE moo SET
                                moo_number = :moo_number,
                                stall_id = :stall_id,
                                statusmoo_id = :statusmoo_id,
                                weight=:weight,
                                ma_number = :ma_number,
                                fa_number = :fa_number,
                                price_sale = :price_sale,
                                image = :image,
                                status_mo = :status_mo
                                WHERE moo_id = :id");

                  $result_mo = $query->execute([
                  "id" => $_GET["id"],
                  "moo_number" => $_POST["moo_number"],
                  "stall_id" => $_POST["stall_id"],
                  "statusmoo_id" => $_POST["statusmoo_id"],
                  "ma_number" => $_POST["ma_number"],
                  "fa_number" => $_POST["fa_number"],
                  "weight"=>$_POST["weight"],
                  "price_sale" => $salePrice,
                  "status_mo" => $_POST["treat"],
                  "image" => $file,
                    ]);
    //=================================================
  
//============================== //insert ลงตารางซ่อมหากมีสถานะเป็น ซ่อม
            if($result_mo){
              if($_POST["detail"]){
              $query_mo = $db->prepare("INSERT INTO treat
                                        (moo_id, detail_treat, status_treat, treat_date)
                                        VALUES (:moo_id ,:detail_treat, :status_treat, :treat_date)");
                  $result_treat = $query_mo->execute([
                  "moo_id" => $_GET["id"],
                  "detail_treat" => $_POST["detail"],
                  "status_treat" => 0,
                  "treat_date" => 0,
                    ]);
                  }
            }
//=================================================================





      echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')
      window.location = '?file=moo/mo/index';
            </script>";
  }else{
      echo "<script>
      alert('Save fail! '".$query->errorInfo()[2].");
            </script>";
          }
    }

      //ขั้น1========================================================
if(isset($_GET['id'])){
$query1 = $db->prepare("SELECT * FROM moo WHERE moo_id = :id");
$query1->execute([
'id'=>$_GET['id'],

]);

if($query1->rowCount()>0){
    $data = $query1->fetch(PDO::FETCH_ASSOC);

  }
}
?>



<form method="post" enctype="multipart/form-data" action="">



  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์หูสุกร</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="moo_number" value="<?=$data["moo_number"]?>">
    </div>
  </div>
  
          
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">น้ำหนัก</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="weight" value="<?=$data["weight"]?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์หูแม่</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="ma_number" value="<?=$data["ma_number"]?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">เบอร์หูพ่อ</label>
    <div class="col-sm-10">
      <input type="text" class="form-control form-control-sm"  name="fa_number" value="<?=$data["fa_number"]?>">
    </div>
  </div>

 
  <input type="hidden" name="buy_price" value="<?=$data["buy_price"]?>">
  
  

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">รูป</label>
    <div class="col-sm-10">
      <input type="file" class="form-control-file form-control-sm"  name="image" value="<?=$data["image"]?>">
    </div>
  </div>
 
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">ตรวจสอบสภาพสุกร</label>
    <div class="col-sm-10">
    <div class="form-check">

    <input type="radio" name="treat" value="1" data-target="motreat"  class="form-check-input treat" > ป่วยต้องรักษา <br>
      <input type="text" name="detail" value="" style="display:none;"  placeholder="รายละเอียดที่ต้องซ่อม" class="form-control detailForm">

      <input type="radio" name="treat" value="2" class="form-check-input"> พร้อมขาย<br>
      <input type="radio" name="treat" value="7" class="form-check-input"> กำลังเลี้ยง
    </div>
    </div>
  </div>
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

    <?php $sql = "SELECT * FROM statusmoo";
      $query = $db->prepare($sql);
      $query->execute();
     ?>
    <div class="form-group row">
    <label class="col-sm-2 ">ระยะสุกร :</label>
    <div class="col-sm-10">
      <select type="text" class="form-control form-control-sm border border-secondary"
      style="width:250px; font-size:20px"  id="statusmoo_id"  name="statusmoo_id" required>
      <option selected>-- ระยะสุกร --</option>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
         <option value="<?php echo $row->statusmoo_id; ?>"><?php echo $row->statusmoo_name?></option>
       <?php } ?>
      </select>
    </div>
    </div>
    
    
<p></p>

<center>
<button type="submit" class="btn btn-success" name='ok'>บันทึก</button>
<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=moo/mo/index';">ยกเลิก</button>
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