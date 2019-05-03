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
            
            <div class="account_main"  style="height: 720px;">
                
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
                <!noidung right>
                <div class="account_right">
                    <div class="account_right_title" style="height: 720px;  background: #99ffff ">
                        <form method="Post"style="margin: 0 auto;padding-left: 150px;padding-top: 36px;text-align: center;" name="chuyen">
                            <table  cellspacing="30" style="font-size: 20px;">
                            <tr>
                                <td colspan="2"><h1>Dịch vụ chuyển tiền</h1></td>
                            </tr>
                            <tr>
                                <td colspan="2"><p>Số tiền hiện tại :<?php echo $row['Tien']; ?> (VND)</p> </td>
                            </tr>
                            <tr>
                                <td> Số tài khoản nhận </td>
                                <td><input type="text" name="tk1" style="height: 30px; font-size: 20px;"></td>
                            </tr>
                            <tr>
                                <td> Số Tiền </td>
                                <td><input type="number" name="tien1" style="height: 30px; font-size: 20px;" placeholder="Số tiền tối thiểu là 1000"></td>
                            </tr>
                            <tr>
                                <td><button type="reset" style="height: 30px; font-size: 20px;">Nhập lại</button> </td>
                                <td><button type="submit" name="sub_chuyen_tien" style="height: 30px; font-size: 20px;">Chuyển tiền</button></td>
                            </tr>
                            </table>
                        </form>
                        <?php 
                        if(isset($_POST['sub_chuyen_tien'])){
                          if(!empty($_POST['tk1'])&&!empty($_POST['tien1'])){ 
                                //lấy tiền bên a (bên gưi) trừ đi số tiền chuyển, rồi cập nhật lại tiền cho bên A
                                $sql_ben_a = "SELECT tien,stk FROM thongtin where username='".$a."' ";
                               $result_ben_a = mysqli_query($conn, $sql_ben_a);
                                $row_a = mysqli_fetch_assoc($result_ben_a);
                                //lấy tiền bên B (bên nhận) công đi số tiền chuyển, rồi cập nhật lại tiền cho bên B
                               $sql_ben_b = "SELECT tien,stk FROM thongtin where stk='".$_POST['tk1']."'";
                               $result_ben_b = mysqli_query($conn, $sql_ben_b);
                                $row_b = mysqli_fetch_assoc($result_ben_b);
                                //bắt đầu chuyển
                                if($_POST['tk1']==$row_b['stk']&&$_POST['tk1']!=$row_a['stk']){
                                        if($_POST['tien1']>$row_a['tien']||$_POST['tien1']<1000){
                                            ?>
                                                <script language='javascript'>
                                                    alert('Số tiền trong tài khoản không đủ để thực hiện giao dịch');
                                                </script>
                                             <?php
                                        }else{
                                           
                                            //bên gửi
                                            $tra=$row_a['tien']-$_POST['tien1'];
                                            $sql_ben_tra = "Update thongtin set tien='".$tra."' where username='".$a."' ";
                                           $result_ben_tra = mysqli_query($conn, $sql_ben_tra); 
                                             //bên nhận
                                            $nhan=$row_b['tien']+$_POST['tien1'];
                                           $sql_ben_nhan = "Update thongtin set tien='".$nhan."' where stk='".$row_b['stk']."' ";
                                          $result_ben_nhan = mysqli_query($conn, $sql_ben_nhan);
                                          //thông báo
                                                ?>
                                          <script language='javascript'>
                                              alert('Chuyển khoản thành công');
                                          </script>
                                         <?php
                                        }  
                                }
                             else {
                                 ?>
                                   <script language='javascript'>
                                       alert('Số tài khoản không hợp lệ');
                                   </script>
                                <?php
                                } 
                    }
                  else {
                        ?>
                            <script language='javascript'>
                                alert('Vui lòng nhập đầy đủ thông tin');
                            </script>
                        <?php
                            }
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
  
