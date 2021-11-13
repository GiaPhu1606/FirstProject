<?php 
include 'lib/session.php';
Session::init();
?>
<?php
include_once 'lib/database.php';
include_once 'helpers/format.php';

spl_autoload_register(function($className){
	include_once "classes/".$className.".php";
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$cs = new customer();
$cat = new category();
$product = new product();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
	<title>Store Website</title>
	<meta http-equiv="charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>

	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script> 
	<script type="text/javascript" src="js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript">

		$(document).ready(function($){
			$('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
		});
	</script>
</head>
<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">

				<a href="index.php"><img src="images/logo.png" style="height: 113px;" /></a> 
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="search.php" method="POST">
						<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa"><input type="submit" name="search_pd" value="Tìm kiếm">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Giỏ hàng</span>
							<span class="no_product">
								<?php
								$check_cart = $ct->check_cart();
								if($check_cart){ 
									$SL = Session::get('SL');
									echo '('.$SL.')';
								}else {
									echo 'Trống';
								}
								?>
								

							</span>
						</a>
					</div>
				</div>
				<?php 
				if(isset($_GET['customer_id'])){
					$delCart = $ct->del_all_cart();
					Session::destroy();
				}
				?>
				<div class="login">
					<?php 
					$login_check = Session::get('customer_login');
					if($login_check == false){
						echo '<a href="login.php">Đăng nhập</a></div>';
					}else{
						echo '<a href="?customer_id='.Session::get('customer_id').' ">Đăng xuất</a></div>';
					}
					?>

					
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="menu">
				<ul id="dc_mega-menu-orange" class="dc_mm-orange">
					<li><a href="index.php">Trang chủ</a></li>
					<li><a href="products.php">Sản phẩm</a> </li>
					<?php 
					$check_cart = $ct->check_cart();
					if($check_cart == true){
						echo '<li><a href="cart.php">Giỏ hàng</a></li>';
					}else{
						echo '';
					}
					?>
					<?php 
					$customer_id = Session::get('customer_id');
					$check_order = $ct->check_order($customer_id);
					if($check_order == true){
						echo '<li><a href="orderdetails.php">Đơn hàng</a></li>';
					}else{
						echo '';
					}
					?>
					<?php 
					$login_check = Session::get('customer_login');
					if($login_check == false){
						echo '';
					}else{
						echo '<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						Tài khoản của tôi
						<span class="caret"></span></a>
						<ul class="dropdown-menu">
						<li>
						<a href="profile.php">Hồ sơ của tôi</a>
						</li>
						<li>
						<a href="address.php">Thêm địa chỉ</a>
						</li>
						
						</ul>
						</li>';
					}
					?>

					<li><a href="contact.php">Liên hệ</a> </li>
					<div class="clear"></div>
				</ul>
			</div>