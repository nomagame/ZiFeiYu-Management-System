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
define('NIUXAMS_ACCESS', 'upload_list');
require 'common.php';
$menu = $_POST['menu'];
////////////////////////////
if( $menu == 'deluploadfile' ){
$fids = insql($_POST['fids']);
if(!$fids){
	die('出错啦！目标为空！你让我删谁？');
}
$dir = $datadir . '/updata/';
$arrayfid = explode(' ', $fids);
foreach ($arrayfid as $fid){
	$fidclass = explode('.', $fid);
	if(is_numeric($fidclass[0]) && strlen($fidclass[0])==14){
		unlink($dir.$fid) or die($fid."删除错误！请确认属性是否设置正确！");
	}
}
$conn = new mysql();
$conn->inoplog('删除上传广告文件', $fids, 1, getname());
die('1');
}
////////////////////////////
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 30;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$upath = $datadir.'/updata';
$upurl = $amsurl . $upath;
$files = getfiles( $upath );
if( $desc ){ rsort( $files ); }else{ sort( $files ); }
$total = count( $files );
if( $page > ceil( $total/$limit ) ){ $page = ceil( $total/$limit ); }
$kashi = $page * $limit - $limit;

$list = '';
for($i=$kashi;$i<$kashi+$limit;$i++){
	$file = $files[$i];
	if( $file ){
		$classic = explode( '.', $file );
		$modifytime = date( "Y-m-d H:i:s", filemtime( $upath . '/' . $file ) );
		$bb = round( filesize( $upath . '/' . $file ) / 1024 , 1 );
		$cc = getimagesize( $upath . '/' . $file );
		$list .= '<tr class="list">';
		$list .= '<td class="ui-widget-content uitd sl">&nbsp;&nbsp;<input type="checkbox" name="chk_list" value="'.$file.'" /></td>';
		$list .= '<td class="ui-widget-content uitd ct">'.($desc ? $total-$i : $i+1).'</td>';
		$list .= '<td class="ui-widget-content uitd pl"><a class="preview" href="'.$upurl.'/'.$file.'" target="_blank" title="">'.$file.'</a></td>';
		$list .= '<td class="ui-widget-content uitd ct">'.$classic[1].'</td>';
		$list .= '<td class="ui-widget-content uitd ct">'.$bb.' K</td>';
		$list .= '<td class="ui-widget-content uitd ct">'.$cc[0].'&times;'.$cc[1].'</td>';
		$list .= '<td class="ui-widget-content uitd ct">'.$modifytime.'</td>';
		$list .= '<td class="ui-widget-content uitd ct"><input class="url ui-widget-content" name="url" type="text" value="'.$upurl.'/'.$file.'" /></td>';
		$list .= '</tr>';
	}
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'upload_list.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&page=';
$fenye = new fenye($total,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

function getfiles( $jdupath, $xdupath = '', &$files = array() ){
	if ( !is_dir( $jdupath ) ) return null;
	$handle = opendir( $jdupath );
	while ( false !== ( $file = readdir( $handle ) ) ) {
		if ( $file != '.' && $file != '..' ) {
			$jdupath2 = $jdupath . DIRS . $file;
			$xdupath2 = $xdupath ? $xdupath . '/' . $file : $file;
			if ( is_dir( $jdupath2 ) ) {
				getfiles( $jdupath2 , $xdupath2 , $files );
			} elseif( strpos($jdupath2, '.html') === false ) {
				$files[] = $xdupath2;
			}
		}
	}
	return $files;
}
$title="上传文件管理";
require 'mo.head.php';
?>
<style>
input.limit{
	width: 1.5em;
}
input.page{
	width: 1em;
}
input.url{
	width: 90%;
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
.showimg{
	max-width:2000px;
}
.niuxcms_slt{
	display: block;
}
</style>
<script type="text/javascript">
$(function() {
	$( '.limit' ).blur(function(){$(this).parent().submit();});
	$( '.limit' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( '.page' ).blur(function(){$(this).parent().submit();});
	$( '.page' ).keydown(function(event){if(event.keyCode == 13){$(this).blur();}});
	$( ':radio' ).click(function(){$(this).parent().parent().submit();});
	$( '.url' ).click(function(){$(this).select();});
	$( 'td' ).hover(function(){$( this ).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$(".chk_all").click(function(){if(this.checked){$("input[name='chk_list']").each(function(){this.checked=true;});}else{$("input[name='chk_list']").each(function(){this.checked=false;});}});
	$( '.preview' ).tooltip({
		tooltipClass: "showimg",
		show: {
			delay: 200,
			duration: 1
		},
		hide: null,
		position: {
			my: "left+15 bottom-15",
			at: "left bottom"
		},
		track: true,
		content: function() {
			var element = $( this );
			if ( element.attr('href').match(/\.(gif|jpeg|jpg|png|bmp)$/ig) ) {
				return "<img class='niuxcms_slt' src='" + element.attr('href') + "' />";
			}
		}
	});
	$( '#upload' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( "#dialog_form" ).dialog({
		autoOpen: false,
		width: 540,
		height: 240,
		show: {
			effect: "blind",
			duration: 400
		},
		hide: {
			effect: "puff",
			duration: 400
		}
	});
	$( '#shanchuselects' ).click(function(){
		var fids = '';
		$( "input[name='chk_list']:checked" ).each(function(){ fids = fids + this.value + " "; });
		if( !fids ){ return false }
		if( confirm("你确定要删除所选文件吗？此操作是不可恢复的噢！请确认此文件未被广告引用！") ){
			$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
			$.post( location.href, { menu: 'deluploadfile', fids: fids },
			function( data ){
				if ( data == '1' ){
					alert( '恭喜你，删除文件成功！' );
					location = location.href;
				} else {
					alert( data );
				}
				$( "#Coverlayer" ).toggle();
			});
		}
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置： 上传文件管理
&nbsp;&nbsp;&nbsp;&nbsp; <button type="button" class="button" id="upload" title="">上传文件</button> <button type="button" class="button" id="shanchuselects" title="删除选择的文件." />删除所选</button>
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
    <th class="ui-widget-header uith" scope="col" style="width: 4em;"><label><input type="checkbox" name="chk_all" class="chk_all" />全选</label></th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">序号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 17em;">文件名</th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;">类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">大小</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">尺寸</th>
    <th class="ui-widget-header uith" scope="col" style="width: 12em;">上传时间</th>
    <th class="ui-widget-header uith" scope="col">文件地址</th>
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

<div id="dialog_form" title="上传文件：">
  <p class="cp" style="height:154px;"><iframe src="upload.php" name="uploadiframe" frameborder="0" scrolling="no" height="100%" width="100%"></iframe></p>
</div>
<?php require 'mo.foot.php'; ?>