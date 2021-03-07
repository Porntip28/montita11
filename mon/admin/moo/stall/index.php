<br>

<p><a href="?file=moo/stall/insert" class="btn btn-success" role="button">เพิ่มข้อมูลคอก</a>

<?php $row = $db->prepare('SELECT COUNT(stall_id) as amountrow FROM stall'); //สต๊อกหมูในคอกทั้งหมด
$row->execute();
$rowall = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo WHERE stall_id = 1'); //สต๊อกหมูที่อยู่คอกที่1
$row->execute();
$row2 = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo WHERE stall_id = 2'); //สต๊อกหมูที่อยู่คอกที่2
$row->execute();
$row3 = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo WHERE stall_id = 3'); //สต๊อกหมูที่อยู่คอกที่3
$row->execute();
$row4 = $row->fetchColumn();



 ?>
 <button type="button" class="btn btn-outline-primary">คอกทั้งหมด <?=$rowall?> ตัว</button>
<button type="button" class="btn btn-outline-warning">คอกที่1:>  <?=$row2?> ตัว</button>
<button type="button" class="btn btn-outline-warning">คอกที่2:>  <?=$row3?> ตัว</button>
<button type="button" class="btn btn-outline-warning">คอกที่3:>  <?=$row4?> ตัว</button>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อคอก</th>
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
      <td>
        <a  title="ดูข้อมูล"  href="?file=moo/stall/view&id=<?=$row["stall_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=moo/stall/update&id=<?=$row["stall_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=moo/stall/delete&id=<?=$row["stall_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=moo/index" class="btn btn-info" role="button">กลับ</a>
