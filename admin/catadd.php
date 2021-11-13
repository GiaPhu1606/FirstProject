
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php  
$cat = new category();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $TenLoaiHang = $_POST['TenLoaiHang'];
    
    
    $insertCat = $cat->insert_category($TenLoaiHang);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm loại hàng</h2>
        <div class="block copyblock">
         <?php 
         if(isset($insertCat)){
            echo $insertCat;
        } 
        ?> 
        <form action="catadd.php" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="TenLoaiHang" placeholder="Nhập loại hàng" class="medium" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Lưu" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
<?php include 'inc/footer.php';?>