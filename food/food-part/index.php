
<br>
<center><h5>ข้อมูลอาหาร</h5></center>
<p><a href="?file=food/food-part/insert" class="btn btn-success" role="button">เพิ่มข้อมูลอาหาร</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่ออาหาร</th>
      <th>ราคา</th>
      <th>จำนวนอาหร</th>
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
      <td><?= $row["price"]?></td>
      <td><?= $row["amount"]?></td>

      <td>
        <a  title="ดูข้อมูล"  href="?file=food/food-part/view&id=<?=$row["food_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="แก้ไขข้อมูล"href="?file=food/food-part/update&id=<?=$row["food_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ลบข้อมูล"href="?file=food/food-part/delete&id=<?=$row["food_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
        <a  href="?file=food/order_food/food-cart&food_id=<?=$row["food_id"]?>" class="btn btn-outline-danger btn-sm" role="button" >สั่งซื้อ</a>
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=pill/index" class="btn btn-info" role="button">กลับ</a>
