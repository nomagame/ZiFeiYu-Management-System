<?php
/* ---------------------------------------------------- */
/* 程序名称: 牛叉广告管理优化大师(NiuXams)
/* 程序功能: 快速低成本建立自己网站的广告管理、智能投放系统！
/* 程序开发: 牛叉软件(NiuXSoft.Com)
/* 版权所有: [NiuXams] (C)2013-2099 NiuXSoft.Com
/* 官方网站: niuxsoft.com  Email: niuxsoft@163.com
/* ---------------------------------------------------- */
/* 使用条款:
/* 1.该软件个人非商业用途免费使用.
/* 2.免费使用禁止修改版权信息和官方推广链接.
/* 3.禁止任何衍生版本.
/* ---------------------------------------------------- */
error_reporting(0);
$num = $_GET['num'];
$imagewidth = 60;
$imageheight = 18;

$numimage = imagecreate($imagewidth, $imageheight) or die("Cannot Initialize new GD image stream");
imagecolorallocate($numimage, 240, 240, 240);
for($i=0; $i<strlen($num); $i++){
	$x = mt_rand(1,8) + $imagewidth*$i/4;
	$y = mt_rand(1,$imageheight/4);
	$color = imagecolorallocate($numimage,mt_rand(0,150),mt_rand(0,150),mt_rand(0,150));
	imagestring($numimage,5,$x,$y,$num[$i],$color);
}

for($i=0; $i<200; $i++){
	$randcolor = imagecolorallocate($numimage,rand(1,255),rand(1,255),rand(1,255));
	imagesetpixel($numimage,rand(0,$imagewidth),rand(0,$imageheight),$randcolor); 
}
header("content-type:image/png");
imagepng($numimage);
imagedestroy($numimage);
?>