
<br>
<p><a href="?file=spare/spare-part/insert" class="btn btn-success" role="button">เพิ่มข้อมูลอะไหล่</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่ออะไหล่</th>
      <th>ราคา</th>
      <th>จำนวนอะไหล่</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM spare');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["spare_name"]?></td>
      <td><?= $row["price"]?></td>
      <td><?= $row["amount"]?></td>

      <td>
        <a  title="ดูข้อมูล"  href="?file=spare/spare-part/view&id=<?=$row["spare_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=spare/spare-part/update&id=<?=$row["spare_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=spare/spare-part/delete&id=<?=$row["spare_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
        <a  href="?file=spare/order_spare/spare-cart&spare_id=<?=$row["spare_id"]?>" class="btn btn-outline-danger btn-sm" role="button" >สั่งซื้อ</a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=spare/index" class="btn btn-info" role="button">กลับ</a>
