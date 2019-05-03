<?php

$conn=mysqli_connect('localhost','root','','project')or die("Kết nối thất bại");
mysqli_set_charset($conn,"utf8");
$sql = "SELECT id,username,password FROM thongtin";
$result = mysqli_query($conn, $sql);
 $dem=0;
if (mysqli_num_rows($result) > 0) { 
    while($row = mysqli_fetch_assoc($result)) {
        if($_POST['user']==$row['username']&&$_POST['pass']==$row['password']){
           header("Location: main.php?trang=1");
               ?>
                    <script language="javascript">
                            alert('Đăng nhập thành công');
                    </script>
              <?php
              $dem==1;
        } else {
            
        }
    } 
} else {
    echo "0 results";
}  //
if($dem==0){
         ?>
<script language="javascript" >
    alert("Tài khoản không hợp lệ");
</script>
  <?php
    }
mysqli_close($conn);
 
?>
