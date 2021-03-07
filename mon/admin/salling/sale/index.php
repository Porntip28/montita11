<!-- <?php $row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo');
$row->execute();
//คำสั่งนับเเถว
?> -->

<center><h5>ข้อมูลการขาย</h5></center>
<p><a href="?file=salling/sale/sale_mo" class="btn btn-success" role="button">เพิ่มการขาย</a>

<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>เบอร์หูสุกร</th>
      <th>ชื่อลูกค้า</th>
      <th>ชำระ</th>
      <th>เครื่องมือ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>

  <?php
  $type_pay = include 'type_pay.php';
  $status_send = include 'status_send.php';
    $query1 = $db->prepare("SELECT 
    moo.moo_number,
    user.name,
    salling.type_pay,
    send.status_send,
    salling.sale_id

     FROM salling 
    INNER JOIN moo ON salling.moo_id = moo.moo_id
    INNER JOIN user ON salling.user_id = user.user_id
    INNER JOIN send ON send.sale_id = salling.sale_id"
    );
$query1->execute();

  if($query1->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
    $i=1;
    while($row = $query1->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
       ?>
      <tr>
        <td><?= $i++?></td>
        <td><?= $row["moo_number"]?></td>
        <td><?= $row["name"]?></td>
        <td><?= $type_pay[$row["type_pay"]]?></td>
        <td><?= $status_send[$row["status_send"]]?></td>
        <!-- <td><?= $row["status_send"]?></td> -->
       
        <td>
          <a  title="ดูข้อมูล"  href="?file=salling/sale/view&id=<?=$row["sale_id"]?>"><i class="far fa-eye"></i></a>
          <!-- <a  title="แก้ไขข้อมูล"href="?file=salling/sale/update&id=<?=$row["sale_id"]?>"><i class='fas fa-edit'></i></a> -->
          <!-- <a  title="ลบข้อมูล"href="?file=salling/sale/delete&id=<?=$row["sale_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a> -->

        </td>

      </tr>
      <?php
    } //  ปิด while
  }
  ?>
</tbody>
</table>
<p><a href="?file=salling/index" class="btn btn-danger" role="button">กลับ</a>
