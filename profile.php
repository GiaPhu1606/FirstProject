<?php 
include 'inc/header.php';
?>
<?php 
$login_check = Session::get('customer_login');
if($login_check == false){
  header('Location:login.php');
}
if(isset($_POST['edit'])){

  header('Location:editprofile.php');
}
if(isset($_POST['chooseaddr'])){
  header('Location:chooseaddress.php');
}
?> 
<style>
   .tb_right{
      text-align: left !important;
   }
   .tb_edit{
      text-align: right !important;
   }
   .tb_left{
      text-align: right !important;
   }
</style>

<div class="main">
 <div class="content">
  <div class="section group">
   <div class="content_top">
      <div class="heading">
         <h3>Hồ sơ của tôi</h3>
      </div>
      <div class="clear"></div>
   </div>
   <form action="" method="POST">
      <table class="tblone">
       <?php 
       $id = Session::get('customer_id');
       $get_customer = $cs->show_customer($id);
       if($get_customer ){
         while($result = $get_customer->fetch_assoc() ){


           ?>
           <tr>
              <td class="tb_left">Họ tên</td>
              <td>:</td>
              <td class="tb_right"><?php echo $result['HoTenKH'] ?></td>
           </tr>
           <tr>
              <td class="tb_left">Tên đăng nhập</td>
              <td>:</td>
              <td class="tb_right"><?php echo $result['Username'] ?></td>
           </tr>
           <tr>
            <td class="tb_left">Nghề nghiệp</td>
            <td>:</td>
            <td class="tb_right"><?php echo $result['nghenghiep'] ?></td>
         </tr>
         <tr>
            <td class="tb_left">Địa chỉ</td>
            <td>:</td>
            <td class="tb_right">
               <?php
                
               $id = Session::get('customer_id');
               $get_addrcustomer = $cs->show_addrcustomer($id);
               if($get_addrcustomer ){
                  $i = 0;

                  while($result_addr = $get_addrcustomer->fetch_assoc() ){
                     $i++;
                     
                     ?>
                    
                     <?php echo $i.' '.':'.' '.$result_addr['DiaChi'].'<br>'?>
                    
                     <?php 
                  }
              }  
            
            ?>
               
            </td>
         </tr>
         <tr>
           <td class="tb_left">Tên công ty</td>
           <td>:</td>
           <td class="tb_right"><?php echo $result['TenCongTy'] ?></td>
        </tr>
        <tr>
           <td class="tb_left">Số điện thoại</td>
           <td>:</td>
           <td class="tb_right"><?php echo $result['SoDienThoai'] ?></td>
        </tr>
        <tr>
           <td class="tb_left">Số fax</td>
           <td>:</td>
           <td class="tb_right"><?php echo $result['SoFax'] ?></td>
        </tr>
        <tr>
         <td class="tb_left">Email</td>
         <td>:</td>
         <td class="tb_right"><?php echo $result['email'] ?></td>
      </tr>
      <tr>
         <td colspan="3" class="tb_edit"><input type="submit" name="edit" value="Cập nhật hồ sơ" ></td>

      </tr>

      <?php 
   }
}
?>
</table>
</div>
</form>
</div>

<?php 
include 'inc/footer.php';
?>