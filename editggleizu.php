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
define('NIUXAMS_ACCESS', 'editggleizu');
require 'common.php';
$menu = $_REQUEST['menu'];
///////////////////////////
if( $menu == 'addleizu' ){
$ggleizu = insql($_REQUEST['ggleizu']);
$name  = insql($_REQUEST['name']);
if( $ggleizu == '1' ){
	$ggl = file( $datadir . '/ggleilist.php' );
	array_shift( $ggl );
	foreach($ggl as $value){
		if( $value == $name."\r\n" ){
			die('名称重复！换名再来！');
		}
	}
	$ggl[] = $name."\r\n";
	array_unshift($ggl, '<?php exit();?>'."\r\n");
	file_put_contents($datadir . '/ggleilist.php', $ggl) or die($datadir . '/ggleilist.php 禁止写入！');
} elseif( $ggleizu == '2' ) {
	$ggz = file( $datadir . '/ggzulist.php' );
	array_shift( $ggz );
	foreach($ggz as $value){
		if( $value == $name."\r\n" ){
			die('名称重复！换名再来！');
		}
	}
	$ggz[] = $name."\r\n";
	array_unshift($ggz, '<?php exit();?>'."\r\n");
	file_put_contents($datadir . '/ggzulist.php', $ggz) or die($datadir . '/ggzulist.php 禁止写入！');
}
$conn = new mysql();
$conn->inoplog('添加广告类/组', $ggleizu.'|'.$name, 1, getname());
die('1');
}
//////////////////////
if( $menu == 'editleizu' ){
$ygglei = insql($_REQUEST['ygglei']);
$xgglei = insql($_REQUEST['xgglei']);
$yggzu = insql($_REQUEST['yggzu']);
$xggzu = insql($_REQUEST['xggzu']);
if(!$ygglei && $xgglei){
	die('原广告类为空！不能修改！');
}
if(!$yggzu && $xggzu){
	die('原广告组为空！不能修改！');
}
if(!$xgglei && !$xggzu){
	die('修改广告类和修改广告组都为空！');
}
if($ygglei && $xgglei){
	$leilist = '<?php exit();?>'."\r\n";
	$ggl = file( $datadir . '/ggleilist.php' );
	array_shift( $ggl );
	foreach($ggl as $value){
		if( $value == $xgglei."\r\n" ){
			die('名称重复！换名再来！');
		}
		if( $value == $ygglei."\r\n" ){
			$leilist .= $xgglei."\r\n";
		} else {
			$leilist .= $value;
		}
	}
	file_put_contents($datadir . '/ggleilist.php', $leilist) or die($datadir . '/ggleilist.php 禁止写入！');
	$content = file_get_contents( $datadir . '/gglist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	foreach($array as $gid){
		$ggd = insou1( file($datadir . '/' . $gid . '.php') );
		if( $ggd[10] == $ygglei){
			$ggd[10] = $xgglei;
			file_put_contents( $datadir . '/' . $gid . '.php' , $ggd );
		}
	}
}
if($yggzu && $xggzu){
	$zulist = '<?php exit();?>'."\r\n";
	$ggz = file( $datadir . '/ggzulist.php' );
	array_shift( $ggz );
	foreach($ggz as $value){
		if( $value == $xggzu."\r\n" ){
			die('名称重复！换名再来！');
		}
		if( $value == $yggzu."\r\n" ){
			$zulist .= $xggzu."\r\n";
		} else {
			$zulist .= $value;
		}
	}
	file_put_contents($datadir . '/ggzulist.php', $zulist) or die($datadir . '/ggzulist.php 禁止写入！');
	$content = file_get_contents( $datadir . '/gglist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	foreach($array as $gid){
		$ggd = insou1( file($datadir . '/' . $gid . '.php') );
		if( $ggd[7] == $yggzu."\r\n" ){
			$ggd[7] = $xggzu."\r\n";
			file_put_contents( $datadir . '/' . $gid . '.php' , $ggd );
		}
	}
}
$conn = new mysql();
$conn->inoplog('修改广告类/组', ($xgglei?$ygglei.':'.$xgglei.'|':'').($xggzu?$yggzu.':'.$xggzu:''), 1, getname());
die('1');
}
//////////////////////
if( $menu == 'editdelleizu' ){
$leiv = insql($_REQUEST['leiv']);
$zuv = insql($_REQUEST['zuv']);
$newggleiv = '<?php exit();?>'."\r\n" . $leiv;
file_put_contents($datadir . '/ggleilist.php', $newggleiv) or die($datadir . '/ggleilist.php 禁止写入！');
$newggzu = '<?php exit();?>'."\r\n" . $zuv;
file_put_contents($datadir . '/ggzulist.php', $newggzu) or die($datadir . '/ggzulist.php 禁止写入！');
$conn = new mysql();
$conn->inoplog('排列/删除广告类/组', $leiv.'|'.$zuv, 1, getname());
die('1');
}
?>