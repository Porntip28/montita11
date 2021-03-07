
<br>
<p><a href="?file=material/usematerial/insert" class="btn btn-success" role="button">เพิ่มข้อมูลการเบิก</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>ชื่ออุปกรณ์</th>
      <th>ชื่ออุปกรณ์</th>
      <th>ชื่ออุปกรณ์</th>
      <th>จำนวนอุปกรณ์</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php

$query =$db->prepare ('SELECT 
usematerial.usematerial_id, 
usematerial.user_id,
 user.name, 
 usematerial.date_use,
usematerial.status,
usematerial.material_id, 
material.material_name,
usematerial.quantity
 FROM usematerial
  INNER JOIN user ON user.user_id = usematerial.user_id
  -- INNER JOIN employee ON usematerial.em_id = employee.em_id 
  INNER JOIN material ON material.material_id =usematerial.material_id 
');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $row["usematerial_id"]?></td>
      <td><?= $row["date_use"]?></td>
      <td><?= $row["name"]?></td>
      <td><?= $row["material_name"]?></td>
      <td><?= $row["quantity"]?></td>
      <td><?= $row["status"] ?></td>

      <td>
        <!-- <a  title="ดูข้อมูล"  href="?file=material/material-part/view&id=<?=$row["usematerial_id"]?>"><i class="far fa-eye"></i></a> -->
        <a  title="แก้ไขข้อมูล"href="?file=material/material-part/update_status&id=<?=$row["usematerial_id"]?>"><i class='fas fa-edit'></i> คืนอุปกรณ์ </a>
        <a  title="ลบข้อมูล"href="?file=material/material-part/delete&id=<?=$row["usematerial_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
      
        <!-- <a  title="ดูข้อมูล"  href="?file=material/material-part/update_status&id=<?=$row["usematerial_id"]?>"><i class="far fa-eye"></i></a> -->
        
      </td>
    </tr>
    <?php
  } //  ปิด while
}// ปิด if

?>
</tbody>
</table>
<p><a href="?file=food/index" class="btn btn-info" role="button">กลับ</a>
