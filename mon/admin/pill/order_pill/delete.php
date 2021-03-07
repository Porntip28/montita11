<?php

if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM order_pill WHERE order_pill_id = :id");
  $result = $query->execute([
    "id" => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('ลบข้อมูลเรียบร้อยแล้ว');
      window.location = '?file=pill/order_pill/index';
    </script>";
  }else{
    echo "Delet fail!";
  }
}
//echo $_GET['id'];
