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
defined('IN_NIUXAMS') or exit('Access Denied.');
function closeyh(){
	global $datadir;
	global $ggwthread;
	$pattern = '|(/\*begin atyh\*/)(.+?)(/\*end atyh\*/)|is';
	if( $dh = opendir($datadir) ){
		while( ( $file = readdir($dh) ) !== false ){
			if( $file != "." && $file != ".." ){
				if( strpos( $file, $ggwthread ) !== false && strpos( $file , '.js' ) !== false ){
					$ggwdm = insou1( file_get_contents( $datadir.'/'.$file ) );
					if( preg_match( $pattern , $ggwdm ) ){
						$ggwdm = preg_replace( $pattern , '' , $ggwdm );
						file_put_contents( $datadir.'/'.$file , $ggwdm );
					}
				}
			}
		}
		closedir($dh);
	}
}
