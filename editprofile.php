<?php 
include 'inc/header.php';
?>
<?php 
$login_check = Session::get('customer_login');
if($login_check == false){
 header('Location:login.php');
}
?>
<?php 

$id = Session::get('customer_id');
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
 $UpdateCustomer = $cs->update_customer($_POST,$id);
}

?> 
<div class="main">
  <div class="content">
    <div class="section group">
      <div class="content_top">
         <div class="heading">
            <h3>Cập nhật thông tin</h3>
         </div>
         <div class="clear"></div>
      </div>
      <form action="" method="POST">
         <table class="tblone">
            <tr>

               <?php 
               if(isset($UpdateCustomer)){
                  echo '<td colspan="3">'.$UpdateCustomer.'</td>';
               }
               ?>

            </tr>
            <?php 
            $id = Session::get('customer_id');
            $get_customer = $cs->show_customer($id);
            if($get_customer){
               while($result = $get_customer->fetch_assoc()){
                ?>
                <tr>
                   <td>Họ tên</td>
                   <td>:</td>
                   <td><input type="text" name="name" value="<?php echo $result['HoTenKH'] ?>"></td>
                </tr>
                <tr>
                   <td>Nghề nghiệp</td>
                   <td>:</td>
                   <td><input type="text" name="job" value="<?php echo $result['nghenghiep'] ?>"></td>
                </tr>
                <tr>
                  <td>Địa chỉ</td>
                  <td>:</td>
                  <td>
                   <?php 
                   $id = Session::get('customer_id');
                   $get_addrcustomer = $cs->show_addrcustomer($id);
                   if($get_addrcustomer ){
                     $i = 0;
                     while($result_addr = $get_addrcustomer->fetch_assoc() ){
                        $i++;

                        ?>

                         <input type="text" readonly="readonly" value=" <?php echo $i.')'.' '.$result_addr['DiaChi'] ?> "> <br> <br>
                        <?php 
                     }
                  } 
                  ?>
               </td>
            </tr>
            <tr>
             <td>Tên công ty</td>
             <td>:</td>
             <td><input type="text" name="company" value="<?php echo $result['TenCongTy'] ?>"></td>
          </tr>
          <tr>
             <td>Số điện thoại</td>
             <td>:</td>
             <td><input type="text" name="phone" value="<?php echo $result['SoDienThoai'] ?>"></td>
          </tr>
          <tr>
             <td>Số fax</td>
             <td>:</td>
             <td><input type="text" name="fax" value="<?php echo $result['SoFax'] ?>"></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
         </tr>
         <tr>
          <td colspan="3"><input type="submit" name="save" value="Lưu" ></td>

       </tr>

       <?php 
    }
 }
 ?>
</table>
</form>
</div>

</div>

<?php 
include 'inc/footer.php';
?>