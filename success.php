<?php 
include 'inc/header.php';
?>
<?php 
if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
 $customer_id = Session::get('customer_id');
 $insertOrder = $ct->insertOrder($customer_id);
 $delCart = $ct->del_all_cart();
 header('Location:success.php');
}

?>
<style>
   h2.success_order{
      text-align: center;
      color: red;
   }
   p.success_note{
      text-align: center;
      padding: 8px;
      font-size: 17px;
   }
</style>
<form action="" method="POST">
  <div class="main">
     <div class="content">
      <div class="section group">
         <h2 class="success_order">Đặt hàng thành công</h2>
         <p class="success_note">Chúng tôi sẽ liên lạc sớm nhất có thể để xác nhận đơn hàng. Để kiểm tra lại đơn hàng. <a href="orderdetails.php">Nhấn vào đây!</a></p>
         
      </div>
   </div>

</div>
</form>
<?php 
include 'inc/footer.php';
?>