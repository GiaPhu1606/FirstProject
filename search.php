<?php 
include 'inc/header.php';

?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<?php 
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$tukhoa = $_POST['tukhoa'];
				$search_pd = $product->search_pd($tukhoa);
			}
			?>
			<div class="heading">
				<h3>Từ khóa tìm kiếm: <?php echo $tukhoa ?> </h3>
			</div>
			
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php 
			
			if($search_pd){
				while($result = $search_pd->fetch_assoc()){

					?>
					<div class="grid_1_of_4 images_1_of_4">
						<a href="preview-3.php"><img src="../admin/uploads/<?php echo $result['TenHinh'] ?>"></a>
						<h2><?php echo $result['TenHH'] ?></h2>
						<p><?php echo $fm->textShorten($result['ChiTietHH'],50)  ?></p>
						<p><span class="price"><?php echo $result['Gia'].' '.'VNĐ' ?></span></p>
						<div class="button"><span><a href="details.php?MSHH=<?php echo $result['MSHH'] ?>" class="details">Chi tiết</a></span></div>
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
