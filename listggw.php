<?php
$pageName = 'index';

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";

define('NIUXAMS_ACCESS', 'listggw');
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
$content = file_get_contents( $datadir . '/ggwlist.php' );
$array = explode("\r\n", $content);
array_shift( $array );
array_pop( $array );
if( $desc ){ rsort( $array ); }else{ sort( $array ); }
$size = count( $array );
if( $page > ceil($size/$limit) ){ $page = ceil($size/$limit); }
/////////////////////////
$j = 0; $gglist = '';
for($i=0; $i<$size; $i++){
	$gid = $array[$i];
	if( $gid ){
		$Serialnumber = $desc ? $size - $i : $i + 1;
		$ggd = file_get_contents($datadir . '/' . $gid . '.php');
		$arrayd = array();
		$arrayd = explode("\r\n", $ggd);
		array_shift( $arrayd );
		if($search=='' || ($search && (strpos(unescape($arrayd[1]),unescape($search)) !== false || strpos($gid,unescape($search)) !== false))){
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
						$gglist .= '<td class="ui-widget-content uitd pl"><a href="previewgg.php?gid='.$gid.'" target="_blank" title="'.htmlspecialchars($tfgg).'">'.htmlspecialchars(cutstr(unescape($arrayd[1]),30)).'</a></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><a href="editggw.php?gid='.$gid.'" title="'.htmlspecialchars(cutstr(unescape($arrayd[1]),3000)).'">修改</a></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><a id="'.$gid.'" class="hqggwdm button">获取代码</a></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$gglx.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[3].'&times;'.$arrayd[4].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[0].'</td>';
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
$leisortable = '';
foreach($ggwll as $key=>$value){
	if($value){
		if($value == $ggwlei){
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
		$leisortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此类"></span>'.htmlspecialchars($value).'</li>';
	}
}
$zu_list = '';
$zusortable = '';
foreach($ggwz as $key=>$value){
	if($value){
		if($value == $ggwzu){
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
		$zusortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此组"></span>'.htmlspecialchars($value).'</li>';
	}
}

$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'listggw.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&ggwlei='.urlencode($ggwlei).'&ggwzu='.urlencode($ggwzu).'&search='.urlencode(unescape($search)).'&page=';
$fenye = new fenye($size,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label>搜索<input class="search ui-widget-content" name="search" type="text" title="输入搜索内容，按回车或失去焦点" value="'.htmlspecialchars(unescape($search)).'" /></label> <label>分类<select class="ggwlei ui-widget-content" name="ggwlei"><option value="-1">所有广告位</option>'.$lei_list.'</select></label> <label>分组<select class="ggwzu ui-widget-content" name="ggwzu"><option value="-1">所有广告位</option>'.$zu_list.'</select></label> <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$title = '广告位管理';
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
#llist{
	width: 25em;
	float: left;
}
#zlist{
	width: 25em;
	float: right;
}
#leisortable li, #zusortable li {
	position: relative;
	margin: 0 3px 3px 3px;
	padding: 0.4em;
	padding-left: 1.3em;
	height: 18px;
}
#leisortable li span, #zusortable li span {
	position: absolute;
	margin-left: 90%;
}
#leisortable li span.ui-icon-close, #zusortable li span.ui-icon-close {
	margin-left: -1.2em;
	cursor: pointer;
}
#ggwdm{
	width: 400px;
	height: 80px;
	font-size: 1em;
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
	$( '.ggwlei' ).change(function(){setCookie('ggwlei', $(this).val(), 120, '/');$(this).parent().parent().submit();});
	$( '.ggwzu' ).change(function(){setCookie('ggwzu', $(this).val(), 120, '/');$(this).parent().parent().submit();});
	$( '.chk_all' ).click(function(){if(this.checked){$("input[type='checkbox']").each(function(){this.checked=true;});}else{$("input[type='checkbox']").each(function(){this.checked=false;});}});
	$( 'td' ).hover(function(){$( this ).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '#delggw' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("删除即刻生效！您确定要删除所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delggw.php',
					data: {menu:'delggw', gids:gids},
					success: function(msg){
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
	$( '#addggwleizu' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( '#editggwleizu' ).click(function(){
		$( '#dialog_form1' ).dialog( "open" );
	});
	$( '#paidelggwleizu' ).click(function(){
		$( '#dialog_form2' ).dialog( "open" );
	});
	$( '#dialog_form' ).dialog({
		autoOpen: false,
		width: 350,
		modal: true,
		position: {
			my: "left top",
			at: "left bottom",
			of: $( '#addggwleizu' )
		},
		show: {
			effect: "scale",
			duration: 400
		},
		hide: {
			effect: "clip",
			duration: 400
		},
		buttons: {
			"添加": function() {
				var chk = true,
				ggwleizuname = $( "#ggwleizuname" );
				ggwleizuname.removeClass( "ui-state-error" );
				chk = chk && checkRegexp( ggwleizuname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( 'editggwleizu.php', {
						menu: 'addleizu',
						ggwleizu: $( "input[name='ggwleizu']:checked" ).val(),
						name: ggwleizuname.val()
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，添加广告位类/组成功啦！' );
							location = location.href;
						} else if ( data.length > 200 ) {
							alert( '抱歉，您没有此功能权限，操作失败！' );
						} else {
							alert( data );
						}
						$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false );
					});
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	$( '#ggwleilist' ).change(function(){
		$( "#ggwleiname" ).val($( "#ggwleilist option:selected" ).val());
	});
	$( '#ggwzulist' ).change(function(){
		$( "#ggwzuname" ).val($( "#ggwzulist option:selected" ).val());
	});
	$( '#dialog_form1' ).dialog({
		autoOpen: false,
		width: 550,
		modal: true,
		position: {
			my: "right top",
			at: "right bottom",
			of: $( '#editggwleizu' )
		},
		show: {
			effect: "slide",
			duration: 400
		},
		hide: {
			effect: "size",
			duration: 400
		},
		buttons: {
			"修改": function() {
				if ( confirm('您确定修改吗?') ) {
					var chk = true,
					ggwleiname = $( "#ggwleiname" ),
					ggwzuname = $( "#ggwzuname" );
					allFields = $( [] ).add( ggwleiname ).add( ggwzuname );
					allFields.removeClass( "ui-state-error" );
					chk = chk && checkRegexp( ggwleiname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){0,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips1");
					chk = chk && checkRegexp( ggwzuname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){0,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips1");
					if ( chk ) {
						$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
						$.get( 'editggwleizu.php', {
							menu: 'editleizu',
							yggwlei: $( "#ggwleilist option:selected"  ).val(),
							xggwlei: ggwleiname.val(),
							yggwzu: $( "#ggwzulist option:selected"  ).val(),
							xggwzu: ggwzuname.val()
						},
						function( data ){
							if ( data == '1' ){
								alert( '恭喜你，修改广告位类/组成功啦！' );
								location = location.href;
							} else if ( data.length > 200 ) {
								alert( '抱歉，您没有此功能权限，操作失败！' );
							} else {
								alert( data );
							}
							$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false );
						});
					}
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	$( '#dialog_form2' ).dialog({
		autoOpen: false,
		width: 860,
		modal: true,
		position: {
			my: "right top",
			at: "right bottom",
			of: $( '#paidelggwleizu' )
		},
		show: {
			effect: "blind",
			duration: 400
		},
		hide: {
			effect: "bounce",
			duration: 400
		},
		buttons: {
			"更新": function() {
				if ( confirm('您确定要更新吗?') ) {
					var leiv = '', zuv = '';
					$( "#leisortable li.val" ).each(function(){
						leiv = leiv + $( this ).text() + "\r\n";
					});
					$( "#zusortable li.val" ).each(function(){
						zuv = zuv + $( this ).text() + "\r\n";
					});
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( 'editggwleizu.php', {
						menu: 'editdelleizu',
						leiv: leiv,
						zuv: zuv
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，排列/删除广告位类/组成功啦！' );
							location = location.href;
						} else if ( data.length > 200 ) {
							alert( '抱歉，您没有此功能权限，操作失败！' );
						} else {
							alert( data );
						}
						$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false );
					});
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	$( "#leisortable,#zusortable" ).sortable({
		placeholder: "ui-state-highlight"
    });
    $( "#leisortable,#zusortable" ).disableSelection();
	$( ".ui-icon-close" ).click(function() {
		$( this ).parent().removeClass( "val" ).hide( "drop" ,400 );
	});
	$( '.hqggwdm' ).click(function(){
		var element = $( this );
		$( '#dialog_form3' ).dialog( "option", "position", { my: "right top", at: "left top", of: element } ).dialog( "open" );
		$( "#ggwdm" ).val('<div class="'+element.attr("id")+'"><script charset="utf-8" language="JavaScript" type="text/javascript" src="<?php echo $amsurl.$datadir.'/'?>'+element.attr("id")+'.js"><\/script></div>').select();
	});
	$( '#dialog_form3' ).dialog({
		autoOpen: false,
		width: 470,
		show: {
			effect: "blind",
			duration: 400
		},
		hide: {
			effect: "size",
			duration: 400
		},
		focus: function() {
			$( "#ggwdm" ).select();
		},
		buttons: {
			"复制": function() {
				$( "#ggwdm" ).select();
				if ( window.clipboardData ) {
					var clipBoardContent = $( "#ggwdm" ).val(); 
					window.clipboardData.setData("Text", clipBoardContent);
					alert("复制成功！"); 
				} else {
					alert("抱歉，您的浏览器不支持，请按 Ctrl+C 复制！"); 
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
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
&nbsp;&nbsp;&nbsp;&nbsp;<a class="button" title="添加广告位." href="addggw.php">添加广告位</a>
<button type="button" class="button" id="delggw" title="删除选择的广告位.">删除广告位</button>
<a class="button" title="广告位回收站." href="ggwrecycle.php">广告位回收站</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" class="button" id="addggwleizu" title="添加广告位类/组.">添加广告位类/组</button>
<button type="button" class="button" id="editggwleizu" title="修改广告位类/组.">修改广告位类/组</button>
<button type="button" class="button" id="paidelggwleizu" title="排列/删除广告位类/组.">排列/删除广告位类/组</button>
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
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分组</th>
    <th class="ui-widget-header uith" scope="col">广告位名称（停留查看信息/点击预览）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">修改</th>
    <th class="ui-widget-header uith" scope="col" style="width: 8em;">获取代码</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;">尺寸</th>
    <th class="ui-widget-header uith" scope="col" style="width: 10em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">统计</th>
  </tr>
<?php echo $gglist ?>
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 1em;"><input type="checkbox" name="chk_all" class="chk_all" title="全选" /></th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分组</th>
    <th class="ui-widget-header uith" scope="col">广告位名称（停留查看信息/点击预览）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">修改</th>
    <th class="ui-widget-header uith" scope="col" style="width: 8em;">获取代码</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;">尺寸</th>
    <th class="ui-widget-header uith" scope="col" style="width: 10em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">统计</th>
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

<div id="dialog_form" title="添加广告位类/组：">
  <p class="cp" id="tips">不超过20个字母或数字或汉字或下划线。</p>
  <p style="text-align:center"><label title="自定义广告位分类"><input type="radio" name="ggwleizu" value="1" />类</label><label title="自定义广告位分组"><input type="radio" name="ggwleizu" value="2" checked />组</label> <input class="text ui-widget-content ui-corner-all" id="ggwleizuname" name="ggwleizuname" type="text" size="20" maxlength="20" value="" /></p>
</div>

<div id="dialog_form1" title="修改广告位类/组：">
  <p class="cp" id="tips1">不填表示不修改，修改不超过20个字母或数字或汉字或下划线。</p>
  <p class="cp" style="text-align:center">类：<select class="text ui-widget-content ui-corner-all" id="ggwleilist" name="ggwleilist"><?php echo $lei_list ?></select> 修改后名称：<input class="text ui-widget-content ui-corner-all" id="ggwleiname" name="ggwleiname" type="text" size="20" maxlength="20" value="" /></p>
  <p class="cp" style="text-align:center">组：<select class="text ui-widget-content ui-corner-all" id="ggwzulist" name="ggwzulist"><?php echo $zu_list ?></select> 修改后名称：<input class="text ui-widget-content ui-corner-all" id="ggwzuname" name="ggwzuname" type="text" size="20" maxlength="20" value="" /></p>
</div>

<div id="dialog_form2" title="排列/删除广告位类/组：">
  <p class="cp" id="tips2">点击<span class="ui-icon ui-icon-close" style="display:inline-block"></span>删除。可拖动排序。类和组不能混排序。</p>
  <div id="llist" class="cc ui-widget-content ui-corner-all">
  &nbsp;广告位类：
  <ul id="leisortable"><?php echo $leisortable ?></ul>
  </div>
  <div id="zlist" class="cc ui-widget-content ui-corner-all">
  &nbsp;广告位组：
  <ul id="zusortable"><?php echo $zusortable ?></ul>
  </div>
  <div class="clear"></div>
</div>
<div id="dialog_form3" title="获取广告位代码：">
  <p class="cp">广告位代码：复制粘贴此代码到页面即可播放广告 </p>
  <div class="cp">
  <textarea id="ggwdm" name="ggwdm" class="text ui-widget-content ui-corner-all"></textarea>
  </div>
</div>
<?php require 'mo.foot.php'; ?>