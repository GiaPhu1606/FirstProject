 <?php 
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/format.php');
 
 ?>

 <?php 
 
 class product
 {
 	private $db;
 	private $fm;

 	public function __construct()
 	{
 		$this->db = new Database();
 		$this->fm = new Format();
 	}
 	public function search_pd($tukhoa){
 		$tukhoa = $this->fm->validation($tukhoa);
 		$query = "SELECT  hanghoa.*,hinhhanghoa.TenHinh,loaihanghoa.TenLoaiHang FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH LEFT JOIN loaihanghoa ON hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang WHERE hanghoa.TenHH LIKE '%$tukhoa%'";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function insert_product($data){
 		$TenHH = mysqli_real_escape_string($this->db->link, $data['TenHH']);
 		$LoaiHH = mysqli_real_escape_string($this->db->link, $data['LoaiHH']);
 		$ChiTietHH = mysqli_real_escape_string($this->db->link, $data['ChiTietHH']);
 		$SoLuongHang = mysqli_real_escape_string($this->db->link, $data['SoLuongHang']);
 		$Gia = mysqli_real_escape_string($this->db->link, $data['Gia']);
 		$Type = mysqli_real_escape_string($this->db->link, $data['Type']);
 		
 		if($TenHH =="" || $LoaiHH =="" || $ChiTietHH =="" || $SoLuongHang =="" || $Gia =="" || $Type ==""){
 			$alert = "<span class='error'>Các trường không nên trống!</span>";
 			return $alert;
 		}else{
 			$query = "INSERT INTO hanghoa (TenHH, MaLoaiHang, ChiTietHH, SoLuongHang, Gia, type) VALUES ('$TenHH','$LoaiHH','$ChiTietHH','$SoLuongHang','$Gia','$Type')";
 			$result = $this->db->insert($query);
 			if($result){
 				$alert = "<span class='success'>Thêm hàng hóa thành công</span>";
 				return $alert;
 			}else{
 				$alert = "<span class='error'>Thêm hàng hóa không thành công</span>";
 				return $alert;
 			}
 		} 
 	}
 	

 	public function insert_image($data,$files){
 		$MaHH = mysqli_real_escape_string($this->db->link, $data['MaHH']);
 		$permited = array('jpg', 'jpeg', 'png', 'gif');
 		$file_name = $_FILES['TenHinh']['name'];
 		$file_size = $_FILES['TenHinh']['size'];
 		$file_temp = $_FILES['TenHinh']['tmp_name'];

 		$div = explode('.',$file_name);
 		$file_ext = strtolower(end($div));
 		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
 		$uploaded_image = "uploads/".$unique_image;
 		if($MaHH =="" || $file_name==""){
 			$alert = "< span class='error'>Trường này không nên trống!</span>";
 			return $alert;
 		}else{
 			
 			$query = " INSERT INTO hinhhanghoa (TenHinh , MSHH) VALUES ('$unique_image','$MaHH')";
 			move_uploaded_file($file_temp, $uploaded_image);
 			$result = $this->db->insert($query);
 			if($result){
 				$alert = "<span class='success'>Thêm hình thành công</span>";
 				return $alert;
 			}else{
 				$alert = "<span class='error'>Thêm hình không thành công</span>";
 				return $alert;
 			}
 		}
 	}
 	
 	public function show_product(){
 		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh,loaihanghoa.TenLoaiHang FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH LEFT JOIN loaihanghoa ON hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang order by hanghoa.MSHH desc";

 		$result = $this->db->select($query);
 		return $result;
 	} 

 	public function getproductbyId($MaHang){
 		$query = "SELECT * FROM hanghoa WHERE MSHH = '$MaHang'";
 		$result = $this->db->select($query);
 		return $result;
 	}

 	public function update_product($data,$MSHH){
 		$TenHH = mysqli_real_escape_string($this->db->link, $data['TenHH']);
 		$LoaiHH = mysqli_real_escape_string($this->db->link, $data['LoaiHH']);
 		$ChiTietHH = mysqli_real_escape_string($this->db->link, $data['ChiTietHH']);
 		$SoLuongHang = mysqli_real_escape_string($this->db->link, $data['SoLuongHang']);
 		$Gia = mysqli_real_escape_string($this->db->link, $data['Gia']);
 		$Type = mysqli_real_escape_string($this->db->link, $data['Type']);
 		
 		
 		if($TenHH =="" || $LoaiHH =="" || $ChiTietHH =="" || $SoLuongHang =="" || $Gia =="" || $Type =="" ){
 			$alert = "<span class='error'>Các trường không nên trống!</span>";
 			return $alert;
 		}else{
 			$query = "UPDATE hanghoa SET TenHH = '$TenHH' , MaLoaiHang = '$LoaiHH', ChiTietHH = '$ChiTietHH' , Gia = '$Gia', SoLuongHang = '$SoLuongHang' , type = '$Type' WHERE MSHH = '$MSHH' ";
 			$result = $this->db->update($query);
 			if($result){
 				$alert = "<span class='success'>Sửa hàng hóa thành công</span>";
 				return $alert;
 			}else{
 				$alert = "<span class='error'>Sửa hàng hóa không thành công</span>";
 				return $alert;
 			}
 		} 
 	}

 	public function del_product($MaHang){
 		$query = "DELETE FROM hanghoa WHERE MSHH = '$MaHang'";
 		$result = $this->db->delete($query);
 		if($result){
 			$alert = "<span class='success'>Xóa hàng hóa thành công</span>";
 			return $alert;
 		}else{
 			$alert = "<span class='error'>Xóa hàng hóa không thành công</span>";
 			return $alert;
 			
 		}
 	}
			//Kết thúc backend
 	public function getproduct_feathered(){
 		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH WHERE type = '0' LIMIT 4";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function getproduct_new(){
 		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH order by hanghoa.MSHH desc LIMIT 4 ";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function get_details($MaHang){
 		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh,loaihanghoa.TenLoaiHang FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH LEFT JOIN loaihanghoa ON hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang WHERE hanghoa.MSHH = '$MaHang'";

 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function getproducts(){
 		$hh_tungtrang = 4;
 		if(!isset($_GET['trang'])){
 			$trang = 1;
 		}else{
 			$trang = $_GET['trang'];
 		}
 		$tung_trang = ($trang - 1) * $hh_tungtrang;
 		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH order by hanghoa.MaLoaiHang desc LIMIT $tung_trang,$hh_tungtrang";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function get_all_product(){
 		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH order by hanghoa.MaLoaiHang desc";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	
 }		


 
?>