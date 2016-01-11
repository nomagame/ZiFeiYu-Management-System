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
define('NIUXAMS_ACCESS', 'tongji');
require 'common.php';
require 'func.tj.php';
$conn = new mysql();
/////////////
$statistics = 'statistics';
tj();
$gid = substr(insql($_REQUEST['gid']), -14, 14);
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$orderby = insql($_REQUEST['orderby']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 7;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$orderby = (strlen($orderby) > 1 && strlen($orderby) < 12) ? $orderby : 'date';
$sql = "SELECT COUNT(*) AS NumberOfRows FROM ${Pre}niux_ams_statistics_02 WHERE gid='$gid'";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$total = $row['NumberOfRows'];
$total = $total ? $total : 0;
if($page > ceil($total/$limit)){
	$page = ceil($total/$limit);
}
$kashi = $page*$limit-$limit;
$sql = "SELECT * FROM ${Pre}niux_ams_statistics_02 WHERE gid='$gid' ORDER BY $orderby $desc LIMIT $kashi,$limit";
$result = $conn->query($sql);
$list = '';
while($row = mysql_fetch_array($result)){
	$list .= '<tr class="list">';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['date'].' 日：</td>';
	$list .= '<td class="ui-widget-content uitd ct">共 '.$row['num01'].' 位访客</td>';
	$list .= '<td class="ui-widget-content uitd ct">其中 '.$row['num02'].' 位获此展现</td>';
	$list .= '<td class="ui-widget-content uitd ct">覆盖率 '.round(100*$row['num02']/$row['num01'], 2).'%</td>';
	$list .= '<td class="ui-widget-content uitd ct">共展现 '.$row['num03'].' 次</td>';
	$list .= '<td class="ui-widget-content uitd ct">获得 '.$row['num04'].' 次点击</td>';
	$list .= '</tr>';
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'tongji.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&orderby='.$orderby.'&gid='.$gid.'&page=';
$fenye = new fenye($total,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>
<input name="orderby" type="hidden" value="'.$orderby.'" /><input id="gid" name="gid" type="hidden" value="'.$gid.'">';

$title = 'GID:'.$gid.' 统计';
require 'mo.head.php';
?>
<style type="text/css">
input.limit{
	width: 1.5em;
}
input.page{
	width: 3em;
}
th.uith{
	border-width:1px 1px 0px 0px;
	font-size: 1.2em;
	line-height: 2em;
}
th.uiths{
	border-width:0px 1px 0px 0px;
	font-size: 1.2em;
	line-height: 2em;
}
td.uitd{
	border-width:0px 1px 1px 0px;
	font-size: 1em;
	line-height: 1.8em;
	overflow: hidden;
}
td.ct{
	text-align:center;
}
td.pl{
	padding-left:1em;
}
.ui-tooltip{
	min-width: 4.4em;
	max-width: 64em;
	word-break: break-all;
}
</style>
<script type="text/javascript">
$(function() {
	$( '.limit' ).blur(function(){$(this).parent().submit();});
	$( '.limit' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( '.page' ).blur(function(){$(this).parent().submit();});
	$( '.page' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( ':radio' ).click(function(){$(this).parent().parent().submit();});
	$( 'td.ct' ).hover(function(){$(this).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置：<?php echo $title ?></p>

<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">
<form method="get">
日期统计报告：<?php echo $nav ?> 
</form>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
<?php echo $list ?>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">今日整体统计</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
	<tr class="list">
    	<td class="ui-widget-content uitd ct"><?php echo date("Y-m-d",time())?> 日：</td>
<?php
$sql = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfV FROM ${Pre}niux_ams_counter WHERE DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfV = $row['NumberOfV'];
$NumberOfV = $NumberOfV ? $NumberOfV : 0;
echo '<td class="ui-widget-content uitd ct">共 '.$NumberOfV.' 位访客</td>';

$sql = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfVv FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfVv = $row['NumberOfVv'];
$NumberOfVv = $NumberOfVv ? $NumberOfVv : 0;
echo '<td class="ui-widget-content uitd ct">其中 '.$NumberOfVv.' 位获此展现</td><td class="ui-widget-content uitd ct">覆盖率 '.(100*$NumberOfVv/$NumberOfV).'%</td>';

$sql = "SELECT COUNT(*) AS NumberOfS FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfS = $row['NumberOfS'];
$NumberOfS = $NumberOfS ? $NumberOfS : 0;
echo '<td class="ui-widget-content uitd ct">共展现 '.$NumberOfS.' 次</td>';

$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS NumberOfC FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfC = $row['NumberOfC'];
$NumberOfC = $NumberOfC ? $NumberOfC : 0;
echo '<td class="ui-widget-content uitd ct">获得 '.$NumberOfC.' 次点击</td>';
?>
    </tr>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">今日细节统计</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">页面展现TOP 10</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,url FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY url ORDER BY Number DESC LIMIT 10";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td><a href="'.$row['url'].'" title="'.$row['url'].'" target="_blank">'.substr($row['url'],-50,50)."</a></td><td>".$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">页面点击TOP 10</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,url FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY url ORDER BY Number DESC LIMIT 10";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td><a href="'.$row['url'].'" title="'.$row['url'].'" target="_blank">'.substr($row['url'],-50,50)."</a></td><td>".$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">来源展现TOP 10</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,referer FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY referer ORDER BY Number DESC LIMIT 10";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td><a href="'.$row['referer'].'" title="'.$row['referer'].'" target="_blank">'.substr($row['referer'],-50,50)."</a></td><td>".$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">来源点击TOP 10</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,referer FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY referer ORDER BY Number DESC LIMIT 10";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td><a href="'.$row['referer'].'" title="'.$row['referer'].'" target="_blank">'.substr($row['referer'],-50,50)."</a></td><td>".$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">广告位展现TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,gwid FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY gwid ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$ggwthread.'-'.$row['gwid'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">广告位点击TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,gwid FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY gwid ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$ggwthread.'-'.$row['gwid'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">屏幕展现TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,screenw,screenh FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY screenw,screenh ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['screenw'].'*'.$row['screenh'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">屏幕点击TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,screenw,screenh FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY screenw,screenh ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['screenw'].'*'.$row['screenh'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">浏览器展现TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,browse,version FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY browse,version ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['browse'].'：'.$row['version'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">浏览器点击TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,browse,version FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY browse,version ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['browse'].'：'.$row['version'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">操作系统展现TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,os FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY os ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['os'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">操作系统点击TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,os FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY os ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['os'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">语言展现TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(*) AS Number,lang FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=1 AND DATE(time)=CURDATE() GROUP BY lang ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['lang'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td><td width="50%" valign="top">
<table class="listtable" width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <th class="ui-widget-header uith" scope="col" width="45%">语言点击TOP 5</th>
    <th class="ui-widget-header uith" scope="col" width="5%">数量</th>
  </tr>
<?php
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS Number,lang FROM ${Pre}niux_ams_counter WHERE (gid='$gid' OR gwid='$gid') AND ac=2 AND DATE(time)=CURDATE() GROUP BY lang ORDER BY Number DESC LIMIT 5";
$result = $conn->query($sql);
while($row = mysql_fetch_array($result))
  {
  echo '<tr><td>'.$row['lang'].'</td><td>'.$row['Number'].'</td></tr>';
  }
?> 
</table>
</td>
  </tr>
</table>
</div>

</div>
<?php require 'mo.foot.php'; ?>