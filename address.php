<?php 
include 'inc/header.php';

?>

<?php  
$login_check = Session::get('customer_login');
if($login_check == false){
   header('Location:login.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
  $customer_id = Session::get('customer_id');
  $insertAddrcustomer = $cs->insert_addrcustomer($_POST,$customer_id);  
}  
if(isset($_GET['idaddr'])){
 $idaddr = $_GET['idaddr'];
 $del_addr = $cs->del_addr($idaddr);
 header('Location:address.php');
}  


?>
<div class="main">
  <div class="content">
   <div class="login_panel">

      <table class="tblone" style="height: 40%;">
        
         <?php 
         $id = Session::get('customer_id');
         if(isset($del_addr)){
           echo $del_addr;
        }
        $get_customer = $cs->show_addrcustomer($id);
        if($get_customer){
           $i=0;
           while($result = $get_customer->fetch_assoc()){
              $i++;

              ?>
              <tr>
               <td>Địa chỉ <?php echo $i; ?></td>
               <td>:</td>
               <td><?php echo $result['DiaChi'] ?></td>
               <td><a onclick="return confirm('Bạn có muốn xóa?')" href="?idaddr=<?php echo $result['MaDC'] ?>">Xóa</a></td>
            </tr>
            
            <?php 
         }
      }
      ?>
   </div>
</table>
</div>

<div class="register_account">
   <h3>Thêm địa chỉ</h3>
   <?php
   if(isset($insertAddrcustomer) ){ 
    echo $insertAddrcustomer;
 } 
 
 ?>
 <form action="" method="POST">
  <table>
   <tbody>
     <tr>
      <td>
       
         <div>
          <input type="text" name="address" placeholder="Nhập địa chỉ...">
       </div> 
    </td>
   
 </tr> 
</tbody>
</table> 
<div class="search"><div><input type="submit" name="submit" class="grey" value="Thêm" style="font-size: 19px;
background: inherit"></div></div>

<div class="clear"></div>
</form>
</div>  	
<div class="clear"></div>
</div>
</div>

<?php 
include 'inc/footer.php';
?> 