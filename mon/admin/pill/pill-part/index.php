
<br>
<p><a href="?file=pill/pill-part/insert" class="btn btn-success" role="button">เพิ่มข้อมูลยา</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อยารักษา</th>
      <th>ราคา</th>
      <th>จำนวนยารักษา</th>
      <th>ราคารวม</th>
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

$b = $row['amount'];
$w= $row['price'];
echo $b;
      echo $w;
     
$c = $b*$w;
echo $c;
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["pill_name"]?></td>
      <td><?= $row["price"]?></td>
      <td><?= $row["amount"]?></td>
      <td><?= $c ?></td>

      <td>
        <a  title="ดูข้อมูล"  href="?file=pill/pill-part/view&id=<?=$row["pill_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=pill/pill-part/update&id=<?=$row["pill_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=pill/pill-part/delete&id=<?=$row["pill_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
        <a  href="?file=pill/order_pill/pill-cart&pill_id=<?=$row["pill_id"]?>" class="btn btn-outline-danger btn-sm" role="button" >สั่งซื้อ</a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=pill/index" class="btn btn-info" role="button">กลับ</a>
