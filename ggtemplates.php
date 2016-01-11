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
if ( $_REQUEST['menu'] == 'getmbcon' ){
require 'common.php';
$selectggmb = htmlspecialchars(insql($_REQUEST['selectggmb']));
if( $selectggmb && file_exists($datadir . '/' . $selectggmb . '.php') ){
	$mbnr = file($datadir . '/' . $selectggmb . '.php');
	array_shift($mbnr);
	$mbnr[0] = rtrim($mbnr[0]);
	$mbnr[1] = rtrim($mbnr[1]);
	die(json_encode(array("title"=>"$mbnr[0]","content"=>"$mbnr[1]")));
}
die('无法读取选择的广告模板！');
}
////////////////////////
define('NIUXAMS_ACCESS', 'ggtemplates');
require 'common.php';
if ( $_REQUEST['menu'] == 'addmb' ){
$nmbn = htmlspecialchars(insql($_REQUEST['nmbn']));
$nmbdm = htmlspecialchars(insql($_REQUEST['nmbdm']));
if ( $nmbn == '' ) {
	die('名称为空！');
}
$ontid = date("YmdHis",time());
$path = $datadir . '/' . $ontid . '.php';
$ggmbcon = '<?php exit();?>'."\r\n".$nmbn."\r\n".$nmbdm."\r\n";
file_put_contents($path, $ggmbcon) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');

$path1 = $datadir . '/ggtemplist.php';
$ggmblist = file( $path1 );
if( !is_array($ggmblist) ){ $ggmblist[] = ''; }
array_shift( $ggmblist );
array_unshift($ggmblist, $ontid."\r\n");
array_unshift($ggmblist, '<?php exit();?>'."\r\n");
file_put_contents($path1, $ggmblist) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');

$conn = new mysql();
$conn->inoplog('新建广告模板', $ontid, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'editmb' ){
/////////////////////
$selectggmb = htmlspecialchars(insql($_REQUEST['selectggmb']));
$embn = htmlspecialchars(insql($_REQUEST['embn']));
$embdm = htmlspecialchars(insql($_REQUEST['embdm']));
if ( $embn == '' ) {
	die('名称为空！');
}
if( !file_exists($datadir . '/' . $selectggmb . '.php') ){
	die('编辑的模板不存在！');
}
$path = $datadir . '/' . $selectggmb . '.php';
$ggmbcon = '<?php exit();?>'."\r\n".$embn."\r\n".$embdm."\r\n";
file_put_contents($path, $ggmbcon) or die('出错啦！无法修改.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');

$conn = new mysql();
$conn->inoplog('修改广告模板', $selectggmb, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'delggmb' ){
/////////////////////
$selectggmb = htmlspecialchars(insql($_REQUEST['selectggmb']));
$path = $datadir . '/' . $selectggmb . '.php';
if( !$selectggmb && !file_exists($path) ){
	die('无法删除选择的广告模板！');
}
unlink( $path ) or die($selectggmb.'.php删除错误！');
$path1 = $datadir . '/ggtemplist.php';
$ggtl = file_get_contents( $path1 );
$ggtl = str_replace($selectggmb."\r\n", '', $ggtl);
file_put_contents( $path1 , $ggtl ) or die('出错啦！无法修改.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('删除广告模板', $selectggmb, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'renewitem' ){
/////////////////////
$itemlist = htmlspecialchars(insql($_REQUEST['itemlist']));
$path1 = $datadir . '/ggtemplist.php';
$ggtl = '<?php exit();?>'."\r\n".$itemlist;
file_put_contents( $path1 , $ggtl ) or die('出错啦！无法修改.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('排序广告模板', $itemlist, 1, getname());
die('1');
/////////////////////
} else {
/////////////////////
$ggtl = file_get_contents( $datadir . '/ggtemplist.php' );
$ggtla = explode("\r\n", $ggtl);
array_shift( $ggtla );
array_pop( $ggtla );
$ggtemp_list = '';
$ggtemp_sortable = '';
foreach($ggtla as $key=>$value){
	if( $value && file_exists($datadir . '/' . $value . '.php') ){
		$mbnr = file($datadir . '/' . $value . '.php');
		array_shift($mbnr);
		$mbsm = htmlspecialchars(rtrim(array_shift($mbnr)));
		$ggtemp_list .= '<option value="'.$value.'" title="'.htmlspecialchars($mbsm).'">'.htmlspecialchars(cutstr($mbsm,10)).'</option>';
		$ggtemp_sortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span>'.htmlspecialchars($mbsm).'<input name="val" type="hidden" value="'.htmlspecialchars($value).'" /></li>';
	}
}
$title = '广告模板管理';
require 'mo.head.php';
?>
<style>
label.tip {
	display:inline-block;
	width:34%;
	text-align:right;
}
td.left {
	width:8em;
	text-align:right;
}
input.text,select.text,textarea.text {
	padding: .3em;
	font-size: 1em;
}
.tips {
	padding:.4em 1em;
}
.mbdm{
	width: 450px;
	height: 200px;
}
#ggtemp_sortable li {
	position: relative;
	margin: 0 3px 3px 3px;
	padding: 0.4em;
	padding-left: 1.3em;
	height: 18px;
}
#ggtemp_sortable li span {
	position: absolute;
	margin-left: -1.2em;
}
</style>
<script type="text/javascript">
$(function() {
	$( '#addbutton' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( '#dialog_form' ).dialog({
		autoOpen: false,
		width: 650,
		modal: true,
		show: {
			effect: "explode",
			duration: 400
		},
		hide: {
			effect: "bounce",
			duration: 400
		},
		buttons: {
			"新建": function() {
				var chk = true,
				nmbn = $( "#nmbn" ),
				nmbdm = $( "#nmbdm" ),
				allFields = $( [] ).add( nmbn ).add( nmbdm );
				allFields.removeClass( "ui-state-error" );
				chk = chk && checkLength( nmbn, "", 1, 20);
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.post( location.href, {
						menu: 'addmb',
						nmbn: nmbn.val(),
						nmbdm: escape(nmbdm.val())
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，新增广告模板成功啦！' );
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
	$( '#editbutton' ).click(function(){
		$( this ).addClass( "ui-state-error ").attr( "disabled" , true );
		$.post( location.href, {
			menu: 'getmbcon',
			selectggmb: $( '#selectggmb' ).val()
		},
		function( data ){
			var dd = eval( '(' + data + ')' );
			$( "#embn" ).val( unescape(dd.title) );
			$( "#embdm" ).val( unescape(dd.content) );
			$( '#dialog_form1' ).dialog( "open" );
			$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false );
		});
	});
	$( '#dialog_form1' ).dialog({
		autoOpen: false,
		width: 650,
		modal: true,
		show: {
			effect: "drop",
			duration: 400
		},
		hide: {
			effect: "fold",
			duration: 400
		},
		buttons: {
			"修改": function() {
				var chk = true,
				embn = $( "#embn" ),
				embdm = $( "#embdm" ),
				allFields = $( [] ).add( embn ).add( embdm );
				allFields.removeClass( "ui-state-error" );
				chk = chk && checkLength( embn, "", 1, 20);
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.post( location.href, {
						menu: 'editmb',
						selectggmb: $( '#selectggmb' ).val(),
						embn: embn.val(),
						embdm: escape(embdm.val())
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，修改广告模板成功啦！' );
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
	$( '#delbutton' ).click(function(){
		if(confirm('您确定要删除模板“' + $( '#selectggmb option:selected' ).text() + '”吗？')){
			$( this ).addClass( "ui-state-error ").attr( "disabled" , true );
			$.post( location.href, {
				menu: 'delggmb',
				selectggmb: $( '#selectggmb' ).val()
			},
			function( data ){
				if ( data == '1' ){
					alert( '恭喜你，删除广告模板成功啦！' );
					location = location.href;
				} else if ( data.length > 200 ) {
					alert( '抱歉，您没有此功能权限，操作失败！' );
				} else {
					alert( data );
				}
				$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false );
			});
		}
	});
	$( "#ggtemp_sortable" ).sortable({
		placeholder: "ui-state-highlight"
    });
    $( "#ggtemp_sortable" ).disableSelection();
	$( "#gxbutton" ).click(function() {
		if(confirm('修改即刻生效！您确定要修改吗？')){
			var vvv='';
			$( ".val input[name='val']" ).each(function(){
				vvv = vvv + $(this).val() + "\r\n";
			});
			$( this ).addClass( "ui-state-error ").attr( "disabled" , true );
			$.ajax({
				type: "POST",
				url: location.href,
				data: {
					menu: 'renewitem',
					itemlist: vvv
				},
				success: function( msg ) {
					if ( msg == "1" ) {
						alert( "恭喜你，排列模板顺序成功！" );
						location = location.href;
					} else {
						alert( msg );
					}
					$( "#gxbutton" ).removeClass( "ui-state-error" ).attr( "disabled" , false );
				}
			});
		}
	});
	$( "#hybutton" ).click(function() {
		location.reload(true);
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置： <?php echo $title ?></p>

<div class="cc ui-widget-content ui-corner-all"><span class="ui-icon ui-icon-info" style="float:left;margin:.1em .3em;"></span>对一些固定的广告样式，可以将其设计成广告模板。之后创建相同样式的广告，只需选择相应的模板，修改参数即可，避免重复写样式代码的麻烦。</div>

<div class="cc"><button type="button" class="button" id="addbutton" />新建广告模板</button></div>

<div class="fw">
<div class="hfw">
<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">编辑广告模板</div>
<div class="cp">
<label class="tip" for="selectggmb">选个广告模板来编辑：</label>
<select id="selectggmb" name="selectggmb" class="text ui-widget-content ui-corner-all"><?php echo $ggtemp_list ?></select>
<br /><br />
<label class="tip">&nbsp;</label>
<button type="button" id="editbutton" class="button" />修改</button> <button type="button" id="delbutton" class="button" />删除</button>
</div>
</div>
</div>

<div class="hfw">
<div class="cc ui-widget-content ui-corner-all">
<div class="tt ui-widget-header ui-corner-all">排序广告模板</div>
<div class="cp">
<ul id="ggtemp_sortable"><?php echo $ggtemp_sortable ?></ul>
<button type="button" id="gxbutton" class="button" />更新</button> <button type="button" id="hybutton" class="button" />还原</button>
</div>
</div>
</div>

<div class="clear"></div>
</div>

</div>

<div id="dialog_form" title="新建广告模板！">
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告模板名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="nmbn" name="nmbn" type="text" size="28" maxlength="20" value="" /><span id="Tips"></span></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告模板代码：</td>
    <td class="right"><textarea class="text mbdm ui-widget-content ui-corner-all" name="nmbdm" id="nmbdm"></textarea></td>
  </tr>
</table>
</div>
</div>

<div id="dialog_form1" title="修改广告模板！">
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告模板名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="embn" name="embn" type="text" size="28" maxlength="20" value="" /><span id="Tips"></span></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告模板代码：</td>
    <td class="right"><textarea class="text mbdm ui-widget-content ui-corner-all" name="embdm" id="embdm"></textarea></td>
  </tr>
</table>
</div>
</div>

<?php require 'mo.foot.php';
//////////////////////////
}
?>