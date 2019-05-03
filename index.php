           <?php
           session_start();
           if(!empty($_POST['user'])&&!empty($_POST['pass'])){
                 setcookie('username',$_POST['user'],  time()+3600,'/','',0,0);
                 setcookie('password',$_POST['pass'],  time()+3600,'/','',0,0);
           } 
            if(!empty($_COOKIE['username'])&&!empty($_COOKIE['password'])){ 
             header("Location: main.php?trang=1");
         }
           ?> 
<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="CSS/Filecss.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>  
        <fieldset style="width: 360px;margin: 0 auto;" id="login">
                    <legend>Login </legend>
                    <form method="POST">
                        <table border="0" cellspacing="10" style="font-size: 20px;" >
                        <tr style=" height: 30px; ">
                            <td style="  width: 150px;background: antiquewhite; border-right:  1px solid black;">
                                <a href="#" style="text-decoration: none;" >Đăng Nhập</a>
                            </td>
                            <td style="  width: 150px; background: aqua; ">
                                <a href="dangky.php"style="text-decoration: none;">Đăng Ký</a>
                            </td>
                        </tr>
                        <tr style=" height:50px; "></tr>
                        <tr>
                            <td> Tên đăng nhập </td>
                            <td><input type="text" name="user" id="user" style="height: 20px;"></td>
                        </tr>
                        <tr style=" height:20px; "> </tr>
                        <tr>
                            <td> Password </td>
                            <td><input type="password" name="pass" id="pass" style="height: 20px;"></td>
                        </tr>
                        <!capcha>
                        <tr >
                            <td colspan="2" style="text-align: center; ">
                                <img src="gencapcha.php">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style=" height:20px; text-align: center; ">
                                <input type="text" name="capcha" id="capcha" style="height: 20px; font-size: 15px">
                            </td>
                        </tr>
                        <tr style="margin-top: 5px;">
                            <td> <input type="reset" value="reset" style="height: 35px; width: 95px; font-size: 20px;font-weight: bold;"></td>
                            <td style="text-align: center;">
                                <input type="submit"  value="login" name="login" style="height: 35px; width: 95px; font-size: 20px;font-weight: bold;">
                            </td>
                        </tr>
                    </table>
                </form>
            </fieldset> 
         <?php
         
     if(isset($_POST['login'])){
         $user = $_POST['user'];
         $pass = $_POST['pass'];
         if(empty($user)||empty($pass)||empty($_POST['capcha'])){
               ?>
                    <script language="javascript">
                            alert('Vui lòng nhập đầy đủ thông tin');
                    </script>
              <?php
         }
         else{
           if($_SESSION['cap_code']==$_POST['capcha']){
                include 'server.php';
           }
         }
     }
        ?>
    </body>
</html>
