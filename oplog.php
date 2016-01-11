<?php 

define('NIUXAMS_ACCESS', 'oplog');
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
$sql = "SELECT COUNT(*) FROM ${Pre}niux_ams_oplog";
$total = $conn->getFieldsVal($sql, 0);
if($page > ceil($total/$limit)){
	$page = ceil($total/$limit);
}
$kashi = $page*$limit-$limit;
$sql = "SELECT * FROM ${Pre}niux_ams_oplog ORDER BY $orderby $desc LIMIT $kashi,$limit";
$result = $conn->query($sql);

$list = '';
while($row = mysql_fetch_array($result)){
	$list .= '<tr class="list">';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['id'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($row['username']).'">'.cutstr($row['username'],6).'</span></td>';
	$list .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($row['caozuo']).'">'.cutstr($row['caozuo'],6).'</span></td>';
	$list .= '<td class="ui-widget-content uitd ct">'.($row['state']?'成功':'失败').'</td>';
	$list .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($row['caozuofile']).'">'.cutstr($row['caozuofile'],8).'</span></td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['time'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['ip'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['port'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['os'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['browse'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['version'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['host'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct">'.$row['lang'].'</td>';
	$list .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($row['referer']).'">查看</span></td>';
	$list .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($row['agent']).'">查看</span></td>';
	$list .= '</tr>';
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'oplog.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&orderby='.$orderby.'&page=';
$fenye = new fenye($total,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>
<input name="orderby" type="hidden" value="'.$orderby.'" />';

$title = '操作日志';
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
	max-width:800px;
}
</style>
<script type="text/javascript">
var orderby = '<?php echo $orderby?>';
$(function() {
	$( '.limit' ).blur(function(){$(this).parent().submit();});
	$( '.limit' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( '.page' ).blur(function(){$(this).parent().submit();});
	$( '.page' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( ':radio' ).click(function(){$(this).parent().parent().submit();});
	$( 'th>a' ).click(function(){$("input[name='orderby']").val(this.className);$("form:first").submit();});
	$( 'td' ).hover(function(){$(this).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '.' + orderby ).parent().addClass( "ui-state-highlight" );
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
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
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="id" title="按此排序">编号</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="username" title="按此排序">用户名</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="caozuo" title="按此排序">操作</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;"><a href="javascript:void(0)" class="state" title="按此排序">状态</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;"><a href="javascript:void(0)" class="caozuofile" title="按此排序">操作明细</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 10em;"><a href="javascript:void(0)" class="time" title="按此排序">时间</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 10em;"><a href="javascript:void(0)" class="ip" title="按此排序">ip地址</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;"><a href="javascript:void(0)" class="port" title="按此排序">端口</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;"><a href="javascript:void(0)" class="os" title="按此排序">操作系统</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="browse" title="按此排序">浏览器</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="version" title="按此排序">版本</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="host" title="按此排序">主机名</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><a href="javascript:void(0)" class="lang" title="按此排序">语言</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;"><a href="javascript:void(0)" class="referer" title="按此排序">来源</a></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;"><a href="javascript:void(0)" class="agent" title="按此排序">代理</a></th>
  </tr>
<?php echo $list ?>
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