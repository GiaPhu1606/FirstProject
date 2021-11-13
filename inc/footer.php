</div>
<div class="footer">
	<div class="wrapper">	
		<div class="section group">
			<div class="col_1_of_4 span_1_of_4">
				<h4>Thông tin về website</h4>
				<ul>
					<li><a href="#">Về chúng tôi</a></li>
					<li><a href="#">Dịch vụ khách hàng</a></li>
					<li><a href="#"><span>Tìm kiếm nâng cao</span></a></li>
					<li><a href="#">Đặt hàng & Hủy đơn hàng</a></li>
					<li><a href="#"><span>Liên hệ với chúng tôi</span></a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Tại sao mua hàng từ website chúng tôi?</h4>
				<ul>
					<li><a href="#">Về chúng tôi</a></li>
					<li><a href="#">Dịch vụ CSKH</a></li>
					<li><a href="#">Chính sách bảo mật</a></li>
					
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Tài khoản của tôi</h4>
				<ul>
					<li><a href="contact.php">Đăng nhập</a></li>
					<li><a href="index.php">Xem giỏ hàng</a></li>
					<li><a href="#">Sản phẩm yêu thích</a></li>
					<li><a href="faq.php">Trợ giúp</a></li>
				</ul>
			</div>
			<div class="col_1_of_4 span_1_of_4">
				<h4>Liên hệ</h4>
				<ul>
					<li><span>+84-07374754</span></li>
				</ul>
				<div class="social-icons">
					<h4>Theo dõi tôi</h4>
					<ul>
						<li class="facebook"><a href="https://www.facebook.com/nguyengiaphu1601" target="_blank"> </a></li>
						<li class="twitter"><a href="#" target="_blank"> </a></li>
						<li class="googleplus"><a href="#" target="_blank"> </a></li>
						<li class="contact"><a href="#" target="_blank"> </a></li>
						<div class="clear"></div>
					</ul>
				</div>
			</div>
		</div>
		<div class="copy_right">
			<p>
				&copy; Copyright <a href="https://www.facebook.com/nguyengiaphu1601">Nguyễn Gia Phú</a>. All Rights Reserved.
			</p>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
	 		*/
	 		
	 		$().UItoTop({ easingType: 'easeOutQuart' });
	 		
	 	});
	 </script>
	 <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
	 <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	 <script defer src="js/jquery.flexslider.js"></script>
	 <script type="text/javascript">
	 	$(function(){
	 		SyntaxHighlighter.all();
	 	});
	 	$(window).load(function(){
	 		$('.flexslider').flexslider({
	 			animation: "slide",
	 			start: function(slider){
	 				$('body').removeClass('loading');
	 			}
	 		});
	 	});
	 </script>
	</body>
	</html>