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
require 'common.php';
$timefile1 = $datadir.'/index.html';
$timefile2 = 'install_lock.php';
$timefile2 = $datadir.'/at.'.md5('time').'.php';
if(file_exists($timefile1)) {
	$lasttime = filemtime($timefile1);
} elseif(file_exists($timefile2)) {
	$lasttime = filemtime($timefile2);
} elseif(file_exists($timefile3)) {
	$lasttime = filemtime($timefile3);
}
$passtime = time()-$lasttime;
if( floor($passtime/(24*60*60)) > 15 ){
	require 'fun.yz.php';
} else {
	die('0');
}
?>