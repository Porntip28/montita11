<?php
$perpage = 5;
 if (isset($_GET['page'])) {
 $page = $_GET['page'];
 } else {
 $page = 1;
 }
 $start = ($page - 1) * $perpage;
$sql = "SELECT usefood ";

$query = $db->prepare($sql);
$query->execute();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>แสดงข้อมูลการให้อาหาร</title>
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/css/dashboard.css" rel="stylesheet">
      <script src="assets/jquery.min.js"></script>
      <script src="assets/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

  <style>
      table, td, th { border:1px solid green;}
      th{ background-color:black; color:white; height: 40px; text-align: center;}

      form{ margin-right: 860px;}/*ตำแหน่งฟอร์ม search*/


  </style>
  </head>
  <body>

          <div class="table">
          <table class="table table-striped table-sm font_article">
      <thead>
        <tr>
           <th>รหัส</th>
           <th>วันที่</th>
           <th>ชื่อพนักงาน</th>
           <th>ชื่อสุกร</th>
           <th>ชื่ออาหาร</th>
           <th>จำนวน/ตัว</th>
           <th>สถานะการผลิต</th>
           <th>จัดการข้อมูล</th>
        </tr>
      </thead>
      <br><br>
      <p class ="text-center font_article " style="font-size:40px;">ข้อมูลการให้อาหาร</p>
      <br>
      <div class="row">

        <a class="btn btn-warning font_article" style="margin-left: 1%;" href="?route=f_food"><i class="fa fa-pencil-square" aria-hidden="true"></i>
          เพิ่มข้อมูล</a>
        <form  action="?route=s_build" method="post">
          <input class="form-control mr-sm-2 border border-secondary" style="width:200px" type="text" name="search" value="<?php echo $search ?>" placeholder="ระบุวันที่ค้นหา">
          <button class="btn btn-secondary" type="submit">Search</button>
        </form>

      </div>
        <br>
      <tbody>
        <?php while($row = $query->fetch(PDO::FETCH_OBJ)){ ?>
        <tr class="text-center">
          <td><?php echo $row->usefood_id ?></td>
          <td><?= date("d-m-Y", strtotime($row->date_use ))?></td>
          <td><?php echo $row->em_id ?></td>
          <td><?php echo $row->moo_id ?></td>
          <td><?php echo $row->food_name ?></td>
          <td><?php echo $row->amount ?></td>  
          <td><?php echo $row->status ?></td>
          <td class="text-center">

            <input class="checkbox" type="checkbox" name="id[]" id="<?php echo $row->usefood_id?>">
            <a class="btn btn-danger"  href="?route=status_food&usefood_id=<?php echo $row->usefood_id  ?>"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิกการผลิต</a>
            <!-- <a class="btn btn-success"  href="?route=d_foodd&usefood_id=<?php echo $row->usefood_id ?>" onclick="if(!confirm('กรุณายืนยันการลบข้อมูล')) { return false; }"><i class="fa fa-trash-o" aria-hidden="true"></i>ลบ</a> -->
          </td>

        </tr>
        <?php } ?>
      </tbody>
    </table>
    <?php
     $sql = "SELECT * from usefood ";
     $query = $db->prepare($sql);
     $query->execute();
     $total_record = $query->rowCount();
     $total_page = ceil($total_record / $perpage);
     //echo $total_record;
     ?>

        <div class="row">
     <ul class="pagination">
     <li class="page-item">
     <a class="page-link" href="main.php?route=s_food&page=1" aria-label="Previous">
     <span aria-hidden="true"></span>Previous
     </a>
     </li>
     <?php for($i=1;$i<=$total_page;$i++){ ?>
     <li><a class="page-link" href="main.php?route=s_food&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
     <?php } ?>
     <li>
     <a class="page-link" href="main.php?route=s_food&page=<?php echo $total_page;?>" aria-label="Next">
     <span aria-hidden="true"></span>Next
     </a>
     </li>
     </ul>
      <input type="checkbox" style="margin-left:900px;"id="checkAll">
     <button type="button" class="btn btn-success" style="margin-left:5px;height:38px;"id="delete">ลบข้อมูลที่เลือก</button>
     </div>
         </div>
     <script>

  $(document).ready(function(){
      $('#checkAll').click(function(){
         if(this.checked){
             $('.checkbox').each(function(){
                this.checked = true;
             });
         }else{
            $('.checkbox').each(function(){
                this.checked = false;
             });
         }
      });


    $('#delete').click(function(){
       var dataArr  = new Array();
       if($('input:checkbox:checked').length > 0){
          $('input:checkbox:checked').each(function(){
              dataArr.push($(this).attr('id'));
              $(this).closest('tr').remove();
          });
          sendResponse(dataArr)
       }else{
         alert('No record selected ');
       }

    });

    function sendResponse(dataArr){
        $.ajax({
            type    : 'post',
            url     : 'admin/food/usefood1/d_food.php',
            data    : {'data' : dataArr},
            success : function(response){
                        alert(response);
                      },
            error   : function(errResponse){
                      alert(errResponse);
                      }
        });
    }

  });
</script>
  </body>
</html>
