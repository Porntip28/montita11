<br>
<center><h5>ข้อมูลการพนักงาน</h5></center>
<p><a href="?file=employee/insert" class="btn btn-success" role="button">เพิ่มข้อมูลพนักงาน</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อพนักงาน</th>
      <th>นามสกุล</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM user WHERE level=2');
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
          <?php if($_SESSION['user']['name'] == $row->name ) { ?>

        <a  title="ดูข้อมูล"  href="?file=employee/view&id=<?=$row->user_id?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=employee/update&id=<?=$row->user_id?>"><i class='fas fa-edit'></i></a>

  <?php }else{ ?>
    <a  title="ดูข้อมูล"  href="?file=employee/view&id=<?=$row->user_id?>"><i class="far fa-eye"></i></a>
  <?php } ?>

      <?php if($_SESSION['user']['level'] == 1){  ?>

        <a  title="แก้ไขข้อมูล"href="?file=employee/update&id=<?=$row->user_id?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=employee/delete&id=<?=$row->user_id?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
<?php } ?>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
