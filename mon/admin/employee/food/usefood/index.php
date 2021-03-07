
<br>
<center><h5>ข้อมูลการให้อาหาร</h5></center>
<p><a href="?file=food/usefood/insert" class="btn btn-success" role="button">เพิ่มข้อมูลให้อาหาร</a>
<br>
<center>
<table class="table table-striped">
  <thead>
    <tr>
      <th><center>ลำดับ</th>
      <th><center>วันที่/เวลาที่ให้</th>
      <th><center>ชื่อพนักงาน</th>
      <th><center>ชื่อคอก</th>
      <th><center>ชื่ออาหาร</th>
      <th><center>จำนวนอาหร</th>
      <th><center>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM usefood 
                                INNER JOIN user ON user.user_id = usefood.user_id
                                INNER JOIN stall ON usefood.stall_id =stall.stall_id
                                INNER JOIN food ON usefood.food_id =food.food_id
                                ');

                                

$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
     
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["use_date"]?></td> 
       <!-- <td><?= $row["usefood_id"]?></td> -->
       <td><?= $row["name"]?></td>
       <td><?= $row["stall_name"]?></td>
      <td><?= $row["food_name"]?></td>
      <td><center><?= $row["quantity"]?></td>

      <td>
        <!-- <a  title="ดูข้อมูล"  href="?file=food/food-part/view&id=<?=$row["food_id"]?>"><i class="far fa-eye"></i></a> -->
        <a  title="แก้ไขข้อมูล"  href="?file=food/usefood/update&id=<?=$row["usefood_id"]?>"><i class='fas fa-edit'></i></a>
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
<p><a href="?file=food/index" class="btn btn-info" role="button">กลับ</a>
