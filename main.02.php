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
$menu = $_REQUEST['menu'];
if( $menu == 'addfo' ){
	$foname = insql($_REQUEST['foname']);
	$fourl  = insql($_REQUEST['fourl']);
	$fofile = $datadir . '/fo.' . md5(getname()) . '.php';
	$focontent = file($fofile);
	array_shift($focontent);
	$focontent[] = $foname.' '.$fourl."\r\n";
	array_unshift($focontent, '<?php exit();?>'."\r\n");
	file_put_contents($fofile, $focontent) or die($fofile . ' 禁止写入！');
	die('1');
} elseif( $menu == 'editfo' ) {
	$oldfo = insql($_REQUEST['oldfo']);
	$newfoname = insql($_REQUEST['newfoname']);
	$newfourl  = insql($_REQUEST['newfourl']);
	$fofile = $datadir . '/fo.' . md5(getname()) . '.php';
	$focontent = file($fofile);
	array_shift($focontent);
	$folist = '<?php exit();?>'."\r\n";
	foreach($focontent as $value){
		$foarray = explode(' ', $value);
		if( $foarray[0] == $oldfo ){
			$folist .= $newfoname.' '.$newfourl."\r\n";
		} else {
			$folist .= $value;
		}
	}
	file_put_contents($fofile, $folist) or die($fofile . ' 禁止写入！');
	die('1');
} elseif( $menu == 'delfo' ) {
	$fov = insql($_REQUEST['fov']);
	$fofile = $datadir . '/fo.' . md5(getname()) . '.php';
	$folist = '<?php exit();?>'."\r\n" . $fov;
	file_put_contents($fofile, $folist) or die($fofile . ' 禁止写入！');
	die('1');
}
?>