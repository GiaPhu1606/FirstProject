<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/format.php');

?>

<?php 

class category
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_category($TenLoaiHang){

		$TenLoaiHang = $this->fm->validation($TenLoaiHang);
		
		$TenLoaiHang = mysqli_real_escape_string($this->db->link, $TenLoaiHang);
		

		if(empty($TenLoaiHang)){
			$alert = "<span class='error'>Loại hàng không nên trống!</span>";
			return $alert;
		}else{
			$query = "INSERT INTO loaihanghoa(TenLoaiHang) VALUES('$TenLoaiHang')";
			$result = $this->db->insert($query);
			if($result){
				$alert = "<span class='success'>Thêm loại hàng thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Thêm loại hàng không thành công</span>";
				return $alert;
			}
		} 
	}

	public function show_category(){
		$query = "SELECT * FROM loaihanghoa order by TenLoaiHang desc";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_category($TenLoaiHang,$MaLoai){
		$TenLoaiHang = $this->fm->validation($TenLoaiHang);
		$TenLoaiHang = mysqli_real_escape_string($this->db->link, $TenLoaiHang);
		$MaLoai = mysqli_real_escape_string($this->db->link, $MaLoai);
		if(empty($TenLoaiHang)){
			$alert = "<span class='error'>Loại hàng không nên trống!</span>";
			return $alert;
		}else{
			$query = "UPDATE loaihanghoa SET TenLoaiHang = '$TenLoaiHang' WHERE MaLoaiHang = '$MaLoai' ";
			$result = $this->db->update($query);
			if($result){
				$alert = "<span class='success'>Sửa loại hàng thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Sửa loại hàng không thành công</span>";
				return $alert;
			}
		} 
	}
	public function del_category($MaLoai){
		$query = "DELETE FROM loaihanghoa WHERE MaLoaiHang = '$MaLoai'";
		$result = $this->db->delete($query);
		if($result){
			$alert = "<span class='success'>Xóa loại hàng thành công</span>";
			return $alert;
		}else{
			$alert = "<span class='error'>Xóa loại hàng không thành công</span>";
			return $alert;
			
		}
	}

	public function getcatbyId($MaLoai){
		$query = "SELECT * FROM loaihanghoa WHERE MaLoaiHang = '$MaLoai'";
		$result = $this->db->select($query);
		return $result;
	}

	public function getproductbycat($MaLoai){
		$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh,loaihanghoa.TenLoaiHang FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH LEFT JOIN loaihanghoa ON hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang WHERE hanghoa.MaLoaiHang =  '$MaLoai' order by hanghoa.MSHH desc LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}


	public function getnamebycat($MaLoai){
		$query = "SELECT hanghoa.*,loaihanghoa.TenLoaiHang,loaihanghoa.MaLoaiHang FROM hanghoa,loaihanghoa WHERE hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang AND hanghoa.MaLoaiHang =  '$MaLoai' ";
		$result = $this->db->select($query);
		return $result;
	}

}

?>