<?php
$row = $db->prepare('SELECT COUNT(installment_id) as amountrow FROM installment WHERE status_pay = 1'); //จ่ายหมดเเล้ว
$row->execute();
$row1 = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(installment_id) as amountrow FROM installment WHERE status_pay = 2'); //ค้างชำระ
$row->execute();
$row2 = $row->fetchColumn();
 ?>
<button type="button" class="btn btn-outline-danger">ค้างชำระ <?=$row1?> คน</button>
<button type="button" class="btn btn-outline-success">จ่ายหมดเเล้ว <?=$row2?> คน</button>

<center><h5>ข้อมูลการผ่อนชำระ</h5></center>
<br>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <!-- <th>เลขทะเบียน</th> -->
      <th>ชื่อลูกค้า</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
  <?php
  $status_pay = include 'status_pay.php';
    $query1 = $db->prepare("SELECT * FROM salling
                           INNER JOIN user ON salling.user_id = user.user_id
                           INNER JOIN installment ON installment.sale_id = salling.sale_id");
$query1->execute();
  if($query1->rowCount() > 0){
    $i=1;
    while($row = $query1->fetch(PDO::FETCH_ASSOC)){
        if($row['type_pay']==2){
       ?>
      <tr>
        <td><?= $i++?></td>
        <td><?= $row["name"]?></td>
        <td><?=$status_pay[$row["status_pay"]]?></td>
        <td>
          <?php if($row['status_pay'] == 1) {?>
          <a  title="แก้ไขข้อมูล"href="?file=salling/install/update&id=<?=$row["sale_id"]?>"><i class='fas fa-edit'></i></a>
        <?php }else{ ?>
          <a  title="ดูข้อมูล"href="?file=salling/install/update&id=<?=$row["sale_id"]?>"><i class="far fa-eye"></i></a>
        <?php } ?>
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
