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
            
            <div class="account_main"style="height: 720px;">
                
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
                                    <?php echo $a.' ('.$row['Loai'].')'; ?></p>
                                <input type="file" name="up_load"style="padding-top: 5px;" > 
                                <button type="submit" name="sub_up_load" onclick="tai_lai_trang()" >Cập nhật Avata</button>
                            </div>
                        </form>
                       </div>     
                           <script>
                                function tai_lai_trang(){
                                    location.reload();
                                }
                            </script> 
                    
                    <div class="menu" style="height: 370px;"  >
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
                <!noidung right>
                <div class="account_right" style="height: 720px;">
                    <div class="account_right_title" style="height: 600px;  background: #99ffff ">
                        <!Cập nhật thông tin>
                       <?php
                           
                             $sql_account = "SELECT * FROM thongtin where username='".$a."' ";
                              $result_account = mysqli_query($conn, $sql_account);
                             $row_account = mysqli_fetch_assoc($result_account);
                          ?>

                            <div style="padding-top: 10px; padding-left: 10px;"><strong style="font-size: 30px;font-weight: bold;">Hồ Sơ Của Tôi</strong>
                    </br> <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p> <hr>
                </div>
                <div class="cap_nhat" style="text-align: center;padding-top: 10px; font-size: 20px;">
                    <form method="post" name="form_capnhat">
                        <div class="cap_nhat_ID" > 
                            ID :<?php echo $row_account['id']; ?>
                        </div>
                        <div class="cap_nhat_ht" >Họ và tên :
                            <input type="text" name="ten" style="font-size: 20px;" value="<?php echo $row_account['Ten']; ?>"placeholder="<?php echo $row_account['ten']; ?>"  >
                        </div>
                        <div class="cap_nhat_ns" >Ngày Sinh :
                            <input type="date" name="ngay" style="font-size: 20px; margin-top: 10px; " value="<?php echo $row_account['Ngay_sinh']; ?>" placeholder="<?php echo $row_account['Ngay_sinh']; ?>"  >
                        </div>
                        <div class="cap_nhat_gt"  >Giới Tính : <input type="radio" name="gt" style="font-size: 20px; margin-top: 10px; " value="NAM">Nam 
                                                               <input type="radio" name="gt" style="font-size: 20px; margin-top: 10px; " value="NỮ">Nữ
                        </div> 
                       <div class="cap_nhat_dc"  >Địa chỉ :
                           <input type="text"name="dc"  style="font-size: 20px; margin-top: 10px; "  value="<?php echo $row_account['diachi']; ?>" placeholder="<?php echo $row_account['diachi']; ?>">
                       </div>
                        <div class="cap_nhat_sdt" >SĐT : 
                            <input type="text"name="sdt" style="font-size: 20px; margin-top: 10px; " value="<?php echo $row_account['Sdt']; ?>" placeholder="<?php echo $row_account['Sdt']; ?>"  >
                        </div>
                        <div class="cap_nhat_email" >Email : 
                            <input type="text" name="email" style="font-size: 20px; margin-top: 10px; " value="<?php echo $row_account['Email']; ?>" placeholder="<?php echo $row_account['Email']; ?>"  >
                        </div>
                        <div class="cap_nhat_tk" > 
                            <p>Số tài khoản :<?php echo $row_account['stk']; ?></p>
                             <p>Số tiền :<?php echo $row_account['Tien']; ?></p>
                             <p>Điểm tích lũy :<?php echo $row_account['diem_tich_luy']; ?></p>
                        </div>
                        
                        <div class="sub" style="margin-top: 30px;">
                            <button type="reset" style="height: 35px; font-size: 25px;font-weight: bold; background: burlywood;">Reset</button> 
                            <button type="submit" name="submit"style="height: 35px; font-size: 25px;font-weight: bold; background: burlywood; margin-left: 50px;" onclick="tai_lai_trang()">
                                Lưu
                            </button> 
                        </div>
                    </form>
                </div>
                        <script language='javascript'>
                         function tai_lai_trang(){
                                location.reload();
                            }
                         </script>
                        <?php
                        if(isset($_POST['submit'])){
                            if(isset($_POST['gt'])){
                            if($_POST['gt']=='Nam'){
                                 $sql_capnhat = "update thongtin set Ten='".$_POST['ten']."',ngay_sinh='".$_POST['ngay']."',gioi_tinh='Nam',diachi='".$_POST['dc']."',sdt='".$_POST['sdt']."',email='".$_POST['email']."'  where username='".$a."'";
                                 $result_capnhat = mysqli_query($conn, $sql_capnhat);
                            }
                            else {
                               $sql_capnhat = "update thongtin set Ten='".$_POST['ten']."',ngay_sinh='".$_POST['ngay']."',gioi_tinh='Nữ',diachi='".$_POST['dc']."',sdt='".$_POST['sdt']."',email='".$_POST['email']."'  where username='".$a."'";
                             $result_capnhat = mysqli_query($conn, $sql_capnhat);
                            }
                            }
                            $sql_capnhat = "update thongtin set Ten='".$_POST['ten']."',ngay_sinh='".$_POST['ngay']."',gioi_tinh='".$row_account['Gioi_tinh']."',diachi='".$_POST['dc']."',sdt='".$_POST['sdt']."',email='".$_POST['email']."'  where username='".$a."'";
                             $result_capnhat = mysqli_query($conn, $sql_capnhat);
                           ?>
                        <script language='javascript'>
                            alert('bạn đã cập nhật thành công');
                        </script>
                        <?php
                        }
                        ?>                
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
 
