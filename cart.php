 <?php 
 include 'inc/header.php';

 ?>
 <?php 
 if(isset($_GET['idgiohang'])){
 	$idgiohang = $_GET['idgiohang'];
 	$delpd_cart = $ct->del_product_cart($idgiohang);
 }
 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
 	$idgiohang = $_POST['idgiohang'];
    $MaHang = $_POST['MSHH'];
 	$SoLuong = $_POST['SoLuong'];
 	$updateCart = $ct->update_cart($SoLuong,$idgiohang);
   //$update_quantity_pro = $ct->update_quantity_product($SoLuong,$MaHang,$idgiohang);

    
 }
 ?>
 <?php 
 if(!isset($_GET['id'])){
 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
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
 	.shopleft {
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
 				<h2>Giỏ hàng</h2>
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
 						<th width="20%">Tên hàng hóa</th>
 						<th width="25%">Hình ảnh</th>
 						<th width="15%">Giá</th>
 						<th width="25%">Số lượng</th>
 						<th width="20%">Tổng giá</th>
 						<th width="10%">Thao tác</th>
 					</tr>
 					<?php 
 					$get_product_cart = $ct->get_product_cart();
 					if($get_product_cart){
 						$SL = 0;
 						$tongtien = 0;
 						while($result = $get_product_cart->fetch_assoc()){
 							
 							?>
 							<tr>
 								<td><?php echo $result['TenHH'] ?></td>
 								<td><img src="admin/uploads/<?php echo $result['TenHinh'] ?>" alt=""/></td>
 								<td><?php echo $fm->format_currency($result['Gia']).' '.'VNĐ' ?></td>
 								<td>
 									<form action="" method="post">
 										<input type="hidden" name="idgiohang" value="<?php echo $result['idgiohang']?>"/>
                              <input type="hidden" name="MSHH" value="<?php echo $result['MSHH']?>"/>
 										<input type="number" name="SoLuong" min="1" value="<?php echo $result['SoLuong']?>"/>
 										<input type="submit" name="submit" value="Cập nhật"/>
 									</form>
 								</td>
 								<td><?php 
 								$tonggia = $result['Gia'] * $result['SoLuong'];
 								echo $fm->format_currency($tonggia).' '.'VNĐ';
 							?></td>
 							<td><a onclick="return confirm('Bạn có muốn xóa?')" href="?idgiohang=<?php echo $result['idgiohang'] ?>">Xóa</a></td>
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
 				<table style="float:right;text-align:left;" width="40%">
 					<tr>
 						<th>Tổng tiền: </th>
 						<td>
 							<?php 
 							
 							echo  $fm->format_currency($tongtien).' '.'VNĐ';
 							
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
 	<div class="shopping">
 		<div class="shopleft">
 			<a style="color:white;" class="payment_href"  href="index.php">Tiếp tục mua hàng</a>
 		</div>
 		<div class="shopright">
 			<div class="payment">
 				<a style="color:white;" class="payment_href" href="payment.php">Thanh toán</a>
 			</div>
 		</div>
 	</div>
 </div>  	
 <div class="clear"></div>
</div>
</div>

<?php 
include 'inc/footer.php';
?>