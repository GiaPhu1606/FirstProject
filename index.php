<?php 
include 'inc/header.php';
include 'inc/slider.php';
?>

<div class="main">
	
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Nổi bật</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			$product_feathered = $product->getproduct_feathered();
			if($product_feathered){
				while ($result = $product_feathered->fetch_assoc()) {
					
					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result['TenHinh'] ?>" /></a>
						<h2> <?php echo $result['TenHH'] ?> </h2>
						<p><?php echo $fm->textShorten($result['ChiTietHH'],50) ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result['Gia']).' '.'VNĐ' ?></span></p>
						<div class="button"><span><a href="details.php?MSHH=<?php echo $result['MSHH'] ?>" class="details">Chi tiết</a></span></div>
					</div>
					<?php 
				}
			}
			?>
		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>Hàng hóa mới</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			$product_new = $product->getproduct_new();
			if($product_new){
				while ($result_new = $product_new->fetch_assoc()) {
					
					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="details.php"><img src="admin/uploads/<?php echo $result_new['TenHinh'] ?>" /></a>
						<h2> <?php echo $result_new['TenHH'] ?> </h2>
						<p><?php echo $fm->textShorten($result_new['ChiTietHH'],50) ?></p>
						<p><span class="price"><?php echo $fm->format_currency($result_new['Gia']).' '.'VNĐ' ?></span></p>
						<div class="button"><span><a href="details.php?MSHH=<?php echo $result_new['MSHH'] ?>" class="details">Chi tiết</a></span></div>
					</div>
					
					<?php 
				}
			}
			?>
			
		</div>
	</div>
</div>

<?php 
include 'inc/footer.php';
?>