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
////////////////////
function autoload($class) {
	require_once 'class.'.$class.'.php';
}
////////////////////
function theme() {
	return $_COOKIE['niuxams_theme'] ? $_COOKIE['niuxams_theme'] : 'smoothness';
}
////////////////////
function getmicrotime(){ 
    list($usec, $sec) = explode(' ',microtime()); 
    return ((float)$usec + (float)$sec); 
}
////////////////////
function getname(){
	global $Pre;
	return $_SESSION[$Pre.'Nxalgnm'] ? $_SESSION[$Pre.'Nxalgnm'] : $_COOKIE[$Pre.'Nxalgnm'];
}
////////////////////
function gnt(){
	return date("Y-m-d H:i:s");
}
////////////////////
function gnd(){
	return date("Y-m-d");
}
////////////////////
function insou($in){
	if (get_magic_quotes_gpc()) {
		$in = is_array($in) ? array_map('insou', $in) : stripslashes($in);
		return $in;
	}else{
		return $in;
	}
}
////////////////////
function insou1($in){
	if (get_magic_quotes_runtime()) {
		$in = is_array($in) ? array_map('insou1', $in) : stripslashes($in);
		return $in;
	}else{
		return $in;
	}
}
////////////////////
function insql($in){
	if (get_magic_quotes_gpc()) {
		return $in;
	}else{
		return addslashes($in);
	}
}
////////////////////
function insql1($in){
	if (get_magic_quotes_runtime()) {
		return $in;
	}else{
		return addslashes($in);
	}
}
////////////////////
function insql2($in){
	return addslashes(stripslashes($in));
}
////////////////////
function nowurl(){
	return "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
}
////////////////////
function nowfile(){
	return basename($_SERVER['PHP_SELF']);
}
////////////////////
function gethost(){
	return $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : '未知';
}
////////////////////
function getlang(){
	$lang = strtolower(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4));
	if (strpos($lang,'zh-c') !== false)
		$ulang="简体中文";
	else if (strpos($lang,'zh') !== false)
	    $ulang="繁體中文";
	else if (strpos($lang,'en') !== false)
	    $ulang="English";
	else if (strpos($lang,'fr') !== false)
	    $ulang="French";
	else if (strpos($lang,'de') !== false)
	    $ulang="German";
	else if (strpos($lang,'jp') !== false)
	    $ulang="Japanese";
	else if (strpos($lang,'ko') !== false)
	    $ulang="Korean";
	else if (strpos($lang,'es') !== false)
	    $ulang="Spanish";
	else if (strpos($lang,'sv') !== false)
	    $ulang="Swedish";
	else
	    $ulang=$lang;
	return $ulang;
}
////////////////////
function getip(){
	return (preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $_SERVER["HTTP_X_FORWARDED_FOR"]))
	? $_SERVER["HTTP_X_FORWARDED_FOR"]
	: $_SERVER['REMOTE_ADDR'];
}
////////////////////
function getport(){
	return $_SERVER['REMOTE_PORT'] ? $_SERVER['REMOTE_PORT'] : '0';
}
////////////////////
function getreferer(){
	return $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : '直接输入地址访问';
}
////////////////////
function getos(){
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	if (strpos($agent, 'win') && strpos($agent, 'nt 5.1'))
		$os = 'Windows XP';
	else if (strpos($agent, 'win') && strpos($agent, 'nt 6.2'))
		$os = 'Windows 8';
	else if (strpos($agent, 'win') && strpos($agent, 'nt 6.1'))
		$os = 'Windows 7';
	else if (strpos($agent, 'win') && strpos($agent, 'nt 6'))
		$os = 'Windows Visita';
	else if (strpos($agent, 'win') && strpos($agent, 'nt 5.2'))
		$os = 'Windows Server 2003';
	else if (strpos($agent, 'win') && strpos($agent, 'nt 5'))
		$os = 'Windows 2000';
	else if (strpos($agent, 'win') && strpos($agent, 'nt'))
		$os = 'Windows NT';
	else if (strpos($agent, 'windows phone') && strpos($agent, '8'))
		$os = 'Windows Phone 8';
	else if (strpos($agent, 'windows phone') && strpos($agent, '7.5'))
		$os = 'Windows Phone 7.5';
	else if (strpos($agent, 'windows phone') && strpos($agent, '7'))
		$os = 'Windows Phone 7';
	else if (strpos($agent, 'android'))
		$os = 'Android';
	else if (strpos($agent, 'ipod'))
		$os = 'iPod';
	else if (strpos($agent, 'ipad'))
		$os = 'iPad';
	else if (strpos($agent, 'iphone'))
		$os = 'iPhone';
	else if (strpos($agent, 'mac') && strpos($agent, 'os'))
		$os = 'Macintosh';
	else if (strpos($agent, 'googlebot'))
		$os = 'Google蜘蛛';
	else if (strpos($agent, 'baiduspider'))
		$os = 'Baidu蜘蛛';
	else if (strpos($agent, 'linux'))
		$os = 'Linux';
	else if (strpos($agent, 'unix'))
		$os = 'Unix';
	else if (strpos($agent, 'sun') && strpos($agent, 'os'))
		$os = 'SunOS';
	else if (strpos($agent, 'ibm') && strpos($agent, 'os'))
		$os = 'IBM OS/2';
	else if (strpos($agent, 'powerpc'))
		$os = 'PowerPC';
	else if (strpos($agent, 'freebsd'))
		$os = 'FreeBSD';
	else if (strpos($agent, 'win 9x') && strpos($agent, '4.90'))
		$os = 'Windows ME';
	else if (strpos($agent, 'win') && strpos($agent, '98'))
		$os = 'Windows 98';
	else if (strpos($agent, 'win') && strpos($agent, '95'))
		$os = 'Windows 95';
	else if (strpos($agent, 'win') && strpos($agent, '32'))
		$os = 'Windows 32';
	else 
		$os = '未知操作系统';
	return $os;
}
////////////////////
function getb(){
	$agent = $_SERVER['HTTP_USER_AGENT'];
	if (eregi('MSIE ([0-9]{1,2}.[0-9]{1,2})',$agent,$str)) {
		$bv = $str[1];
		$bn = 'Internet Explorer';
	} else if (eregi('Opera/([0-9]{1,2}.[0-9]{1,2})',$agent,$str)) {
		$bv = $str[1];
		$bn = 'Opera';
	} else if (eregi('Maxthon/([0-9]{1,2}.[0-9]{1,2})',$agent,$str)) {
		$bv = $str[1];
		$bn = 'Maxthon';
	} else if (eregi('Firefox/([0-9.]{1,10})',$agent,$str)) {
		$bv = $str[1];
		$bn = 'Firefox';
	}else if (eregi('Chrome/([0-9.]{1,10})',$agent,$str)) {
		$bv = $str[1];
		$bn = 'Chrome';
	}else if (eregi('Safari/([0-9.]{1,10})',$agent,$str)) {
		$bn = 'Safari';
		eregi('Version/([0-9.]{1,10})',$agent,$str);
		$bv = $str[1];
	}else if (eregi('WebKit/([0-9.]{1,10})',$agent,$str)) {
		$bv = $str[1];
		$bn = 'WebKit';
	}else {
		$bv = '未知版本';
		$bn = '未知浏览器';
	}
	return array($bn, $bv);
}
////////////////////
function errwin($msg){
	global $time_start;
	$title = '出错提示';
	require 'mo.head.php';
?>
<style>
#tips { padding: 0.7em; }
</style>
<script type="text/javascript">
$(function() {
	$("#dialog").dialog({
		autoOpen: true,
		width: 400,
		modal: true,
		show: "bounce",
		hide: "bounce",
		buttons: [{
			text: "返回",
			click: function() {
				history.back()
			}
		}]
	});
	setTimeout(function() {
		$("#tips").removeClass("ui-state-highlight", 1500)
	}, 5000)
});
</script>
</head>
<body>
<div style="height:80%"></div>
<div id="dialog" title="警告：出错啦！！！">
	<p id="tips" class="ui-state-highlight ui-corner-all"><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
<?php echo $msg ?></p>
</div>
<?php
	require 'mo.foot.php';
	exit;
}
////////////////////
function okwin($msg, $url='main.php'){
	global $time_start;
	$title = '成功提示';
	require 'mo.head.php';
?>
<style>
#tips { padding: 0.7em; }
</style>
<script type="text/javascript">
$(function() {
	$("#dialog").dialog({
		autoOpen: true,
		width: 400,
		modal: true,
		show: "bounce",
		hide: "bounce",
		buttons: [{
			text: "确定",
			click: function() {
				location='<?php echo $url ?>'
			}
		},{
			text: "返回",
			click: function() {
				history.back()
			}
		}]
	});
	setTimeout(function() {
		$("#tips").removeClass("ui-state-highlight", 1500)
	}, 5000)
});
</script>
</head>
<body>
<div style="height:80%"></div>
<div id="dialog" title="恭喜你：成功啦！！！">
	<p id="tips" class="ui-state-highlight ui-corner-all"><span class="ui-icon ui-icon-circle-check" style="float: left; margin-right: .3em;"></span>
<?php echo $msg ?></p>
</div>
<?php
	require 'mo.foot.php';
	exit;
}
////////////////////
function Access(){
    global $Pre, $datadir, $adname, $adpassword, $subadmin;
    session_start();
    $Nxalgnm = $_SESSION[$Pre . 'Nxalgnm'];
    $Nxalgpw = $_SESSION[$Pre . 'Nxalgpw'];
    $status = 0;
    if ( $Nxalgnm == $adname && $Nxalgpw == $adpassword ) {
        $status = 1;
    } else {
	    $Nxalgnm = $_COOKIE[$Pre . 'Nxalgnm'];
	    $Nxalgpw = $_COOKIE[$Pre . 'Nxalgpw'];
	    foreach ( $subadmin as $key => $value ) {
	        if ( $Nxalgnm == $key && $Nxalgpw == md5( $key . $value[0] . $key ) ) {
				if ( defined( 'NIUXAMS_ACCESS' ) ) {
					$accessdata = file( $datadir.'/access/'.$value[1].'.access.php' );
					array_shift( $accessdata );
					array_shift( $accessdata );
					$Allowaccess = explode( '|', rtrim(array_shift($accessdata)) );
					if ( !in_array( '-', $Allowaccess ) && !in_array( NIUXAMS_ACCESS, $Allowaccess ) && NIUXAMS_ACCESS != $value[1] ) {
						errwin('抱歉，您没有此功能的权限！');
					}
				}
	            $status = 1;
	            break;
	        }
	    }
	}
    if ($status == 0) {
        header('Location: login.html');
        exit;
    }
}
////////////////////
function cutstr($string, $length, $dot = '..'){
    if (strlen($string) <= $length) {
        return $string;
    }
    $pre = chr(1);
    $end = chr(1);
    $string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array(($pre . '&') . $end, ($pre . '"') . $end, ($pre . '<') . $end, ($pre . '>') . $end), $string);
    $strcut = '';
    $n = ($tn = ($noc = 0));
    while ($n < strlen($string)) {
        $t = ord($string[$n]);
        if (($t == 9 || $t == 10) || 32 <= $t && $t <= 126) {
            $tn = 1;
            $n++;
            $noc++;
        } elseif (194 <= $t && $t <= 223) {
            $tn = 2;
            $n += 2;
            $noc += 1.5;
        } elseif (224 <= $t && $t <= 239) {
            $tn = 3;
            $n += 3;
            $noc += 1.5;
        } elseif (240 <= $t && $t <= 247) {
            $tn = 4;
            $n += 4;
            $noc += 1.5;
        } elseif (248 <= $t && $t <= 251) {
            $tn = 5;
            $n += 5;
            $noc += 1.5;
        } elseif ($t == 252 || $t == 253) {
            $tn = 6;
            $n += 6;
            $noc += 1.5;
        } else {
            $n++;
        }
        if ($noc > $length) {
            $ifdot = $dot;
            break;
        }
    }
    if ($noc > $length) {
        $n -= $tn;
    }
    $strcut = substr($string, 0, $n);
    $strcut = str_replace(array(($pre . '&') . $end, ($pre . '"') . $end, ($pre . '<') . $end, ($pre . '>') . $end), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
    $pos = strrpos($strcut, chr(1));
    if ($pos !== false) {
        $strcut = substr($strcut, 0, $pos);
    }
    return $strcut . $ifdot;
}
////////////////////
function cforr(){
	global $datadir;
	return file_get_contents( $datadir . '/index.html' );
}
////////////////////
function unescape($str){
	$ret = '';
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++){
		if ($str[$i] == '%' && $str[$i+1] == 'u'){
			$val = hexdec(substr($str, $i+2, 4));
			if ($val < 0x7f) $ret .= chr($val);
			else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
			else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
			$i += 5;
		} else if ($str[$i] == '%') {
			$ret .= urldecode(substr($str, $i, 3));
			$i += 2;
		} else $ret .= $str[$i];
	}
	return $ret;
}