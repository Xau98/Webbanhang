<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
       
    </head>
    <body style="background:aliceblue">
        <fieldset style="width: 300px;margin: 0 auto;">
                    <legend>Đăng Ký </legend>
                    <form method="Post" style="background: beige" name="form_dk" >
                        <table >
                            <tr style=" height: 40px;">
                                <td>Họ tên <label style="color: red">*</label> </td>
                                <td><input type="text" name="ten" ></td>
                            </tr>
                           
                            <tr style=" height: 40px;">
                                <td>Email </td>
                                <td><input type="email" name="email" ></td>
                            </tr>
                            
                            <tr style=" height: 40px;">
                                <td>Số điện thoại <label style="color: red">*</label> </td>
                                <td><input type="text" name="sdt" ></td>
                            </tr>
                            
                            <tr style=" height: 40px;">
                                <td>Địa chỉ  : </td>
                                <td><input type="text" name="add" ></td> 
                            </tr> 
                            
                            <tr style=" height: 40px;">
                                <td>Username <label style="color: red">*</label> </td>
                                <td><input type="text" name="user"></td>
                            </tr >
                            
                            
                            <tr style=" height: 40px;">
                                <td>Password <label style="color: red">*</label> </td>
                                <td><input type="password" name="password" ></td>
                            </tr>
                           
                            
                            <tr style=" height: 40px;">
                                <td>Confirm <label style="color: red">*</label> </td>
                                <td><input type="password" name="confirm"></td>
                            </tr>
                            
                            <!–button–>
                            <tr style=" height: 70px;">
                                <td style="text-align: center ; font-size: 30px; font-weight: bold;">
                                    <button type="reset" >Reset</button>
                                </td>
                                <td style="text-align: center ; font-size: 30px; font-weight: bold;" >
                                    <button type="submit" name="luu"> Đăng Ký </button>
                                </td> 
                            </tr>
                            <tr style=" height: 40px;">
                                <td colspan="2" style="text-align: center ; font-size: 30px; font-weight: bold;">
                                    <button type="submit" name="back" ><a href="index.php">Quay Lại >>> Đăng nhập</a></button>
                                </td>
                            </tr>
                            
                        </table>
                    </form>
                   
        </fieldset>
        <?php
          if(isset($_POST['luu'])){
                 $conn=mysqli_connect('localhost','root','','project')or die("can't connect database");
                $ht= $_POST['ten'];
                $email= $_POST['email'];
                $sdt= $_POST['sdt'];
                $dc= $_POST['add'];
                $user= $_POST['user'];
                $pass= $_POST['password']; 
                $confirm= $_POST['confirm']; 
                $pattern = '#0[\d]{9}#';
                            
                //bắt lỗi
                if(empty($ht)||empty($sdt)||empty($user)||empty($pass)||empty($confirm)){
                 ?>
                    <script language="javascript">
                            alert('Vui lòng nhập đầy đủ thông tin');
                    </script>
                 <?php
                }else{
                    if($pass!=$confirm){
                     ?>
                        <script language="javascript">
                                alert('Lỗi confirm password');
                        </script>
                     <?php
                     }
                    else{
                        if(preg_match($pattern, $sdt)){
                            $date=  date('Y-m-d');
                           $sql = "Insert into thongtin(`Ten`, `Email`, `Sdt`, `diachi`, `username`, `password`,date_tao) values ('$ht','$email','$sdt','$dc','$user','$pass','$date')";
                           $result = mysqli_query($conn, $sql);
                             ?>
                                <script language="javascript">
                                        alert('Đăng ký thành công.');
                                </script>
                             <?php 
                        }else{
                           ?>
                            <script language="javascript">
                                    alert('Số điện thoại không hợp lệ.');
                            </script>
                          <?php 
                        }
                    }
                }
                //ko xóa những cái ko lỗi và giữ lại cái ko có lỗi 
                //chưa bắt lỗiuser ko trùng với user trong database
               
           }
           
            ?>
    </body>
</html>
