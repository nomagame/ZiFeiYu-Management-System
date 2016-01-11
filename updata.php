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
define('NIUXAMS_ACCESS', 'updata');
require 'common.php';
if( !preg_match( "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/" , getip() ) || stripos( $_SERVER['SERVER_NAME'] , '127.0.0.1') !== false || stripos( $_SERVER['SERVER_NAME'] , 'localhost') !== false ){
	die('在线升级功能不对内网测试用户开放，请上传到外网服务器或主机使用本功能！');
}
ini_set("default_socket_timeout", 300);
$lastver = file_get_contents($cloudurl . 'updata_ver.htm') or die('云端连接失败！云端地址错误或php函数限制或云端忙！');
if( NIUXAMS_VER >= $lastver ){die('当前使用版本已经是最新版本，无需升级！');}
$content = file_get_contents($cloudurl . 'updata.php?domain='.$_SERVER['SERVER_NAME'].'&amsurl='.$amsurl) or die('获取最新文件列表失败，云端不可连接！');
$lines = explode("\r\n", insou1($content));
if( count($lines) < 4 ){die($content);}
foreach ($lines as $line_num => $line){
	$dirmd5 = explode(' ', $line);
	if( $dirmd5[0] && $dirmd5[1] && (md5_file($dirmd5[0]) != $dirmd5[1]) ){
		if( !file_exists( dirname($dirmd5[0]) ) ){ mkdir( dirname($dirmd5[0]) , 0777 , true ); }
		$fdata = file_get_contents($cloudurl . 'updata.php?menu=downfile&f='.$dirmd5[0]) or die('获取最新更新文件失败，云端不可连接！');
		file_put_contents($dirmd5[0], insou1($fdata)) or die('升级出错啦！无法替换原文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
	}
}
include 'updata_run.php';
die('1');
?>