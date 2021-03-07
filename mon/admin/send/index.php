<!-- <?php $row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo');
$row->execute();
//คำสั่งนับเเถว
?> -->

<center><h5>ข้อมูลการจัดส่ง</h5></center>
<p><a href="?file=salling/sale/sale_mo" class="btn btn-success" role="button">เพิ่มการขาย</a>

<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <!-- <th>รหัสการขาย</th> -->
      <th>ชื่อลูกค้า</th>
      <th>รหัสสุกร</th>
      <th>สถานะการจัดส่ง</th>
      <th>เครื่องมือ</th>
     
    </tr>
  </thead>
<tbody>

  <?php
  $status_send = include 'status_send.php';
    $query1 = $db->prepare("SELECT 
                                  send.send_id,
                                  user.name,
                                  moo.moo_number,
                                  send.status_send,
                                  salling.sale_id
                                        FROM send
                                  INNER JOIN user ON user.user_id =send.user_id
                                  INNER JOIN salling ON send.sale_id = salling.sale_id 
                                  INNER JOIN moo ON salling.moo_id = moo.moo_id ");                                     
$query1->execute();

  if($query1->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
    $i=1;
    while($row = $query1->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
       ?>
      <tr>
        <td><?= $row['send_id']?></td>
        <!-- <td><?= $row["sale_id"]?></td> -->
        <td><?= $row["name"]?></td>
        <td><?= $row["moo_number"]?></td>
        <td><?= $status_send[$row["status_send"]]?></td>
        <!-- <td><?= $row["status_send"]?></td> -->
       
        <td>
          <a  title="แก้ไขข้อมูล"  href="?file=send/edit_status_send&id=<?=$row["sale_id"]?>"><i class='fas fa-edit'></i></a>
          <!-- <a  title="แก้ไขข้อมูล"href="?file=salling/sale/update&id=<?=$row["sale_id"]?>"><i class='fas fa-edit'></i></a> -->
         <a  title="ลบข้อมูล"href="?file=send/index/delete&id=<?=$row["send_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a> 

        </td>

      </tr>
      <?php
    } //  ปิด while
  }
  ?>
</tbody>
</table>
<p><a href="?file=send/index" class="btn btn-danger" role="button">กลับ</a>
