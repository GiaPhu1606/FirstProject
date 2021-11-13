<?php 
include '../classes/adminlogin.php';

?>
<?php 
$class = new adminlogin();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$aduser = $_POST['aduser'];
	$adpass = md5($_POST['adpass']);
	
	$login_check = $class->login_admin($aduser,$adpass);
}
?>
<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container">
		<section id="content">
			<form action="login.php" method="POST">
				<h1>Đăng nhập quản lí</h1>
				<span><?php
				if(isset($login_check)){
					echo $login_check;
				}
			?>
				
			</span>
			<div>
				<input type="text" autocomplete="off" placeholder="Tên đăng nhập" required="" name="aduser"/>
			</div>
			<div>
				<input type="password" autocomplete="off" placeholder="Mật khẩu" required="" name="adpass"/>
			</div>
			<div>
				<input  type="submit" value="Đăng nhập" />
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>