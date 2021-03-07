
<br>
<p><a href="?file=moo/stall-part/insert" class="btn btn-success" role="button">เพิ่มข้อมูลคอก</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อคอก</th>
      
      <th>จำนวนอะไหล่</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM stall');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["stall_name"]?></td>
    
      <td><?= $row["amount"]?></td>

      <td>
        <a  title="ดูข้อมูล"  href="?file=moo/stall-part/view&id=<?=$row["stall_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=moo/stall-part/update&id=<?=$row["stall_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=moo/stall-part/delete&id=<?=$row["stall_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
        
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=stall-part/index" class="btn btn-info" role="button">กลับ</a>
