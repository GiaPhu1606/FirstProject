<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php  
$cat = new category();
if(isset($_GET['delMaLoaiHang'])){
	$Ma = $_GET['delMaLoaiHang'];
	$delcat = $cat->del_category($Ma);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<div class="block">
			<?php 
			if(isset($delcat)){
				echo $delcat;
			} 
			?>         
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>STT</th>
						<th>Tên loại hàng</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$show_cate = $cat->show_category();
					if($show_cate){
						$i = 0;
						while($result = $show_cate->fetch_assoc()){
							$i++;
							
							
							?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['TenLoaiHang'] ?></td>
								<td><a href="catedit.php?MaLoaiHang=<?php echo $result['MaLoaiHang']?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa?')" href="?delMaLoaiHang= <?php echo $result['MaLoaiHang']?>">Xóa</a></td>
							</tr>
							<?php
						} 
					}	
					?>	
				</tr>
			</tbody>
		</table>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

