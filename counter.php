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
define('NIUXAMS_LOGIN', true);
require 'common.php';
require 'func.tj.php';
$ac = $_REQUEST['ac'];
if( $ac == 'show' ){
	acshow();
} else if ( $ac == 'click' ) {
	acclick();
} else if ( $ac == 'query' ){
	acquery();
}
/////////////////////////
function acshow() {
	global $Pre;
	$conn = new mysql();
	if( insql($_POST['attj']) == '1' ){tj();}
	$args = insql($_POST['args']);
	$ac = 1;
	$screenw = substr(insql($_POST['screenw']),0,6);
	$screenh = substr(insql($_POST['screenh']),0,6);
	$htmlw = substr(insql($_POST['htmlw']),0,6);
	$htmlh = substr(insql($_POST['htmlh']),0,6);
	$htmlurl = substr(insql($_POST['htmlurl']),0,255);
	$time = gnt();
	$gethost = substr(insql2(gethost()),0,20);
	$getlang = substr(insql2(getlang()),0,12);
	$getip = substr(insql2(getip()),0,15);
	$getport = substr(insql2(getport()),0,5);
	$getos = substr(insql2(getos()),0,20);
	$getb = getb();
	$getbn = substr(insql2($getb[0]),0,20);
	$bversion = substr(insql2($getb[1]),0,12);
	$agent = substr(insql2($_SERVER['HTTP_USER_AGENT']),0,255);
	$referer = substr(insql2($_POST['referrer']),0,255);
	$pieces = explode(',', $args);
	$size = count($pieces);
	for ($i=0; $i<$size; $i++){
		$piece = explode(' ', $pieces[$i]);
		$piece[0] = substr($piece[0],-14,14);
		$piece[1] = substr($piece[1],-14,14);
		$piece[2] = substr($piece[2],0,6);
		$piece[3] = substr($piece[3],0,6);
		$piece[4] = substr($piece[4],0,6);
		$piece[5] = substr($piece[5],0,6);
		$piece[6] = substr($piece[6],0,3);
		$piece[7] = substr($piece[7],0,4);
		$piece[8] = substr($piece[8],0,5);
		$piece[9] = substr($piece[9],0,2) ? substr($piece[9],0,2) : 0;
		$piece[10] = substr($piece[10],0,3) ? substr($piece[10],0,3) : 0;
		$piece[11] = substr($piece[11],0,4);
		$piece[12] = substr($piece[12],0,5);
		$piece[13] = substr($piece[13],0,3) ? substr($piece[13],0,3) : 0;
		$piece[14] = substr($piece[14],0,4) ? substr($piece[14],0,4) : 0;
		$piece[15] = substr($piece[15],0,1);
		$sql = "INSERT INTO ${Pre}niux_ams_counter (ac,screenw,screenh,bodyw,bodyh,gid,gwid,gwx,gwy,gww,gwh,gshow,gshow1,gshow2,gclick,gclick1,ashow,ashow1,aclick,aclick1,atyh,time,ip,port,os,lang,browse,version,host,url,referer,agent) VALUES ('$ac','$screenw','$screenh','$htmlw','$htmlh','$piece[0]','$piece[1]','$piece[2]','$piece[3]','$piece[4]','$piece[5]','$piece[6]','$piece[7]','$piece[8]','$piece[9]','$piece[10]','$piece[11]','$piece[12]','$piece[13]','$piece[14]','$piece[15]','$time','$getip','$getport','$getos','$getlang','$getbn','$bversion','$gethost','$htmlurl','$referer','$agent')";
		$conn->uidRst($sql);
	}
}
/////////////////////////
function acclick() {
	global $Pre;
	$conn = new mysql();
	$args = insql($_POST['args']);
	$ac = 2;
	$screenw = substr(insql($_POST['screenw']),0,6);
	$screenh = substr(insql($_POST['screenh']),0,6);
	$htmlw = substr(insql($_POST['htmlw']),0,6);
	$htmlh = substr(insql($_POST['htmlh']),0,6);
	$htmlurl = substr(insql($_POST['htmlurl']),0,255);
	$time = gnt();
	$gethost = substr(insql2(gethost()),0,20);
	$getlang = substr(insql2(getlang()),0,12);
	$getip = substr(insql2(getip()),0,15);
	$getport = substr(insql2(getport()),0,5);
	$getos = substr(insql2(getos()),0,20);
	$getb = getb();
	$getbn = substr(insql2($getb[0]),0,20);
	$bversion = substr(insql2($getb[1]),0,12);
	$agent = substr(insql2($_SERVER['HTTP_USER_AGENT']),0,255);
	$referer = substr(insql2($_POST['referrer']),0,255);
	$piece = explode(' ', $args);
	$piece[0] = substr($piece[0],-14,14);
	$piece[1] = substr($piece[1],-14,14);
	$piece[2] = substr($piece[2],0,6);
	$piece[3] = substr($piece[3],0,6);
	$piece[4] = substr($piece[4],0,6);
	$piece[5] = substr($piece[5],0,6);
	$piece[6] = substr($piece[6],0,3);
	$piece[7] = substr($piece[7],0,4);
	$piece[8] = substr($piece[8],0,5);
	$piece[9] = substr($piece[9],0,2);
	$piece[10] = substr($piece[10],0,3);
	$piece[11] = substr($piece[11],0,4);
	$piece[12] = substr($piece[12],0,5);
	$piece[13] = substr($piece[13],0,3);
	$piece[14] = substr($piece[14],0,4);
	$piece[15] = substr($piece[15],0,1);
	$sql = "INSERT INTO ${Pre}niux_ams_counter (ac,screenw,screenh,bodyw,bodyh,gid,gwid,gwx,gwy,gww,gwh,gshow,gshow1,gshow2,gclick,gclick1,ashow,ashow1,aclick,aclick1,atyh,time,ip,port,os,lang,browse,version,host,url,referer,agent) VALUES ('$ac','$screenw','$screenh','$htmlw','$htmlh','$piece[0]','$piece[1]','$piece[2]','$piece[3]','$piece[4]','$piece[5]','$piece[6]','$piece[7]','$piece[8]','$piece[9]','$piece[10]','$piece[11]','$piece[12]','$piece[13]','$piece[14]','$piece[15]','$time','$getip','$getport','$getos','$getlang','$getbn','$bversion','$gethost','$htmlurl','$referer','$agent')";
	$conn->uidRst($sql);
}
/////////////////////////
function acquery() {
	global $Pre;
	$gid = substr(insql($_GET['gid']), -14, 14);
	$sorc = insql($_GET['sorc']);
	$conn = new mysql();
	if($sorc=='1' && is_numeric($gid)){
		$sql = "SELECT COUNT(*) AS NumberOfShows FROM ${Pre}niux_ams_counter where ac=1 and gid='$gid' and DATE(time)=CURDATE()";
		echo $conn->getFieldsVal($sql, 'NumberOfShows');
	} elseif($sorc=='2' && is_numeric($gid)) {
		$sql = "SELECT COUNT(*) AS NumberOfClicks FROM ${Pre}niux_ams_counter where ac=2 and gid='$gid' and DATE(time)=CURDATE()";
		echo $conn->getFieldsVal($sql, 'NumberOfClicks');
	}
}
/////////////////////////
?>