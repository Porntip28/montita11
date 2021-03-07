<br>
<p><a href="?file=motorcycle/suplier/insert" class="btn btn-success" role="button">เพิ่มข้อมูลซัพพลายเออร์</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อร้านค้า</th>
      <th>ที่อยู่</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM suplier');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["sup_name"]?></td>
      <td><?= $row["sup_address"]?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=motorcycle/suplier/view&id=<?=$row["sup_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=motorcycle/suplier/update&id=<?=$row["sup_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=motorcycle/suplier/delete&id=<?=$row["sup_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=motorcycle/index" class="btn btn-info" role="button">กลับ</a>
