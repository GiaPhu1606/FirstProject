<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php  
$cat = new category();
if(!isset($_GET['MaLoaiHang']) || $_GET['MaLoaiHang'] == NULL){
    echo "<script>window.location ='catlist.php' </script>";
}else{
    $MaLoai = $_GET['MaLoaiHang'];
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $TenLoaiHang = $_POST['TenLoaiHang'];
    $updateCat = $cat->update_category($TenLoaiHang,$MaLoai);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa loại hàng</h2>
        <div class="block copyblock">
         <?php 
         if(isset($updateCat)){
            echo $updateCat;
        } 
        ?> 
        <?php 
        $get_cate_name = $cat->getcatbyId($MaLoai);
        if($get_cate_name){
            while($result = $get_cate_name->fetch_assoc()){

                ?>
                <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['TenLoaiHang'] ?>" name="TenLoaiHang" placeholder="Sửa loại hàng" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Sửa" />
                            </td>
                        </tr>
                    </table>
                </form>

                <?php 

            }
        }
        ?>
    </div>
</div>
</div>
<?php include 'inc/footer.php';?>