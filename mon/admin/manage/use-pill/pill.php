<?php
if(isset($_GET['id'])){
$query = $db->prepare("SELECT * FROM treat WHERE treat_id = :id");
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
      <th>ชื่อยา</th>
      <th>จำนวนยา</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM pill');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["pill_name"]?></td>
      <td><?= $row["amount"]?></td>

      <td>
        <a  href="?file=manage/use-pill/use-cart&pill_id=<?=$row["pill_id"]?>" class="btn btn-warning btn-sm" role="button" >เลือกอะไหล่</a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=manage/treat/index" class="btn btn-info" role="button">กลับ</a>
