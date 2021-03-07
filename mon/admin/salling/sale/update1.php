<?php
  error_reporting( error_reporting() & ~E_NOTICE );
  session_start(); ?>

<?php
    // $conn = mysqli_connect("localhost","root","","pjdb");
    include('../libs/connect.php'); 
    
   
    // date_default_timezone_set('Asia/Bangkok');

    $sql = "INSERT INTO use usematerial
                                    (
                                        
                                        usematerial_id,
                                        material_id,
                                        em_id,
                                        date_use,
                                        quantity,
                                        status
                                        
                                        
                                    ) 
                            VALUES  (
                                    
                                    -- '$date_use',
                                    '".$_POST["usematerial_id"]."',
                                    '".$_POST["material_id"]."',
                                    '".$_POST["em_id"]."',
                                    '".$_POST["date_use"]."',
                                    '".$_POST["quantity"]."',
                                    '".$_POST["status"]."'
                                    
                                    )
                        ";
                mysqli_query($conn, $sql);

    $number = count($_POST["usematerial_id"]);
    
    if($number > 0)
    {
        for($i=0; $i<$number; $i++)
        {
            
            if(trim($_POST["usematerial_id"][$i]) != '')
            {

                $sql1 = "INSERT INTO usematerial_id
                            (
                    
                                usematerial_id,
                                quanlity,
                                material_id

                            ) 
                        VALUES (

                                '".mysqli_real_escape_string($conn, $_POST["usematerial_id,"][$i])."',
                                '".mysqli_real_escape_string($conn, $_POST["quanlity"][$i])."',
                                '".mysqli_real_escape_string($conn, $_POST["material_id"])."'
                            )
                        ";
                mysqli_query($conn, $sql1); 

                $sql2 = " UPDATE    material
                          SET       amount = quanlity + '".$_POST["quanlity"][$i]."'
                          WHERE     material.material_id = '".$_POST["material_id"][$i]."' ";
            
                mysqli_query($conn, $sql2);
                
            }
        }
        echo 'บันทึกข้อมูลการคืนอุปกรณ์';
        // header( "location: material/index.php" );
    }
    else
    {
        echo "Enter Name";
    }
?>