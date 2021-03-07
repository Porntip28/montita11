<?php
$orderStatus = 'status_repair.php';

if(isset($_GET['id'])){

//รับค่ารหัสการซ่อม
$query1 = $db->prepare("SELECT * FROM repair WHERE repair_id = :id");
$query1->execute([
'id'=>$_GET['id'],
]);

if($query1->rowCount()>0){
    $data = $query1->fetch(PDO::FETCH_ASSOC);

  }
}

//คิวรี่อะไหล่
$query_spare = $db->prepare("SELECT * FROM spare ");
$query_spare->execute();
$spare = $query_spare->fetchAll(PDO::FETCH_ASSOC);

// $query_detail_use_spare = $db->prepare("SELECT * FROM detail_use_spare ");
// $query_detail_use_spare->execute();
// $detail_use_spare = $query_detail_use_spare->fetchAll(PDO::FETCH_OBJ);
?>

<form method="post" action="">
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">วันที่ซ่อม</label>
    <div class="col-3">
      <input type="date" class="form-control form-control-sm"  name="repair_date" value="<?=$data["repair_date"]?>">
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">รายละเอียดการซ่อม</label>
    <div class="col-3">
      <input type="text" class="form-control form-control-sm"  name="" value="<?=$data["detail_repair"]?>" disabled>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label col-form-label-sm">สถานะการซ่อม</label>
    <?php
     if($data['status_repair'] == 2){
       echo $orderStatus[$data['status_repair']];
     }else {?>
    <select class="form-form-control" name="status_repair">
        <option value="0">รอการซ่อม</option>
        <option value="1">กำลังซ่อม</option>
        <option value="2">ซ่อมเสร็จเเล้ว</option>
      </select>
      <?php }?>
  </div>
<p></p>
<center>
    <div class="text-left">
      เลือกอะไหล่
    </div>
    <p>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>#</th>
        <th>รายการ</th>
        <th>จำนวน</th>
      </tr>
    </thead>
    <tbody>
  <?php
  $i=0;
  foreach ($spare as $key=> $value): ?>
  <tr >
      <td><?=++$i;?></td>
      <input type="hidden" name="repair_id" value="<?=$data["repair_id"]?>">
      <td><input type="checkbox" name="spare[<?=$key?>]" value="<?=$value['spare_id']?>">  <?=$value['spare_name']?></td>
      <td class=""><input type="number" value="['quantity']" min="1" class="quantity" name="quantity[<?=$key?>]"></td>

  </tr>
  <?php endforeach; ?>
</table>
<!-- <?php
 if($data['status_repair'] == 2){

 }else {?>

<?php }?> -->

<button type="submit" class="btn btn-success" name='ok'>อัพเดท</button>

<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=insurance/repair/index';">ยกเลิก</button>
</center>
</form>


<!--====================-->
<?php
if(isset($_POST['ok'])){
  foreach($_POST['spare'] as $key => $val){
      $_SESSION['use_spare'][$key]=[
        'spare_id' => $val,
        'quantity' => $_POST['quantity'][$key]

      ];
  }
  $status = $_POST['status_repair'];
  $repair_id = $_GET['id'];
  $quantity = $_POST['quantity'];

  $query = $db->prepare("UPDATE repair SET
                                repair_date = :repair_date,
                                status_repair = :status_repair
                                WHERE repair.repair_id = :id");

  $result = $query->execute([
  "id" => $repair_id,
  "repair_date" => $_POST["repair_date"],
  "status_repair" => $_POST["status_repair"],
  ]);
  if($result){

      foreach($_SESSION['use_spare'] as $key=>$item){
        $query2 = $db->prepare("INSERT INTO detail_use_spare (repair_id, spare_id, quantity)
                               VALUES ( :repair_id, :spare_id, :quantity)");
        $result1 = $query2->execute([
          'repair_id'=>$repair_id,
          'spare_id'=>$item['spare_id'],
          'quantity'=>$item['quantity'],
          ]);
        }
        //ตัดสตอค
        if ($result1) {
          //=======================update stock spare=======================
            foreach ($_POST['spare_id'] as $key => $item) :
              $query2 = $db->prepare("UPDATE spare SET
              amount = amount - :quantity WHERE spare_id = :spare_id");    //

              $result2 = $query2->execute([
                'spare_id' => $_POST['spare_id'][$key],
                'quantity' => $quantity,

              ]);
            endforeach;
          unset($_SESSION['use_spare']);

          // $query = $db->prepare("SELECT * FROM detail_use_spare  INNER JOIN spare
          //   ON detail_use_spare.spare_id=spare.spare_id
          //   WHERE detail_use_spare.spare_id=:spare_id");
          // $query->execute(['spare_id'=>$lastId]);
          // $stock_spare = $query->fetchAll(PDO::FETCH_ASSOC);

          // print_r($arr1);
          // exit();
        //
        // foreach ($stock_spare as $value) {
        //   $query = $db->prepare('UPDATE spare SET amount = :amount WHERE spare_id = :spare_id');
        //   $stock_spare = $query->execute([
        //     'spare_id'=>$value['spare_id'],
        //     'amount'=>($value['amount'])-($value['quantity']),


          }
        }
        echo "<script>
          alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
              window.location = '?file=insurance/repair/index';
        </script>";

           }
 ?>
