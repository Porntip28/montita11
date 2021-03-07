<br>
<center><h5>ข้อมูลลูกค้า</h5></center>
<p><a href="?file=user/insert" class="btn btn-success" role="button">เพิ่มข้อมูลลูกค้า</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อลูกค้า</th>
      <th>นามสกุล</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM user WHERE level=3');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_OBJ)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row->name?></td>
      <td><?= $row->surname?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=user/view&id=<?=$row->user_id?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=user/update&id=<?=$row->user_id?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=user/delete&id=<?=$row->user_id?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php
  }
}
?>
</tbody>
</table>
