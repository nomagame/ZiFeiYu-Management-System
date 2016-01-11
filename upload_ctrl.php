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
if( cforr() != '1' ){
	$timefile = $datadir.'/gt.'.md5('ggupday').'.php';
	if(file_exists($timefile)){
		$lasttime = filemtime($timefile);
	} else {
		$lasttime = time()-(7*24*60*60);
	}
	$passtime = time()-$lasttime;
	if( floor($passtime/(24*60*60)) > 1 ){
		$maingg = file_get_contents($cloudurl . 'gg/maingg.htm') or die('失败！');
		file_put_contents( $datadir . '/maingg.htm' , insou1($maingg) );
		$logingg = file_get_contents($cloudurl . 'gg/logingg.htm') or die('失败！！');
		file_put_contents( $datadir . '/logingg.htm' , insou1($logingg) );
		file_put_contents($timefile, '<?php echo 1;?>');
		die('1');
	} else {
		die('0');
	}
}
die('0');
?>