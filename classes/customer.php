  <?php 
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/format.php');
 
 ?>

 <?php 
 
 class customer
 {
 	private $db;
 	private $fm;

 	public function __construct()
 	{
 		$this->db = new Database();
 		$this->fm = new Format();
 	}
 	public function insert_customer($data){
 		$name = mysqli_real_escape_string($this->db->link, $data['name']);
 		$company = mysqli_real_escape_string($this->db->link, $data['company']);
 		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
 		$fax = mysqli_real_escape_string($this->db->link, $data['fax']);
 		$username = mysqli_real_escape_string($this->db->link, $data['username']);
 		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
 		$job = mysqli_real_escape_string($this->db->link, $data['job']);
 		$email = mysqli_real_escape_string($this->db->link, $data['email']);

 		if($name =="" || $company =="" || $phone =="" || $fax =="" || $username =="" || $password =="" || $email =="" || $job =="" ){
 			$alert = "<span style='color:red;font-size:18px;'>Các trường không nên trống!</span>";
 			return $alert;
 		}else{
 			$check_username = "SELECT * FROM khachhang WHERE Username = '$username' LIMIT 1";
 			$result_check = $this->db->select($check_username);
 			if($result_check){
 				$alert = "<span style='color:red;font-size:18px;'>Tên đăng nhập đã tồn tại!!!</span>";
 				return $alert;
 			}else{
 				$query = "INSERT INTO khachhang (HoTenKH, TenCongTy, SoDienThoai, SoFax, Username, Password, email, nghenghiep) VALUES ('$name','$company','$phone','$fax','$username','$password','$email' ,'$job' )";
 				$result = $this->db->insert($query);
 				if($result){
 					$alert = "<span style='color:green;font-size:18px;'>Tạo tài khoản thành công</span>";
 					return $alert;
 				}else{
 					$alert = "<span style='color:red;font-size:18px;'>Tạo tài khoản không thành công</span>";
 					return $alert;
 				}

 			} 
 		}


 		
 	}
 	
 	
 	public function insert_addrcustomer($data,$id){
 		$address = mysqli_real_escape_string($this->db->link, $data['address']);
 		
 		if($address =="" ){
 			$alert = "<span style='color:red;font-size:18px;'>Các trường không nên trống!</span>";
 			return $alert;
 		}else{
 			$query = "INSERT INTO diachikh(DiaChi, MSKH) VALUES ('$address','$id')";
 			$result = $this->db->insert($query);
 			if($result){
               
 				$alert = "<span style='color:green;font-size:18px;'>Thêm địa chỉ thành công</span>";
 				return $alert;
 			}else{
 				$alert = "<span style='color:red;font-size:18px;'>Thêm địa chỉ không thành công</span>";
 				return $alert;
 			}

 		}	
 	}
 	public function login_customer($data){
 		$username = mysqli_real_escape_string($this->db->link, $data['Username']);
 		$password = mysqli_real_escape_string($this->db->link, md5($data['Password']));

 		if(empty($username) || empty($password)){
 			$alert = "<span style='color:red;font-size:18px;'>Tài khoản hoặc mật khẩu không nên trống!</span>";
 			return $alert;
 		}else{
 			$check_login = "SELECT * FROM khachhang WHERE Username = '$username' AND Password ='$password'";
 			$result_check = $this->db->select($check_login);
 			if($result_check){
 				$values = $result_check->fetch_assoc();
 				Session::set('customer_login',true);
 				Session::set('customer_id',$values['MSKH']);
 				Session::set('customer_name',$values['HoTenKH']);
 				header('Location:index.php');
 			}else{
 				$alert = "<span style='color:red;font-size:18px;'>Tên đăng nhập hoặc mật khẩu không đúng</span>";
 				return $alert;

 			}
 		}
 	}
 	 
       public function show_customer($id){
        $query = "SELECT * FROM khachhang WHERE MSKH = '$id'";
              $result = $this->db->select($query);
              return $result;
       }
       public function show_addrorder($iddc,$id){
        $query = "SELECT dathang.*, diachikh.DiaChi FROM dathang LEFT JOIN diachikh ON dathang.DiaChiGH = diachikh.MaDC AND dathang.MSKH = diachikh.MSKH WHERE dathang.MSKH = '$id' AND dathang.DiaChiGH = '$iddc' limit 1";
              $result = $this->db->select($query);
              return $result;
       }
        
       
 	public function show_customer_order($id){
 		$query = "SELECT khachhang.*, diachikh.DiaChi,diachikh.MaDC FROM khachhang LEFT JOIN diachikh ON khachhang.MSKH = diachikh.MSKH WHERE khachhang.MSKH = '$id'";
 		$result = $this->db->select($query);
 		return $result;
 	}
    public function show_customer_order_choose($MaDC,$id){
        $query = "SELECT khachhang.*, diachikh.DiaChi,diachikh.MaDC FROM khachhang LEFT JOIN diachikh ON khachhang.MSKH = diachikh.MSKH WHERE khachhang.MSKH = '$id' AND diachikh.MaDC = '$MaDC'";
        $result = $this->db->select($query);
        return $result;
    }
 	public function show_addrcustomer($id){
 		$query = "SELECT * FROM diachikh WHERE MSKH = '$id'";
 		$result_addr = $this->db->select($query);
 		return $result_addr;
 	}
  

 	public function del_addr($idaddr){
 		$query = "DELETE FROM diachikh WHERE MaDC = '$idaddr'";
 		$result = $this->db->delete($query);
 		if($result){
 			$alert = "<span style='color:green;font-size:18px;>Xóa địa chỉ thành công</span>";
 			return $alert;
 		}else{
 			$alert = "<span style='color:red;font-size:18px;>Xóa địa chỉ không thành công</span>";
 			return $alert;
 			
 		}
 	}

 	public function update_customer($data,$id){
 		$name = mysqli_real_escape_string($this->db->link, $data['name']);
 		$company = mysqli_real_escape_string($this->db->link, $data['company']);
 		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
 		$fax = mysqli_real_escape_string($this->db->link, $data['fax']);
 		$job = mysqli_real_escape_string($this->db->link, $data['job']);
 		$email = mysqli_real_escape_string($this->db->link, $data['email']);

 		if($name =="" || $company =="" || $phone =="" || $fax =="" || $job =="" || $email =="" ){
 			$alert = "<span style='color:red;font-size:18px;'>Các trường không nên trống!</span>";
 			return $alert;
 		}else{
 			
 			$query = "UPDATE khachhang SET HoTenKH ='$name', TenCongTy ='$company', SoDienThoai ='$phone', SoFax ='$fax', nghenghiep ='$job', email ='$email' WHERE MSKH = '$id'";
 			$result = $this->db->insert($query);
 			if($result){
 				$alert = "<span style='color:green;font-size:18px;'>Cập nhật thông tin thành công</span>";
 				return $alert;
 			}else{
 				$alert = "<span style='color:red;font-size:18px;'>Cập nhật thông tin không thành công</span>";
 				return $alert;
 			}

 		}
 	}

 	public function insert_bluan(){
 		$pd_id_bluan = $_POST['pd_id_bluan'];
 		$tenbluan = $_POST['tenbluan'];
 		$binhluan = $_POST['bluan'];
 		if($tenbluan =="" || $binhluan ==""){
 			$alert = "<span style='color:red;font-size:18px;'>Các trường không nên trống!</span>";
 			return $alert;
 		}else{
 			$query = "INSERT INTO binhluan (Tennguoibluan, noidung, MSHH) VALUES ('$tenbluan','$binhluan','$pd_id_bluan')";
 			$result = $this->db->insert($query);
 			if($result){
 				$alert = "<span style='color:green;font-size:18px;'>Bình luận đã được gửi</span>";
 				return $alert;
 			}else{
 				$alert = "<span style='color:red;font-size:18px;'>Bình luận không được gửi</span>";
 				return $alert;
 			}

 		}	
 		
 	}
 }
 
?>