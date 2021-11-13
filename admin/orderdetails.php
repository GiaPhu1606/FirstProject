<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/customer.php');
include_once ($filepath.'/../classes/cart.php');
include_once ($filepath.'/../helpers/format.php');
?>
<?php  
$cs = new customer();
if(!isset($_GET['MSKH']) || $_GET['MSKH'] == NULL){
    echo "<script>window.location ='order.php' </script>";
}else{
    $id = $_GET['MSKH'];

}
?>
<?php  
$cs = new customer();
if(!isset($_GET['MaDC']) || $_GET['MaDC'] == NULL){
    echo "<script>window.location ='order.php' </script>";
}else{
    $iddc = $_GET['MaDC'];

}
?>
<?php
$fm = new Format();  
$ct = new cart();
if(!isset($_GET['SodonDH']) || $_GET['SodonDH'] == NULL){
    echo "<script>window.location ='order.php' </script>";
}else{
    $shd = $_GET['SodonDH'];
}
?>
<style>
   .payment {
     text-align: center;
     font-size: 20px;
     font-weight: bold;
     margin: 0px 0px auto auto;
     padding: 10px;
     background: #494D48;
     border: 1px solid #000;
     color: #FFFFFF;
     width: 200px;     
  } 
  table.tblone {
    width: 100%;
    border: 1px solid;
    padding: 10px;
    margin: 10px;
    text-align: center;
}
    .tblone th {
    border-bottom: 1px solid;
    border-left: 1px solid;
    }
    .tblone td {
    border-bottom: 1px solid;
    border-left: 1px solid;
    }
</style>
 
            
     
    
<div class="grid_10">
    <div class="box round first grid">
        <h2>Khách hàng</h2>
        <div class="block copyblock" style="width: 86%;">

            <?php 
            $get_customer = $cs->show_customer($id);
            if($get_customer){
                while($result = $get_customer->fetch_assoc()){

                    ?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>Họ tên</td>
                                <td>:</td>
                                <td>
                                    <?php echo $result['HoTenKH'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tên công ty</td>
                                <td>:</td>
                                <td>
                                    <?php echo $result['TenCongTy'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td>:</td>
                                <td>
                                    <?php echo $result['SoDienThoai'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Số fax</td>
                                <td>:</td>
                                <td>
                                    <?php echo $result['SoFax'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ giao hàng</td>
                                <td>:</td>
                                <td>
                                <?php
                                     $get_addrcustomer = $cs->show_addrorder($iddc,$id);
                                     if($get_addrcustomer ){
                                     while($result_addr = $get_addrcustomer->fetch_assoc() ){
                                ?>
                    
                     <?php echo  $result_addr['DiaChi']?>
                    
                     <?php 
                  }
              }  ?>
            
                        </td>

                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>
                            <?php echo $result['email'] ?>
                        </td>
                    </tr>
                </table>
            </form>
            <div class="order_details">
                <table class="tblone">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Tên hàng hóa</th>
                        
                        <th width="25%">Số lượng</th>
                        <th width="25%">Giá</th>
                    </tr>
                    <?php 
                    $get_product_order = $ct->get_product_order($shd);
                    if($get_product_order){
                        $SL = 0;
                        $i = 0;
                        $tongtien = 0;
                        while($result = $get_product_order->fetch_assoc()){
                            $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['TenHH'] ?></td>
                                
                                <td><?php echo $result['SoLuong']?></td>
                                <td><?php echo $fm->format_currency($result['GiaDatHang']).' '.'VNĐ' ?></td>
                            
                        </tr>
                        <?php 
                        $tongtien += $result['GiaDatHang'];
                        $SL += $result['SoLuong'];
                    } 
                }
                ?>
            </table>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Tổng tiền đơn hàng: </th>
                        <td>
                            <?php 
                            
                            echo  $fm->format_currency($tongtien).' '.'VNĐ';
                            
                            Session::set('SL',$SL);

                            ?>
                        </td>
                    </tr>
                    
                </tr>
            </table>

          

            <?php 

        }
    }
    ?>


</div>

</div></div><div class="shopping">
         <div class="payment">
            <a style="color:white;" class="payment_href"  href="order.php">Trở về</a>
         </div>
      </div>
</div>


<?php include 'inc/footer.php';?>