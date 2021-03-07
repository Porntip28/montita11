<?php
$moo_id = $_GET['id'];
  // echo $moo_id = $_GET['id'];
    $query_cus = $db->prepare("INSERT INTO user
       (name, surname ,email ,tel ,address ,username ,password ,	level, status)
        VALUES (:name, :surname ,:email ,:tel ,:address ,:username ,:password ,:level ,:status)");
        $result_cus = $query_cus->execute([
          'name'=>$_POST['name'],
          'surname' => $_POST['surname'],
          'email' => 0,
          'tel' => 0,
          'address' => 0,
          'username' => 0,
          'password' => 0,
          'level' => 3,
          'status' => 1,
        ]);

  $user_id = $db->lastInsertId();
    $query_sale = $db->prepare("INSERT INTO salling
                (moo_id, user_id ,type_pay,status_send)
        VALUES (:moo_id, :user_id ,:type_pay,:status_send)");
        $result_sale = $query_sale->execute([
          'moo_id'=>$moo_id,
          'user_id' => $user_id,
          'type_pay' => $_REQUEST['pay'],
          'status_send' => $_REQUEST['send'],
          ]);
          $sale_id = $db->lastInsertId();  

    //     $query_send = $db->prepare("INSERT INTO send
    //  (send_id, status_send)
    //   VALUES (:send_id, :status_send)");
    //   $result_send = $query_send->execute([
    //     'sale_id'=>$sale_id,
    //     'status_send' => $_REQUEST['send'],
        
    //   ]);

    // $send_id = $db->lastInsertId();

if($_POST['down']){
  // try {
  $installment = $db->prepare("INSERT INTO installment
              (sale_id, date_install, amount ,down,month,status_pay)
      VALUES (:sale_id, :date_install, :amount ,:down,:month,:status_pay)");
      $sale2 = $installment->execute([
        'sale_id'=>$sale_id,
        'date_install' => date('Y-m-d h:i:s'),
        'amount' => $_REQUEST['price_sale'],
        'down' => $_REQUEST['down'],
        'month' => $_REQUEST['month'],
        'status_pay' => 1,
        
      ]);
    //   $db->exec($installment);
    //       echo "New record created successfully";
    //       }
    //       catch(PDOException $e)
    // {
    //   echo $installment . "<br>" . $e->getMessage();
    // }

}else{
  $query_pay = $db->prepare("INSERT INTO pay
     (sale_id, pay_date, amount_pay )
      VALUES (:sale_id, :pay_date, :amount_pay)");
      $result_pay = $query_pay->execute([
        'sale_id'=>$sale_id,
        'pay_date' => date('Y-m-d h:i:s'),
        'amount_pay' =>$_POST['price_sale'],
        
      ]);
      }

      if($_POST['send']){
        $send = $db->prepare("INSERT INTO send 
              (sale_id,user_id,status_send)
      VALUES (:sale_id,:user_id,:status_send)");
    $result_send = $send->execute([
        'sale_id'=>$sale_id,
        'user_id' => $user_id,
        'status_send' => $_REQUEST['send'],
        ]);
      }

      $update_status = $db->prepare("UPDATE moo SET
                                  status_mo = 3
                                  WHERE moo_id = :id");
      $result_status = $update_status->execute([
        'id'=>$_GET['id'],
      ]);

      
      echo "<script>
        alert('บันทึกข้อมูลการขายเรียบร้อยแล้ว');
            window.location = '?file=moo/mo/sale_view&id=$sale_id';
      </script>";
// }
//=========================================================
