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
define('NIUXAMS_ACCESS', 'editggwleizu');
require 'common.php';
$menu = $_REQUEST['menu'];
///////////////////////////
if( $menu == 'addleizu' ){
$ggwleizu = insql($_REQUEST['ggwleizu']);
$name  = insql($_REQUEST['name']);
if( $ggwleizu == '1' ){
	$ggwl = file( $datadir . '/ggwleilist.php' );
	array_shift( $ggwl );
	foreach($ggwl as $value){
		if( $value == $name."\r\n" ){
			die('名称重复！换名再来！');
		}
	}
	$ggwl[] = $name."\r\n";
	array_unshift($ggwl, '<?php exit();?>'."\r\n");
	file_put_contents($datadir . '/ggwleilist.php', $ggwl) or die($datadir . '/ggwleilist.php 禁止写入！');
} elseif( $ggwleizu == '2' ) {
	$ggwz = file( $datadir . '/ggwzulist.php' );
	array_shift( $ggwz );
	foreach($ggwz as $value){
		if( $value == $name."\r\n" ){
			die('名称重复！换名再来！');
		}
	}
	$ggwz[] = $name."\r\n";
	array_unshift($ggwz, '<?php exit();?>'."\r\n");
	file_put_contents($datadir . '/ggwzulist.php', $ggwz) or die($datadir . '/ggwzulist.php 禁止写入！');
}
$conn = new mysql();
$conn->inoplog('添加广告位类/组', $ggwleizu.'|'.$name, 1, getname());
die('1');
}
//////////////////////
if( $menu == 'editleizu' ){
$yggwlei = insql($_REQUEST['yggwlei']);
$xggwlei = insql($_REQUEST['xggwlei']);
$yggwzu = insql($_REQUEST['yggwzu']);
$xggwzu = insql($_REQUEST['xggwzu']);
if(!$yggwlei && $xggwlei){
	die('原广告位类为空！不能修改！');
}
if(!$yggwzu && $xggwzu){
	die('原广告位组为空！不能修改！');
}
if(!$xggwlei && !$xggwzu){
	die('修改广告位类和修改广告位组都为空！');
}
if($yggwlei && $xggwlei){
	$leilist = '<?php exit();?>'."\r\n";
	$ggwl = file( $datadir . '/ggwleilist.php' );
	array_shift( $ggwl );
	foreach($ggwl as $value){
		if( $value == $xggwlei."\r\n" ){
			die('名称重复！换名再来！');
		}
		if( $value == $yggwlei."\r\n" ){
			$leilist .= $xggwlei."\r\n";
		} else {
			$leilist .= $value;
		}
	}
	file_put_contents($datadir . '/ggwleilist.php', $leilist) or die($datadir . '/ggwleilist.php 禁止写入！');
	$content = file_get_contents( $datadir . '/ggwlist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	foreach($array as $gid){
		$ggwd = insou1( file($datadir . '/' . $gid . '.php') );
		if( $ggwd[9] == $yggwlei){
			$ggwd[9] = $xggwlei;
			file_put_contents( $datadir . '/' . $gid . '.php' , $ggwd );
		}
	}
}
if($yggwzu && $xggwzu){
	$zulist = '<?php exit();?>'."\r\n";
	$ggwz = file( $datadir . '/ggwzulist.php' );
	array_shift( $ggwz );
	foreach($ggwz as $value){
		if( $value == $xggwzu."\r\n" ){
			die('名称重复！换名再来！');
		}
		if( $value == $yggwzu."\r\n" ){
			$zulist .= $xggwzu."\r\n";
		} else {
			$zulist .= $value;
		}
	}
	file_put_contents($datadir . '/ggwzulist.php', $zulist) or die($datadir . '/ggwzulist.php 禁止写入！');
	$content = file_get_contents( $datadir . '/ggwlist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	foreach($array as $gid){
		$ggwd = insou1( file($datadir . '/' . $gid . '.php') );
		if( $ggwd[8] == $yggwzu."\r\n" ){
			$ggwd[8] = $xggwzu."\r\n";
			file_put_contents( $datadir . '/' . $gid . '.php' , $ggwd );
		}
	}
}
$conn = new mysql();
$conn->inoplog('修改广告位类/组', ($xggwlei?$yggwlei.':'.$xggwlei.'|':'').($xggwzu?$yggwzu.':'.$xggwzu:''), 1, getname());
die('1');
}
//////////////////////
if( $menu == 'editdelleizu' ){
$leiv = insql($_REQUEST['leiv']);
$zuv = insql($_REQUEST['zuv']);
$newggwleiv = '<?php exit();?>'."\r\n" . $leiv;
file_put_contents($datadir . '/ggwleilist.php', $newggwleiv) or die($datadir . '/ggwleilist.php 禁止写入！');
$newggwzu = '<?php exit();?>'."\r\n" . $zuv;
file_put_contents($datadir . '/ggwzulist.php', $newggwzu) or die($datadir . '/ggwzulist.php 禁止写入！');
$conn = new mysql();
$conn->inoplog('排列/删除广告位类/组', $leiv.'|'.$zuv, 1, getname());
die('1');
}
?>