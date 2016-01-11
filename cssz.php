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
define('NIUXAMS_ACCESS', 'cssz');
require 'common.php';
$menu = $_POST['menu'];
///////////////////////////
if( $menu == 'szcs' ){
$adname1 = rtrim(htmlspecialchars(insql($_POST['adname1'])),'\\');
if( strlen($_POST['adpassword1']) > 5 ){
	$adpassword1 = md5(insql($_POST['adpassword1']));
} else {
	$adpassword1 = $adpassword;
}
$SqlServer1 = rtrim(htmlspecialchars(insql($_POST['SqlServer1'])),'\\');
$SqlUserName1 = rtrim(htmlspecialchars(insql($_POST['SqlUserName1'])),'\\');
if( strlen($_POST['SqlPassword1']) > 5 ){
	$SqlPassword1 = rtrim(htmlspecialchars(insql($_POST['SqlPassword1'])),'\\');
} else {
	$SqlPassword1 = $SqlPassword;
}
$SqlDataBase1 = rtrim(htmlspecialchars(insql($_POST['SqlDataBase1'])),'\\');
$Pre1 = rtrim(htmlspecialchars(insql($_POST['Pre1'])),'\\');
$amsurl1 = rtrim(htmlspecialchars(insql($_POST['amsurl1'])),'\\');
if ( $amsurl1 && strrchr( $amsurl1 , '/' ) != '/' ) { $amsurl1 .= '/'; }
$thread1 = rtrim(htmlspecialchars(insql($_POST['thread1'])),'\\');
$clthread1 = rtrim(htmlspecialchars(insql($_POST['clthread1'])),'\\');
$ggwthread1 = rtrim(htmlspecialchars(insql($_POST['ggwthread1'])),'\\');
$timezone1 = rtrim(htmlspecialchars(insql($_POST['timezone1'])),'\\');
$configdata = "<?php
defined('IN_NIUXAMS') or exit('Access Denied.');
\$adname = '$adname1';
\$adpassword = '$adpassword1';
\$SqlServer = '$SqlServer1';
\$SqlUserName = '$SqlUserName1';
\$SqlPassword = '$SqlPassword1';
\$SqlDataBase = '$SqlDataBase1';
\$Pre = '$Pre1';
\$amsurl = '$amsurl1';
\$thread = '$thread1';
\$clthread = '$clthread1';
\$ggwthread = '$ggwthread1';
\$timezone = '$timezone1';
";
file_put_contents( 'config.php' , $configdata ) or errwin('出错啦！config.php无法修改！请将程序目录和文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('修改基本参数', 'cssz', 1, getname());
okwin('恭喜你，修改参数成功了！');
exit;
}
///////////////////////////
$title = '基本参数设置';
require 'mo.head.php';
?>
<style>
.cssz{
	border-width:1px 0px 0px 1px;
}
.left{
	border-width:0px 1px 1px 0px;
	font-size: 1em;
	line-height: 1.8em;
	overflow: hidden;
	text-align: right;
	padding-right:4px;
	width:20%;
}
.right{
	border-width:0px 1px 1px 0px;
	font-size: 1em;
	line-height: 1.8em;
	overflow: hidden;
	padding-left:4px;
	width:80%;
}
input.text{
	width:36%;
	padding:.3em;
	margin:4px 0;
}
input.text1{
	width:18%;
	padding:.3em;
	margin:4px 0;
}
input.text2{
	width:9%;
	padding:.3em;
	margin:4px 0;
}
.tips{
	padding-left:4px;
}
.xiugai{
	border-width:0px 0px 1px 0px;
	height:60px;
}
</style>
<script type="text/javascript">
$(function() {
	$( "#editcs" ).submit(function() {
		if(confirm('您确定要修改吗?')){
			if(!$( "#thread" ).val().match(/^([0-9a-zA-Z]){1,20}$/)){
				$( "#thread" ).focus();
				alert('广告线程名： 1-20个字符的字母、数字的组合！！！');
				return false;
			} else if(!$( "#clthread" ).val().match(/^([0-9a-zA-Z]){1,20}$/)){
				$( "#clthread" ).focus();
				alert('广告策略线程名： 1-20个字符的汉字、字母、数字的组合！！！');
				return false;
			} else if(!$( "#ggwthread" ).val().match(/^([0-9a-zA-Z]){1,20}$/)){
				$( "#ggwthread" ).focus();
				alert('广告位线程名： 1-20个字符的汉字、字母、数字的组合！！！');
				return false;
			} else if(!$( "#adname" ).val().match(/^([0-9a-zA-Z]){3,40}$/)){
				$( "#adname" ).focus();
				alert('超级管理员用户名不能包含特殊字符！！！');
				return false;
			}
			$( "#submit" ).addClass( "ui-state-error ").attr( "disabled" , true );
		} else {
			return false;
		}
    });
});
</script>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置： <?php echo $title ?></p>

<div class="cc ui-widget-content ui-corner-all">
<form id="editcs" method="post">
<div class="tt ui-widget-header ui-corner-all">参数设置：（修改参数前请确认您明白其意思！否则请保持默认值！一旦确定，不要轻易修改！）</div>
<div class="cp">
<table class="cssz ui-widget-content" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left ui-widget-content">超级管理员用户名：</td>
    <td class="right ui-widget-content">
    <input id="adname" name="adname1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($adname)?>" title="登录用户名！3-20个字符的字母、数字的组合" />
    <span class="tips">（本程序超级管理员用户名）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">超级管理员密码：</td>
    <td class="right ui-widget-content">
    <input id="adpassword" name="adpassword1" type="text" class="text1 ui-widget-content ui-corner-all" value="" title="6-40个字符的各种字符的组合。" />
    <span class="tips">（本程序超级管理员密码，不填表示不修改，修改需要输入大于5位的新密码）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">数据库服务器地址：</td>
    <td class="right ui-widget-content">
    <input id="SqlServer" name="SqlServer1" type="text" class="text ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($SqlServer)?>" />
    <span class="tips">（数据库连接地址）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">连接数据库的用户名：</td>
    <td class="right ui-widget-content">
    <input id="SqlUserName" name="SqlUserName1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($SqlUserName)?>" />
    <span class="tips">（数据库连接用户名）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">连接数据库的密码：</td>
    <td class="right ui-widget-content">
    <input id="SqlPassword" name="SqlPassword1" type="text" class="text1 ui-widget-content ui-corner-all" value="" />
    <span class="tips">（数据库连接密码，不填表示不修改，修改需要输入大于5位的新密码）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">用于本程序的数据库名：</td>
    <td class="right ui-widget-content">
    <input id="SqlDataBase" name="SqlDataBase1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($SqlDataBase)?>" />
    <span class="tips">（存放本程序数据的数据库名）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">用于本程序的数据表前缀：</td>
    <td class="right ui-widget-content">
    <input id="Pre" name="Pre1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($Pre)?>" />
    <span class="tips">（避免同一个数据库内同名数据表冲突）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">牛叉NiuXams的根网址：</td>
    <td class="right ui-widget-content">
    <input id="amsurl" name="amsurl1" type="text" class="text ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($amsurl)?>" title="" />
    <span class="tips">（最后包括斜杠 "/"）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">广告线程名：</td>
    <td class="right ui-widget-content">
    <input id="thread" name="thread1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($thread)?>" title="1-20个字符的字母、数字的组合" maxlength="20" />
    <span class="tips">（确定后请勿更改。作用：防止广告屏蔽软件特征识别，尽量大众化、伪装化英语单词或汉语拼音）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">广告策略线程名：</td>
    <td class="right ui-widget-content">
    <input id="clthread" name="clthread1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($clthread)?>" title="1-20个字符的字母、数字的组合" maxlength="20" />
    <span class="tips">（确定后请勿更改。作用：防止广告屏蔽软件特征识别，尽量大众化、伪装化英语单词或汉语拼音）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">广告位线程名：</td>
    <td class="right ui-widget-content">
    <input id="ggwthread" name="ggwthread1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($ggwthread)?>" title="1-20个字符的字母、数字的组合" maxlength="20" />
    <span class="tips">（确定后请勿更改。作用：防止广告屏蔽软件特征识别，尽量大众化、伪装化英语单词或汉语拼音）</span>
    </td>
  </tr>
  <tr>
    <td class="left ui-widget-content">服务器时区设置：</td>
    <td class="right ui-widget-content">
    <input id="timezone" name="timezone1" type="text" class="text1 ui-widget-content ui-corner-all" value="<?php echo htmlspecialchars($timezone)?>" />
    <span class="tips">（正确的php时区值）</span>
    </td>
  </tr>
  <tr>
    <td class="left xiugai ui-widget-content">&nbsp;</td>
    <td class="right ui-widget-content">
    <input name="menu" type="hidden" value="szcs" />
    <input id="submit" name="submit" class="button" type="submit" value=" 修 改 " />
    <input name="reset" class="button" type="reset" value=" 重 置 " /><span id="tip">&nbsp;</span>
    </td>
  </tr>
</table>
</div>

</form>
</div>

</div>
<?php require 'mo.foot.php'; ?>