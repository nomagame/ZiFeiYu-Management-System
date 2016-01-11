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
define('NIUXAMS_ACCESS', 'listggcl');
require 'common.php';
$menu = $_REQUEST['menu'];
$desc = insql($_REQUEST['desc']);
$limit = insql($_REQUEST['limit']);
$page = insql($_REQUEST['page']);
$ggcllei = insql($_GET['ggcllei'] ? $_GET['ggcllei'] : ( $_POST['ggcllei'] ? $_POST['ggcllei'] : unescape($_COOKIE['ggcllei']) ));
$ggclzu = insql($_GET['ggclzu'] ? $_GET['ggclzu'] : ( $_POST['ggclzu'] ? $_POST['ggclzu'] : unescape($_COOKIE['ggclzu']) ));
$search = insql($_REQUEST['search']);
$desc = $desc ? '': 'DESC';
$limit = (is_numeric($limit) && ($limit>1)) ? $limit : 20;
$page = (is_numeric($page) && ($page>1)) ? $page : 1;
$ggcllei = ( $ggcllei=='' ) ? -1 : $ggcllei;
$ggclleil = file_get_contents( $datadir . '/ggclleilist.php' );
$ggclll = explode("\r\n", $ggclleil);
array_shift( $ggclll );
array_pop( $ggclll );
$ggclzu = ( $ggclzu=='' ) ? -1 : $ggclzu;
$ggclzul = file_get_contents( $datadir . '/ggclzulist.php' );
$ggclz = explode("\r\n", $ggclzul);
array_shift( $ggclz );
array_pop( $ggclz );
$content = file_get_contents( $datadir . '/ggcllist.php' );
$array = explode("\r\n", $content);
array_shift( $array );
array_pop( $array );
if( $desc ){ rsort( $array ); }else{ sort( $array ); }
$size = count( $array );
if( $page > ceil($size/$limit) ){ $page = ceil($size/$limit); }
///////////////////////////
if( $menu == 'ajax' ){
$ggwlx = (int)insql($_REQUEST['ggwlx']);
$j = 0; $gglist = '';
for($i=0; $i<$size; $i++){
	$gid = $array[$i];
	if( $gid ){
		$Serialnumber = $desc ? $size - $i : $i + 1;
		$ggd = file_get_contents($datadir . '/' . $gid . '.php');
		$arrayd = array();
		$arrayd = explode("\r\n", $ggd);
		array_shift( $arrayd );
		if(($ggwlx==0 && $arrayd[3]) || ($ggwlx && $arrayd[3]==2)){
			if($search=='' || ($search && (strpos(unescape($arrayd[1]),unescape($search)) !== false || strpos($gid,unescape($search)) !== false))){
				if($arrayd[31]==$ggcllei || $ggcllei==-1){
					if($arrayd[30]==$ggclzu || $ggclzu==-1){
						$j++;
						if(ceil($j/$limit)==$page){
							if($arrayd[3]==1){$class='固定';}else{$class='非固定';}
							$pattern = '|(, )(.+?)(\. )|is';
							$tfgg = '包含广告：'."\r\n".preg_replace($pattern, "\r\n", $arrayd[5]);
							if($arrayd[9] || ($arrayd[10]&&$arrayd[11]) || ($arrayd[12]&&$arrayd[13])){$tfgg .= "时间条件：√\r\n";}
							if($arrayd[15]){$tfgg .= "操作系统条件：√\r\n";}
							if($arrayd[17]){$tfgg .= "分辨率条件：√\r\n";}
							if($arrayd[19]){$tfgg .= "浏览器条件：√\r\n";}
							if($arrayd[21]){$tfgg .= "语言条件：√\r\n";}
							if($arrayd[23]){$tfgg .= "来源条件：√\r\n";}
							if($arrayd[25]){$tfgg .= "网址条件：√\r\n";}
							if($arrayd[27]){$tfgg .= "地域条件：√\r\n";}
							if($arrayd[29]){$tfgg .= "接入条件：√\r\n";}
							if($arrayd[31]){$tfgg .= "策略分类：".$arrayd[31]."\r\n";}
							if($arrayd[30]){$tfgg .= "策略分组：".$arrayd[30]."\r\n";}
							$tfgg.="策略描述说明：";
							$gglist .= '<tr class="list">';
							$gglist .= '<td class="ui-widget-content uitd ct"><button type="button" class="button selectggcl" title="'.$gid.'" value="'.$gid.'">选择</button></td>';
							$gglist .= '<td class="ui-widget-content uitd ct">'.$Serialnumber.'</td>';
							$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[31]).'">'.htmlspecialchars(cutstr($arrayd[31],6)).'</span></td>';
							$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[30]).'">'.htmlspecialchars(cutstr($arrayd[30],6)).'</span></td>';
							$gglist .= '<td class="ui-widget-content uitd pl"><a href="editggcl.php?gid='.$gid.'" title="'.$tfgg.htmlspecialchars(cutstr(unescape($arrayd[2]),3000)).'" target="_blank">'.htmlspecialchars(cutstr(unescape($arrayd[1]),38)).'</a></td>';
							$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[4].'</td>';
							$gglist .= '<td class="ui-widget-content uitd ct">'.$class.'</td>';
							$gglist .= '</tr>';
						}
					}
				}
			}
		}
	}
}
$size = $j;
if($page>ceil($size/$limit)){$page=ceil($size/$limit);}

$lei_list = '';
foreach($ggclll as $key=>$value){
	if($value){
		if($value == $ggcllei){
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$zu_list = '';
foreach($ggclz as $key=>$value){
	if($value){
		if($value == $ggclzu){
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$qpage = ($page>1) ? ($page-1) : $page;
$hpage = ($page<ceil($size/$limit)) ? ($page+1) : $page;
$listdh='<input id="searchcl" name="searchcl" type="text" value="'.unescape($search).'" class="text ui-widget-content ui-corner-all" /><button type="button" id="searchggcl" class="button">搜索</button> <label title="列表升序排列，小到大"><input type="radio" id="cldesc_1" name="cldesc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" id="cldesc_0" name="cldesc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$nav = '&nbsp;共<strong>'.$size.'</strong>个 <strong>'.$limit.'</strong>个/页 第<strong>'.$page.'</strong>页/共<strong>'.ceil($size/$limit).'</strong>页 <button type="button" id="ggclksy" class="button">首页</button><button type="button" id="clqpage" class="button" value="'.$qpage.'">上页</button><button type="button" id="clhpage" class="button" value="'.$hpage.'">下页</button><button type="button" id="ggclzhy" class="button" value="'.ceil($size/$limit).'">尾页</button>';
?>
<div class="ui-widget-content ui-corner-top" style="border-bottom-width:0; padding:.2em .2em;">
<?php echo $nav ?> <label>类<select class="ggcllei text ui-widget-content ui-corner-all" id="ggcllei" name="ggcllei"><option value="-1">所有广告策略</option><?php echo $lei_list ?></select></label> <label>组<select class="ggclzu text ui-widget-content ui-corner-all" id="ggclzu" name="ggclzu"><option value="-1">所有广告策略</option><?php echo $zu_list ?></select></label>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">选择</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">分组</th>
    <th class="ui-widget-header uith" scope="col" style="width: 29.4em;">广告策略名称（停留查看信息/点击修改）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">权重</th>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;">类型</th>
  </tr>
<?php echo $gglist ?>
</table>

<div class="ui-widget-content ui-corner-bottom" style="border-top-width:0; padding:.2em .2em;">
<?php echo $listdh ?> <button type="button" id="syggclsy" class="button" title="返回所有广告策略首页"><span class="ui-icon ui-icon-home"></span></button> <input id="clpage" name="clpage" type="hidden" value="<?php echo $page ?>" /><input id="ggwclass" name="ggwclass" type="hidden" value="<?php echo $ggwlx ?>" />
</div>

<?php
exit;
}
///////////////////////////
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
			if($arrayd[31]==$ggcllei || $ggcllei==-1){
				if($arrayd[30]==$ggclzu || $ggclzu==-1){
					$j++;
					if(ceil($j/$limit)==$page){
						if($arrayd[3]==1){$class='固定占位';}else{$class='非固定占位';}
						$pattern = '|(, )(.+?)(\. )|is';
						$tfgg = '包含广告：'."\r\n".preg_replace($pattern, "\r\n", $arrayd[5]);
						if($arrayd[9] || ($arrayd[10]&&$arrayd[11]) || ($arrayd[12]&&$arrayd[13])){$tfgg .= "时间条件：√\r\n";}
						if($arrayd[15]){$tfgg .= "操作系统条件：√\r\n";}
						if($arrayd[17]){$tfgg .= "分辨率条件：√\r\n";}
						if($arrayd[19]){$tfgg .= "浏览器条件：√\r\n";}
						if($arrayd[21]){$tfgg .= "语言条件：√\r\n";}
						if($arrayd[23]){$tfgg .= "来源条件：√\r\n";}
						if($arrayd[25]){$tfgg .= "网址条件：√\r\n";}
						if($arrayd[27]){$tfgg .= "地域条件：√\r\n";}
						if($arrayd[29]){$tfgg .= "接入条件：√\r\n";}
						if($arrayd[31]){$tfgg .= "策略分类：".$arrayd[31]."\r\n";}
						if($arrayd[30]){$tfgg .= "策略分组：".$arrayd[30]."\r\n";}
						$tfgg.="策略描述说明：";
						$gglist .= '<tr class="list">';
						$gglist .= '<td class="ui-widget-content uitd ct"><input type="checkbox" name="chk_list" value="'.$gid.'" /></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$Serialnumber.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[31]).'">'.htmlspecialchars(cutstr($arrayd[31],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[30]).'">'.htmlspecialchars(cutstr($arrayd[30],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd pl"><a href="editggcl.php?gid='.$gid.'" title="'.$tfgg.htmlspecialchars(cutstr(unescape($arrayd[2]),3000)).'">'.htmlspecialchars(cutstr(unescape($arrayd[1]),38)).'</a></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[4].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$class.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[0].'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$gid.'</td>';
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
foreach($ggclll as $key=>$value){
	if($value){
		if($value == $ggcllei){
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
		$leisortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此类"></span>'.htmlspecialchars($value).'</li>';
	}
}
$zu_list = '';
$zusortable = '';
foreach($ggclz as $key=>$value){
	if($value){
		if($value == $ggclzu){
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
		$zusortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此组"></span>'.htmlspecialchars($value).'</li>';
	}
}
$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'listggcl.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&ggcllei='.urlencode($ggcllei).'&ggclzu='.urlencode($ggclzu).'&search='.urlencode(unescape($search)).'&page=';
$fenye = new fenye($size,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label>搜索<input class="search ui-widget-content" name="search" type="text" title="输入搜索内容，按回车或失去焦点" value="'.htmlspecialchars(unescape($search)).'" /></label> <label>分类<select class="ggcllei ui-widget-content" name="ggcllei"><option value="-1">所有广告策略</option>'.$lei_list.'</select></label> <label>分组<select class="ggclzu ui-widget-content" name="ggclzu"><option value="-1">所有广告策略</option>'.$zu_list.'</select></label> <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$title = '广告策略管理';
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
	$( '.ggcllei' ).change(function(){setCookie('ggcllei', $(this).val(), 120, '/');$(this).parent().parent().submit();});
	$( '.ggclzu' ).change(function(){setCookie('ggclzu', $(this).val(), 120, '/');$(this).parent().parent().submit();});
	$( '.chk_all' ).click(function(){if(this.checked){$("input[type='checkbox']").each(function(){this.checked=true;});}else{$("input[type='checkbox']").each(function(){this.checked=false;});}});
	$( 'td' ).hover(function(){$( this ).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '#delggcl' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("删除即刻生效！您确定要删除所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delggcl.php',
					data: {menu:'delggcl', gids:gids},
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
	$( '#addggclleizu' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( '#editggclleizu' ).click(function(){
		$( '#dialog_form1' ).dialog( "open" );
	});
	$( '#paidelggclleizu' ).click(function(){
		$( '#dialog_form2' ).dialog( "open" );
	});
	$( '#dialog_form' ).dialog({
		autoOpen: false,
		width: 350,
		modal: true,
		position: {
			my: "left top",
			at: "left bottom",
			of: $( '#addggclleizu' )
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
				ggclleizuname = $( "#ggclleizuname" );
				ggclleizuname.removeClass( "ui-state-error" );
				chk = chk && checkRegexp( ggclleizuname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( 'editggclleizu.php', {
						menu: 'addleizu',
						ggclleizu: $( "input[name='ggclleizu']:checked" ).val(),
						name: ggclleizuname.val()
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，添加广告策略类/组成功啦！' );
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
	$( '#ggclleilist' ).change(function(){
		$( "#ggclleiname" ).val($( "#ggclleilist option:selected" ).val());
	});
	$( '#ggclzulist' ).change(function(){
		$( "#ggclzuname" ).val($( "#ggclzulist option:selected" ).val());
	});
	$( '#dialog_form1' ).dialog({
		autoOpen: false,
		width: 550,
		modal: true,
		position: {
			my: "right top",
			at: "right bottom",
			of: $( '#editggclleizu' )
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
					ggclleiname = $( "#ggclleiname" ),
					ggclzuname = $( "#ggclzuname" );
					allFields = $( [] ).add( ggclleiname ).add( ggclzuname );
					allFields.removeClass( "ui-state-error" );
					chk = chk && checkRegexp( ggclleiname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){0,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips1");
					chk = chk && checkRegexp( ggclzuname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){0,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips1");
					if ( chk ) {
						$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
						$.get( 'editggclleizu.php', {
							menu: 'editleizu',
							yggcllei: $( "#ggclleilist option:selected"  ).val(),
							xggcllei: ggclleiname.val(),
							yggclzu: $( "#ggclzulist option:selected"  ).val(),
							xggclzu: ggclzuname.val()
						},
						function( data ){
							if ( data == '1' ){
								alert( '恭喜你，修改广告策略类/组成功啦！' );
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
			of: $( '#paidelggclleizu' )
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
					$.get( 'editggclleizu.php', {
						menu: 'editdelleizu',
						leiv: leiv,
						zuv: zuv
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，排列/删除广告策略类/组成功啦！' );
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
&nbsp;&nbsp;&nbsp;&nbsp;<a class="button" title="添加广告策略." href="addggcl.php">添加广告策略</a>
<button type="button" class="button" id="delggcl" title="删除选择的广告策略.">删除策略</button>
<a class="button" title="广告策略回收站." href="ggclrecycle.php">策略回收站</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" class="button" id="addggclleizu" title="添加广告策略类/组.">添加策略类/组</button>
<button type="button" class="button" id="editggclleizu" title="修改广告策略类/组.">修改策略类/组</button>
<button type="button" class="button" id="paidelggclleizu" title="排列/删除广告策略类/组.">排列/删除策略类/组</button>
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
    <th class="ui-widget-header uith" scope="col">广告策略名称（停留查看信息/点击修改）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">权重</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">策略类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 11em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 14em;">GID</th>
  </tr>
<?php echo $gglist ?>
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 1em;"><input type="checkbox" name="chk_all" class="chk_all" title="全选" /></th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 6em;">自定义分组</th>
    <th class="ui-widget-header uith" scope="col">广告策略名称（停留查看信息/点击修改）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">权重</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">策略类型</th>
    <th class="ui-widget-header uith" scope="col" style="width: 11em;">添加时间</th>
    <th class="ui-widget-header uith" scope="col" style="width: 14em;">GID</th>
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

<div id="dialog_form" title="添加广告策略类/组：">
  <p class="cp" id="tips">不超过20个字母或数字或汉字或下划线。</p>
  <p style="text-align:center"><label title="自定义广告策略分类"><input type="radio" name="ggclleizu" value="1" />类</label><label title="自定义广告策略分组"><input type="radio" name="ggclleizu" value="2" checked />组</label> <input class="text ui-widget-content ui-corner-all" id="ggclleizuname" name="ggclleizuname" type="text" size="20" maxlength="20" value="" /></p>
</div>

<div id="dialog_form1" title="修改广告策略类/组：">
  <p class="cp" id="tips1">不填表示不修改，修改不超过20个字母或数字或汉字或下划线。</p>
  <p class="cp" style="text-align:center">类：<select class="text ui-widget-content ui-corner-all" id="ggclleilist" name="ggclleilist"><?php echo $lei_list ?></select> 修改后名称：<input class="text ui-widget-content ui-corner-all" id="ggclleiname" name="ggclleiname" type="text" size="20" maxlength="20" value="" /></p>
  <p class="cp" style="text-align:center">组：<select class="text ui-widget-content ui-corner-all" id="ggclzulist" name="ggclzulist"><?php echo $zu_list ?></select> 修改后名称：<input class="text ui-widget-content ui-corner-all" id="ggclzuname" name="ggclzuname" type="text" size="20" maxlength="20" value="" /></p>
</div>

<div id="dialog_form2" title="排列/删除广告策略类/组：">
  <p class="cp" id="tips2">点击<span class="ui-icon ui-icon-close" style="display:inline-block"></span>删除。可拖动排序。类和组不能混排序。</p>
  <div id="llist" class="cc ui-widget-content ui-corner-all">
  &nbsp;广告策略类：
  <ul id="leisortable"><?php echo $leisortable ?></ul>
  </div>
  <div id="zlist" class="cc ui-widget-content ui-corner-all">
  &nbsp;广告策略组：
  <ul id="zusortable"><?php echo $zusortable ?></ul>
  </div>
  <div class="clear"></div>
</div>
<?php require 'mo.foot.php'; ?>