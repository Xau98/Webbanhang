<?php
        $conn=mysqli_connect('localhost','root','','project')or die("Không kết nối được");
        mysqli_set_charset($conn,"utf8");
        $a= $_COOKIE['username']; 
         $sql = "SELECT * FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
       
                        if(isset($_POST['change'])){
                            
                            if(!empty($_POST['Password_cu'])&&!empty($_POST['Password_moi'])){
                                
                                if($_POST['Password_cu']==$b){
                                        if($_POST['Password_moi']==$_POST['Password_confirm']){
                                             $sql_capnhat_pass = "update thongtin set username='".$_POST['change_username']."', password='".$_POST['Password_moi']."'  where username='".$a."'";
                                             $result_capnhat_pass = mysqli_query($conn, $sql_capnhat_pass);
                                             $a=1;
                                        }
                                }
                            }
                            if(!empty($_POST['change_username'])){// tạo trường hợp tên username không được trùng với username trong database
                                $sql_capnhat_user = "update thongtin set username='".$_POST['change_username']."'  where username='".$a."'";
                               $result_capnhat_user = mysqli_query($conn, $sql_capnhat_user);
                               $a=1;
                            }
                           if($a=1){
                               setcookie('username',$a,  time()-3600,'/','',0,0);
                               setcookie('password',$b,  time()-3600,'/','',0,0);
                               header("Location: index.php");
                           ?>
                        <script language='javascript'>
                            alert('Cập nhật thành công');
                        </script>
                        <?php
                         header("Location: index.php");
                           }
                        }
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
                    <div class="account_right_title" style="height: 570px;  background: #99ffff ; margin: 0 auto; ">
                        <form method="POST" style="margin: 0 auto;padding-left: 150px;padding-top: 36px;text-align: center;">
                            <table border="1" cellpadding="2" cellspacing="30" style="font-size: 20px;">
                                <tr>
                                    <td colspan="2" style="height: 40px; font-size: 25px;font-weight: bold;"> Thay đổi Username và password</td>  
                                </tr>
                                <tr>
                                    <td>Username </td>
                                    <td><input type="text" name="change_username" value="<?php echo $a; ?>" placeholder="<?php echo $a; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Password cũ </td>
                                    <td><input type="password" name="Password_cu"></td>
                                </tr>
                                <tr>
                                    <td>Password mới </td>
                                    <td><input type="password" name="Password_moi"></td>
                                </tr>.<tr>
                                    <td>Confirm Password </td>
                                    <td><input type="password" name="Password_confirm"></td>
                                </tr>
                                <tr style="height: 40px; width: 60px;">
                                    <td><button type="reset" style="height: 35px;background: coral; font-size: 25px;font-weight: bold;" >Reset</button></td>
                                    <td><button type="submit" name="change"  style="height: 35px;background: #99ff33; font-size: 25px;font-weight: bold;">
                                            Thay Đổi</button>
                                    </td>
                                </tr>
                            </table> 
                        </form> 
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
 