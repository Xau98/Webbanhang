<?php
        $conn=mysqli_connect('localhost','root','','project')or die("Kết nối thất bại");
        mysqli_set_charset($conn,"utf8");
        $a= $_COOKIE['username'];
         $sql = "SELECT * FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         //
           $ma_sp =$_GET['id'];
      
        
         //
         $sql_hang = "SELECT chi_tiet_hoa_don.id,ds_sp.id as 'idsp',Ten_sp,gia_niem_yet,gia_sp,mau,So_luong FROM (chi_tiet_hoa_don join thongtin on makh=thongtin.id)join ds_sp on ds_sp.id=chi_tiet_hoa_don.ma_sp where username='".$a."' ";
          $result_hang = mysqli_query($conn, $sql_hang);
          $row_hang = mysqli_fetch_assoc($result_hang);
          $result_xuly = mysqli_query($conn, $sql_hang);
          $result_xoa_gio = mysqli_query($conn, $sql_hang);
          // trang kéo lên kéo xuống
         
         // nhập mã giảm giá
         //ko cho đặt số lượng lớn hơn số lượng sp còn trong kho
          
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
                                        header("Location:  main.php?trang=1");
                                    }
                             ?> 
                <!noidung right>
                <div class="account_right" style="height: 720px;">
                    
                    <div class="account_right_title" style="height: 680px;  background: #99ffff ">
                        <form method="Post">
                            <table cellspacing="20" style="width: 750px; border: 1px #99ff33 solid; font-size: 20px; text-align: center;">
                                <tr style="font-weight:bold;     ">
                                    <td  colspan="2" >Sản Phẩm </td>
                                    <td>Màu</td>
                                    <td>Đơn Giá</td>
                                    <td>Số lượng</td>
                                    <td>Số Tiền</td>
                                    <td>Thao tác</td>
                                </tr>
                                <?php
                                while( $row_hang = mysqli_fetch_array($result_hang)) {
                                ?>
                                <tr>
                                    <td  colspan="2" ><a href="Thongtinsp.php?id=<?php echo $row_hang['id'];?>"> <?php echo $row_hang['Ten_sp'] ; ?>  </a></td>
                                    <td><?php echo $row_hang['mau'] ; ?></td>
                                    <td>
                                        <strike><?php echo $row_hang['gia_niem_yet'] ; ?></strike>=><?php echo $row_hang['gia_sp'] ; ?>
                                    </td>
                                      <td>
                                          
                                          <input type="number" id="sl" name="n<?php echo $row_hang['id'];?>" value="<?php echo $row_hang['So_luong'] ; ?>" style="height: 20px; width: 30px;">
                                          <button name="c<?php echo $row_hang['id'];?>"  >Ok</button> 
                                            
                                    </td>
                                    <td><?php 
                                        echo $row_hang['gia_sp']*$row_hang['So_luong'] ; ?>
                                    </td>
                                    <td><button name="b<?php echo $row_hang['id'];?>" onclick="alert('Xóa thành công');">xóa</button></td>
                                   
                                </tr>
                                <?php
                                } 
                              
                                ?>
                            </table>
                        </form>
                        <form>
                            <table>
                                
                            </table>
                        </form>
                            <?php
                            
                                 while( $row_xuly = mysqli_fetch_array($result_xuly)) {
                               
                                         
                               //xử lý nút OK
                                       $xuly_sl='c'.$row_xuly['id'];
                                       if(isset($_POST[$xuly_sl])){
                                         $up_sl= 'n'.$row_xuly['id'];
                                          echo $row_xuly['id'];
                                              $sql_up = "update chi_tiet_hoa_don set so_luong='".$_POST[$up_sl]."'where id='".$row_xuly['id']."'";
                                             $result_up = mysqli_query($conn, $sql_up); 
                                           //up load chậm
                                        } 

                                        //xử lý nút xóa
                                        $xuly_xoa='b'.$row_xuly['id'];
                                        if(isset($_POST[$xuly_xoa])){
                                              $sql_up_xoa = "DELETE FROM chi_tiet_hoa_don WHERE chi_tiet_hoa_don.id = '".$row_xuly['id']."'";
                                             $result_up_xoa = mysqli_query($conn, $sql_up_xoa);
                                        }
                                 
                                }
                                ?>

                        <div>
                            <?php
                            //SELECT SUM(So_luong*gia_sp) FROM (chi_tiet_hoa_don join thongtin on makh=thongtin.id)join ds_sp on ds_sp.id=chi_tiet_hoa_don.ma_sp where username='tien' 
                            $sql_sum = "SELECT SUM(So_luong*gia_sp) as'tong_tien' FROM (chi_tiet_hoa_don join thongtin on makh=thongtin.id)join ds_sp on ds_sp.id=chi_tiet_hoa_don.ma_sp where username='".$a."' ";
                            $result_sum = mysqli_query($conn, $sql_sum); 
                           $row_sum = mysqli_fetch_assoc($result_sum);
                            ?>
                            <form method="Post">
                                <table style="width: 750px;  border: 1px #99ff33 solid; font-size: 20px; text-align: center;">
                                    <tr>
                                        <td>
                                            <p>Tổng Tiền : 
                                                <?php 
                                                if($row['Loai']=='VIP'||$row['Loai']=='VIP1'||$row['Loai']=='VIP2'){
                                                  $kq=  $row_sum['tong_tien']*0.7; 
                                                  echo $kq;
                                             }
                                            else {
                                                $kq=  $row_sum['tong_tien'] ; 
                                                  echo $kq;
                                                
                                            }  
                                            ?> 
                                            VND</p>  
                                        </td>
                                      
                                    </tr>
                                    <tr>
                                        <td> 
                                            <button name="thanh_toan" style="height: 40px; width: 300px; font-size: 30px; font-weight: bold; background: #99ff33;">
                                                Thanh toán
                                            </button> 
                                        </td>

                                    </tr>
                                    <tr>
                                       <td>
                                            <p>Điểm tích lũy : <?php echo $kq/1000; ?> (Điểm)</p>  
                                       </td>
                                    </tr>
                                </table>

                            </form>
                            <?php
                              if(isset($_POST['thanh_toan'])){
                                  if($row['Tien']>$kq){
                                    $row['Tien']=$row['Tien']-$kq;
                                    $row['diem_tich_luy']=$row['diem_tich_luy']+$kq/1000;
                                     //thanh toán
                                     $sql_up_tien = "update thongtin set Tien='".$row['Tien']."',diem_tich_luy='".$row['diem_tich_luy']." where username='".$a."'  ";
                                    $result_up_tien = mysqli_query($conn, $sql_up_tien);  
                                    
                                    
                                    $date_dat=  date("Y-m-d"); 
                                    echo $date_dat;
                                    while( $row_xoa_gio = mysqli_fetch_array($result_xoa_gio)) {
                                        //lưu vào lịch sử mua hàng 
                                       
                                        $sql_ls1="INSERT INTO lich_su (MaKH, Ma_sp, So_luong, Tinh_trang_sp, Date_tao) VALUES ( '".$row['id']."', '".$row_xoa_gio['idsp']."', '".$row_xoa_gio['So_luong']."', 'đang giao', '".$date_dat."')  ";
                                      $result_ls1= mysqli_query($conn, $sql_ls1);
                                        //xóa hàng trong giỏ hàng 
                                     $sql_xoa_gio1 = "DELETE FROM chi_tiet_hoa_don WHERE chi_tiet_hoa_don.id = '".$row_xoa_gio['id']."'";
                                      $result_xoa_gio1  = mysqli_query($conn, $sql_xoa_gio1 );
                                    }
                               ?>  
                            <script language="javascript">
                                alert('Thanh Toán Thành công');
                            </script> 
                              <?php 
                              }
                            else {
                                ?>  
                                    <script language="javascript">
                                        alert('Số Tiền trong tài Khoản Ko đủ để thực hiện ');
                                    </script> 
                              <?php
                                    
                            }
                        }
                            ?>
                       </div>
                    </div>
                </div>
               
            </div>
            <?php
            // nâng cấp tài khoản 
          
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
                  
        </div>
       
    </body>
</html>
                           
