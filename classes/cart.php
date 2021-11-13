 <?php 
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/database.php');
 include_once ($filepath.'/../helpers/format.php');
 
 ?>

 <?php 
 
 class cart
 {
 	private $db;
 	private $fm;

 	public function __construct()
 	{
 		$this->db = new Database();
 		$this->fm = new Format();
 	}
 	public function add_to_cart($SoLuong,$MaHang){
 		$SoLuong = $this->fm->validation($SoLuong);
 		$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
 		$MaHang = mysqli_real_escape_string($this->db->link, $MaHang);
 		$sMaHang = session_id();
 		$check_cart = "SELECT * FROM giohang WHERE MSHH = '$MaHang' AND sid ='$sMaHang' limit 1";
 		$result_check_cart = $this->db->select($check_cart);
        // var_dump($result_check_cart);
         // die();
        $check_sl = "SELECT * FROM hanghoa WHERE MSHH = '$MaHang' limit 1";
        $result_check_product = $this->db->select($check_sl)->fetch_assoc();
        // var_dump($result_check_product);
        // die();
       if($SoLuong > $result_check_product['SoLuongHang']){
            $msg = "<span class='error'>Số lượng hàng hóa trong kho không đủ</span>";
            return $msg;
 		
 		}elseif($result_check_cart){
            $msg = "<span class='error'>Hàng hóa đã được thêm vào</span>";
            return $msg;
        }else{
 			$query = "SELECT hanghoa.*,hinhhanghoa.TenHinh,loaihanghoa.TenLoaiHang FROM hanghoa LEFT JOIN hinhhanghoa ON hanghoa.MSHH = hinhhanghoa.MSHH LEFT JOIN loaihanghoa ON hanghoa.MaLoaiHang = loaihanghoa.MaLoaiHang WHERE hanghoa.MSHH = '$MaHang'";
 			$result = $this->db->select($query)->fetch_assoc();
 			
 			$TenHinh = $result["TenHinh"];
 			$Gia = $result["Gia"];
 			$TenHH = $result["TenHH"];
            
            
 			$query_insert = "INSERT INTO giohang (MSHH, SoLuong, sid, Gia , TenHinh, TenHH) VALUES ('$MaHang','$SoLuong','$sMaHang','$Gia','$TenHinh','$TenHH')";
 			
 			$insert_cart = $this->db->insert($query_insert);
 			if($insert_cart){
 				header('Location:cart.php');

 			}else{
 				header('Location:404.php');
 			}
            }
 		}
 	
    // public function update_quantity_product($SoLuong,$MaHang,$idgiohang){
    //     $SoLuong = $this->fm->validation($SoLuong);
    //     $SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
    //     $MaHang = mysqli_real_escape_string($this->db->link, $MaHang);
    //     $sMaHang = session_id();
    //     $query = "SELECT hanghoa*,giohang.SoLuong FROM hanghoa LEFT JOIN giohang ON hanghoa.MaHang = '$MaHang' AND giohang.idgiohang = '$idgiohang' ";
    //     $result = $this->db->select($query);
    //     $SoLuong = $result['SoLuong'];
    //     $TonKho = $SoLuongHang = $result['SoLuongHang'] - $SoLuong;
    //     $query_quantity = "UPDATE hanghoa SET SoLuongHang = '$TonKho' WHERE MaHang = '$MaHang' ";
    //     $result_quantity = $this->db->update($query_quantity);

    // }
 	public function get_product_cart(){
 		$sId = session_id();
 		$query = "SELECT * FROM giohang WHERE sid ='$sId' ";
 		$result = $this->db->select($query);
 		return $result;
 	}
    public function get_product_order($shd){
        $query = "SELECT chitietdathang.*,hinhhanghoa.TenHinh,hanghoa.TenHH FROM chitietdathang LEFT JOIN hinhhanghoa ON chitietdathang.MSHH = hinhhanghoa.MSHH LEFT JOIN hanghoa ON chitietdathang.MSHH = hanghoa.MSHH WHERE chitietdathang.SoDonDH = '$shd'";
        $result = $this->db->select($query);
        return $result;
    }
 	public function update_cart($SoLuong,$idgiohang){
 		$SoLuong = mysqli_real_escape_string($this->db->link, $SoLuong);
 		$idgiohang = mysqli_real_escape_string($this->db->link, $idgiohang);

 		$query = "UPDATE giohang SET SoLuong = '$SoLuong' WHERE idgiohang = '$idgiohang'";
 		$result = $this->db->update($query);
 		if($result){
 			header('Location:cart.php');
 		}else {
 			$msg = "<span class='error' style='color: red; font-size: 18px;'>Cập nhật số lượng không thành công</span>";
 			return $msg;
 		}
 	}
 	public function del_product_cart($idgiohang){
 		$idgiohang = mysqli_real_escape_string($this->db->link, $idgiohang);
 		$query = "DELETE FROM giohang WHERE idgiohang ='$idgiohang' ";
 		$result = $this->db->delete($query);
 		if($result){
 			header('Location:cart.php');
 		}else {
 			$msg = "<span class='error' style='color: red; font-size: 18px;'>Xóa hàng hóa không thành công</span>";
 			return $msg;
 		}
 	}
 	public function check_order($customer_id){
 		$sId = session_id();
 		$query = "SELECT * FROM dathang WHERE MSKH ='$customer_id' ";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function check_cart(){
 		$sId = session_id();
 		$query = "SELECT * FROM giohang WHERE sid ='$sId' ";
 		$result = $this->db->select($query);
 		return $result;
 	}
 	public function del_all_cart(){
 		$sId = session_id();
 		$query = "DELETE FROM giohang WHERE sid ='$sId' ";
 		$result = $this->db->delete($query);
 		return $result;
 	}
 	public function insertOrder($customer_id,$MaDC){
 		$sId = session_id();
 		$query = "SELECT * FROM giohang WHERE sid ='$sId' ";
 		$get_product = $this->db->select($query);
        
 		if($get_product){
            $customer_id = $customer_id;
            $query_order = "INSERT INTO dathang (MSKH,sid,DiaChiGH) VALUES ('$customer_id','$sId','$MaDC') ";
            $insert_order = $this->db->insert($query_order);
            $query_lastorder = "SELECT SoDonDH FROM dathang order by SoDonDH desc limit 1";
            $get_pd = $this->db->select($query_lastorder);
            $result_dt = $get_pd->fetch_assoc();
            $SoDonDH = $result_dt['SoDonDH'];
 			while($result = $get_product->fetch_assoc()){
 				$MSHH = $result['MSHH'];
 				$TenHH = $result['TenHH'];
 				$SoLuong = $result['SoLuong'];
 				$Gia = $result['Gia'] * $SoLuong;
 				$TenHinh = $result['TenHinh'];
 				$query_orderdetails = "INSERT INTO chitietdathang (MSHH, SoLuong, GiaDatHang, SoDonDH) VALUES ('$MSHH','$SoLuong','$Gia','$SoDonDH') ";
                $insert_orderdetails = $this->db->insert($query_orderdetails);
              
            }
 		}
 	}

 	public function get_cart_order(){
 		$query = "SELECT * FROM dathang order by NgayDH desc";
 		$get_cart_order = $this->db->select($query);
 		return $get_cart_order;
 	}

 	public function get_inbox_cart(){
 		$query = "SELECT * FROM dathang order by NgayDH";
 		$get_inbox_cart = $this->db->select($query);
 		return $get_inbox_cart;
 	}
 	public function shifted($id,$time,$time_od,$mskh){
 		$id = mysqli_real_escape_string($this->db->link, $id);
 		$time = mysqli_real_escape_string($this->db->link, $time);
        $time_od = mysqli_real_escape_string($this->db->link, $time_od);
 		$mskh = mysqli_real_escape_string($this->db->link, $mskh);
        
 		
 		$query = "UPDATE dathang SET TrangThaiDH = '1',NgayGH = '$time_od' WHERE SoDonDH = '$id' AND NgayDH = '$time' AND MSKH = '$mskh'";
 		$result = $this->db->update($query);
 		if($result){
 			$msg = "<span class='success' style='color: green; font-size: 18px;'>Cập nhật trạng thái đơn hàng thành công</span>";
 			return $msg;
 		}else {
 			$msg = "<span class='error' style='color: red; font-size: 18px;'>Cập nhật trạng thái đơn hàng không thành công</span>";
 			return $msg;
 		}
 	}
 	public function del_shifted($id,$time,$mskh){
 		$id = mysqli_real_escape_string($this->db->link, $id);
 		$time = mysqli_real_escape_string($this->db->link, $time);
 		$mskh = mysqli_real_escape_string($this->db->link, $mskh);
 		
 		$query = "DELETE FROM dathang WHERE SoDonDH = '$id' AND NgayDH = '$time' AND MSKH = '$mskh'";
 		$result = $this->db->update($query);
 		if($result){
 			$msg = "<span class='success' style='color: green; font-size: 18px;'>Xóa đơn hàng thành công</span>";
 			return $msg;
 		}else {
 			$msg = "<span class='error' style='color: red; font-size: 18px;'>Xóa đơn hàng không thành công</span>";
 			return $msg;
 		}
 	}
 	public function shifted_comfirm($id,$time,$shd){
 		$id = mysqli_real_escape_string($this->db->link, $id);
 		$time = mysqli_real_escape_string($this->db->link, $time);
 		$price = mysqli_real_escape_string($this->db->link, $price);
 		$shd = mysqli_real_escape_string($this->db->link, $shd);
 		$query = "UPDATE dathang SET TrangThaiDH ='2' WHERE MSKH = '$id' AND  SoDonDH = '$shd' AND NgayDH = '$time'";
 		$result = $this->db->update($query);
 		
 	}
 	
 	
 }


?>