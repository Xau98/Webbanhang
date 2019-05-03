<?php
        $conn=mysqli_connect('localhost','root','','project')or die("Không kết nối được");
        session_start(); 
        mysqli_set_charset($conn,"utf8"); 
         $a= $_COOKIE['username'];
        $sql = "SELECT id,username,password,img,Tien,Loai FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         
         $ma_sp=$_GET['id'];
         $sql_chitiet = "SELECT ten_sp,img_sp,gia_niem_yet,gia_sp,xuat_xu,chat_lieu,Thong_tin_chi_tiet,Soluong,mau FROM ds_sp where id='".$ma_sp."' ";
          $result_chitiet = mysqli_query($conn, $sql_chitiet);
         $row_chitiet = mysqli_fetch_assoc($result_chitiet);  
?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Account user</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link href="CSS/sanpham.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="sanpham">
            <!banner>
            <div class="sanpham_title" >
                <a href="#"><img src="IMG/banner_sp.PNG" width="1000" height="200" > </a>
            </div>
            <!boddy>
            <div class="sanpham_main">
                <!noidung left>
                <div class="sanpham_left">
                    <div class="sanpham_left_img"><img src="<?php echo $row_chitiet['img_sp']; ?>" height="400" width="400" ></div>
                </div>
                    
                <!noidung right>
                <div class="sanpham_right"> 
                    <div class="sanpham_right_sp">
                    <form method="POST">
                        <table cellspacing="20" style="text-align: center;">
                            <tr>
                                <td colspan="2" style="font-weight: bold;"> Mã Sản Phẩm : <?php echo $ma_sp; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2"style="font-weight: bold;">Tên Sản Phẩm :<?php echo $row_chitiet['ten_sp']; ?> </td> 
                            </tr>
                            <tr>
                                <td colspan="2" > Giá bán  :   <strike><?php echo $row_chitiet['gia_niem_yet']; ?></strike> => <?php echo $row_chitiet['gia_sp']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Màu</td>
                                <td><?php echo $row_chitiet['mau']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">chất liệu</td>
                                <td><?php echo $row_chitiet['chat_lieu']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Xuất xứ</td>
                                <td><?php echo $row_chitiet['xuat_xu']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Mô tả sản phẩm </td>
                                <td><?php echo $row_chitiet['Thong_tin_chi_tiet']; ?></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold;">Số lượng</td>
                                <td><?php echo $row_chitiet['Soluong']; ?></td>
                            </tr>
                            <td style="height: 100px;"></td>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" style="height: 50px;font-weight: bold; font-size: 30px; background: #99ff33;" value="Thêm vào giỏ" name="them_vao_gio">
                                </td>
                                <td colspan="2">
                                    <input type="submit" style="height: 50px;font-weight: bold; font-size: 30px; background: #99ff33;" value="Quay Lại" name="quaylai">
                                </td>
                                
                            </tr>
                            
                        </table>
                    </form>
                  </div>
                </div>
                </div>
            <?php 
            if(isset($_POST['them_vao_gio'])){
                //insert 
                if($row_chitiet['Soluong']>0){
                 $sql_gio = "INSERT INTO chi_tiet_hoa_don( MaKH, ma_sp, So_luong) VALUES (".$row['id'].",'".$ma_sp."',1)";
                 $result_gio = mysqli_query($conn, $sql_gio); 
                 //giảm số lượng trong kho
                 $giam=$row_chitiet['Soluong']-1;
                 $sql_giam = "Update ds_sp set soluong='".$giam."' where id='".$ma_sp."'";
                 $result_giam = mysqli_query($conn, $sql_giam); 
                header("Location: giohang.php?id=");
                }
            else {
                    ?>
            
            <script language="javascript">
            
            alert("Sản phẩm đã hết hàng ");
                    </script>
            <?php
            }
            }
             if(isset($_POST['quaylai'])){
                 header("Location:  main.php?trang=1");
            }
            ?>
                   <!foot >
    <div class="foot" style="height: 250px; background: antiquewhite;">
        <div style="padding-left:  20px; padding-top: 20px;">
            <div><p>Tên Công ty :  </p>  <p>Địa chỉ:</p></div>
            <div><p>Tổng Đài liên lạc:</p><p>Mã Số doanh nghiệp:</p></div>
            <div>Emai:</div>
            <hr>
            <div>Bản quyền:</div>
        </div>
    </div>
        
    </body>
</html>
                           


