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
define('NIUXAMS_ACCESS', 'ggwrecycle');
require 'common.php';
$menu = $_REQUEST['menu'];
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$ggwlei = insql($_GET['ggwlei'] ? $_GET['ggwlei'] : ( $_POST['ggwlei'] ? $_POST['ggwlei'] : unescape($_COOKIE['ggwlei']) ));
$ggwzu = insql($_GET['ggwzu'] ? $_GET['ggwzu'] : ( $_POST['ggwzu'] ? $_POST['ggwzu'] : unescape($_COOKIE['ggwzu']) ));
$search = insql($_REQUEST['search']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 20;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$ggwlei = ( $ggwlei=='' ) ? -1 : $ggwlei;
$ggwleil = file_get_contents( $datadir . '/ggwleilist.php' );
$ggwll = explode("\r\n", $ggwleil);
array_shift( $ggwll );
array_pop( $ggwll );
$ggwzu = ( $ggwzu=='' ) ? -1 : $ggwzu;
$ggwzul = file_get_contents( $datadir . '/ggwzulist.php' );
$ggwz = explode("\r\n", $ggwzul);
array_shift( $ggwz );
array_pop( $ggwz );
$content = file_get_contents( $datadir . '/ggwrecyclelist.php' );
$array = explode("\r\n", $content);
array_shift( $array );
array_pop( $array );
if( $desc ){ rsort( $array ); }else{ sort( $array ); }
$size = count( $array );
if( $page > ceil($size/$limit) ){ $page = ceil($size/$limit); }
$j = 0; $gglist = '';
for($i=0; $i<$size; $i++){
	$gid = $array[$i];
	if( $gid ){
		$Serialnumber = $desc ? $size - $i : $i + 1;
		$ggd = file_get_contents($datadir . '/' . $gid . '.phprecycle');
		$arrayd = array();
		$arrayd = explode("\r\n", $ggd);
		array_shift( $arrayd );
		if($search=='' || ($search && (strpos(unescape($arrayd[1]),unescape($search)) !== false))){
			if($arrayd[8]==$ggwlei || $ggwlei==-1){
				if($arrayd[7]==$ggwzu || $ggwzu==-1){
					$j++;
					if(ceil($j/$limit)==$page){
						if($arrayd[2]==1){$gglx='固定';}else if($arrayd[2]==2){$gglx='非固定';}
						if($arrayd[3]==''){$arrayd[3]='-';}
						if($arrayd[4]==''){$arrayd[4]='-';}
						$tfgg = '包含策略：'."\r\n".str_replace('. ',"\r\n",$arrayd[5])."背景广告：\r\n".($arrayd[6]?$arrayd[6]."\r\n":"")."广告位分类：".$arrayd[8]."\r\n".'广告位分组：'.$arrayd[7]."\r\n";
						$gglist .= '<tr class="list">';
						$gglist .= '<td class="ui-widget-content uitd ct"><input type="checkbox" name="chk_list" value="'.$gid.'" /></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$Serialnumber.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[8]).'">'.htmlspecialchars(cutstr($arrayd[8],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[7]).'">'.htmlspecialchars(cutstr($arrayd[7],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd pl"><span title="'.htmlspecialchars($tfgg).'">'.htmlspecialchars(cutstr(unescape($arrayd[1]),30)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$gglx.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[3].'&times;'.$arrayd[4].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[0].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><a href="tongji.php?gid='.$gid.'" title="'.$gid.'">统计</a></td>';
						$gglist .= '</tr>';
					}
				}
			}
		}
	}
}
$size = $j;
if($page>ceil($size/$limit)){$page=ceil($size/$limit);}

$lei_list = '';
foreach($ggwll as $key=>$value){
	if($value){
		if($value == $ggwlei){
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$zu_list = '';
foreach($ggwz as $key=>$value){
	if($value){
		if($value == $ggwzu){
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'ggwrecycle.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&ggwlei='.urlencode($ggwlei).'&ggwzu='.urlencode($ggwzu).'&search='.urlencode(unescape($search)).'&page=';
$fenye = new fenye($size,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label>搜索<input class="search ui-widget-content" name="search" type="text" title="输入搜索内容，按回车或失去焦点" value="'.htmlspecialchars(unescape($search)).'" /></label> <label>分类<select class="ggwlei ui-widget-content" name="ggwlei"><option value="-1">所有广告位</option>'.$lei_list.'</select></label> <label>分组<select class="ggwzu ui-widget-content" name="ggwzu"><option value="-1">所有广告位</option>'.$zu_list.'</select></label> <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$title = '广告位回收站';
require 'mo.head.php';
?>
<style type="text/css">
input.limit{
	width: 1.5em;
}
input.page{
	width: 1em;
}
input.search{
	width: 4em;
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
input.text,select.text,textarea.text {
	padding:.3em;
}
.ui-tooltip {
	max-width: 550px;
	word-break: break-all;
}
</style>
<script type="text/javascript">
$(function() {
	$( '.limit' ).blur(function(){$(this).parent().submit();});
	$( '.limit' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( '.page' ).blur(function(){$(this).parent().submit();});
	$( '.page' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( '.search' ).blur(function(){$(this).parent().parent().submit();});
	$( '.search' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( ':radio' ).click(function(){$(this).parent().parent().submit();});
	$( '.ggwlei' ).change(function(){$(this).parent().parent().submit();});
	$( '.ggwzu' ).change(function(){$(this).parent().parent().submit();});
	$( '.chk_all' ).click(function(){if(this.checked){$("input[type='checkbox']").each(function(){this.checked=true;});}else{$("input[type='checkbox']").each(function(){this.checked=false;});}});
	$( 'td' ).hover(function(){$( this ).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '#rebkggw' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("还原即刻生效！您确定要还原所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delggw.php',
					data: {menu:'rebkggw', gids:gids},
					success: function( msg ){
						if ( msg == '1' ){
							alert("还原成功！");
							location = location.href;
						}else{
							alert(msg);
							$( "#Coverlayer" ).toggle();
						}
					}
				});
			}
		}
	});
	$( '#delggwtrue' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("警告：此操作将不可恢复！您确定要删除所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delggw.php',
					data: {menu:'delggwtrue', gids:gids},
					success: function( msg ){
						if ( msg == '1' ){
							alert("删除成功！");
							location = location.href;
						}else{
							alert(msg);
							$( "#Coverlayer" ).toggle();
						}
					}
				});
			}
		}
	});
	$( ".previewgg, .pl" ).tooltip({
		show: {
			delay: 200,
			duration: 1
		},
		hide: {
			effect: "blind",
			duration: 200
		},
		items: ".previewgg, [title]",
		track: true,
		content: function() {
			var element = $( this );
			if ( element.is( ".previewgg" ) ) {
				return element.attr( "title" );
			}
			if ( element.is( "[title]" ) ) {
				return element.attr( "title" ).replace(/</igm,"&lt;").replace(/>/igm,"&gt;").replace(/\n/igm,"<br />");
			}
		}
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置： <?php echo $title ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" class="button" id="rebkggw" title="还原广告位">还原广告位</button>
<button type="button" class="button" id="delggwtrue" title="彻底删除广告位，无法恢复。">彻底删除广告位</button>
&nbsp;&nbsp;&nbsp;&nbsp;<a class="button" title="广告位管理." href="listggw.php">广告位管理</a>
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
    <th class="ui-widget-header uith" scope="col" style="width: 1em;"><input type="checkbox" name="chk_all" class="chk_all" title="全选" /></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分组</th>
    <th class="ui-widget-header uith" scope="col">广告位名称（停留查看信息）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">尺寸</th>
    <th class="ui-widget-header uith" scope="col" style="width: 11em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">统计</th>
  </tr>
<?php echo $gglist ?>
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 1em;"><input type="checkbox" name="chk_all" class="chk_all" title="全选" /></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分组</th>
    <th class="ui-widget-header uith" scope="col">广告位名称（停留查看信息）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">尺寸</th>
    <th class="ui-widget-header uith" scope="col" style="width: 11em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">统计</th>
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