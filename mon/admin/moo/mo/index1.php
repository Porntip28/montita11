<?php $row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo'); //สต๊อกทั้งหมด
$row->execute();
$rowall = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(moo_id) as amountrow FROM moo WHERE status_mo = 2'); //สต๊อกที่พร้อมขาย
$row->execute();
$row2 = $row->fetchColumn();

$row = $db->prepare('SELECT COUNT(motor_id) as amountrow FROM motorcycle WHERE status_mo = 3'); //สต๊อกที่ขายเเล้ว
$row->execute();
$row3 = $row->fetchColumn();
 ?>
<!-- //ค้นหา -->
 <script type="text/javascript">
 function search(val){
   $.ajax(
     {
       url: "admin/moo/mo/search_mo.php?q=" + val,
        success: function(result){
             $("#search_data").html(result);
         }
     });
 }
 </script>
<!---===================-->
<button type="button" class="btn btn-outline-primary">หมูทั้งหมด <?=$rowall?> ตัว</button>
<button type="button" class="btn btn-outline-warning">หมูที่พร้อมขาย <?=$row2?> ตัว</button>
<!-- <button type="button" class="btn btn-outline-danger">ขายไปเเล้ว <?=$row3?> ตัว</button> -->

<!-- //ค้นหา -->
<div class="container">
  <div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
      <input type="search" onkeyup="search(this.value)" class="form-control input-sm" placeholder="search" aria-controls="" autofocus>
    </div>
  </div>
</div>
<!---===================-->
<center><h5>ข้อมูลหมู</h5></center>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ลำดับ</th>
      <th>รุ่น</th>
      <th>เบอร์สุกร</th>
      <th>สถานะ</th>
      <th>เครื่องมือ</th>
    </tr>
  </thead>
<tbody>
<?php

$status = include 'status_mo.php';
$query = $db->prepare('SELECT * FROM moo');
$query->execute();

if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
  $i=1;
  while($row = $query->fetch(PDO::FETCH_ASSOC)){//ดึงข้อมูลมาใส่ใน $row
     ?>
    <tr>
      <td><?= $i++?></td>
      <td><?= $row["gene"]?></td>
      <td><?= $row["moo_number"]?></td>
      <td><?= $status[$row["status_mo"]]?></td>
      <td>
        <a  title="ดูข้อมูล"  href="?file=moo/mo/view&id=<?=$row["moo_id"]?>"><i class="far fa-eye"></i></a>
        <?php  if($row["status_mo"] == 0){ ?>
        <a  title="แก้ไขข้อมูล"href="?file=moo/mo/update&id=<?=$row["moo_id"]?>"><i class='fas fa-edit'></i></a>
      <?php } ?>
        <!-- <a  title="ลบข้อมูล"href="?file=moo/mo/delete&id=<?=$row["moo_id"]?>" onclick="return confirm('คุณต้องลบจริงไหม?')"><i class="far fa-trash-alt"></i></a> -->
        <?php if($row["status_mo"] == 2){ ?>
        <a  href="?file=moo/mo/cart&moo_id=<?=$row["moo_id"]?>" class="btn btn-outline-warning btn-sm" role="button" >ขาย</a>
    <?php   } ?>
      </td>
    </tr>
    <?php
  }
}

?>
</tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>

<p><a href="?file=moo/index" class="btn btn-info" role="button">กลับ</a>
