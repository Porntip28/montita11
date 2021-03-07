<?php
$moo_id = $_GET['id'];
$_SESSION['cart'][$moo_id] = [
'amount' => 1,

];
header("location : ?file=moo/mo/index");
 ?>
