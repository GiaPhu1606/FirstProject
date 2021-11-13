<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php'; ?>

<?php  
$pd = new product();
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $insertImage = $pd->insert_image($_POST,$_FILES);
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm hình hàng hóa</h2>
        <div class="block">
            <?php 
            if(isset($insertImage)){
                echo $insertImage;
            } 
            ?>               
            <form action="imageadd.php" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Tên hàng hóa</label>
                        </td>
                        <td>
                            <select id="select" name="MaHH">
                                <option>---Chọn hàng hóa---</option>
                                <?php 
                                $pd = new product();
                                $pdlist = $pd->show_product();
                                if($pdlist){
                                    while($result = $pdlist->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $result['MSHH'] ?>"> <?php echo $result['TenHH']?></option>  
                                        <?php
                                    }
                                }
                                ?> 
                            </select>
                        </td>
                    </tr>  
                    <tr>
                        <td>
                            <label>Tải ảnh</label>
                        </td>
                        <td>
                            <input type="file" name="TenHinh" multiple="multiple" />
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


