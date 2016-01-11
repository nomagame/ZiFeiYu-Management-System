<?php

define('NIUXAMS_ACCESS', 'listgg');
require 'common.php';
$menu = $_REQUEST['menu'];
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
$content = file_get_contents( $datadir . '/gglist.php' );
$array = explode("\r\n", $content);
array_shift( $array );
array_pop( $array );
if( $desc ){ rsort( $array ); }else{ sort( $array ); }
$size = count( $array );
if( $page > ceil($size/$limit) ){ $page = ceil($size/$limit); }
///////////////////////////
if( $menu == 'ajax' ){
$wllx = (int)insql($_REQUEST['wllx']);
$j = 0; $gglist = '';
for($i=0; $i<$size; $i++){
	$gid = $array[$i];
	if( $gid ){
		$Serialnumber = $desc ? $size - $i : $i + 1;
		$ggd = file_get_contents($datadir . '/' . $gid . '.php');
		$arrayd = array();
		$arrayd = explode("\r\n", $ggd);
		array_shift( $arrayd );
		if(($wllx==0 && $arrayd[2]==0)||($wllx && $arrayd[2])){
			if($search=='' || ($search && (strpos(unescape($arrayd[0]),unescape($search)) !== false || strpos($gid,unescape($search)) !== false))){
				if($arrayd[9]==$gglei || $gglei==-1){
					if($arrayd[6]==$ggzu || $ggzu==-1){
						$j++;
						if(ceil($j/$limit) == $page){
							if($arrayd[2]==0){$class='固定';}else if($arrayd[2]==1){$class='漂浮';}else{$class='弹窗';}
							if($arrayd[3]==''){$arrayd[3]='-';}
							if($arrayd[4]==''){$arrayd[4]='-';}
							if(!$arrayd[8]){$jfclass='其他';}else if($arrayd[8]==1){$jfclass='CPM';}else if($arrayd[8]==2){$jfclass='CPC';}else if($arrayd[8]==3){$jfclass='CPA';}else if($arrayd[8]==4){$jfclass='CPS';}else if($arrayd[8]==5){$jfclass='CPT';}
							$gglist .= '<tr class="list">';
							$gglist .= '<td class="ui-widget-content uitd ct"><button type="button" class="button selectgg" title="'.$gid.'" value="'.$gid.'">选择</button></td>';
							$gglist .= '<td class="ui-widget-content uitd ct">'.$Serialnumber.'</td>';
							$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[9]).'">'.htmlspecialchars(cutstr($arrayd[9],6)).'</span></td>';
							$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[6]).'">'.htmlspecialchars(cutstr($arrayd[6],6)).'</span></td>';
							$gglist .= '<td class="ui-widget-content uitd pl"><a href="previewgg.php?gid='.$gid.'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayd[1]),3000)).'">'.htmlspecialchars(cutstr(unescape($arrayd[0]),22)).'</a></td>';
							$gglist .= '<td class="ui-widget-content uitd ct"><a href="editgg.php?gid='.$gid.'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayd[0]),255)).'">修改</a></td>';
							$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars(cutstr(unescape($arrayd[1]),9000)).'" class="previewgg">'.$class.'</span></td>';
							$gglist .= '<td class="ui-widget-content uitd ct">'.$jfclass.'</td>';
							$gglist .= '<td class="ui-widget-content uitd ct">'.$arrayd[3].'&times;'.$arrayd[4].'</td>';
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

$qpage = ($page>1) ? ($page-1) : $page;
$hpage = ($page<ceil($size/$limit)) ? ($page+1) : $page;
$listdh='<input id="search" name="search" type="text" value="'.unescape($search).'" class="text ui-widget-content ui-corner-all" /><button type="button" id="searchgg" class="button">搜索</button> <label title="列表升序排列，小到大"><input type="radio" id="desc_1" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" id="desc_0" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$nav = '&nbsp;共<strong>'.$size.'</strong>个 <strong>'.$limit.'</strong>个/页 第<strong>'.$page.'</strong>页/共<strong>'.ceil($size/$limit).'</strong>页 <button type="button" id="ggksy" class="button">首页</button><button type="button" id="qpage" class="button" value="'.$qpage.'">上页</button><button type="button" id="hpage" class="button" value="'.$hpage.'">下页</button><button type="button" id="ggzhy" class="button" value="'.ceil($size/$limit).'">尾页</button>';
?>
<div class="ui-widget-content ui-corner-top" style="border-bottom-width:0; padding:.2em .2em;">
<?php echo $nav ?> <label>类<select class="gglei text ui-widget-content ui-corner-all" id="gglei" name="gglei"><option value="-1">所有广告</option><?php echo $lei_list ?></select></label> <label>组<select class="ggzu text ui-widget-content ui-corner-all" id="ggzu" name="ggzu"><option value="-1">所有广告</option><?php echo $zu_list ?></select></label>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width: 4em;">选择</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">编号</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">分类</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">分组</th>
    <th class="ui-widget-header uith" scope="col" style="width: 18em;">广告名称（点击预览）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">修改</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">展现</th>
    <th class="ui-widget-header uith" scope="col" style="width: 2.6em;">计费</th>
    <th class="ui-widget-header uith" scope="col" style="width: 5em;">展示尺寸</th>
  </tr>
<?php echo $gglist ?>
</table>

<div class="ui-widget-content ui-corner-bottom" style="border-top-width:0; padding:.2em .2em;">
<?php echo $listdh ?> <button type="button" id="syggsy" class="button" title="返回所有广告首页"><span class="ui-icon ui-icon-home"></span></button> <input id="page" name="page" type="hidden" value="<?php echo $page ?>" /><input id="ggclass" name="ggclass" type="hidden" value="<?php echo $wllx ?>" />
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
		if($search=='' || ($search && (strpos(unescape($arrayd[0]),unescape($search)) !== false || strpos($gid,unescape($search)) !== false))){
			if($arrayd[9]==$gglei || $gglei==-1){
				if($arrayd[6]==$ggzu || $ggzu==-1){
					$j++;
					if(ceil($j/$limit) == $page){
						if($arrayd[2]==0){$class='固定';}else if($arrayd[2]==1){$class='漂浮';}else{$class='弹窗';}
						if($arrayd[3]==''){$arrayd[3]='-';}
						if($arrayd[4]==''){$arrayd[4]='-';}
						if(!$arrayd[8]){$jfclass='其他';}else if($arrayd[8]==1){$jfclass='CPM';}else if($arrayd[8]==2){$jfclass='CPC';}else if($arrayd[8]==3){$jfclass='CPA';}else if($arrayd[8]==4){$jfclass='CPS';}else if($arrayd[8]==5){$jfclass='CPT';}
						$gglist .= '<tr class="list">';
						$gglist .= '<td class="ui-widget-content uitd ct"><input type="checkbox" name="chk_list" value="'.$gid.'" /></td>';
						$gglist .= '<td class="ui-widget-content uitd ct">'.$Serialnumber.'</td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[9]).'">'.htmlspecialchars(cutstr($arrayd[9],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayd[6]).'">'.htmlspecialchars(cutstr($arrayd[6],8)).'</span></td>';
						$gglist .= '<td class="ui-widget-content uitd pl"><a href="previewgg.php?gid='.$gid.'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayd[1]),3000)).'">'.htmlspecialchars(cutstr(unescape($arrayd[0]),38)).'</a></td>';
						$gglist .= '<td class="ui-widget-content uitd ct"><a href="editgg.php?gid='.$gid.'" title="'.htmlspecialchars(cutstr(unescape($arrayd[0]),255)).'">修改</a></td>';
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
$leisortable = '';
foreach($ggll as $key=>$value){
	if($value){
		if($value == $gglei){
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$lei_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
		$leisortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此类"></span>'.htmlspecialchars($value).'</li>';
	}
}
$zu_list = '';
$zusortable = '';
foreach($ggz as $key=>$value){
	if($value){
		if($value == $ggzu){
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$zu_list .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
		$zusortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此组"></span>'.htmlspecialchars($value).'</li>';
	}
}
$sub_pages = $page < 1000 ? 10 : ($page < 10000 ? 7 : 5);
$subpageurl = 'listgg.php?desc='.$_REQUEST['desc'].'&limit='.$limit.'&gglei='.urlencode($gglei).'&ggzu='.urlencode($ggzu).'&search='.urlencode(unescape($search)).'&page=';
$fenye = new fenye($size,$limit,$page,$sub_pages,$subpageurl,1);
$nav = $fenye->jieguo.' <label>搜索<input class="search ui-widget-content" name="search" type="text" title="输入搜索内容，按回车或失去焦点" value="'.htmlspecialchars(unescape($search)).'" /></label> <label>分类<select class="gglei ui-widget-content" name="gglei"><option value="-1">所有广告</option>'.$lei_list.'</select></label> <label>分组<select class="ggzu ui-widget-content" name="ggzu"><option value="-1">所有广告</option>'.$zu_list.'</select></label> <label title="列表升序排列，小到大"><input type="radio" name="desc" value="1"'.($desc ? '' : ' checked="checked"').' />升序</label><label title="列表降序排列，大到小"><input type="radio" name="desc" value="0"'.($desc ? ' checked="checked"' : '').' />降序</label>';

$title = '广告管理';
require 'mo.head.php';
?>
<style>
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
	max-width: 2000px;
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
	$( '.gglei' ).change(function(){setCookie('gglei', $(this).val(), 120, '/');$(this).parent().parent().submit();});
	$( '.ggzu' ).change(function(){setCookie('ggzu', $(this).val(), 120, '/');$(this).parent().parent().submit();});
	$( '.chk_all' ).click(function(){if(this.checked){$("input[type='checkbox']").each(function(){this.checked=true;});}else{$("input[type='checkbox']").each(function(){this.checked=false;});}});
	$( 'td' ).hover(function(){$( this ).parent().children( 'td' ).toggleClass( "ui-state-highlight" ).css({ "border-top-width" : 0, "border-left-width" : 0 });});
	$( '#delgg' ).click(function(){
		var gids = '';
		$( "input[name='chk_list']:checked" ).each(function(){gids = gids + this.value + " ";});
		if( gids ){
			if(confirm("删除即刻生效！您确定要删除所选吗？")){
				$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
				$.ajax({
					type: "POST",
					url: 'delgg.php',
					data: {menu:'delgg', gids:gids},
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
	$( '#addggleizu' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( '#editggleizu' ).click(function(){
		$( '#dialog_form1' ).dialog( "open" );
	});
	$( '#paidelggleizu' ).click(function(){
		$( '#dialog_form2' ).dialog( "open" );
	});
	$( '#dialog_form' ).dialog({
		autoOpen: false,
		width: 350,
		modal: true,
		position: {
			my: "left top",
			at: "left bottom",
			of: $( '#addggleizu' )
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
				ggleizuname = $( "#ggleizuname" );
				ggleizuname.removeClass( "ui-state-error" );
				chk = chk && checkRegexp( ggleizuname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( 'editggleizu.php', {
						menu: 'addleizu',
						ggleizu: $( "input[name='ggleizu']:checked" ).val(),
						name: ggleizuname.val()
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，添加广告类/组成功啦！' );
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
	$( '#ggleilist' ).change(function(){
		$( "#ggleiname" ).val($( "#ggleilist option:selected" ).val());
	});
	$( '#ggzulist' ).change(function(){
		$( "#ggzuname" ).val($( "#ggzulist option:selected" ).val());
	});
	$( '#dialog_form1' ).dialog({
		autoOpen: false,
		width: 550,
		modal: true,
		position: {
			my: "right top",
			at: "right bottom",
			of: $( '#editggleizu' )
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
					ggleiname = $( "#ggleiname" ),
					ggzuname = $( "#ggzuname" );
					allFields = $( [] ).add( ggleiname ).add( ggzuname );
					allFields.removeClass( "ui-state-error" );
					chk = chk && checkRegexp( ggleiname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){0,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips1");
					chk = chk && checkRegexp( ggzuname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){0,20}$/, "不超过20个字母或数字或汉字或下划线", "#tips1");
					if ( chk ) {
						$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
						$.get( 'editggleizu.php', {
							menu: 'editleizu',
							ygglei: $( "#ggleilist option:selected"  ).val(),
							xgglei: ggleiname.val(),
							yggzu: $( "#ggzulist option:selected"  ).val(),
							xggzu: ggzuname.val()
						},
						function( data ){
							if ( data == '1' ){
								alert( '恭喜你，修改广告类/组成功啦！' );
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
			of: $( '#paidelggleizu' )
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
					$.get( 'editggleizu.php', {
						menu: 'editdelleizu',
						leiv: leiv,
						zuv: zuv
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，排列/删除广告类/组成功啦！' );
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
&nbsp;&nbsp;&nbsp;&nbsp;<a class="button" title="添加广告." href="addgg.php">添加广告</a>
<button type="button" class="button" id="delgg" title="删除选择的广告.">删除广告</button>
<a class="button" title="广告回收站." href="ggrecycle.php">广告回收站</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" class="button" id="addggleizu" title="添加广告类/组.">添加广告类/组</button>
<button type="button" class="button" id="editggleizu" title="修改广告类/组.">修改广告类/组</button>
<button type="button" class="button" id="paidelggleizu" title="排列/删除广告类/组.">排列/删除广告类/组</button>
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
    <th class="ui-widget-header uith" scope="col">广告名称（停留查看代码/点击预览）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">修改</th>
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
    <th class="ui-widget-header uith" scope="col">广告名称（停留查看代码/点击预览）</th>
    <th class="ui-widget-header uith" scope="col" style="width: 3em;">修改</th>
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

<div id="dialog_form" title="添加广告类/组：">
  <p class="cp" id="tips">不超过20个字母或数字或汉字或下划线。</p>
  <p style="text-align:center"><label title="自定义广告分类"><input type="radio" name="ggleizu" value="1" />类</label><label title="自定义广告分组"><input type="radio" name="ggleizu" value="2" checked />组</label> <input class="text ui-widget-content ui-corner-all" id="ggleizuname" name="ggleizuname" type="text" size="20" maxlength="20" value="" /></p>
</div>

<div id="dialog_form1" title="修改广告类/组：">
  <p class="cp" id="tips1">不填表示不修改，修改不超过20个字母或数字或汉字或下划线。</p>
  <p class="cp" style="text-align:center">类：<select class="text ui-widget-content ui-corner-all" id="ggleilist" name="ggleilist"><?php echo $lei_list ?></select> 修改后名称：<input class="text ui-widget-content ui-corner-all" id="ggleiname" name="ggleiname" type="text" size="20" maxlength="20" value="" /></p>
  <p class="cp" style="text-align:center">组：<select class="text ui-widget-content ui-corner-all" id="ggzulist" name="ggzulist"><?php echo $zu_list ?></select> 修改后名称：<input class="text ui-widget-content ui-corner-all" id="ggzuname" name="ggzuname" type="text" size="20" maxlength="20" value="" /></p>
</div>

<div id="dialog_form2" title="排列/删除广告类/组：">
  <p class="cp" id="tips2">点击<span class="ui-icon ui-icon-close" style="display:inline-block"></span>删除。可拖动排序。类和组不能混排序。</p>
  <div id="llist" class="cc ui-widget-content ui-corner-all">
  &nbsp;广告类：
  <ul id="leisortable"><?php echo $leisortable ?></ul>
  </div>
  <div id="zlist" class="cc ui-widget-content ui-corner-all">
  &nbsp;广告组：
  <ul id="zusortable"><?php echo $zusortable ?></ul>
  </div>
  <div class="clear"></div>
</div>
<?php require 'mo.foot.php'; ?>