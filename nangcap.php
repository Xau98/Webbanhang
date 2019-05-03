<?php
        $conn=mysqli_connect('localhost','root','','project')or die("Không kết nối được");
        mysqli_set_charset($conn,"utf8");
        $a= $_COOKIE['username']; 
         $sql = "SELECT * FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
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
            
            <div class="account_main">
                
                <div class="account_left" style="height: 720px;">
                    <div class="taikhoan" style="height: 330px;" style="height: 720px;" >
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
                                         header("Location: lichsu.php?trang=1");
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
                                        header("Location: main.php?trang=1");
                                    }
                               ?> 
                <div class="account_right" style="height: 720px;">
                    <div class="account_right_title" style="height: 720px;  background: #99ffff ; margin: 0 auto; width: 748px; ">
                        <div style="height: 40px; font-size: 25px; font-weight: bold; text-align: center;">Nâng cấp tài khoản VIP</div>
                        <div style="height: 30px; font-size: 20px; text-align: center;">Giảm 30% khi mua hàng cho tài khoản VIP</div> 
                        <div style="background: #99ffff ; margin: 15px 50px;  width: 748px;">
                            <form method="POST">
                                <div style="border: 2px #99ff33 solid;margin: 0 auto; text-align: center; height: 300px; width: 300px;float: left;"> 
                                      <div style="height: 50px ;margin: 0 auto; width: 50px; padding-top:  5px;">VIP1</div>
                                      <div style="height: 100px;">Thông tin của gói : <p>Giảm 30% cho tất cả các sp</p></div>
                                      <div style="height: 50px;">Time : 30 ngày (từ ngày đăng ký)</div>
                                      <div style="height: 40px;">Giá Tiền : 200.000 (VND)</div>
                                      <div style="height: 50px;"><button style="height: 30px; width: 70px;" name="VIP1">Mua</button> </div>
                                  </div> 
                                  <div style="border: 2px #99ff33 solid;text-align: center; margin: 0 50px; height: 300px;float: left; width: 300px; ">
                                      <div style="height: 50px ;margin: 0 auto; width: 50px; padding-top:  5px;">VIP2</div>
                                      <div style="height: 100px;">Thông tin của gói : <p>Giảm 30% cho tất cả các sp</p></div>
                                      <div style="height: 50px;">Time : 1 năm (từ ngày đăng ký)</div>
                                      <div style="height: 40px;">Giá Tiền : 1.500.000 (VND)</div>
                                      <div style="height: 50px;"><button style="height: 30px; width: 70px;" name="VIP2" >Mua</button> </div>
                                  </div>
                                  <div style="border: 2px #99ff33 solid; text-align: center;margin: 20px 0px; height: 300px;float: left; width: 300px;  ">
                                        <div style="height: 50px ;margin: 0 auto; width: 50px; padding-top:  5px;">VIP</div>
                                      <div style="height: 100px;">Thông tin của gói : <p>Giảm 30% cho tất cả các sp</p></div>
                                      <div style="height: 50px;">Time : 1 tuần (từ ngày đăng ký)</div>
                                      <div style="height: 40px;">Giá Tiền : 70.000 (VND)</div>
                                      <div style="height: 50px;"><button style="height: 30px; width: 70px;" name="VIP">Mua</button> </div>
                                  </div>
                            </form>
                        </div>
                    </div>
                    <?php 
                    //VIP
                    if(isset($_POST['VIP'])){
                        $sql_VIP="Update thongtin set Loai ='VIP',date_tao='".$date."' where username='".$a."'";
                        mysqli_query($conn, $sql_VIP);
                        ?>
                    <script language="javascript">
                    alert("Nâng cấp tài khoản VIP thành công (Hạn sử dụng trong 1 tuần kể từ ngày đăng ký). ");
                    </script> 
                    <?php
                    }
                    //VIP1
                    if(isset($_POST['VIP1'])){
                        $date=  date('Y-m-d');
                        $sql_VIP1="Update thongtin set Loai ='VIP1' ,date_tao='".$date."' where username='".$a."'";
                        mysqli_query($conn, $sql_VIP1);
                        ?>
                    <script language="javascript">
                       alert("Nâng cấp tài khoản VIP1 thành công (Hạn sử dụng trong 1 tháng kể từ ngày đăng ký). ");
                    </script> 
                    <?php
                    }
                    //VIP2
                    if(isset($_POST['VIP2'])){
                        $sql_VIP2="Update thongtin set Loai ='VIP',date_tao='".$date."' where username='".$a."'";
                        mysqli_query($conn, $sql_VIP2);
                        ?>
                    <script language="javascript">
                     alert("Nâng cấp tài khoản VIP2 thành công (Hạn sử dụng trong 1 năm kể từ ngày đăng ký). ");
                    </script> 
                    <?php
                    }
                    ?>
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
 