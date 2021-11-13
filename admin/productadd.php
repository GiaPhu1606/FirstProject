<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>

<?php  
$pd = new product();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    
    $insertProduct = $pd->insert_product($_POST);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm hàng hóa</h2>
        <div class="block">
            <?php 
            if(isset($insertProduct)){
                echo $insertProduct;
            }
            ?>               
            <form action="productadd.php" method="post" >
                <table class="form">
                 
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="text" autocomplete="off" name="TenHH" placeholder="Nhập tên hàng hóa" class="medium" />
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
                                        <option value="<?php echo $result['MaLoaiHang'] ?>"> <?php echo $result['TenLoaiHang']?></option>  
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
                            <textarea name="ChiTietHH" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Số lượng hàng</label>
                        </td>
                        <td>
                            <input type="text" autocomplete="off" name="SoLuongHang" placeholder="Nhập số lượng " class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá</label>
                        </td>
                        <td>
                            <input type="text" autocomplete="off" name="Gia" placeholder="Nhập giá " class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Loại</label>        
                        </td>
                        <td>
                            <select id="select" name="Type">
                                <option>---Trạng thái---</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Không nổi bật</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Lưu" />
                        </td>
                    </tr>
                </table>
            </form>
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


