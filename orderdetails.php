  <?php 
 include 'inc/header.php';

 ?>
 <?php 
 $login_check = Session::get('customer_login');
 if($login_check == false){
   header('Location:login.php');
}
?>
<style>
   .payment {
     text-align: center;
     font-size: 20px;
     font-weight: bold;
     margin: 0px 0px auto auto;
     padding: 10px;
     background: #494D48;
     border: 1px solid #000;
     color: #FFFFFF;
     width: 200px;
  } 
  
</style>
<div class="main">
  <div class="content">
   <div class="cartoption">      
      <div class="cartpage">
         <h2 style=" width: 500px;">Đơn hàng</h2>
         <?php 

         if (isset($shifted_comfirm)){
            echo $shifted_comfirm;
         }
         ?>
         <table class="tblone">
            <tr>
               <th width="10%">ID</th>
               <th width="25%">Ngày đặt</th>
               <th width="25%">Dự kiến giao hàng</th>
               <th width="20%">Chi tiết đơn hàng</th>
               <th width="20%">Trạng thái</th>
               
            </tr>
            <?php 
            
            $get_cart_order = $ct->get_cart_order();
            if($get_cart_order){
               $i = 0;
               while($result = $get_cart_order->fetch_assoc()){
                  $i++;
                  ?>
                  <tr>
                     <td><?php echo $i ?></td>
                     <td><?php echo $fm->formatDate($result['NgayDH']) ?></td>
                     <?php if($result['NgayGH'] == '0000-00-00'){
                        ?>
                        <td><?php echo 'N/A'?></td>
                     <?php  
                     }else{
                        ?> 
                     <td><?php echo $fm->formatDateDelivery($result['NgayGH'])?></td>
                     <?php
                     }
                     ?>
                     <td><a href="order.php?SodonDH=<?php echo $result['SoDonDH'] ?>">Xem</a></td>
                     <td>
                        <?php 
                        if($result['TrangThaiDH'] == '0'){
                           echo 'Đang xử lí';
                        }elseif($result['TrangThaiDH'] == '1'){
                            
                           echo 'Đang vận chuyển';
 
                        }elseif($result['TrangThaiDH'] == '2') {
                           echo 'Đã nhận';
                        }
                        ?>

                     </td>
                  </tr>
                  
                  <?php 
                  
               } 
            }
            ?>
         </table>
         
         
         
      </div>
      <div class="shopping">
         <div class="payment">
            <a style="color:white;" class="payment_href"  href="index.php">Tiếp tục mua hàng</a>
         </div>
      </div>
   </div>   
   <div class="clear"></div>
</div>
</div>

<?php 
include 'inc/footer.php';
?>