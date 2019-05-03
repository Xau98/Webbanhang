<?php
session_start();
$ranStr = md5(microtime());
$ranStr=  substr($ranStr, 0,6);
$_SESSION['cap_code']=$ranStr;
$newImage=  imagecreatefromjpeg("capcha/Capcha.jpg");
$txtColor =  imagecolorallocate($newImage, 0,0,0);
imagestring($newImage,500,50,19, $ranStr, $txtColor);
header("Content-type: image/jpeg");
imagejpeg($newImage);
?>
