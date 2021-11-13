<?php 
include 'inc/header.php';
?>
<?php 
if(!isset($_GET['MSHH']) || $_GET['MSHH'] == NULL){
	echo "<script>window.location ='404.php' </script>";
}else{
	$MaHang = $_GET['MSHH'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	$SoLuong = $_POST['SoLuong'];
	$AddtoCart = $ct->add_to_cart($SoLuong,$MaHang);

	
}
if(isset($_POST['binhluan_submit'])){
	$bluan = $cs->insert_bluan();
}
?>
<div class="main">
	<div class="content">
		<div class="section group">
			<?php 
			$get_product_details = $product->get_details($MaHang);
			if($get_product_details){
				while($result_details = $get_product_details->fetch_assoc()){
					?>
					<div class="cont-desc span_1_of_2">				
						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_details['TenHinh'] ?>"  />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_details['TenHH'] ?> </h2>
							<p><?php echo  $fm->textShorten($result_details['ChiTietHH'],100)  ?></p>					
							<div class="price">
								<p>Giá: <span><?php echo $fm->format_currency($result_details['Gia']).' '.'VNĐ' ?></span></p>
								<p>Loại hàng hóa: <span><?php echo $result_details['TenLoaiHang'] ?></span></p>
								
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="SoLuong" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Mua ngay"/>
								</form>				
								<?php 
								if(isset($AddtoCart)){
									echo '<span style="color:red;font-size:18px;"> '.$AddtoCart.'</span>';

								}
								?>
							</div>

						</div>
						<div class="product-desc">
							<h2>Chi tiết hàng hóa</h2>
							<p><?php echo  $fm->textShorten($result_details['ChiTietHH'],100)  ?></p>
						</div>
						
					</div>
					<?php 
				}
			}
			?>

			<div class="rightsidebar span_3_of_1">
				<h2>Loại hàng hóa</h2>
				<ul>
					<?php 
					$getall_category = $cat->show_category();
					if($getall_category ){
						while($result_allcat = $getall_category->fetch_assoc()){
							?>
							<li><a href="productbycat.php?MaLoaiHang=<?php echo $result_allcat['MaLoaiHang'] ?>"><?php echo $result_allcat['TenLoaiHang'] ?></a></li>
							<?php 
						}
					}
					?>
				</ul>
				
			</div>
		</div>
		<div class="binhluan">
			<div class="row">

				<div class="col-md-8">
					<h5>Bình luận hàng hóa</h5>
					<?php
					if(isset($bluan)){
						echo $bluan;
					} 
					?>
					<form action="" method="POST">
						<p><input type="hidden" value="<?php echo $MaHang ?>" name="pd_id_bluan"></p>
						<p><input type="text" placeholder="Điền tên" class="form-control" name="tenbluan"></p>
						<p><textarea rows="5" style="resize: none;" placeholder="Bình luận...." class="form-control" name="bluan"></textarea></p>
						<p><input type="submit" name="binhluan_submit" class="btn btn-success" value="Gửi bình luận"></p>
					</form>
				</div>
			</div>	
		</textarea>
	</div>

</div>

<?php 
include 'inc/footer.php';
?>