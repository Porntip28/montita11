<?php

if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM spare WHERE spare_id = :id");
  $result = $query->execute([
    "id" => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('ลบข้อมูลเรียบร้อยแล้ว');
      window.location = '?file=spare/spare/index';
    </script>";
  }else{
    echo "Delet fail!";
  }
}
//echo $_GET['id'];
