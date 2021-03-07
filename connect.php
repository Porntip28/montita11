<?php
$db_host = 'localhost'; // Sever database
$db_name = 'pjdb'; // ฐานข้อมูล
$db_user = 'root'; // ชื่อผู้ใช้
$db_pass = ''; // รหัสผ่าน
$db = null;

try { // ให้พยายามทำงานคำสั่งต่อไปนี้
  $db = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_pass);
  $db->exec("SET CHARACTER SET utf8"); // ให้รองรับภาษาไทย
}catch (PDOException $e) { //กรณีทำงานผิดพลาด
  echo "พบปัญหา : ".$e->getMessage(); //แสดง Error
}

 ?>
