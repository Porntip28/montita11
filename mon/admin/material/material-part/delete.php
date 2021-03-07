<?php

if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM usematerial WHERE usematerial_id = :id");
  $result = $query->execute([
    "id" => $_GET['id'],
  ]);


  if($result){
    echo "<script>
      alert('ลบข้อมูลเรียบร้อยแล้ว');
      window.location = '?file=material/usematerial/index';
    </script>";
  }else{
    echo "Delet fail!";
  }
}
//echo $_GET['id'];
