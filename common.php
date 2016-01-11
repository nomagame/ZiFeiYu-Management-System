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
$pageName = 'index';

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
define('IN_NIUXAMS', true);
define('NIUXAMS_VER', '2.12');
require 'config.php';
require 'subadmin.php';
require 'common.func.php';

$datadir = 'data';
$time_start = getmicrotime();
defined('NIUXAMS_LOGIN') or Access();
$timezone = $timezone ? $timezone : 'Asia/Shanghai';
date_default_timezone_set($timezone);
$cloudurl = 'http://www.niuxsoft.com/niuxams/cloud/';
if(function_exists('spl_autoload_register')) {
	spl_autoload_register('autoload');
} else {
	function __autoload($class) {
		return autoload($class);
	}
}