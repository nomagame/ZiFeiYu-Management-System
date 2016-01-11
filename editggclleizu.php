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
define('NIUXAMS_ACCESS', 'editggclleizu');
require 'common.php';
$menu = $_REQUEST['menu'];
///////////////////////////
if( $menu == 'addleizu' ){
$ggclleizu = insql($_REQUEST['ggclleizu']);
$name  = insql($_REQUEST['name']);
if( $ggclleizu == '1' ){
	$ggcll = file( $datadir . '/ggclleilist.php' );
	array_shift( $ggcll );
	foreach($ggcll as $value){
		if( $value == $name."\r\n" ){
			die('名称重复！换名再来！');
		}
	}
	$ggcll[] = $name."\r\n";
	array_unshift($ggcll, '<?php exit();?>'."\r\n");
	file_put_contents($datadir . '/ggclleilist.php', $ggcll) or die($datadir . '/ggclleilist.php 禁止写入！');
} elseif( $ggclleizu == '2' ) {
	$ggclz = file( $datadir . '/ggclzulist.php' );
	array_shift( $ggclz );
	foreach($ggclz as $value){
		if( $value == $name."\r\n" ){
			die('名称重复！换名再来！');
		}
	}
	$ggclz[] = $name."\r\n";
	array_unshift($ggclz, '<?php exit();?>'."\r\n");
	file_put_contents($datadir . '/ggclzulist.php', $ggclz) or die($datadir . '/ggclzulist.php 禁止写入！');
}
$conn = new mysql();
$conn->inoplog('添加广告策略类/组', $ggclleizu.'|'.$name, 1, getname());
die('1');
}
//////////////////////
if( $menu == 'editleizu' ){
$yggcllei = insql($_REQUEST['yggcllei']);
$xggcllei = insql($_REQUEST['xggcllei']);
$yggclzu = insql($_REQUEST['yggclzu']);
$xggclzu = insql($_REQUEST['xggclzu']);
if(!$yggcllei && $xggcllei){
	die('原广告策略类为空！不能修改！');
}
if(!$yggclzu && $xggclzu){
	die('原广告策略组为空！不能修改！');
}
if(!$xggcllei && !$xggclzu){
	die('修改广告策略类和修改广告策略组都为空！');
}
if($yggcllei && $xggcllei){
	$leilist = '<?php exit();?>'."\r\n";
	$ggcll = file( $datadir . '/ggclleilist.php' );
	array_shift( $ggcll );
	foreach($ggcll as $value){
		if( $value == $xggcllei."\r\n" ){
			die('名称重复！换名再来！');
		}
		if( $value == $yggcllei."\r\n" ){
			$leilist .= $xggcllei."\r\n";
		} else {
			$leilist .= $value;
		}
	}
	file_put_contents($datadir . '/ggclleilist.php', $leilist) or die($datadir . '/ggclleilist.php 禁止写入！');
	$content = file_get_contents( $datadir . '/ggcllist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	foreach($array as $gid){
		$ggcld = insou1( file($datadir . '/' . $gid . '.php') );
		if( $ggcld[32] == $yggcllei){
			$ggcld[32] = $xggcllei;
			file_put_contents( $datadir . '/' . $gid . '.php' , $ggcld );
		}
	}
}
if($yggclzu && $xggclzu){
	$zulist = '<?php exit();?>'."\r\n";
	$ggclz = file( $datadir . '/ggclzulist.php' );
	array_shift( $ggclz );
	foreach($ggclz as $value){
		if( $value == $xggclzu."\r\n" ){
			die('名称重复！换名再来！');
		}
		if( $value == $yggclzu."\r\n" ){
			$zulist .= $xggclzu."\r\n";
		} else {
			$zulist .= $value;
		}
	}
	file_put_contents($datadir . '/ggclzulist.php', $zulist) or die($datadir . '/ggclzulist.php 禁止写入！');
	$content = file_get_contents( $datadir . '/ggcllist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	foreach($array as $gid){
		$ggcld = insou1( file($datadir . '/' . $gid . '.php') );
		if( $ggcld[31] == $yggclzu."\r\n" ){
			$ggcld[31] = $xggclzu."\r\n";
			file_put_contents( $datadir . '/' . $gid . '.php' , $ggcld );
		}
	}
}
$conn = new mysql();
$conn->inoplog('修改广告策略类/组', ($xggcllei?$yggcllei.':'.$xggcllei.'|':'').($xggclzu?$yggclzu.':'.$xggclzu:''), 1, getname());
die('1');
}
//////////////////////
if( $menu == 'editdelleizu' ){
$leiv = insql($_REQUEST['leiv']);
$zuv = insql($_REQUEST['zuv']);
$newggclleiv = '<?php exit();?>'."\r\n" . $leiv;
file_put_contents($datadir . '/ggclleilist.php', $newggclleiv) or die($datadir . '/ggclleilist.php 禁止写入！');
$newggclzu = '<?php exit();?>'."\r\n" . $zuv;
file_put_contents($datadir . '/ggclzulist.php', $newggclzu) or die($datadir . '/ggclzulist.php 禁止写入！');
$conn = new mysql();
$conn->inoplog('排列/删除广告策略类/组', $leiv.'|'.$zuv, 1, getname());
die('1');
}
?>