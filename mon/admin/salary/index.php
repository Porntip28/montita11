<br>
<p><a href="?file=salary/insert" class="btn btn-success" role="button">เพิ่มข้อมูลค่าตอบแทน</a>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>วันที่</th>
      <th>ชื่อพนักงาน</th>
      <th>นามสกุล</th>
      <!-- <th>จำนวนวันทำงาน</th> -->
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php
$query = $db->prepare('SELECT * FROM salary INNER JOIN user
                        ON salary.user_id = user.user_id  WHERE level = 2 GROUP BY user.user_id');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  $salary=0;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
    $salary=$row["total_work"] * $row["salary"]
     ?>
    <tr>

      <td><?= $i++?></td>
      <td><?php echo date("d-m-Y", strtotime ($row["salary_date"]))?></td>
      <td><?= $row["name"]?></td>
      <td><?= $row["surname"]?></td>
      <!-- <td><?= $row["total_work"]?></td> -->


      <td>
          <?php if($_SESSION['user']['name'] == $row["name"] ) { ?>

        <a  title="ดูข้อมูล"  href="?file=salary/view&id=<?=$row["user_id"]?>"><i class="far fa-eye"></i></a>
  <?php }?>
      <?php if($_SESSION['user']['level'] == 1){  ?>
        <a  title="แก้ไขข้อมูล"href="?file=salary/update&id=<?=$row["user_id"]?>"><i class='fas fa-edit'></i></a>
        <a  title="ดูข้อมูล"  href="?file=salary/view&id=<?=$row["user_id"]?>"><i class="far fa-eye"></i></a>
        <a  title="ลบข้อมูล"href="?file=salary/delete&id=<?=$row["user_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a>
<?php } ?>
      </td>
    </tr>
    <?php
  }
}

?>
</tbody>
</table>
