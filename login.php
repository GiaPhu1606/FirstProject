<?php 
include 'inc/header.php';

?>
<?php 

$login_check = Session::get('customer_login');
if($login_check){
	header('Location:index.php');
}
?>
<?php  

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	
	$insertCustomer = $cs->insert_customer($_POST);
	
}

?>
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
	$loginCustomer = $cs->login_customer($_POST);
}

?>

<div class="main">
	<div class="content">
		<div class="login_panel">
			<h3>Khách hàng đăng nhập</h3>
			
			<?php 
			
			if(isset($loginCustomer) ){
				echo $loginCustomer;
			} 
			?>
			<form action="" method="POST" >
				<input type="text" autocomplete="off" name="Username" class="field" placeholder="Nhập tên đăng nhập...">
				<input  type="password" autocomplete="off" name="Password" class="field" placeholder="Nhập mật khẩu...">
				<div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng nhập" style="font-size: 19px; background: inherit"></div></div>
			</form>
		</div>
		
		

		<div class="register_account">
			<h3>Tạo tài khoản mới</h3>
			<?php
			if(isset($insertCustomer) ){ 
				echo $insertCustomer;
			} 
			
			?>
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" autocomplete="off" name="name" placeholder="Nhập họ tên..." >
								</div>
								
								<div>
									<input type="text" autocomplete="off" name="company" placeholder="Nhập tên công ty...(Nếu không có ghi 'Không')">
								</div>

								
								<div>
									<input type="text" autocomplete="off" name="phone" placeholder="Nhập số điện thoại...">
								</div>
								
								<div>
									<input type="text" autocomplete="off" name="fax" placeholder="Nhập số fax...">
								</div>
							</td>

							<td>
								<div>
									<input type="text" autocomplete="off" name="username" placeholder="Nhập tên đăng nhập...">
								</div>

								<div>
									<input type="text" autocomplete="off" name="password" placeholder="Nhập mật khẩu...">
								</div>
								<div>
									<input type="text" autocomplete="off" name="job" placeholder="Nhập nghề nghiệp...">
								</div> 
								
								<div>
									<input type="text" autocomplete="off" name="email" placeholder="Nhập email...">
								</div>
								

							</td>
						</tr> 
					</tbody></table> 
					<div class="search"><div><input type="submit" name="submit" class="grey" value="Đăng kí" style="font-size: 19px;
					background: inherit"></div></div>
					
					<div class="clear"></div>
				</form>
			</div>  	
			<div class="clear"></div>
		</div>
	</div>
	
	<?php 
	include 'inc/footer.php';
?>