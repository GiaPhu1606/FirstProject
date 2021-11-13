<?php 
include 'inc/header.php';
include 'inc/slider.php';
?>

<div class="main">
	
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Hàng hóa</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			$products = $product->getproducts();
			if($products){
				while ($result = $products->fetch_assoc()) {
					
					?>
					<div class="grid_1_of_4 images_1_of_4" style="height: 479px;">
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
		
		
	</div>
	<div>
		<?php 
		$product_all = $product->get_all_product();
		$product_count = mysqli_num_rows($product_all);
		$product_button = ceil($product_count/4);
		$i= 1;
		echo '<p>Trang :</p>';
		for($i=1;$i<$product_button;$i++){
			echo '<a style="margin: 0px 5px;" href="products.php?trang='.$i.'">'.$i.'</a>';

		} 

		?>

	</div>
</div>
</div>
<?php 
include 'inc/footer.php';
?>