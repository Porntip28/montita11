<?php
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM food WHERE moo_id = :id");
$query->execute([
'id'=>$_GET['id']
]);//รัน sql
    $data = $query->fetch(PDO::FETCH_ASSOC);
  }
 ?>
<br>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่ออะไหล่</th>
      <th>จำนวนอะไหล่</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM food');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["food_name"]?></td>
      <td><?= $row["amount"]?></td>

      <td>
        <a  href="?file=food/use-food/use-cart&food_id=<?=$row["food_id"]?>" class="btn btn-warning btn-sm" role="button" >เลือกอะไหล่</a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=food/usefood/index" class="btn btn-info" role="button">กลับ</a>
