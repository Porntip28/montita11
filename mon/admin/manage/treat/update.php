<?php
$status_repair = 'status_treat.php';
if(isset($_GET['id'])){

//รับค่ารหัสการซ่อม
$query1 = $db->prepare("SELECT * FROM treat WHERE treat_id = :id");
$query1->execute([
'id'=>$_GET['id'],
]);

if($query1->rowCount()>0){
    $data = $query1->fetch(PDO::FETCH_ASSOC);
  }
}
//================================================
//คิวรี่อะไหล่
$query_pill = $db->prepare("SELECT * FROM pill ");
$query_pill->execute();
$pill = $query_pill->fetchAll(PDO::FETCH_ASSOC);
?>

<form method="post" action="">
  <input type="hidden" name="moo_id" value="<?=$data["moo_id"]?>">
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">วันที่ให้ยา</label>
    <div class="col-3">
      <input type="date" class="form-control form-control-sm"  name="treat_date" value="<?=$data["treat_date"]?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">รายละเอียดการให้ยา</label>
    <div class="col-3">
      <input type="text" class="form-control form-control-sm"  name="" value="<?=$data["detail_treat"]?>" disabled>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">สถานะการรักษา</label>
    <?php
     if($data['status_treat'] == 2){
        echo "รักษาเสร็จแล้ว";
     }elseif ($data['status_treat'] == 0) {?>
    <select class="form-form-control" name="status_treat">
        <option value="0">รอการรักษา</option>
        <option value="1">กำลังรักษา</option>
        <option value="7">รักษาเสร็จเเล้ว</option>
        <option value="0">รอ</option>
      </select>
    <?php }elseif ($data['status_treat'] == 1) { ?>
      <select class="form-form-control" name="status_treat">
          <option value="1">กำลังรักษา</option>
          <option value="7">รักษาเสร็จเเล้ว</option>
          <option value="0">รอ</option>
        </select>

        <?php }elseif ($data['status_treat'] == 4) { ?>
      <select class="form-form-control" name="status_treat">
          <option value="1">กำลังรักษา</option>
          <option value="7">รักษาเสร็จเเล้ว</option>
          <option value="4">รอ</option>
          <option value="0">รอการรักษา</option>
        </select>
  <?php  } ?>
  </div>
<p></p>
<center>
  <?php  if($data['status_treat'] == 0){ ?>
    <div class="text-left">
      เลือกยารักษา
    </div>
    <p>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>รายการ</th>
        <th>จำนวน</th>
      </tr>
    </thead>
    <tbody>
  <?php
  $i=0;
  foreach ($pill as $key=> $value): ?>
  <tr >
      <td><?=++$i;?></td>
      <input type="hidden" name="treat_id" value="<?=$data["treat_id"]?>">
      <td><input type="checkbox" name="pill_id[<?=$key?>]" value="<?=$value['pill_id']?>">  <?=$value['pill_name']?></td>
      <td class=""><input type="number" value="['quantity']" min="1" class="quantity" name="quantity[<?=$key?>]"></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php
 }else {?>

<?php }?>
<button type="submit" class="btn btn-success" name='ok'>อัพเดท</button>

<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=manage/treat/index';">ยกเลิก</button>
</center>
</form>

<!--=======================================-->
<?php
if(isset($_POST['ok'])){
  foreach($_POST['pill_id'] as $key => $val){
      $_SESSION['use_pill'][$key]=[
        'pill_id' => $val,
        'quantity' => $_POST['quantity'][$key]
      ];
  }
  $status = $_POST['status_treat'];
  $treat_id = $_REQUEST['id'];
  $moo_id = $_POST['moo_id'];
  $quantity = $_POST['quantity'];

  //============================================
  $query = $db->prepare("UPDATE treat SET
                                treat_date = :treat_date,
                                status_treat = :status_treat
                                WHERE treat_id = :id");

          $result = $query->execute([
          "id" => $treat_id,
          "treat_date" => $_POST["treat_date"],
          "status_treat" =>$status ,
          ]);
//==================================================
              if($result){
                  foreach($_SESSION['use_pill'] as $key=>$item){
                    $query2 = $db->prepare("INSERT INTO detail_use_pill (treat_id, pill_id, quantity)
                                           VALUES ( :treat_id, :pill_id, :quantity)");
                    $result1 = $query2->execute([
                      'treat_id'=>$treat_id,
                      'pill_id'=>$item['pill_id'],
                      'quantity'=>$item['quantity'],
                      ]);
                }
}
          //=======================update stock spare=======================
            foreach ($_POST['pill_id'] as $key => $item) :
              $query3 = $db->prepare("UPDATE pill SET
              amount = amount - :quantity WHERE pill_id = :pill_id");

              $result2 = $query3->execute([
                'pill_id' => $_POST['pill_id'][$key],
                'quantity' => $_POST['quantity'][$key],
              ]);
            endforeach;
          unset($_SESSION['use_pill']);

          //===================อัพเดทสถานะการซ่อม=========================

          $status = $_POST['status_treat'];
          $query4 = $db->prepare("UPDATE moo SET
          status_mo = :status_mo WHERE moo_id = :moo_id");

          $result3 = $query4->execute([
            'moo_id' => $moo_id,
            'status_mo' => $status,

          ]);
          echo "<script>
            alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
                window.location = '?file=manage/treat/index';
          </script>";
   }
 ?>
