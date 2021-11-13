<?php 
include 'inc/header.php';

?>
<?php 
if(!isset($_GET['MaLoaiHang']) || $_GET['MaLoaiHang'] == NULL){
	echo "<script>window.location ='404.php' </script>";
}else{
	$MaLoai = $_GET['MaLoaiHang'];
}

?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<?php 
			$namecat = $cat->getnamebycat($MaLoai);
			if($namecat){
				($result_name = $namecat->fetch_assoc())

				?>
				<div class="heading">
					<h3>Loại hàng hóa: <?php echo $result_name['TenLoaiHang'] ?> </h3>
				</div>
				<?php 
				
			}
			?>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			$productbycat = $cat->getproductbycat($MaLoai);
			if($productbycat){
				while($result = $productbycat->fetch_assoc()){

					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"><img src="admin/uploads/<?php echo $result['TenHinh'] ?>"></a>
						<h2><?php echo $result['TenHH'] ?></h2>
						<p><?php echo $fm->textShorten($result['ChiTietHH'],50)  ?></p>
						<p><span class="price"><?php echo $result['Gia'].' '.'VNĐ' ?></span></p>
						<div class="button"><span><a href="details.php?MSHH=<?php echo $result['MSHH'] ?>" class="details">Chi tiết</a></span></div>
					</div>
					<?php 
				}
			}else{
				echo 'Loại hàng hóa không có';
			}
			?>
		</div>
	</div>
</div>

<?php 
include 'inc/footer.php';
?>
