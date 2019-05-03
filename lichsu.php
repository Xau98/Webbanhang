<?php   
        // trang lịch sử
        $conn=mysqli_connect('localhost','root','','project')or die("Kết nối thất bại");
        mysqli_set_charset($conn,"utf8");
        $a= $_COOKIE['username'];
         $sql = "SELECT * FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
          
         
         //phân trang 
         $sosptren1tr=2;
         // truy xuất sản phẩm
         $trang=$_GET['trang'];
         $from=($trang-1)*$sosptren1tr;
          $sql_sp = "SELECT * FROM lich_su  LIMIT ".$from.",".$sosptren1tr."" ;
          $result_sp = mysqli_query($conn, $sql_sp);
           $row_sp = mysqli_fetch_assoc($result_sp);
            $soluongsp= mysqli_query($conn, "Select count(id)as 'sl' from lich_su where MaKH='".$row['id']."' ");
           $row_slsp = mysqli_fetch_assoc($soluongsp);
         // truy xuất table lich_su
         $sql_ls="Select ds_sp.id,gia_niem_yet, Ten_sp , mau, gia_sp,So_luong,Date_tao,Tinh_trang_sp from ds_sp join lich_su on ds_sp.id=lich_su.Ma_sp where MAKH='".$row['id']."'";
         $result_ls=  mysqli_query($conn, $sql_ls);
        // $row_ls=  mysqli_fetch_assoc($result_ls);
         ?> 
<!DOCTYPE html>
<html>
    <head>
        <title>Account user</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link href="CSS/account.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="account">
            
            <div class="account_title">
                <a href="#"><img  src="IMG/banner_account.PNG"  height="200" width="1000"></a>
            </div>
            
            <div class="account_main" style="height: 720px;">
                
                <div class="account_left" style="height: 720px;">
                    <div class="taikhoan" style="height: 330px;" >
                          <?php 
                            if(isset($_POST['sub_up_load'])){
                                $file_part=$_FILES['up_load']['name'];
                                move_uploaded_file($_FILES['up_load']['tmp_name'],"IMG/".$file_part);
                                $sql_up_anh= "update thongtin set img='IMG/".$file_part."' where username='".$a."'";
                                mysqli_query($conn, $sql_up_anh);
                            }
                            ?>
                        <form method="post" action="account.php" enctype="multipart/form-data">
                            <div class="account_img">
                                <img src="<?php echo $row['img'];  ?>" alt="IMG Account" width="220" height="220" >
                                <p style="height: 4px;font-size: 20px;margin-top: 7px;margin-bottom: 20px; text-align: center; font-weight: bold;">
                                    <?php echo $a; ?></p>
                                <input type="file" name="up_load"style="padding-top: 5px;" > 
                                <button type="submit" name="sub_up_load" >Cập nhật Avata</button>
                            </div>
                        </form>
                          
                       
                    </div>
                    
                    <div class="menu"  style="height: 370px;" >
                        <form method="post" name="choose">
                        <button class="chucnang" name="ho_so" > 
                            Hồ sơ
                        </button>
                        <button  class="chucnang" name="gio_hang" > 
                            Giỏ hàng
                        </button>
                        <button  class="chucnang" name="lich_su" > 
                            Lịch Sử
                        </button>
                        <button  class="chucnang"  name="nap_tien"> 
                           Nạp tiền
                        </button>
                        <button  class="chucnang"  name="chuyen_tien"> 
                           Chuyển tiền
                        </button>
                         <button  class="chucnang"  name="nang_cap"> 
                           Nâng cấp tài khoản
                        </button>
                        <button  class="chucnang" name="doi_mk"> 
                            Đổi mật khẩu
                        </button>
                        <button  class="chucnang" name="dang_xuat"> 
                            Đăng xuất
                        </button>
                        <button  class="chucnang" name="quay_lai"> 
                            Quay lại
                        </button>
                        </form>
                    </div>
                </div>
                             <?php
                                   if(isset($_POST['ho_so'])){
                                      header("Location: account.php");
                                      } 
                                     if(isset($_POST['gio_hang'])){
                                      header("Location: giohang.php?id=");
                                      } 
                                    if(isset($_POST['nap_tien'])){
                                       header("Location: naptien.php");
                                    }
                                    if(isset($_POST['chuyen_tien'])){
                                       header("Location: chuyentien.php");
                                    }
                                     if(isset($_POST['nang_cap'])){
                                       header("Location: nangcap.php");
                                    } 
                                    if(isset($_POST['lich_su'])){
                                       header("Location: lichsu.php");
                                    }
                                    if(isset($_POST['doi_mk'])){
                                    header("Location:doimk.php");
                                    }
                                    if(isset($_POST['dang_xuat'])){
                                        setcookie('username',$a,  time()-3600,'/','',0,0);
                                         setcookie('password',$b,  time()-3600,'/','',0,0);
                                        header("Location: index.php");
                                    }
                                    if(isset($_POST['quay_lai'])){
                                        header("Location:  main.php?trang=1");
                                    }
                             ?> 
                <!noidung right>
                <div class="account_right" style="height: 720px;">
                    
                    <div class="account_right_title" style="height: 680px;  background: #99ffff ">
                        <form method="Post">
                            <table cellspacing="20"  style="width: 750px; border: 1px #99ff33 solid; font-size: 20px; text-align: center;">
                                <tr>
                                    <td colspan="7" style="text-align: center; font-size: 40px; font-weight: bold; height: 45px;"> Lịch sử mua hàng</td>
                                </tr>
                                <tr style="font-weight:bold;     ">
                                    <td  colspan="2" >Sản Phẩm </td>
                                    <td>Màu</td>
                                    <td>Đơn Giá</td>
                                    <td>Số lượng</td>
                                    <td>Số Tiền</td>
                                    <td>Ngày đặt hàng</td>
                                    <td>Tình trạng hàng</td>
                                </tr>
                                <?php
                                while( $row_ls = mysqli_fetch_array($result_ls)) {
                                ?>
                                <tr>
                                    <td  colspan="2" ><a href="Thongtinsp.php?id=<?php echo $row_ls['id'];?>"> <?php echo $row_ls['Ten_sp'] ; ?>  </a></td>
                                    <td><?php echo $row_ls['mau'] ; ?></td>
                                    <td>
                                        <strike><?php echo $row_ls['gia_niem_yet'] ; ?></strike>=><?php echo $row_ls['gia_sp'] ; ?>
                                    </td>
                                      <td>
                                           <?php   echo  $row_ls['So_luong'] ; ?>
                                    </td>
                                    <td>
                                        <?php  
                                        if($row['Loai']=='VIP'||$row['Loai']=='VIP1'||$row['Loai']=='VIP2'){
                                                  $kq=  $row_ls['gia_sp']*0.7; 
                                                  echo $kq;
                                             }
                                            else {
                                                $kq=  $row_sum['gia_sp'] ; 
                                                  echo $kq; 
                                            }  
                                        ?>
                                    </td>
                                    <td>
                                        <?php   echo $row_ls['Date_tao']; ?>
                                    </td>
                                    <td>
                                        <?php  echo $row_ls['Tinh_trang_sp']; ?>
                                    </td>
                                </tr>
                                <?php
                                } 
                              
                                ?>
                            </table>
                        </form>
                         

                         
                    </div>
                
                      <!phan trang>
                        <div style="background: #cccc00; height: 30px; width: 600px; padding-bottom:10px; text-align: center;">

                            <a>
                                <?php
                                 $sotrang=ceil($row_slsp['sl']/$sosptren1tr);

                                   for($t=1;$t<=$sotrang;$t++){
                                       echo'<a href="lichsu.php?trang='.$t.'"style="text-decoration: none;">';
                                        echo 'Trang  '. $t.' >> ';
                                     echo '</a>';
                                   }
                                ?>
                            </a>

                        </div>
                </div>
            </div> 
            
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
                  
        </div>
       
    </body>
</html>
                           





