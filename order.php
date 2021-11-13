 <?php 
 include 'inc/header.php';

 ?>
 <?php  
$ct = new cart();
if(!isset($_GET['SodonDH']) || $_GET['SodonDH'] == NULL){
    echo "<script>window.location ='orderdetails.php' </script>";
}else{
    $shd = $_GET['SodonDH'];
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
 				<h2>Chi tiết đơn hàng</h2>
 				<table class="tblone">
 					<tr>
                        <th width="10%">ID</th>
 						<th width="20%">Tên hàng hóa</th>
 						<th width="10%">Hình ảnh</th>
 						<th width="25%">Số lượng</th>
                        <th width="25%">Giá</th>
 					</tr>
 					<?php 
 					$get_product_order = $ct->get_product_order($shd);
 					if($get_product_order){
 						$SL = 0;
                        $i = 0;
 						$tongtien = 0;
 						while($result = $get_product_order->fetch_assoc()){
 							$i++;
 							?>
 							<tr>
                                <td><?php echo $i ?></td>
 								<td><?php echo $result['TenHH'] ?></td>
 								<td><img src="admin/uploads/<?php echo $result['TenHinh'] ?>" alt=""/></td>
 								<td><?php echo $result['SoLuong']?></td>
 								<td><?php echo $fm->format_currency($result['GiaDatHang']).' '.'VNĐ' ?></td>
 							
 						</tr>
 						<?php 
 						$tongtien += $result['GiaDatHang'];
 						$SL += $result['SoLuong'];
 					} 
 				}
 				?>
 			</table>
 				<table style="float:right;text-align:left;" width="40%">
 					<tr>
 						<th>Tổng tiền đơn hàng: </th>
 						<td>
 							<?php 
 							
 							echo  $fm->format_currency($tongtien).' '.'VNĐ';
 							
 							Session::set('SL',$SL);

 							?>
 						</td>
 					</tr>
 					
 				</tr>
 			</table>
 	 
 	</div>
    <div class="shopping">
         <div class="payment">
            <a style="color:white;" class="payment_href"  href="orderdetails.php">Trở về</a>
         </div>
      </div>
 </div>  	
 <div class="clear"></div>
</div>
</div>

<?php 
include 'inc/footer.php';
?>