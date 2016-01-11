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
define('NIUXAMS_ACCESS', 'tongji_gglog');
require 'common.php';
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$orderby = insql($_REQUEST['orderby']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 30;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$orderby = (strlen($orderby) > 1 && strlen($orderby) < 12) ? $orderby : 'id';
$conn = new mysql();
$sql = "SELECT COUNT(*) AS NumberOfRows FROM ${Pre}niux_ams_counter WHERE DATE(time)=CURDATE()";
$total = $conn->getFieldsVal($sql, 'NumberOfRows');
if($page > ceil($total/$limit)){
	$page = ceil($total/$limit);
}
$kashi = $page*$limit-$limit;
$sql = "SELECT * FROM ${Pre}niux_ams_counter WHERE DATE(time)=CURDATE() ORDER BY $orderby $desc LIMIT $kashi,$limit";
$result = $conn->query($sql);

$list = '';
while($row = mysql_fetch_array($result)){
	$list .= '<tr class="list">';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['id'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['time'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.(2==$row['ac']?'点击':'展示').'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['ip'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['port'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['os'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['lang'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['browse'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['version'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['screenw'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['screenh'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct"><a href="'.$row['url'].'" title="'.$row['url'].'" target="_blank">..'.substr($row['url'],-30,30).'</a></td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['bodyw'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['bodyh'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gwid'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gwx'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gwy'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gww'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gwh'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gid'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gshow'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gshow1'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gshow2'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gclick'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['gclick1'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['ashow'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['ashow1'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['aclick'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['aclick1'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.(1==$row['atyh']?'是':'否').'</td>';
	$list .= '<td class="ui-widget-content uitd ct"><a href="'.$row['referer'].'" title="'.$row['referer'].'" target="_blank">..'.substr($row['referer'],-30,30).'</a></td>';
	$list .= '<td class="ui-widget-content uitd ct"><span title="'.$row['agent'].'">..'.substr($row['agent'],-30,30).'</span></td>';
	$list .= '</tr>';
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'tongji_gglog.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&orderby='.$orderby.'&page=';
$fenye = new fenye($total,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>
<input name="orderby" type="hidden" value="'.$orderby.'" />';

$title = '今日广告日志';
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
.ui-tooltip{
	min-width: 4.4em;
	max-width: 64em;
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
});
</script>
</head>
<body class="ui-widget-content" style="width:2730px;border:0">
<div class="fullscreen">

<p class="cp">当前位置：<?php echo $title ?>
</p>

<div class="cc ui-widget-content ui-corner-all">
<div class="cp fenye">
<form method="get">
<?php echo $nav ?> 
</form>
</div>
</div>

<div class="cc ui-widget-content ui-corner-all">
<table width="2700px" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="id" title="按此排序">编号</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="time" title="按此排序">时间</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ac" title="按此排序">操作</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ip" title="按此排序">ip地址</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="port" title="按此排序">端口</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="os" title="按此排序">操作系统</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="lang" title="按此排序">语言</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="browse" title="按此排序">浏览器</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="version" title="按此排序">版本</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="screenw" title="按此排序">屏幕宽</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="screenh" title="按此排序">屏幕高</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="url" title="按此排序">访问页面</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="bodyw" title="按此排序">页面宽</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="bodyh" title="按此排序">页面高</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwid" title="按此排序">广告位ID</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwx" title="按此排序">广告位X坐标</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwy" title="按此排序">广告位Y坐标</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gww" title="按此排序">广告位宽</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwh" title="按此排序">广告位高</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gid" title="按此排序">广告物料ID</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gshow" title="按此排序">次显示</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gshow1" title="按此排序">天显示</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gshow2" title="按此排序">月显示</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gclick" title="按此排序">次点击</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gclick1" title="按此排序">月点击</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ashow" title="按此排序">次总显</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ashow1" title="按此排序">月总显</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="aclick" title="按此排序">次总点</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="aclick1" title="按此排序">月总点</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="atyh" title="按此排序">优化</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="referer" title="按此排序">来源</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="agent" title="按此排序">代理</a></th>
  </tr>
<?php echo $list ?>
  <tr>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="id" title="按此排序">编号</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="time" title="按此排序">时间</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ac" title="按此排序">操作</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ip" title="按此排序">ip地址</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="port" title="按此排序">端口</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="os" title="按此排序">操作系统</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="lang" title="按此排序">语言</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="browse" title="按此排序">浏览器</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="version" title="按此排序">版本</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="screenw" title="按此排序">屏幕宽</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="screenh" title="按此排序">屏幕高</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="url" title="按此排序">访问页面</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="bodyw" title="按此排序">页面宽</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="bodyh" title="按此排序">页面高</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwid" title="按此排序">广告位ID</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwx" title="按此排序">广告位X坐标</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwy" title="按此排序">广告位Y坐标</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gww" title="按此排序">广告位宽</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gwh" title="按此排序">广告位高</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gid" title="按此排序">广告物料ID</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gshow" title="按此排序">次显示</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gshow1" title="按此排序">天显示</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gshow2" title="按此排序">月显示</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gclick" title="按此排序">次点击</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="gclick1" title="按此排序">月点击</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ashow" title="按此排序">次总显</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="ashow1" title="按此排序">月总显</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="aclick" title="按此排序">次总点</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="aclick1" title="按此排序">月总点</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="atyh" title="按此排序">优化</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="referer" title="按此排序">来源</a></th>
    <th class="ui-widget-header uith" scope="col"><a href="javascript:void(0)" class="agent" title="按此排序">代理</a></th>
  </tr>
</table>
</div>

<div class="cc ui-widget-content ui-corner-all">
<div class="cp fenye">
<form method="get">
<?php echo $nav ?> 
</form>
</div>
</div>

</div>
<?php require 'mo.foot.php'; ?>