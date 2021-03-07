
      <?php
      $orderStatus = include 'status_m.php';
      if(isset($_GET['id'])){
        $query = $db->prepare("SELECT  * FROM order_moo  WHERE order_m_id=:id");
        $query->execute([
          'id'=>$_GET['id']
        ]);

        if($query->rowCount()>0){
          $data = $query->fetch(PDO::FETCH_ASSOC);
        }
       }

      ?>
      <?php
        $query1 = $db->prepare("SELECT * FROM order_moo INNER JOIN detail_order_m
        ON detail_order_m.order_m_id = order_moo.order_m_id
        INNER JOIN suplier ON suplier.sup_id = detail_order_m.sup_id
        INNER JOIN gene ON gene.gene_id = detail_order_m.gene_id
        WHERE detail_order_m.order_m_id = :order_m_id"); //:idตามไอดีที่GETมา

      $query1->execute([
        'order_m_id'=> $_GET['id'],
        // 'order_spare_id'=>$data->order_spare_id
      ]);
      if($query1->rowCount()>0){
        $data1 = $query1->fetchAll(PDO::FETCH_ASSOC);
      }
       ?>
  <div class="text-center">
    <img src="image/title2.png" width="200" class="pull-left">
    <h5>Montita Farme ฟาร์มหมูมณฑิตา</h5>
    30 หมู่4 ต.หาดสำราญ อ.หาดสำราญ จ.ตรัง 92120
    <br>
    </div>
      <form class="" action="" method="post">
      <div class="row">
        <div class="col-sm-12">
      <table class="table ">
       <tr><th class="text-right" width="20%">รหัสใบส่งซื้อ :</th><td><?=$data["order_m_id"];?></td></tr>
       <tr><th class="text-right">ผู้สั่ง :</th><td><?=$_SESSION['user']['name'];?> <?=$_SESSION['user']['surname'];?> </td></tr>
         <tr><th class="text-right">วันที่ :</th><td><?=date("d-m-Y", strtotime ($data["date_order_m"]));?></td></tr>
         <tr><th class="text-right">สถานะ :</th><td>
           <?php
            if($data['status_m'] == 2){
              echo $orderStatus[$data['status_m']];
            }else {?>
              <select class="form-form-control" name="status_m">
                <option value="1">ยังไม่ได้รับ</option>
                <option value="2">ได้รับเเล้ว</option>
              </select>
          <?php }?>
         </tr>
       </table>
      <!-- ====================================================-->
        <table class="table table-striped table-bordered cart">
          <thead>
            <tr>
              <th>#</th>
              <th>รุ่นสุกร</th>
              <th>สายพันธุ์</th>
              <th>น้ำหนัก</th>
              <th>เพศ</th>
              <th>ราคาซื้อ</th>
              <th>ฟาร์มคู่ค้า</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sum_m=0;
            $i=0;
            foreach($data1 as $key=> $val):
              $sum_m = $sum_m + $val["buy_price"];
              ?>
            <tr >
                <td><?=++$i;?></td>
                <td>
                  <?=$val["gene"];?>
                  <input type="hidden" name="gene[]" value="<?=$val["gene"];?>">
                </td>
                <td >
                  <?=$val["gene_name"];?>
                </td>
                <td >
                  <?=$val["weight"];?>
                  <input type="hidden" name="weight[]" value="<?=$val["weight"];?>">
                </td>
                <td>
                  <?=$val["sex"];?>
                  <input type="hidden" name="sex[]" value="<?=$val["sex"];?>">
                </td>
                <td >
                  <?=$val["buy_price"];?>
                  <input type="hidden" name="buy_price[]" value="<?=$val["buy_price"];?>">
                </td>
                <td >
                  <?=$val["sup_name"];?>
                </td>
            </tr>
      <?php endforeach; ?>

            <tfoot>
              <tr>
                <td colspan="7" class="text-right">
                  <b>รวมเป็นเงินทั้งสิ้น</b>
                </td>
                <td><font color="red"><?=number_format($sum_m,2,'.',',');?></font> <b>บาท<b></td>
              </tr>
            </tfoot>
          </tbody>
        </table>
        <center>
          <?php
           if($data['status_m'] == 2){

           }else {?>
            <input type="submit" class="btn btn-info" name="ok" value="อัพเดต"></center>
         <?php }?>
      </div>
      </form>
      </div>
      <p><a href="?file=moo/order_moo/index" class="btn btn-danger" role="button">กลับ</a>

      <!-- =================== ส่วนของการอัพเดท  -->
      <?php
      if(isset($_POST['ok'])){
      // print_r($_POST);
        $status = $_POST['status_m'];
        $order_id = $_GET['id']; //get id order motorcycle in  motor index page
        // $quantity = $_POST['quantity'];

        $query = $db->prepare("UPDATE order_moo SET
        status_m = :status_m
        WHERE order_moo.order_m_id = :id");

        $result = $query->execute([
        "id" => $_GET["id"],
        "status_m" => $_POST["status_m"]
        ]);
        echo "<script>
          alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
              window.location = '?file=moo/order_mo/index';
        </script>";

      //=======================update ข้อมูลรถลงดาต้าเบส=======================
      if($result){
        $order_id = $_GET['id'];

          $number = count($_POST["gene"]);
       if($number > 0)
       {
            for($i=0; $i<$number; $i++)
            {
                 if($_POST["gene"][$i] != '')
                 {
                   $query_mo = $db->prepare("INSERT INTO moo
                         (gene, weight, sex, buy_price, moo_number, price_sale ,image	,status_mo, order_id)
                         VALUES ( :gene, :weight, :sex, :buy_price, :moo_number , :price_sale , :image, :status_mo ,:order_id)");

                       $result_mo = $query_mo->execute([
                         'order_id' => $order_id,
                         'gene' => $_POST['gene'][$i],
                         'weight' => $_POST['weight'][$i],
                         'sex' => $_POST['sex'][$i],
                         'buy_price' => $_POST['buy_price'][$i],
                         'moo_number' => 0,
                         'price_sale' => 0,
                         'image' => 0,
                         'status_mo' => 7,
                       ]);
                       // echo $result_mo;
                 }
            }
          }
        }
      }
       ?>
