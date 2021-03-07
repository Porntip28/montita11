<?php
include('./../../../connect.php');
$status_mo = include('status_mo.php');
$html = '<thead>
    <tr>
    <th>ลำดับ</th>
    <th>ยี่ห้อ-รุ่น</th>
    <th>เลขทะเบียน</th>
    <th>สถานะ</th>
    <th>เครื่องมือ</th>
  </tr>
</thead>';
$test = "";
  if(isset($_GET["q"])){

    $query = $db->prepare("SELECT * FROM motorcycle WHERE brand like :q");
    $params = array(
      ':q' => "%" . $_GET["q"] . "%"
    );
    try {
      $query->execute($params);
      $i=1;
      while($rs = $query->fetch(PDO::FETCH_OBJ)){
        $html .= "<tbody><tr>
                  <td><center>" . $i++ . "</td>
                  <td>" . $rs->brand . "</td>
                  <td>" . $rs->motor_number . "</td>
                  <td>" . $status_mo[$rs->status_mo] . "</td>";
        $html .= "<td>
          <center>
          <a  title='ดูข้อมูล'  href='?file=motorcycle/motor/view&id=" . $rs->motor_id . "'> <i class='far fa-eye'></i></a>
          <?php  if(" . $rs->motor_id . " == 0){ ?>
          <a  title='แก้ไขข้อมูล'href='?file=motorcycle/motor/update&id=" . $rs->motor_id . "'><i class='fas fa-edit'></i></a>
        <?php } ?>
          <!-- <a  title='ลบข้อมูล'href='?file=motorcycle/motor/delete&id=" . $rs->motor_id . "' onclick='return confirm('คุณต้องลบจริงไหม?')'><i class='far fa-trash-alt'></i></a> -->
          <?php if(" . $rs->motor_id . " == 2){ ?>
          <a  href='?file=motorcycle/motor/cart&motor_id=" . $rs->motor_id . "' class='btn btn-outline-warning btn-sm' role='button'>ขาย</a>
      <?php   } ?>

        </td></tbody>";
      }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

  } else {

  }
  echo $html;
 ?>
