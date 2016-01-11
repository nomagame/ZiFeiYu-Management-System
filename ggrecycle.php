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
define('NIUXAMS_ACCESS', 'ggrecycle');
require 'common.php';
///////////////////////////
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$gglei = insql($_GET['gglei'] ? $_GET['gglei'] : ( $_POST['gglei'] ? $_POST['gglei'] : unescape($_COOKIE['gglei']) ));
$ggzu = insql($_GET['ggzu'] ? $_GET['ggzu'] : ( $_POST['ggzu'] ? $_POST['ggzu'] : unescape($_COOKIE['ggzu']) ));
$search = insql($_REQUEST['search']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 20;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$gglei = ( $gglei=='' ) ? -1 : $gglei;
$ggleil = file_get_contents( $datadir . '/ggleilist.php' );
$ggll = explode("\r\n", $ggleil);
array_shift( $ggll );
array_pop( $ggll );
$ggzu = ( $ggzu=='' ) ? -1 : $ggzu;
$ggzul = file_get_contents( $datadir . '/ggzulist.php' );
$ggz = explode("\r\n", $ggzul);
array_shift( $ggz );
array_pop( $ggz );
$content = file_get_contents( $datadir . '/ggrecyclelist.php' );
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
		if($search=='' || ($search && (strpos(unescape($arrayd[0]),unescape($search))!==false))){
			if($arrayd[9]==$gglei || $gglei==-1){
				if($arrayd[6]==$ggzu || $ggzu==-1){
					$j++;
					if(ceil($j/$limit)==$page){
						if($arrayd[2]==0){$class='固定';}else if($arrayd[2]==1){$class='漂浮';}else{$class='弹窗';}
						if($arrayd[3]==''){$arrayd[3]='-';}
						if($arrayd[4]==''){$arrayd[4]='-';}
						if(!$arrayd[8]){$jfclass='其他';}else if($arrayd[8]==1){$jfclass='CPM';}else if($arrayd[8]==2){$jfclass='CPC';}else if($arrayd[8]==3){$jfclass='CPA';}else if($arrayd[8]==4){$jfclass='CPS';}else if($arrayd[8]==5){$jfclass='CPT';}
						$gglist .= '<tr class="list">';
						$gglist .= '<td class="ui-widget-content uitd ct"><input type="checkbox" name="chk_list" value="'.$gid.'" /></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$Serialnumber.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[9]).'">'.htmlspecialchars(cutstr($arrayd[9],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[6]).'">'.htmlspecialchars(cutstr($arrayd[6],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd pl"><span title="'.htmlspecialchars(cutstr(unescape($arrayd[1]),3000)).'">'.htmlspecialchars(cutstr(unescape($arrayd[0]),38)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars(cutstr(unescape($arrayd[1]),9000)).'" class="previewgg">'.$class.'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$jfclass.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[3].'&times;'.$arrayd[4].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[5].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><a href="tongji.php?gid='.$gid.'" title="'.$gid.'">查看</a></td>';
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
foreach($ggll as $key=>$value){
	if($value){
		if($value == $gglei){
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$zu_list = '';
foreach($ggz as $key=>$value){
	if($value){
		if($value == $ggzu){
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'ggrecycle.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&gglei='.urlencode($gglei).'&ggzu='.urlencode($ggzu).'&search='.urlencode(unescape($search)).'&page=';
$fenye = new fenye($size,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label>搜索<input class="search ui-widget-content" name="search" type="text" title="输入搜索内容，按回车或失去焦点" value="'.htmlspecialchars(unescape($search)).'" /></label> <label>分类<select class="gglei ui-widget-content" name="gglei"><option value="-1">所有广告</option>'.$lei_list.'</select></label> <label>分组<select class="ggzu ui-widget-content" name="ggzu"><option value="-1">所有广告</option>'.$zu_list.'</select></label> <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$title = '广告回收站';
require 'mo.head.php';
?>
<style>
input.limit{
	width: 1.5em;
}
input.page{
	width: 3em;
}
input.search{
	width: 6em;
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
	max-width: 2000px;
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
	$( '.gglei' ).change(function(){$(this).parent().parent().submit();});
	$( '.ggzu' ).change(function(){$(this).parent().parent().submit();});
	$( '.chk_all' ).click(function(){if(this.checked){$("input[type='checkbox']").each(function(){this.checked=true;});}else{$("input[type='checkbox']").each(function(){this.checked=false;});}});
	$( 'td' ).hover(function(){$( this ).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '#rebkgg' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("还原即刻生效！您确定要还原所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delgg.php',
					data: {menu:'rebkgg', gids:gids},
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
	$( '#delggtrue' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("警告：此操作将不可恢复！您确定要删除所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delgg.php',
					data: {menu:'delggtrue', gids:gids},
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
<button type="button" class="button" id="rebkgg" title="还原广告">还原广告</button>
<button type="button" class="button" id="delggtrue" title="彻底删除广告，无法恢复。">彻底删除广告</button>
&nbsp;&nbsp;&nbsp;&nbsp;<a class="button" title="广告管理." href="listgg.php">广告管理</a>
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
    <th class="ui-widget-header uith" scope="col">广告名称（停留查看代码）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">展现</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">计费</th>
    <th class="ui-widget-header uith" scope="col" style="width: 8em;">展示尺寸</th>
    <th class="ui-widget-header uith" scope="col" style="width: 11em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">统计</th>
  </tr>
<?php echo $gglist ?>
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 1em;"><input type="checkbox" name="chk_all" class="chk_all" title="全选" /></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分组</th>
    <th class="ui-widget-header uith" scope="col">广告名称（停留查看代码）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">展现</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">计费</th>
    <th class="ui-widget-header uith" scope="col" style="width: 8em;">展示尺寸</th>
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