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
defined('IN_NIUXAMS') or die('Access Denied.');
$file1 = $datadir.'/index.html';
$file2 = 'install_lock.php';
$file3 = $datadir.'/at.'.md5('time').'.php';
$content = file_get_contents($cloudurl . 'authorization.php?domain='.$_SERVER['SERVER_NAME'].'&amsurl='.$amsurl) or die('失败！');
if( $content == '1' ){
	file_put_contents($file1, '1');
	file_put_contents($file2, '<?php echo 2;?>');
	file_put_contents($file3, '<?php echo 2;?>');
} else {
	file_put_contents($file1, ' ');
	file_put_contents($file2, '<?php echo 1;?>');
	file_put_contents($file3, '<?php echo 1;?>');
}
die('1');