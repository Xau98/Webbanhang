<?php 
        $conn=mysqli_connect('localhost','root','','project')or die("can't connect database");
        mysqli_set_charset($conn,"utf8");
        $a= $_COOKIE['username'];
        session_start();
        //
        $iddm=$_GET['id'];
         $sql = "SELECT id,username,password,img,Tien,Loai FROM thongtin where username='".$a."' ";
          $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result); 
         // truy xuất sản phẩm 
          $sql_sp = "SELECT ds_sp.id as'id',ten_sp,img_sp,gia_niem_yet,gia_sp FROM ds_sp join danhmucsp on ds_sp.id=ma_sp where ma_danh_muc='".$iddm."'" ;
          $result_sp = mysqli_query($conn, $sql_sp);
           $row_sp = mysqli_fetch_assoc($result_sp);
        
           //truy xuất sp theo nhu cầu
           //ID là ma sp
           if(!empty($_POST['seach'])){
                $sql_seach = "SELECT id,ten_sp,img_sp,gia_niem_yet,gia_sp FROM ds_sp where id like'%".$_POST['seach']."%'or ten_sp like '%".$_POST['seach']."%'  " ;
           $result_seach = mysqli_query($conn, $sql_seach);
           }
          //truy xuất danh mục
            $sql_dm = "SELECT ten_danh_muc FROM tendm" ;
          $result_dm = mysqli_query($conn, $sql_dm);
           $row_dm = mysqli_fetch_assoc($result_dm);
           //
           $sql_dmh = "SELECT ten_danh_muc FROM tendm where id='".$iddm."'" ;
          $result_dmh = mysqli_query($conn, $sql_dmh);
           $row_dmh = mysqli_fetch_assoc($result_dmh);
           //
           $soluongsp= mysqli_query($conn, "Select count(id)as 'sl' from chi_tiet_hoa_don where MaKH='".$row['id']."' ");
           $row_slsp = mysqli_fetch_assoc($soluongsp);
           //kết nối giữa các danh mục
        ?>

<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project CMC</title>
<link href="CSS/Filecss.css" rel="stylesheet" type="text/css"/>
 
</head>
<body>
    <!banner >
<div class="banner" >
        <a><marquee scrollamount='10'><img src="https://i.imgur.com/ueWpoG4.png" width="1000" height="300"  alt="banner"/>
                <img src="IMG/banner2.PNG" width="1000" height="300" alt="banner2"/>
            </marquee>
        </a>
    </div>

    <!main >
    <div class="body">
         <!boddy left>
        <div class="body_left">
            <div class="account">
                <div class="anhdaidien" ><img src="<?php echo $row['img']; ?>" width="170" height="170" alt="anh dai dien"/></div>
                <div class="name_account" >
                    <a href="account.php" style="text-decoration: none;"> 
                           <?php 
                           echo $row['username'].' ( '.$row['Loai'].' )'; 
                           ?>
                     </a>
                </div>
            </div>
            
            <div class="left_ads" >
                <marquee direction="down" height="549">
                    <a href="#" ><img src="IMG/banner_left/xoso.PNG"  width="200"></a>
                    <a href="#" ><img src="IMG/banner_left/K+.PNG"  width="200"></a>
                </marquee>
               
            </div>
        </div>
         <!boddy center>
        <div class="body_main">
            <div class="main_top" ><a style="text-decoration: none;" href="main.php?trang=1">>>Home</a>
                      <a style="text-decoration: none;" href="#">>><?php echo $row_dmh['ten_danh_muc']; ?></a>
            </div>
            <div style="width: 600px; background: #99ffff;height: 30px"><form method="post" >
                    <input type="search" name="seach" id="seach" placeholder="Tìm kiếm" style="width: 220px; height: 30px;float: right ">
                    <input type="submit" name="submit_seach" value="Tìm Kiếm"  style="width: 96px; height: 30px; float: right; ">
                    
                    <button name="slsp"  style="float: right; height: 30px;">Giỏ hàng(<?php echo $row_slsp['sl']; ?>)</button>
                </form>
            </div>
            
            <!main >
            <div class="main" style="background: #ffffff;">  
                    <?php 
                      if(isset($_POST['slsp'])){
                          header("Location: giohang.php?id=");
                      }
                     if(isset($_POST['submit_seach'])&&!empty($_POST['seach'])){ 
                            while($row_seach = mysqli_fetch_assoc($result_seach)) { 
                            ?>
                            <div class="main_sp" style="padding-top: 10px; padding-left: 10px;width: 188px;border: 1px solid #ccff33; height: 275px; background: #cccc00;  float: left;" >
                                <div class="img_sp" >
                                    <a href="#" > <img src="<?php echo $row_seach['img_sp']; ?>" alt="laptop" width="180" height="180"></a>
                                </div>
                                <div class="ten_sp" id="sp"> 

                                    <a  href="Thongtinsp.php?id=<?php echo $row_seach['id']; ?>" style="text-decoration: none;" ><?php  echo $row_seach['ten_sp']; ?></a>

                                </div>
                                <div class="gia_sp" id="sp">Giá :<strike><?php echo $row_seach['gia_niem_yet']; ?></strike>=><?php echo $row_seach['gia_sp']; ?>
                                </div>

                                <div class="gio_hang"id="sp" style="background: #99ffff;">

                                    <a href="giohang.php?id=<?php echo $row_seach['id']; ?>" style="text-decoration: none; ">Thêm Vào Giỏ</a>
                                </div>
                            </div>
                             <?php
                            }
                }else{
                    while($row_sp = mysqli_fetch_array($result_sp)) {
                    ?>
                
                <div class="main_sp" style="padding-top: 10px; padding-left: 10px;width: 188px;border: 1px solid #ccff33; height: 275px; background: #cccc00;  float: left;" >
                    <div class="img_sp" >
                        <a href="#" > <img src="<?php echo $row_sp['img_sp']; ?>" alt="laptop" width="180" height="180"></a>
                    </div>
                    <div class="ten_sp" id="sp"> 
                        
                        <a  href="Thongtinsp.php?id=<?php echo $row_sp['id']; ?>" style="text-decoration: none;" ><?php  echo $row_sp['ten_sp']; ?></a>
                  
                    </div>
                    <div class="gia_sp" id="sp">Giá :<strike><?php echo $row_sp['gia_niem_yet']; ?></strike>=><?php echo $row_sp['gia_sp']; ?>
                    </div>
                    
                    <div class="gio_hang"id="sp" style="background: #99ffff;">
                        
                        <a href="giohang.php?id=<?php echo $row_sp['id']; ?>" style="text-decoration: none; ">Thêm Vào Giỏ</a>
                    </div>
                </div>   
                     <?php
                     
                    } 
                     
                }
                   ?> 
            </div>
        </div>
         
        <!boddy right>
        <div class="boddy_right">
            <div class="title_boddy_right"   >Danh mục Sản Phẩm</div>
            <div class="danh_muc">
              <form method="post">  
                  <?php
                 while($row_dm = mysqli_fetch_array($result_dm)) {
                ?>
                
                  <button  name="<?php echo $row_dm['ten_danh_muc'] ; ?>" class="ten_dm" style="">
                            <a><?php echo $row_dm['ten_danh_muc'] ; ?></a>
                    </button> 
                    <?php
                 }
                    ?>
                </form>
            </div>
            
        </div>
    </div> 
    
    <!foot >
    <div class="foot" style="height: 250px;" >
        <div style="padding-left:  20px; padding-top: 20px;">
            <div><p  >Tên Công ty :  </p>  <p>Địa chỉ:</p></div>
            <div><p>Tổng Đài liên lạc:</p><p>Mã Số doanh nghiệp:</p></div>
            <div>Emai:</div>
            <hr>
            <div>Bản quyền:</div>
        </div>
    </div>
    
    
</body>
</html>

