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
define('NIUXAMS_ACCESS', 'tongji_nowreport');
require 'common.php';
$conn = new mysql();
$today = date("Y-m-d", time());
$sql = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfV,COUNT(DISTINCT ip) AS NumberOfIp FROM ${Pre}niux_ams_counter WHERE DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfV = $row['NumberOfV'];
$NumberOfIp = $row['NumberOfIp'];
$sql = "SELECT COUNT(*) AS NumberOfS,COUNT(DISTINCT time) AS NumberOfPv FROM ${Pre}niux_ams_counter WHERE ac=1 and DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfS = $row['NumberOfS'];
$NumberOfPv = $row['NumberOfPv'];
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfC FROM ${Pre}niux_ams_counter WHERE ac=2 and DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfC = $row['NumberOfC'];
$sql = "SELECT COUNT(*) AS NumberOfSny FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=0 and DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfSny = $row['NumberOfSny'];
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCny FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=0 and DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfCny = $row['NumberOfCny'];
$sql = "SELECT COUNT(*) AS NumberOfSy FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=1 and DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfSy = $row['NumberOfSy'];
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfCy FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=1 and DATE(time)=CURDATE()";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$NumberOfCy = $row['NumberOfCy'];
///////////////////////////
$sql = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfhV FROM ${Pre}niux_ams_counter WHERE DATE(time)=CURDATE() GROUP BY EXTRACT(HOUR FROM time)";
$result = $conn->query($sql);
while ($row = mysql_fetch_array($result)) {
	$NumberOfhV = $row['NumberOfhV'];
	$NumberOfhV = $NumberOfhV ? $NumberOfhV : 1;
	$maxVnum = max($NumberOfhV, $maxVnum);
}
$sql = "SELECT COUNT(*) AS NumberOfhS FROM ${Pre}niux_ams_counter WHERE ac=1 and DATE(time)=CURDATE() GROUP BY EXTRACT(HOUR FROM time)";
$result = $conn->query($sql);
while ($row = mysql_fetch_array($result)) {
	$NumberOfhS = $row['NumberOfhS'];
	$NumberOfhS = $NumberOfhS ? $NumberOfhS : 1;
	$maxSnum = max($NumberOfhS, $maxSnum);
}
$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent,time) AS NumberOfhC FROM ${Pre}niux_ams_counter WHERE ac=2 and DATE(time)=CURDATE() GROUP BY EXTRACT(HOUR FROM time)";
$result = $conn->query($sql);
while ($row = mysql_fetch_array($result)) {
	$NumberOfhC = $row['NumberOfhC'];
	$NumberOfhC = $NumberOfhC ? $NumberOfhC : 1;
	$maxCnum = max($NumberOfhC, $maxCnum);
}
////////////////////
$listreport = '';
$listreport .= '<tr class="list">';
$listreport .= '<td class="ui-widget-content uitd ct">'.$NumberOfV.'<span class="tip">（人）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$NumberOfIp.'<span class="tip">（个）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$NumberOfPv.'<span class="tip">（页）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$NumberOfS.'<span class="tip">（次）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$NumberOfC.'<span class="tip">（次）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($NumberOfC/($NumberOfV?$NumberOfV:1),4).'<span class="tip">（点击/访客）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($NumberOfPv/($NumberOfV?$NumberOfV:1),2).'<span class="tip">（页/人）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($NumberOfS/($NumberOfPv?$NumberOfPv:1),2).'<span class="tip">（广告/页）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($NumberOfC/($NumberOfS?$NumberOfS:1),4).'<span class="tip">（点击/展现）</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($NumberOfS/($NumberOfV?$NumberOfV:1),2).'<span class="tip">（展现/访客）</span></td>';
$listreport .= '</tr>';

$title = '今日统计报告';
require 'mo.head.php';
?>
<style>
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
.listtable tr{
	vertical-align: bottom;
}
.listtable th.left{
	width: 4%;
	border-right: 1px solid; 
	text-align: right; 
	vertical-align: middle;
}
.listtable th.leftup{
	text-align: right;
	vertical-align: bottom;
	line-height: 1em
}
.listtable td{
	width: 4%;
	height: 200px;
	border-bottom: 1px solid;
	line-height: 1em
}
</style>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置：<?php echo $title ?></p>

<div class="cc ui-widget-content ui-corner-all">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col">独立访客数UV</th>
    <th class="ui-widget-header uith" scope="col">独立IP数</th>
    <th class="ui-widget-header uith" scope="col">浏览量PV</th>
    <th class="ui-widget-header uith" scope="col">广告展现数</th>
    <th class="ui-widget-header uith" scope="col">广告点击数</th>
    <th class="ui-widget-header uith" scope="col">访客点击率</th>
    <th class="ui-widget-header uith" scope="col">访客浏览率</th>
    <th class="ui-widget-header uith" scope="col">页面广告率</th>
    <th class="ui-widget-header uith" scope="col">展现点击率</th>
    <th class="ui-widget-header uith" scope="col">展现率</th>
  </tr>
<?php echo $listreport ?>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">今日小时统计</div>
<div class="cc ui-widget-content ui-corner-all">
<table class="listtable" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col" class="leftup"><?php echo $maxVnum?>_</th>
    <th colspan="24" scope="col"><span class="ui-state-error">&nbsp;&nbsp;&nbsp;&nbsp;</span>独立访客数</th>
    </tr>
  <tr>
    <th scope="row" class="left"><?php echo ceil($maxVnum/2)?>-</th>
<?php 
for ($i=0; $i<=23; $i++){
	$sql = "SELECT COUNT(DISTINCT ip,screenw,screenh,agent) AS NumberOfhV FROM ${Pre}niux_ams_counter WHERE DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhV = $row['NumberOfhV'];
	$NumberOfhV = $NumberOfhV ? $NumberOfhV : 0;
	echo '<td><span class="ui-state-error" style="display: inline-block; width: 99%; height: '.ceil((200/$maxVnum)*$NumberOfhV).'px;" title="'.$NumberOfhV.'"></span></td>';
}
?>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">0</th>
    <th scope="col">1</th>
    <th scope="col">2</th>
    <th scope="col">3</th>
    <th scope="col">4</th>
    <th scope="col">5</th>
    <th scope="col">6</th>
    <th scope="col">7</th>
    <th scope="col">8</th>
    <th scope="col">9</th>
    <th scope="col">10</th>
    <th scope="col">11</th>
    <th scope="col">12</th>
    <th scope="col">13</th>
    <th scope="col">14</th>
    <th scope="col">15</th>
    <th scope="col">16</th>
    <th scope="col">17</th>
    <th scope="col">18</th>
    <th scope="col">19</th>
    <th scope="col">20</th>
    <th scope="col">21</th>
    <th scope="col">22</th>
    <th scope="col">23</th>
  </tr>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<table class="listtable" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col" class="leftup"><?php echo $maxSnum?>_</th>
    <th colspan="24" scope="col"><span class="ui-state-error">&nbsp;&nbsp;&nbsp;&nbsp;</span>广告展现数量<span class="ui-widget-header">&nbsp;&nbsp;&nbsp;&nbsp;</span>原始广告展现数量<span class="ui-state-highlight">&nbsp;&nbsp;&nbsp;&nbsp;</span>优化广告展现数量</th>
    </tr>
  <tr>
    <th scope="row" class="left"><?php echo ceil($maxSnum/2)?>-</th>
<?php 
for ($i=0; $i<=23; $i++){
	$sql = "SELECT COUNT(*) AS NumberOfhS FROM ${Pre}niux_ams_counter WHERE ac=1 and DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhS = $row['NumberOfhS'];
	$NumberOfhS = $NumberOfhS ? $NumberOfhS : 0;
	$sql = "SELECT COUNT(*) AS NumberOfhnyS FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=0 and DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhnyS = $row['NumberOfhnyS'];
	$NumberOfhnyS = $NumberOfhnyS ? $NumberOfhnyS : 0;
	$sql = "SELECT COUNT(*) AS NumberOfhyS FROM ${Pre}niux_ams_counter WHERE ac=1 and atyh=1 and DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhyS = $row['NumberOfhyS'];
	$NumberOfhyS = $NumberOfhyS ? $NumberOfhyS : 0;
	echo '<td><span class="ui-state-error" style="display: inline-block; width: 28%; height: '.ceil((200/$maxSnum)*$NumberOfhS).'px;" title="'.$NumberOfhS.'"></span><span class="ui-widget-header" style="display: inline-block; width: 28%; height: '.ceil((200/$maxSnum)*$NumberOfhnyS).'px;" title="'.$NumberOfhnyS.'"></span><span class="ui-state-highlight" style="display: inline-block; width: 28%; height: '.ceil((200/$maxSnum)*$NumberOfhyS).'px;" title="'.$NumberOfhyS.'"></span></td>';
}
?>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">0</th>
    <th scope="col">1</th>
    <th scope="col">2</th>
    <th scope="col">3</th>
    <th scope="col">4</th>
    <th scope="col">5</th>
    <th scope="col">6</th>
    <th scope="col">7</th>
    <th scope="col">8</th>
    <th scope="col">9</th>
    <th scope="col">10</th>
    <th scope="col">11</th>
    <th scope="col">12</th>
    <th scope="col">13</th>
    <th scope="col">14</th>
    <th scope="col">15</th>
    <th scope="col">16</th>
    <th scope="col">17</th>
    <th scope="col">18</th>
    <th scope="col">19</th>
    <th scope="col">20</th>
    <th scope="col">21</th>
    <th scope="col">22</th>
    <th scope="col">23</th>
  </tr>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<table class="listtable" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col" class="leftup"><?php echo $maxCnum?>_</th>
    <th colspan="24" scope="col"><span class="ui-state-error">&nbsp;&nbsp;&nbsp;&nbsp;</span>广告点击数量<span class="ui-widget-header">&nbsp;&nbsp;&nbsp;&nbsp;</span>原始广告点击数量<span class="ui-state-highlight">&nbsp;&nbsp;&nbsp;&nbsp;</span>优化广告点击数量</th>
    </tr>
  <tr>
    <th scope="row" class="left"><?php echo ceil($maxCnum/2)?>-</th>
<?php 
for ($i=0; $i<=23; $i++){
	$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS NumberOfhC FROM ${Pre}niux_ams_counter WHERE ac=2 and DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhC = $row['NumberOfhC'];
	$NumberOfhC = $NumberOfhC?$NumberOfhC:0;
	$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS NumberOfhnyC FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=0 and DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhnyC = $row['NumberOfhnyC'];
	$NumberOfhnyC = $NumberOfhnyC?$NumberOfhnyC:0;
	$sql = "SELECT COUNT(DISTINCT ip,gid,gwid,gshow,gshow1,gshow2,url,referer,screenw,screenh,agent) AS NumberOfhyC FROM ${Pre}niux_ams_counter WHERE ac=2 and atyh=1 and DATE(time)=CURDATE() and EXTRACT(HOUR FROM time)=$i";
	$result = $conn->query($sql);
	$row = mysql_fetch_array($result);
	$NumberOfhyC = $row['NumberOfhyC'];
	$NumberOfhyC = $NumberOfhyC?$NumberOfhyC:0;
	echo '<td><span class="ui-state-error" style="display: inline-block; width: 28%; height: '.ceil((200/$maxCnum)*$NumberOfhC).'px;" title="'.$NumberOfhC.'"></span><span class="ui-widget-header" style="display: inline-block; width: 28%; height: '.ceil((200/$maxCnum)*$NumberOfhnyC).'px;" title="'.$NumberOfhnyC.'"></span><span class="ui-state-highlight" style="display: inline-block; width: 28%; height: '.ceil((200/$maxCnum)*$NumberOfhyC).'px;" title="'.$NumberOfhyC.'"></span></td>';
}
?>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">0</th>
    <th scope="col">1</th>
    <th scope="col">2</th>
    <th scope="col">3</th>
    <th scope="col">4</th>
    <th scope="col">5</th>
    <th scope="col">6</th>
    <th scope="col">7</th>
    <th scope="col">8</th>
    <th scope="col">9</th>
    <th scope="col">10</th>
    <th scope="col">11</th>
    <th scope="col">12</th>
    <th scope="col">13</th>
    <th scope="col">14</th>
    <th scope="col">15</th>
    <th scope="col">16</th>
    <th scope="col">17</th>
    <th scope="col">18</th>
    <th scope="col">19</th>
    <th scope="col">20</th>
    <th scope="col">21</th>
    <th scope="col">22</th>
    <th scope="col">23</th>
  </tr>
</table>
</div>
</div>

</div>
<?php require 'mo.foot.php'; ?>