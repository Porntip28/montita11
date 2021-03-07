<br>
<center><h5>ข้อมูลการผสมพันธุ์</h5></center>
<p><a href="?file=hybridize/insert" class="btn btn-success" role="button">เพิ่มข้อมูลการผสมพันธุ์</a>
<br>
<center>
<table class="table table-striped"  >
  <thead>
    <tr >
      <th>ลำดับ</th>
      <th>วันที่ทำการผสม</th>
      <th>ชื่อพนักงาน</th>
      <th>เบอร์หูพ่อ</th>
      <th>เบอร์หูแม่</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM hybridize INNER JOIN user
                        ON hybridize.user_id = user.user_id  ');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr >
      <td><?= $i++?></td>
      <td><?php echo date("d-m-Y", strtotime ($row["hybridize_date"]))?></td>
      <td><?= $row["name"]?>&nbsp&nbsp&nbsp&nbsp<?= $row["surname"]?></td>
      <td ><?= $row["hybridize_f"]?></td>
      <td><?= $row["hybridize_m"]?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=hybridize/view&id=<?=$row["hybridize_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=hybridize/update&id=<?=$row["hybridize_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=hybridize/delete&id=<?=$row["hybridize_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=hybridize/index" class="btn btn-info" role="button">กลับ</a>



      