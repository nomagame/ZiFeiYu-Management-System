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
define('NIUXAMS_ACCESS', 'tongji_report');
require 'common.php';
require 'func.tj.php';
$conn = new mysql();
///////////////////////////
if( $menu == 'ajax' ){
$riqi = insql($_REQUEST['riqi']);
$sql = "SELECT MAX(num01),MAX(num02),MAX(num03) FROM ${Pre}niux_ams_statistics_01 WHERE DATE(time)='$riqi' and hour<>24";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$maxVnum = $row['MAX(num01)'];
$maxSnum = $row['MAX(num02)'];
$maxCnum  =$row['MAX(num03)'];
$sql = "SELECT * FROM ${Pre}niux_ams_statistics_01 WHERE DATE(time)='$riqi' and hour<>24";
$result = $conn->query($sql);
?>
<div class="cp">&nbsp;&nbsp;<?php echo $riqi?> 日</div>
<div class="cc ui-widget-content ui-corner-all">
<table class="listtable" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="col" class="leftup"><?php echo $maxVnum?>_</th>
    <th colspan="24" scope="col"><span class="ui-state-error">&nbsp;&nbsp;&nbsp;&nbsp;</span>独立访客数</th>
    </tr>
  <tr>
    <th scope="row" class="left"><?php echo ceil($maxVnum/2)?>-</th>
<?php 
while($row = mysql_fetch_array($result)){
	echo '<td><span class="ui-state-error" style="display: inline-block; width: 99%; height: '.ceil((200/$maxVnum)*$row['num01']).'px;" title="'.$row['num01'].'"></span></td>';
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
mysql_data_seek($result, 0);
while($row = mysql_fetch_array($result)){
	echo '<td><span class="ui-state-error" style="display: inline-block; width: 28%; height: '.ceil((200/$maxSnum)*$row['num02']).'px;" title="'.$row['num02'].'"></span><span class="ui-widget-header" style="display: inline-block; width: 28%; height: '.ceil((200/$maxSnum)*$row['num04']).'px;" title="'.$row['num04'].'"></span><span class="ui-state-highlight" style="display: inline-block; width: 28%; height: '.ceil((200/$maxSnum)*$row['num05']).'px;" title="'.$row['num05'].'"></span></td>';
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
mysql_data_seek($result,0);
while($row = mysql_fetch_array($result)){
	echo '<td><span class="ui-state-error" style="display: inline-block; width: 28%; height: '.ceil((200/$maxCnum)*$row['num03']).'px;" title="'.$row['num03'].'"></span><span class="ui-widget-header" style="display: inline-block; width: 28%; height: '.ceil((200/$maxCnum)*$row['num06']).'px;" title="'.$row['num06'].'"></span><span class="ui-state-highlight" style="display: inline-block; width: 28%; height: '.ceil((200/$maxCnum)*$row['num07']).'px;" title="'.$row['num07'].'"></span></td>';
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
<?php
exit;
}
///////////////////////
$statistics = 'statistics';
tj();
$sql = "SELECT COUNT(*) AS NumberOfRows,SUM(num01) AS TotalOfV,SUM(num02) AS TotalOfS,SUM(num03) AS TotalOfC,MAX(time) AS FirstOfTime,MIN(time) AS LastOfTime,SUM(num08) AS TotalOfIp,SUM(num09) AS TotalOfPv FROM ${Pre}niux_ams_statistics_01 WHERE hour=24";
$result = $conn->query($sql);
$row = mysql_fetch_array($result);
$totalday = $row['NumberOfRows'];
$totalday = $totalday ? $totalday : 0;
$TotalOfV = $row['TotalOfV'];
$TotalOfV = $TotalOfV ? $TotalOfV : 0;
$TotalOfS = $row['TotalOfS'];
$TotalOfS = $TotalOfS ? $TotalOfS : 0;
$TotalOfC = $row['TotalOfC'];
$TotalOfC = $TotalOfC ? $TotalOfC : 0;
$FirstOfTime = $row['FirstOfTime'];
$FirstOfTime = $FirstOfTime ? $FirstOfTime : 0;
$LastOfTime = $row['LastOfTime'];
$LastOfTime = $LastOfTime ? $LastOfTime : 0;
$TotalOfIp = $row['TotalOfIp'];
$TotalOfIp = $TotalOfIp ? $TotalOfIp : 0;
$TotalOfPv = $row['TotalOfPv'];
$TotalOfPv = $TotalOfPv ? $TotalOfPv : 0;
////////////////////
$listreport = '';
$listreport .= '<tr class="list">';
$listreport .= '<td class="ui-widget-content uitd ct">'.substr($LastOfTime,0,10).'<span class="tip">至</span>'.substr($FirstOfTime,0,10).'</td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$totalday.'<span class="tip">天</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$TotalOfV.'<span class="tip">人次</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$TotalOfIp.'<span class="tip">个</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$TotalOfPv.'<span class="tip">次</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$TotalOfS.'<span class="tip">次</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.$TotalOfC.'<span class="tip">次</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($TotalOfPv/($TotalOfV?$TotalOfV:1),2).'<span class="tip">页/人</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($TotalOfS/($TotalOfPv?$TotalOfPv:1),2).'<span class="tip">广告/页</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($TotalOfS/($TotalOfV?$TotalOfV:1),2).'<span class="tip">展现/访客</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($TotalOfC/($TotalOfV?$TotalOfV:1),4).'<span class="tip">点击/访客</span></td>';
$listreport .= '<td class="ui-widget-content uitd ct">'.round($TotalOfC/($TotalOfS?$TotalOfS:1),4).'<span class="tip">点击/展现</span></td>';
$listreport .= '</tr>';
////////////////////
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$orderby = insql($_REQUEST['orderby']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 7;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$orderby = (strlen($orderby) > 1 && strlen($orderby) < 12) ? $orderby : 'time';
$sql = "SELECT COUNT(*) AS NumberOfRows FROM ${Pre}niux_ams_statistics_01 WHERE hour=24";
$result = $conn->query($sql);
$row =  mysql_fetch_array($result);
$total = $row['NumberOfRows'];
$total = $total ? $total : 0;
if($page > ceil($total/$limit)){
	$page = ceil($total/$limit);
}
$kashi = $page*$limit-$limit;
$sql = "SELECT time FROM ${Pre}niux_ams_statistics_01 WHERE hour=24 ORDER BY $orderby $desc LIMIT $kashi,$limit";
$result = $conn->query($sql);
$row  =  mysql_fetch_array($result);
$riqi = substr($row['time'], 0, 10);
$sql = "SELECT * FROM ${Pre}niux_ams_statistics_01 WHERE hour=24 ORDER BY $orderby $desc LIMIT $kashi,$limit";
$result = $conn->query($sql);
$list = '';
while($row = mysql_fetch_array($result)){
	$list .= '<tr class="list">';
	$list .= '<td class="ui-widget-content uitd ct"><a href="javascript:void(0)" class="'.substr($row['time'],0,10).'" title="按此显示'.substr($row['time'],0,10).'日小时统计">'.substr($row['time'],0,10).'</a></td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num01'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num08'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num09'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num02'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num03'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.round($row['num03']/$row['num01'],4).'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.round($row['num03']/$row['num02'],4).'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num04'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num05'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num06'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['num07'].'</td>';
	$list .= '</tr>';
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'tongji_report.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&orderby='.$orderby.'&page=';
$fenye = new fenye($total,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>
<input name="orderby" type="hidden" value="'.$orderby.'" />';

$title = '历史统计报告';
require 'mo.head.php';
?>
<style>
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
<script type="text/javascript">
$(function() {
	$( '.limit' ).blur(function(){$(this).parent().submit();});
	$( '.limit' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( '.page' ).blur(function(){$(this).parent().submit();});
	$( '.page' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( ':radio' ).click(function(){$(this).parent().parent().submit();});
	$( 'th>a' ).click(function(){$("input[name='orderby']").val(this.className);$("form:first").submit();});
	$( 'td' ).hover(function(){$(this).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '.<?php echo $orderby?>' ).parent().addClass( "ui-state-highlight" );
	$( '#xiaoshi' ).load( "tongji_report.php?menu=ajax&riqi=<?php echo $riqi?>" );
	$( '#listtable td>a' ).click(function(){$( '#xiaoshi' ).load( "tongji_report.php?menu=ajax&riqi=" + this.className );});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置：<?php echo $title ?></p>

<div class="cc ui-widget-content ui-corner-all">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col">统计日期（不含今日）</th>
    <th class="ui-widget-header uith" scope="col">统计天数</th>
    <th class="ui-widget-header uith" scope="col">独立访客UV</th>
    <th class="ui-widget-header uith" scope="col">独立IP数</th>
    <th class="ui-widget-header uith" scope="col">浏览量PV</th>
    <th class="ui-widget-header uith" scope="col">广告展现量</th>
    <th class="ui-widget-header uith" scope="col">广告点击量</th>
    <th class="ui-widget-header uith" scope="col">访客浏览率</th>
    <th class="ui-widget-header uith" scope="col">页面广告率</th>
    <th class="ui-widget-header uith" scope="col">展现率</th>
    <th class="ui-widget-header uith" scope="col">访客点击率</th>
    <th class="ui-widget-header uith" scope="col">展现点击率</th>
  </tr>
<?php echo $listreport ?>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<div class="cp fenye">
<form method="get">
日期统计报告<?php echo $nav ?> 
</form>
</div>
<table id="listtable" width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="time" title="按此排序">日期</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num01" title="按此排序">独立访客</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num08" title="按此排序">独立IP</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num09" title="按此排序">浏览量PV</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num02" title="按此排序">广告展现</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num03" title="按此排序">广告点击</a></th>
    <th class="ui-widget-header uith" scope="col">访客点击率</th>
    <th class="ui-widget-header uith" scope="col">展现点击率</th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num04" title="按此排序">原始展现</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num05" title="按此排序">优化展现</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num06" title="按此排序">原始点击</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="num07" title="按此排序">优化点击</a></th>
  </tr>
<?php echo $list ?>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">小时统计报告</div>
<div id="xiaoshi"></div>
</div>

</div>
<?php require 'mo.foot.php'; ?>