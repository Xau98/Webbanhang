 <?php
        $conn=mysqli_connect('localhost','root','','project')or die("Không kết nối được");
        mysqli_set_charset($conn,"utf8");
        $a= $_COOKIE['username']; 
         $sql = "SELECT * FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         //Lưu lại lịch sử giao dịch
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
                                        header("main.php?trang=1");
                                    }
                             ?> 
                <!noidung right>
                <div class="account_right">
                    <div class="account_right_title" style="height: 720px;  background: #99ffff ">
                        <form method="Post"style="margin: 0 auto;padding-left: 150px;padding-top: 36px;text-align: center;" name="chuyen">
                            <table  cellspacing="30" style="font-size: 20px;">
                            <tr>
                                <td colspan="2"><h1>Dịch vụ nạp tiền vào tài khoản</h1></td>
                            </tr>
                            <tr>
                                <td> Loại thẻ : </td>
                                <td>
                                    <select name="loai_the" style="height: 40px; width: 250px; font-size: 20px;">
                                          <option value="chon_loai_the">Chọn loại thẻ</option>
                                          <option value="Viettel">Viettel</option>
                                          <option value="Vinaphone">Vinaphone</option>
                                          <option value="Mobifone">Mobifone</option>
                                          <option value="Zing">Zing</option>
                                      </select>
                                  </td>
                            </tr>
                            <tr>
                                <td> Mệnh giá : </td>
                                <td>
                                     <select name="menh_gia" style="height: 40px; width: 250px; font-size: 20px;">
                                         <option value="chon_menh_gia">Chọn mệnh giá</option> 
                                         <option value="20000">20.000</option>
                                          <option value="50000">50.000</option>
                                          <option value="100000">100.000</option>
                                          <option value="200000">200.000</option>
                                          <option value="500000">500.000</option>
                                      </select>
                                </td>
                                
                            </tr>
                            <tr>
                                <td> Số seri : </td>
                                <td><input type="text" name="seri" style="height: 30px; font-size: 20px;"></td>
                            </tr>
                            <tr>
                                <td> Số thẻ : </td>
                                <td><input type="text" name="ntk" style="height: 30px; font-size: 20px;"></td>
                            </tr>
                            
                            <tr>
                                <td><button type="reset" style="height: 30px; font-size: 20px;">Nhập lại</button> </td>
                                <td><button type="submit" name="sub_nap_tien" style="height: 30px; font-size: 20px;">Nạp tiền</button></td>
                            </tr>
                            </table>
                        </form>
                        <?php 
                        if(isset($_POST['sub_nap_tien'])){ 
                            
                                if(!empty($_POST['ntk'])&&!empty($_POST['seri'])&&$_POST['loai_the']!='chon_loai_the'&&!$_POST['menh_gia']!='chon_menh_gia'){ 
                                    //kiem tra mã thẻ đã tồn tại chưa
                                   
                                        $sql_kt_ma = "SELECT * FROM ma_the where ma_the='".$_POST['ntk']."' ";
                                     $result_kt_ma = mysqli_query($conn, $sql_kt_ma);
                                      $row_kt_ma = mysqli_fetch_assoc($result_kt_ma);

                                    if($_POST['ntk']==$row_kt_ma['ma_the']&&$_POST['seri']==$row_kt_ma['seri']&&$_POST['loai_the']==$row_kt_ma['Loai_the']&&$_POST['menh_gia']==$row_kt_ma['menh_gia']){
                                        //update tiền 
                                        $row['Tien']=$row['Tien']+$row_kt_ma['menh_gia'];
                                       $sql_up_tien = "update thongtin set Tien='".$row['Tien']."' where username='".$a."'  ";
                                       $result_up_tien = mysqli_query($conn, $sql_up_tien);  
                                         ?>
                                                      <script language='javascript'>
                                                          alert('Giao dịch thành công !!!');
                                                      </script>
                                         <?php
                                           $sql_kt_dl = "DELETE FROM `ma_the` WHERE  ma_the='".$_POST['ntk']."' ";
                                          $result_kt_dl = mysqli_query($conn, $sql_kt_dl);
                                    }
                                    else{ 
                                       ?>
                                                      <script language='javascript'>
                                                          alert('Nhập  !!!');
                                                      </script>
                                         <?php 
                                    }
                                }
                                else{ 
                                       ?>
                                                      <script language='javascript'>
                                                          alert('Nhập đầy đủ thông tin !!!');
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
  


