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
define('NIUXAMS_ACCESS', 'delgg');
require 'common.php';
$gids = insql($_POST['gids']);
$menu = $_POST['menu'];
$conn = new mysql();
///////////////////////////
if( $menu == 'delgg' ){
if( !$gids ){
	die('出错啦！gids为空！你让我删谁？');
}
$arraygid = explode(' ', $gids);
$file = $datadir . '/gglist.php';
$content = file_get_contents( $file ); 
$file1 = $datadir . '/ggrecyclelist.php';
$content1 = file_get_contents( $file1 );
if( strlen($content1) < 15 ){
	$content1= '<?php exit();?>'."\r\n";
}
foreach ($arraygid as $gid){
	if( strlen($gid) == strlen($thread) + 15 ){
		$path = $datadir.'/'.$gid.'.js';
		$path1 = $datadir.'/'.$gid.'.php';
		rename($path, $path.'recycle') or die($gid.' 删除错误！');
		rename($path1, $path1.'recycle') or die($gid.' 删除错误！');
		$content = str_replace($gid."\r\n", '', $content);
		$content1 .= $gid."\r\n";
		$pattern = '|(/\*begin '.$gid.'\*/)(.+?)(/\*end '.$gid.'\*/)|is';
		if( $dh = opendir($datadir) ){
			while( ( $file2 = readdir($dh) ) !== false ){
				if( $file2 != "." && $file2 != ".." ){
					if( strpos( $file2, $ggwthread ) !== false && strpos( $file2 , '.js' ) !== false ){
						$ggwdm = insou1( file_get_contents( $datadir.'/'.$file2 ) );
						if( preg_match( $pattern , $ggwdm ) ){
							$ggwdm = preg_replace( $pattern , '${1}'."\r\n"."\r\n".'$3' , $ggwdm );
							file_put_contents( $datadir.'/'.$file2 , $ggwdm );
						}
					}
				}
			}
			closedir($dh);
		}
	}
}
file_put_contents( $file , $content );
file_put_contents( $file1 , $content1 );
$conn->inoplog('删除广告', $gids, 1, getname());
die('1');
}
///////////////////////////
if( $menu == 'rebkgg' ){
if( !$gids ){
	die('出错啦！gids为空！你让我还原谁？');
}
$arraygid = explode(' ', $gids);
$file = $datadir . '/gglist.php';
$content = file_get_contents( $file ); 
$file1 = $datadir . '/ggrecyclelist.php';
$content1 = file_get_contents( $file1 ); 
foreach ($arraygid as $gid){
	if( strlen($gid) == strlen($thread) + 15 ){
		$path = $datadir.'/'.$gid.'.js';
		$path1= $datadir.'/'.$gid.'.php';
		rename($path.'recycle' , $path) or die($gid.'还原错误！');
		rename($path1.'recycle' , $path1) or die($gid.'还原错误！');
		$content1 = str_replace($gid."\r\n", '', $content1);
		$content .= $gid."\r\n";
		$ggcon = insou1( file_get_contents( $datadir.'/'.$gid.'.js' ) );
		$pattern = '|(/\*begin '.$gid.'\*/)(.+?)(/\*end '.$gid.'\*/)|is';
		if( $dh = opendir( $datadir ) ){
			while( ( $file2 = readdir($dh) ) !== false){
				if( $file2 != "." && $file2 != ".." ){
					if( strpos( $file2 , $ggwthread ) !== false && strpos( $file2 , '.js' ) !== false ){
						$ggwdm = insou1( file_get_contents( $datadir.'/'.$file2 ) );
						if( preg_match( $pattern , $ggwdm ) ){
							$ggwdm = preg_replace( $pattern , '${1}'."\r\n".$ggcon."\r\n".'$3' , $ggwdm );
							file_put_contents( $datadir.'/'.$file2 , $ggwdm );
						}
					}
				}
			}
			closedir($dh);
		}
	}
}
file_put_contents( $file , $content );
file_put_contents( $file1  ,$content1 );
$conn->inoplog('还原广告', $gids, 1, getname());
die('1');
}
///////////////////////////
if( $menu == 'delggtrue' ){
if( !$gids ){
	die('出错啦！gids为空！你让我删谁？');
}
$arraygid = explode(' ', $gids);
$file = $datadir.'/ggrecyclelist.php';
$content = file_get_contents( $file ); 
foreach ($arraygid as $gid){
	if( strlen( $gid ) == strlen( $thread ) + 15 ){
		$path = $datadir.'/'.$gid.'.jsrecycle';
		$path1= $datadir.'/'.$gid.'.phprecycle';
		unlink( $path ) or die($gid.'删除错误！');
		unlink( $path1 ) or die($gid.'删除错误！');
		$content = str_replace( $gid."\r\n" , '' , $content );
		$pattern = '|(/\*begin '.$gid.'\*/)(.+?)(/\*end '.$gid.'\*/)|is';
		if( $dh = opendir( $datadir ) ){
			while( ( $file2 = readdir($dh) ) !== false ){
				if( $file2 != "." && $file2 != ".." ){
					if( strpos( $file2 , $ggwthread ) !== false && strpos( $file2 , '.js' ) !== false ){
						$ggwdm = insou1( file_get_contents( $datadir.'/'.$file2 ) );
						if( preg_match( $pattern , $ggwdm ) ){
							$ggwdm = preg_replace( $pattern , ''  ,$ggwdm );
							file_put_contents( $datadir.'/'.$file2 , $ggwdm );
						}
					}
				}
			}
			closedir($dh);
		}
	}
}
file_put_contents( $file , $content );
$conn->inoplog('彻底删除广告', $gids, 1, getname());
die('1');
}
///////////////////////////
?>