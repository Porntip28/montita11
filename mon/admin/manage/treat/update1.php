<?php
$orderStatus = 'status_treat.php';

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

//คิวรี่อะไหล่
$query_pill = $db->prepare("SELECT * FROM pill ");
$query_pill->execute();
$pill = $query_pill->fetchAll(PDO::FETCH_ASSOC);

// $query_detail_use_spare = $db->prepare("SELECT * FROM detail_use_spare ");
// $query_detail_use_spare->execute();
// $detail_use_spare = $query_detail_use_spare->fetchAll(PDO::FETCH_OBJ);
?>

<form method="post" action="">
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
       echo $orderStatus[$data['status_treat']];
     }else {?>
    <select class="form-form-control" name="status_treat">
        <option value="0">รอการรักษา</option>
        <option value="1">กำลังรักษา</option>
        <option value="0">รักษาเสร็จเเล้ว</option>
      </select>
      <?php }?>
  </div>
<p></p>
<center>
    <div class="text-left">
      เลือกยารักษา
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
  foreach ($pill as $key=> $value): ?>
  <tr >
      <td><?=++$i;?></td>
      <input type="hidden" name="treat_id" value="<?=$data["treat_id"]?>">
      <td><input type="checkbox" name="pill[<?=$key?>]" value="<?=$value['pill_id']?>">  <?=$value['pill_name']?></td>
      <td class=""><input type="number" value="['quantity']" min="1" class="quantity" name="quantity[<?=$key?>]"></td>

  </tr>
  <?php endforeach; ?>
</table>
<!-- <?php
 if($data['status_treat'] == 2){

 }else {?>

<?php }?> -->

<button type="submit" class="btn btn-success" name='ok'>อัพเดท</button>

<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=manage/treat/index';">ยกเลิก</button>
</center>
</form>


<!--====================-->
<?php
if(isset($_POST['ok'])){
  foreach($_POST['pill'] as $key => $val){
      $_SESSION['use_pill'][$key]=[
        'pill_id' => $val,
        'quantity' => $_POST['quantity'][$key]

      ];
  }
  $status = $_POST['status_treat'];
  $treat_id = $_GET['id'];
  $quantity = $_POST['quantity'];

  $query = $db->prepare("UPDATE treat SET
                                treat_date = :treat_date,
                                status_treat = :status_treat
                                WHERE treat.treat_id = :id");

  $result = $query->execute([
  "id" => $repair_id,
  "treatr_date" => $_POST["treat_date"],
  "status_treat" => $_POST["status_treat"],
  ]);
  if($result){

      foreach($_SESSION['use_pill'] as $key=>$item){
        $query2 = $db->prepare("INSERT INTO detail_use_pill (treat_id, pill_id, quantity)
                               VALUES ( :treat_id, :pill_id, :quantity)");
        $result1 = $query2->execute([
          'treat_id'=>$repair_id,
          'pill_id'=>$item['pill_id'],
          'quantity'=>$item['quantity'],
          ]);
        }
        //ตัดสตอค
        if ($result1) {
          //=======================update stock pill=======================
            foreach ($_POST['pill_id'] as $key => $item) :
              $query2 = $db->prepare("UPDATE pill SET
              amount = amount - :quantity WHERE pill_id = :pill_id");    //

              $result2 = $query2->execute([
                'pill_id' => $_POST['pill_id'][$key],
                'quantity' => $quantity,

              ]);
            endforeach;
          unset($_SESSION['use_pill']);

          // $query = $db->prepare("SELECT * FROM detail_use_pill  INNER JOIN pill
          //   ON detail_use_pill.pill_id=pill.pill_id
          //   WHERE detail_use_pill.pill_id=:pill_id");
          // $query->execute(['pill_id'=>$lastId]);
          // $stock_pill = $query->fetchAll(PDO::FETCH_ASSOC);

          // print_r($arr1);
          // exit();
        //
        // foreach ($stock_pill as $value) {
        //   $query = $db->prepare('UPDATE pill SET amount = :amount WHERE pill_id = :pill_id');
        //   $stock_spare = $query->execute([
        //     'pill_id'=>$value['pill_id'],
        //     'amount'=>($value['amount'])-($value['quantity']),


          }
        }
        echo "<script>
          alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
              window.location = '?file=manage/treat/index';
        </script>";

           }
 ?>
