<?php
if (isset($_GET['usefood_id'])) {

  $id = $_GET['usefood_id'];
  $query = $db->prepare("SELECT status FROM usefood WHERE usefood_id ='$id' ");
  $query->execute();

  while($row = $query->fetch(PDO::FETCH_OBJ))
  {
      if ($row->status == 'ยกเลิก') {
        ?>
       <script type="text/javascript">
           alert("สถานะอยู่ในการยกเลิกอยู่แล้ว");
       </script>
        <?php

      }else {

        $query = $db->prepare("UPDATE usefood SET status = 'ยกเลิก' WHERE usefood_id ='$id' ");
        $query->execute();


        $query = $db->prepare("SELECT amount,food_id  FROM usefood WHERE usefood_id = '$id' ");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_OBJ))
        {
          $query1 = $db->prepare("UPDATE food
          SET amount = amount + $row->amount
          WHERE food_id = $row->food_id");
          $query1->execute();

         
        }
        header('Location: ?route=s_food'); //ล๊อกอิินเสร็จไปหน้าแรก
          exit();

      }

  }

}

 ?>
