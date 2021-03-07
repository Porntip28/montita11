<?php

if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM pill WHERE pill_id = :id");
  $result = $query->execute([
    "id" => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('ลบข้อมูลเรียบร้อยแล้ว');
      window.location = '?file=pill/pill/index';
    </script>";
  }else{
    echo "Delet fail!";
  }
}
//echo $_GET['id'];
