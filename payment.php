 <?php 
include 'inc/header.php';
?>
<?php 
if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
  $customer_id = Session::get('customer_id');
  $MaDC = $_GET['MaDC'];
  $insertOrder = $ct->insertOrder($customer_id,$MaDC);
  $delCart = $ct->del_all_cart();
   header('Location:success.php');
}

?>
<style>
 .box_left {
    width: 50%;
    border: 1px solid brown;
    float: left;
    padding: 4px;
 }
 .box_right {
    width: 45%;
    border: 1px solid brown;
    float: right;
    padding: 4px;
 }
 .tb_right{
   float: left;
 }
 .order{
   padding: 10px 70px;
   border: none;
   background: red;
   font-size: 25px;
   color: #fff;
   margin:  10px;
   cursor:  pointer;

}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
      <div class="section group">
         <div class="heading">
            <h3>Thanh toán</h3>
         </div>
         <div class="clear"></div>
         
            <div class="cartpage">

               <?php 
               if(isset($updateCart)){
                  echo $updateCart;
                  
               }
               ?>
               <?php 
               if(isset($delpd_cart)){
                  echo $delpd_cart;
                  
               }
               ?>
               <table class="tblone">
                  <tr>
                     <th width="5%">ID</th>
                     <th width="15%">Tên hàng hóa</th>
                     <th width="15%">Giá</th>
                     <th width="25%">Số lượng</th>
                     <th width="20%">Tổng giá</th>
                     
                  </tr>
                  <?php 
                  $get_product_cart = $ct->get_product_cart();
                  if($get_product_cart){
                     $SL = 0;
                     $tongtien = 0;
                     $i = 0;
                     while($result = $get_product_cart->fetch_assoc()){
                        $i++;
                        
                        ?>
                        <tr>
                           <td><?php echo $i ?></td>
                           <td><?php echo $result['TenHH'] ?></td>
                           <td><?php echo $fm->format_currency($result['Gia']).' '.'VNĐ' ?></td>
                           <td>

                              <?php echo $result['SoLuong'] ?>
                              
                           </td>
                           <td><?php 
                           $tonggia = $result['Gia'] * $result['SoLuong'];
                           echo $fm->format_currency($tonggia).' '.'VNĐ';
                        ?></td>
                        
                     </tr>
                     <?php 
                     $tongtien += $tonggia;
                     $SL += $result['SoLuong'];
                  } 
               }
               ?>
            </table>
            <?php
            $check_cart = $ct->check_cart();
            if($check_cart){ 


             ?>
             <table style="float:right;text-align:center; margin: 5px;" width="40%">
               <tr>
                  <th>Tổng tiền: </th>
                  <td>
                     <?php 
                     
                     echo $fm->format_currency($tongtien).' '.'VNĐ';
                     
                     Session::set('SL',$SL);

                     ?>
                  </td>
               </tr>
               
            </tr>
         </table>
         <?php 
      }else{
         echo 'Giỏ hàng hiện trống. Mua hàng ngay!';
      }
      ?>
      
   </div>

<div class="heading">
            <h4>Thông tin đặt hàng</h4>
         </div>
         <div class="clear"></div>
   <table class="tblone">
                  <tr>
                     <th width="5%">ID</th>
                     <th width="15%">Họ tên</th>
                     <th width="15%">Số điện thoại</th>
                     <th width="25%">Số fax</th>
                     <th width="20%">Địa chỉ</th>
                     <th width="10%">Thao tác</th>
                     
                  </tr>
    <?php 
   $id = Session::get('customer_id');
   if(isset($_GET['MaDC'])){
   $MaDC = $_GET['MaDC'];
   $get_customer_order = $cs->show_customer_order_choose($MaDC,$id);
   }else{
    $get_customer_order = $cs->show_customer_order($id);
   }
    if($get_customer_order ){
      $i=0;
      while($result = $get_customer_order->fetch_assoc() ){
         $i++;

       ?>
       <tr>
          <td><?php echo $i ?></td>
          <td ><?php echo $result['HoTenKH'] ?></td>
          <td ><?php echo $result['SoDienThoai'] ?></td>
          <td ><?php echo $result['SoFax'] ?></td>
          <td>  
               <?php echo $result['DiaChi']?>
         </td>
            <?php  if(isset($_GET['MaDC'])){
            $MaDC = $_GET['MaDC'];
            ?>
            <td><p>Đã chọn</p> </td>
            <?php
            }else {
               ?>
               <td> <a class="add" href="?MaDC=<?php echo $result['MaDC'] ?>">Chọn</a></td>
            <?php } ?>
            
   </tr>

 <?php }
} ?>

</table>
</div>
  </div>

<center><a href="?orderid=order&madc=<?php echo $_GET['MaDC'] ?>" class="order">Đặt hàng</a></center><br>

</div>


</form>
<?php 
include 'inc/footer.php';
?>