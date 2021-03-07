<!-- <?php $row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo');
$row->execute();
//คำสั่งนับเเถว
?> -->

<center><h5>ข้อมูลการชำระ(จ่ายสด)</h5></center>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <!-- <th>เลขทะเบียน</th> -->
      <th>ชื่อลูกค้า</th>
      <th>ชำระ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
  <?php
  $type_pay = include 'type_pay.php';

    $query1 = $db->prepare("SELECT * FROM salling
                           INNER JOIN user ON salling.user_id = user.user_id
                           INNER JOIN pay ON pay.sale_id = salling.sale_id");
$query1->execute();

  if($query1->rowCount() > 0){
    $i=1;
    while($row = $query1->fetch(PDO::FETCH_ASSOC)){
      if($row['type_pay']==1){

       ?>
      <tr>
        <td><?= $i++?></td>
        <td><?= $row["name"]?></td>
        <td><?= $type_pay[$row["type_pay"]]?></td>
        <td>
          <a  title="ดูข้อมูล"  href="?file=salling/pay/view&id=<?=$row["sale_id"]?>"><i class="far fa-eye"></i></a>

        </td>
      </tr>
      <?php
    }
  }
}
  ?>
</tbody>
</table>

<p><a href="?file=salling/index" class="btn btn-info" role="button">กลับ</a>
