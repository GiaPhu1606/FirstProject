<?php 
$filepath = realpath(dirname(__FILE__));
include ($filepath.'/../lib/session.php');
Session::checkLogin();
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>

<?php 

class adminlogin
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function login_admin($aduser,$adpass){
		$aduser = $this->fm->validation($aduser);
		$adpass = $this->fm->validation($adpass);

		$aduser = mysqli_real_escape_string($this->db->link, $aduser);
		$adpass = mysqli_real_escape_string($this->db->link, $adpass);

		if(empty($aduser) || empty($adpass)){
			$alert = "Tài khoản và mật khẩu không nên trống!";
			return $alert;
		}else{
			$query = "SELECT * FROM nhanvien WHERE username = '$aduser' && password = '$adpass' LIMIT 1";
			$result = $this->db->select($query);

			if($result != false){
				$value = $result->fetch_assoc();
				Session::set('adminlogin',true);
				Session::set('adminname', $value['HoTenNV']);
				Session::set('aduser', $value['username']);
				Session::set('adpass', $value['password']);
				header('Location:index.php');
			}else{
				$alert = "Tài khoản hoặc mật khẩu không đúng!";
				return $alert;
			} 
		}


	}
}
?>