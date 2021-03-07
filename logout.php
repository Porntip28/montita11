<?php

  session_start(); //check ปุ่ม logout
  unset($_SESSION['user']);// reset ค่าใน session
  // unset($_SESSION['cart']);
  header('location: index.php');

?>
