<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php 
$fm = new Format();
$pd = new product();
if(isset($_GET['MSHH'])){
	$MaHang = $_GET['MSHH'];
	$delpd = $pd->del_product($MaHang);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">  
			<?php 
			if(isset($delpd)){
				echo $delpd;
			} 
			?> 
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Mã hàng hóa</th>
						<th>Tên hàng hóa</th>
						<th>Giá</th>
						<th>Hình ảnh</th>
						<th>Chi tiết hàng hóa</th>
						<th>Số lượng</th>
						<th>Loại hàng hóa</th>
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>	
					<?php 
					$pdlist = $pd->show_product();
					if($pdlist){
						$i = 0;
						while($result = $pdlist->fetch_assoc()){
							$i++;
							?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['TenHH'] ?></td>
								<td><?php echo $fm->format_currency($result['Gia']).' '.'VNĐ' ?></td>
								<td> <img src="uploads/<?php echo $result['TenHinh'] ?>" width = "80"></td>
								<td><?php echo $fm->textShorten($result['ChiTietHH'],50)  ?></td>
								<td><?php echo $result['SoLuongHang'] ?></td>
								<td><?php echo $result['TenLoaiHang'] ?></td>
								<td> <?php 
								if($result['type'] == 1){
									echo 'Nổi bật';
								}else { echo 'Không nổi bật';
							}
						?> </td>
						
						<td><a href="productedit.php?MSHH=<?php echo $result['MSHH']?>">Sửa</a> || <a onclick= "return confirm('Bạn có muốn xóa?')" href="?MSHH=<?php echo $result['MSHH']?>">Xóa</a></td>
					</tr> 
					<?php 
				}
			}
			?>
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
