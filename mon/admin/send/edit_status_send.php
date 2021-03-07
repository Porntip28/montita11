<?php
$status_send = include 'status_send.php';


if(isset($_GET['id'])){
  $query = $db->prepare("SELECT  * FROM send WHERE sale_id = :id");
  $query->execute(['id'=>$_GET['id']]);

  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
  }
 }
?>

<!-- <div id="print"> -->
  <br>
  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
    </div>
<form class="" action="" method="post">
<div class="row">

<div class="col-sm-12">
<table class="table ">
<?php $sale_id = $data->sale_id;  ?>
  <tr><th class="text-right" width="20%">รหัสใบส่งซื้อ :</th><td><?= $data->sale_id; ?></td></tr>
      <tr><th class="text-right">สถานะ : <td><select name="status_send">
          <option value="2">กำลังจัดส่ง</option>
          <option value="1">จัดส่งแล้ว</option></select>
      </tr>
      
  </table>

    <center><input type="submit" class="btn btn-info" name="ok" value="อัพเดต"></center>
</div>
<!-- </form>
</div>

<p><a href="?file=send/index" class="btn btn-info" role="button">กลับ</a> -->

<?php
if(isset($_POST['ok'])){

  $status = $_POST['status_send'];
  // $quantity = $_POST['quantity'];


  $query2 = $db->prepare("UPDATE send SET status_send = '$status'
  WHERE sale_id = '$sale_id'");
  $result2 = $query2->execute();

//=======================update stock spare=======================
  // foreach ($_POST['food_id'] as $key => $item) :
  //   $query2 = $db->prepare("UPDATE food SET
  //   amount = amount + :quantity WHERE food_id = :food_id");

  //   $result2 = $query2->execute([
  //     'food_id' => $_POST['food_id'][$key],
  //     'quantity' => $_POST['quantity'][$key],

  //   ]);

  
  echo "<script>
    alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
        window.location = '?file=send/index';
  </script>";
    }
 ?>
