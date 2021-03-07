<?php
if(isset($_GET['id'])){

//รับค่ารหัสการซ่อม
$query1 = $db->prepare("SELECT * FROM usematerial WHERE usematerial_id = :id");
$query1->execute([
'id'=>$_GET['id'],
]);

if($query1->rowCount()>0){
    $data = $query1->fetch(PDO::FETCH_ASSOC);
  }
}
//================================================
//คิวรี่อะไหล่
$query_material = $db->prepare("SELECT * FROM usematerial ");
$query_material->execute();
$material = $query_material->fetchAll(PDO::FETCH_ASSOC);
?>

<center>
  <?php  if($data['status'] == ยกเลิกการเบิก){ ?>
    <div class="text-left">
      เลือกยารักษา
    </div>
    <p>
  <table class="table table-striped table-bordered cart">
    <thead>
      <tr>
        <th>รหัส</th>
        <th>รายการ</th>
        <th>จำนวน</th>
      </tr>
    </thead>
    <tbody>
  <?php
  $i=0;
  foreach ($material as $key=> $value): ?>
  <tr >
      <td><?=++$i;?></td>
      <input type="hidden" name="usematerial_id" value="<?=$data["usematerial_id"]?>">
      <td><input type="checkbox" name="material_id[<?=$key?>]" value="<?=$value['material_id']?>">  <?=$value['pmaterial_name']?></td>
      <td class=""><input type="number" value="['quantity']" class="quantity" name="quantity[<?=$key?>]"></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php
 }else {?>

<?php }?>
<button type="submit" class="btn btn-success" name='ok'>อัพเดท</button>

<button type="button" class="btn btn-danger" onclick="window.location.href=' ?file=material/usematerial/index';">ยกเลิก</button>
</center>
</form>

<!--=======================================-->
<?php
if(isset($_POST['ok'])){
            
          //=======================update stock spare=======================
            foreach ($_POST['material_id'] as $key => $item) :
              $query3 = $db->prepare("UPDATE material SET
              amount = amount + :quantity WHERE material_id = :material_id");

              $result2 = $query3->execute([
                'materiall_id' => $_POST['material_id'][$key],
                'quantity' => $_POST['quantity'][$key],
              ]);
            endforeach;
          unset($_SESSION['usematerial']);

         
          echo "<script>
            alert('อัพเดทข้อมูลเรียบร้อยแล้ว');
                window.location = '?file=material/usematerial/index';
          </script>";
   }
 ?>
