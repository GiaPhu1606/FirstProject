<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>

<?php  
$pd = new product();  

if(!isset($_GET['MSHH']) || $_GET['MSHH'] == NULL){
    echo "<script>window.location ='productlist.php' </script>";
}else{
    $MaHang = $_GET['MSHH'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
   
    $updateProduct = $pd->update_product($_POST,$MaHang);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa hàng hóa</h2>
        <div class="block">
            <?php 
            if(isset($updateProduct)){
                echo $updateProduct;
            } 
            ?>
            <?php 
            $get_product_by_id = $pd->getproductbyId($MaHang);
            if($get_product_by_id){
                while ($result_pd = $get_product_by_id->fetch_assoc()) {
                    
                    
                   ?>               
                   
                   <form action="" method="post" >
                    <table class="form">
                     
                        <tr>
                            <td>
                                <label>Tên hàng hóa</label>
                            </td>
                            <td>
                                <input type="text" name="TenHH" value ="<?php echo $result_pd['TenHH'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Loại hàng hóa</label>
                            </td>
                            <td>
                                <select id="select" name="LoaiHH">
                                    <option>---Chọn loại hàng hóa---</option>
                                    <?php 
                                    $cat = new category();
                                    $catlist = $cat->show_category();
                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){


                                            ?>
                                            <option
                                            <?php if($result['MaLoaiHang'] == $result_pd['MaLoaiHang']){echo 'selected'; } ?>

                                            value="<?php echo $result['MaLoaiHang'] ?>"> <?php echo $result['TenLoaiHang']?></option>  
                                            <?php
                                        }
                                    }
                                    ?> 
                                    
                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                         
                        </tr>
                        
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Chi tiết hàng hóa</label>
                            </td>
                            <td>
                                <textarea name="ChiTietHH" class="tinymce"><?php echo $result_pd["ChiTietHH"] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Số lượng hàng</label>
                            </td>
                            <td>
                                <input type="text" name="SoLuongHang" value ="<?php echo $result_pd['SoLuongHang'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Giá</label>
                            </td>
                            <td>
                                <input type="text" name="Gia" value ="<?php echo $result_pd['Gia'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Loại</label>        
                            </td>
                            <td>
                                <select id="select" name="Type">
                                    <option>Loại</option>
                                    <?php 
                                    if($result_pd['Type'] == 0){

                                       ?>
                                       <option selected value="0">Nổi bật</option>
                                       <option value="1">Không nổi bật</option>
                                       <?php 
                                   }else{
                                       ?>
                                       <option  value="0">Nổi bật</option>
                                       <option selected value="1">Không nổi bật</option>    
                                       <?php 
                                   } ?>
                               </select>
                           </td>
                       </tr> 
                       <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Sửa" />
                        </td>
                    </tr>
                </table>
            </form>
        <?php }
    } ?>
</div>
</div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


