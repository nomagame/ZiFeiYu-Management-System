<?php
$pageName = 'index';

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";
require('./init.php');
if(!Auth::is_login())
{
    redirect('./login.php?act=in');
    exit();
}
define('NIUXAMS_ACCESS', 'addggcl');
require 'common.php';
$menu = $_POST['menu'];
///////////////////////////
if( $menu == 'addggcl' ){
$cltitle = insql($_POST['cltitle']);
$clsm = insql($_POST['clsm']);
$wllx = insql($_POST['wllx']);
$clqz = insql($_POST['clqz']);
$xzgg = insql($_POST['xzgg']);
$lhcl = insql($_POST['lhcl']);
$lhjg = insql($_POST['lhjg']);
$sjeorne = insql($_POST['sjeorne']);
$sjsz = insql($_POST['sjsz']);
$xzmrcs = insql($_POST['xzmrcs']);
$mrcs = insql($_POST['mrcs']);
$xzfkcs = insql($_POST['xzfkcs']);
$fkcs = insql($_POST['fkcs']);
$oseorne = insql($_POST['oseorne']);
$os = insql($_POST['os']);
$fbleorne = insql($_POST['fbleorne']);
$fbl = insql($_POST['fbl']);
$llqeorne = insql($_POST['llqeorne']);
$llq = insql($_POST['llq']);
$yuyeorne = insql($_POST['yuyeorne']);
$yuy = insql($_POST['yuy']);
$lyeorne = insql($_POST['lyeorne']);
$vly = insql($_POST['vly']);
$urleorne = insql($_POST['urleorne']);
$url = insql($_POST['url']);
$diyueorne = insql($_POST['diyueorne']);
$diyu = insql($_POST['diyu']);
$jreorne=insql($_POST['jreorne']);
$jr=insql($_POST['jr']);
$ggcllei = insql($_POST['ggcllei']);
$ggclzu = insql($_POST['ggclzu']);
$ontid = date("YmdHis",time());
$gid = $clthread.'-'.$ontid;
if( !$cltitle ){die('标题不能为空！');}
if( !$wllx ){die('广告类型不能为空！');}
if( !$xzgg ){die('广告不能为空！');}
require 'func.gg.php';
$path = $datadir.'/'.$clthread.'-'.$ontid.'.js';
$path1= $datadir.'/'.$clthread.'-'.$ontid.'.php';
$path2= $datadir.'/'.'ggcllist.php';
$ggclcon = cltojs($gid,$wllx,$clqz,$xzgg,$lhcl,$lhjg,$sjeorne,$sjsz,$xzmrcs,$mrcs,$xzfkcs,$fkcs,$oseorne,$os,$fbleorne,$fbl,$llqeorne,$llq,$yuyeorne,$yuy,$lyeorne,$vly,$urleorne,$url,$diyueorne,$diyu,$jreorne,$jr);
$ggclcon1 = '<?php exit();?>'."\r\n".gnt()."\r\n".$cltitle."\r\n".$clsm."\r\n".$wllx."\r\n".$clqz."\r\n".$xzgg."\r\n".$lhcl."\r\n".$lhjg."\r\n".$sjeorne."\r\n".$sjsz."\r\n".$xzmrcs."\r\n".$mrcs."\r\n".$xzfkcs."\r\n".$fkcs."\r\n".$oseorne."\r\n".$os."\r\n".$fbleorne."\r\n".$fbl."\r\n".$llqeorne."\r\n".$llq."\r\n".$yuyeorne."\r\n".$yuy."\r\n".$lyeorne."\r\n".$vly."\r\n".$urleorne."\r\n".$url."\r\n".$diyueorne."\r\n".$diyu."\r\n".$jreorne."\r\n".$jr."\r\n".$ggclzu."\r\n".$ggcllei;

file_put_contents($path, $ggclcon) or die('出错啦！无法创建.js文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
file_put_contents($path1, $ggclcon1) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$ggcllist = file( $path2 );
if( !is_array($ggcllist) ){ $ggcllist[] = ''; }
array_shift( $ggcllist );
array_unshift($ggcllist, $clthread.'-'.$ontid."\r\n");
array_unshift($ggcllist, '<?php exit();?>'."\r\n");
file_put_contents($path2, $ggcllist) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('添加广告策略', $gid, 1, getname());
die('1');
}
///////////////////////////
$ggcllei = unescape($_COOKIE['ggcllei']);
$ggclzu = unescape($_COOKIE['ggclzu']);
$ggclleil = file_get_contents( $datadir . '/ggclleilist.php' );
$ggclll = explode("\r\n", $ggclleil);
array_shift( $ggclll );
$ggclleilist = '';
foreach($ggclll as $value){
	if( $value ){
		if( $value == $ggcllei ){
			$ggclleilist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggclleilist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$ggclzul = file_get_contents( $datadir . '/ggclzulist.php' );
$ggclz = explode("\r\n", $ggclzul);
array_shift( $ggclz );
$ggclzulist = '';
foreach($ggclz as $value){
	if( $value ){
		if( $value == $ggclzu ){
			$ggclzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggclzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$title = '添加新广告策略';
require 'mo.head.php';
?>
<style type="text/css">
td.left {
	width: 12%;
	text-align: right;
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
	padding-left:.2em;
}
#sjsz li {
	position: relative;
	margin: 0 1px 1px 1px;
	width: 22em;
	height: 2.2em;
}
#sjsz li span {
	position: absolute;
	margin-top: .4em;
	margin-left: .9em;
}
#sjsz li span.ui-icon-close {
	margin-left: 0;
	cursor: pointer;
}
.ui-tooltip {
	max-width: 2000px;
	word-break: break-all;
}
input.text,select.text,textarea.text {
	padding: .3em;
	font-size: 1em;
}
#cltitle{
	width: 24em;
}
#clsm{
	width: 550px;
	height: 60px;
}
</style>
<script type="text/javascript">
$(function() {
	$( ".tabpanels li:first" ).addClass( "ui-tabs-active ui-state-active" );
	$( ".tabdiv" ).hide();
	$( ".tabdiv:first" ).show();
	$( ".tabpanels li" ).click(function(){
		$( this ).parent().children( "li" ).removeClass( "ui-tabs-active ui-state-active" );
		$( this ).addClass( "ui-tabs-active ui-state-active" );
		$( ".tabdiv" ).hide();
		$( ".tabdiv" ).eq( $(this).parent().children( "li" ).index( this ) ).show();
	});
	$( ".tabpanels li" ).hover(function () {
		$( this ).addClass( "ui-state-hover" );
	},
	function () {
		$( this ).removeClass( "ui-state-hover" );
	});
	function wlqzsoh(){
		if( $( "#lhcl" ).val() == 2 && $( "input[name='wllx']:checked" ).val() == 1 ){
			$( ".wlqz" ).show();
		} else {
			$( ".wlqz" ).hide();
		}
	}
	function lhsjjgsoh(){
		if( $( "#lhcl" ).val() == 3 && $( "input[name='wllx']:checked" ).val() == 1 ){
			$( "#lhsjjg" ).show();
		} else {
			$( "#lhsjjg" ).hide();
		}
	}
	$( "#wllx_0" ).click(function(){
		$( "#clqzdiv" ).show();
		$( "#gglhcl" ).show();
		wlqzsoh();
		lhsjjgsoh();
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx: 0}, function(){$( '.button' ).button();});
	});
	$( "#wllx_1" ).click(function(){
		$( "#clqzdiv" ).hide();
		$( "#gglhcl" ).hide();
		$( ".wlqz" ).hide();
		$( "#lhsjjg" ).hide();
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx: 1}, function(){$( '.button' ).button();});
	});
	$( "#listggku" ).hide();
	$( "#wllx_0" ).click();
	$( '#fromggk' ).click(function(){$( "#listggku" ).toggle();});
	$( document ).on("click", "#syggsy", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), gglei:-1, ggzu:-1, desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#ggksy", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#qpage", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), page:$("#qpage").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#hpage", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), page:$("#hpage").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#ggzhy", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), page:$("#ggzhy").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#searchgg", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("change", "#gglei", function() {
		setCookie('gglei', $(this).val(), 120, '/');
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("change", "#ggzu", function() {
		setCookie('ggzu', $(this).val(), 120, '/');
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#desc_0,#desc_1", function() {
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx:$("#ggclass").val(), page:$("#page").val(), search:escape($("#search").val()), gglei:$("#gglei").val(), ggzu:$("#ggzu").val(), desc:$("input[name='desc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", ".selectgg", function() {
		$( this ).parent().parent().clone().appendTo("#xzgg table");
		$("#xzgg table tr:last").children("td").eq(0).replaceWith('<td class="ui-widget-content uitd ct"><button type="button" class="button delselectgg" title="'+$(this).val()+'" value="'+$(this).val()+'">移除</button></td>');
		$("#xzgg table tr:last").children("td").eq(4).after('<td class="ui-widget-content uitd ct">比例<select class="wlqz text ui-widget-content ui-corner-all" name="wlqz" title="广告手动轮换比例"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5" selected="selected">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></td>');
		wlqzsoh();
		$( '.button' ).button();
	});
	$( document ).on("click", ".delselectgg", function() {
		$( this ).parent().parent().remove();
	});
	$( "#lhcl" ).change(function(){
		if( $( this ).val() == 1 ){
			$( ".wlqz" ).hide();
			$( "#lhsjjg" ).hide();
		}else if( $( this ).val() == 2 ){
			$( ".wlqz" ).show();
			$( "#lhsjjg" ).hide();
		}else if( $( this ).val() == 3 ){
			$( ".wlqz" ).hide();
			$( "#lhsjjg" ).show();
		}
	});
	$( "#sjclxz" ).change(function(){
		var myDate = new Date(), nianfen = '', yuefen = '', riqi = '', xingqi = '', xiaoshi = '';
		for(var i=0;i<10;i++){nianfen += '<option value="'+(parseInt(myDate.getFullYear())+i)+'">'+(parseInt(myDate.getFullYear())+i)+'</option>';}
		for(var i=1;i<13;i++){yuefen += '<option value="'+i+'">'+i+'</option>';}
		for(var i=1;i<32;i++){riqi += '<option value="'+i+'">'+i+'</option>';}
		for(var i=1;i<8;i++){xingqi += '<option value="'+i+'">'+i+'</option>';}
		for(var i=0;i<24;i++){xiaoshi += '<option value="'+i+'">'+i+'</option>';}
		if( $( this ).val() == 1 ){
			$( "#sjsz" ).append('<li class="nianfen ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:2em;">年份：</strong><select class="ksnian text ui-widget-content ui-corner-all" name="ksnian">'+nianfen+'</select>至<select class="jsnian text ui-widget-content ui-corner-all" name="jsnian">'+nianfen+'</select></li>');
		}else if( $( this ).val() == 2 ){
			$( "#sjsz" ).append('<li class="yuefen ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:4em;">月份：</strong><select class="ksyue text ui-widget-content ui-corner-all" name="ksyue">'+yuefen+'</select>至<select class="jsyue text ui-widget-content ui-corner-all" name="jsyue">'+yuefen+'</select></li>');
		}else if( $( this ).val() == 3 ){
			$( "#sjsz" ).append('<li class="riqi ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:6em;">日期：</strong><select class="ksriqi text ui-widget-content ui-corner-all" name="ksriqi">'+riqi+'</select>至<select class="jsriqi text ui-widget-content ui-corner-all" name="jsriqi">'+riqi+'</select></li>');
		}else if( $( this ).val() == 4){
			$( "#sjsz" ).append('<li class="xingqi ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:8em;">星期：</strong><select class="ksxingqi text ui-widget-content ui-corner-all" name="ksxingqi">'+xingqi+'</select>至<select class="jsxingqi text ui-widget-content ui-corner-all" name="jsxingqi">'+xingqi+'</select></li>');
		}else if( $( this ).val() == 5 ){
			$( "#sjsz" ).append('<li class="xiaoshi ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:10em;">小时：</strong><select class="ksxiaoshi text ui-widget-content ui-corner-all" name="ksxiaoshi">'+xiaoshi+'</select>至<select class="jsxiaoshi text ui-widget-content ui-corner-all" name="jsxiaoshi">'+xiaoshi+'</select></li>');
		}
		$( this ).children( "option" ).first().attr( "selected" , "selected" );
	});
	$( "#sjsz" ).sortable({
		placeholder: "ui-state-highlight"
    });
    $( "#sjsz" ).disableSelection();
	$( document ).on("click", ".ui-icon-close", function() {
		$( this ).parent().hide( "drop" ,200 ,function(){$( this ).remove();});
	});
	$( document ).tooltip({
		content: function() {
			var element = $( this );
			if ( element.is( ".previewgg" ) ) {
				return element.attr( "title" );
			}
			if ( element.is( "[title]" ) ) {
				return element.attr( "title" ).replace(/</igm,"&lt;").replace(/>/igm,"&gt;").replace(/\n/igm,"<br />");
			}
		},
		show: {
			delay: 200,
			duration: 1
		},
		hide: {
			effect: "blind",
			duration: 200
		},
		track: true
	});
	$( 'input[name="reset"]' ).click(function(){window.location.reload()});
	$( "#submit" ).click(function(){
		if( confirm('您确定吗？') ){
			var action = $( this ),
			cltitle = $( "#cltitle" ),
			lhjg = $( "#lhjg" ),
			mrcs = $( "#mrcs" ),
			fkcs = $( "#fkcs" );
			if( cltitle.val().length < 1 ){
				cltitle.focus();
				alert("标题不能为空！");
				return false;
			}
			if( !$("#xzgg table tr").eq(1).html() ){
				$( "#fromggk" ).focus();
				alert("投放广告不能为空！");
				return false;
			}
			if( lhjg.val().length > 0 && lhjg.val().match(/\D/g) ){
				lhjg.focus();
				alert("轮换时间间隔必须是数字！");
				return false;
			}
			if( mrcs.val().length > 0 && mrcs.val().match(/\D/g) ){
				mrcs.focus();
				alert("限制每日投放数量必须是数字！");
				return false;
			}
			if( fkcs.val().length > 0 && fkcs.val().match(/\D/g) ){
				fkcs.focus();
				alert("限制对独立访客的展现必须是数字！");
				return false;
			}
			action.addClass( "ui-state-error ").attr( "disabled" , true );
			setCookie('ggcllei', $( "#ggcllei option:selected" ).val(), 120, '/');
			setCookie('ggclzu', $( "#ggclzu option:selected" ).val(), 120, '/');
			var selectgg = "",
			ggsjsz = "",
			osarr = $( "select[name='os']" ).val() || [],
			fblarr = $( "select[name='fbl']" ).val() || [],
			llqarr = $( "select[name='llq']" ).val() || [],
			yuyarr = $( "select[name='yuy']" ).val() || [],
			jrarr = $( "select[name='jr']" ).val() || [],
			osval = osarr.join(", "),
			fblval = fblarr.join(", "),
			llqval = llqarr.join(", "),
			yuyval = yuyarr.join(", "),
			jrval = jrarr.join(", ");
			$( ".delselectgg" ).each(function(){
				selectgg += $( this ).val() + ", " + $( this ).parent().parent().children( "td" ).eq(5).children( "select" ).val()+". ";
			});
			$( "#sjsz" ).children( "li" ).each(function(){
				ggsjsz += $( this ).removeClass( "ui-state-default" ).attr( "class" ) + ", " + $( this ).children( "select" ).eq(0).val() + "-" + $( this ).children( "select" ).eq(1).val()+". ";
				$( this ).addClass( "ui-state-default" )
			});
			$.ajax({
				type: "POST",
				url: location.href,
				data: {
					menu : 'addggcl',
					cltitle : escape( $( "#cltitle" ).val() ),
					clsm : escape( $( "#clsm" ).val() ),
					wllx : $( "input[name='wllx']:checked" ).val(),
					clqz : $( "select[name='clqz'] option:selected" ).val(),
					xzgg : selectgg,
					lhcl : $( "select[name='lhcl'] option:selected" ).val(),
					lhjg : $( "#lhjg" ).val(),
					sjeorne : $( "select[name='sjeorne'] option:selected" ).val(),
					sjsz : ggsjsz,
					xzmrcs : $( "select[name='xzmrcs'] option:selected" ).val(),
					mrcs : $( "#mrcs" ).val(),
					xzfkcs : $( "select[name='xzfkcs'] option:selected" ).val(),
					fkcs : $( "#fkcs" ).val(),
					oseorne : $( "select[name='oseorne'] option:selected" ).val(),
					os : osval,
					fbleorne : $( "select[name='fbleorne'] option:selected" ).val(),
					fbl : fblval,
					llqeorne : $( "select[name='llqeorne'] option:selected" ).val(),
					llq : llqval,
					yuyeorne : $( "select[name='yuyeorne'] option:selected" ).val(),
					yuy : yuyval,
					lyeorne : $( "select[name='lyeorne'] option:selected" ).val(),
					vly : escape( $( "#vly" ).val() ),
					urleorne : $( "select[name='urleorne'] option:selected" ).val(),
					url : escape( $( "#url" ).val() ),
					diyueorne : $( "select[name='diyueorne'] option:selected" ).val(),
					diyu : escape( $( "#diyu" ).val() ),
					jreorne : $( "select[name='jreorne'] option:selected" ).val(),
					jr : jrval,
					ggcllei : $( "#ggcllei option:selected" ).val(),
					ggclzu : $( "#ggclzu option:selected" ).val()
				},
				success: function( msg ){
					if ( msg == '1' ){
						if(confirm( '恭喜你，添加广告策略成功！是否继续添加广告策略？' )){
							location = location.href;
						} else {
							location = 'listggcl.php';
						}
					} else {
						alert( msg );
					}
					action.removeClass( "ui-state-error" ).attr( "disabled" , false );
				}
			});
		}
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">

<div class="fullscreen">

<p class="cp">当前位置： <?php echo $title ?></p>

<form method="post">
<div class="cc ui-widget-content ui-corner-all">
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告策略名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="cltitle" name="cltitle" type="text" />
      &nbsp;&nbsp;策略分类：<select class="text ui-widget-content ui-corner-all" id="ggcllei" name="ggcllei"><?php echo $ggclleilist ?></select>
      &nbsp;&nbsp;策略分组：<select class="text ui-widget-content ui-corner-all" id="ggclzu" name="ggclzu"><?php echo $ggclzulist ?></select>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left" style="vertical-align:top">广告策略说明：</td>
    <td class="right"><textarea class="text ui-widget-content ui-corner-all" name="clsm" id="clsm"></textarea> <span class="tip">（例如:午夜0-5点，投放某某广告）</span>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">投放广告类型：</td>
    <td class="right">
    <label>
      <input type="radio" name="wllx" value="1" id="wllx_0" checked />
      固定占位</label>
    &nbsp;
    <label>
      <input type="radio" name="wllx" value="2" id="wllx_1" />
      非固定占位（漂浮、弹窗）</label>
    </td>
  </tr>
</table>
</div>
<div class="cp" id="clqzdiv">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告策略权重：</td>
    <td class="right">
    <select id="clqz" name="clqz" class="text ui-widget-content ui-corner-all">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5" selected>5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    </select> &nbsp;&nbsp;<span class="tip">固定占位策略权重优先顺序1级>2级>3级...>10级，权重相同按其在广告位排位顺序决定优先。非固定占位策略无视权重！</span>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">&nbsp;</td>
    <td class="right">
    <input name="submit" id="submit" class="button" type="button" value=" 完 成 " /> <input name="reset" class="button" type="reset" value=" 重 置 " />
    </td>
  </tr>
</table>
</div>
</div>

<div class="tabs cc ui-tabs ui-widget ui-widget-content ui-corner-all">
  <ul class="tabpanels ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">投放广告</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">时间</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">操作系统</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">分辨率</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">浏览器</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">语言</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">来源</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">网址</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">地域</a></li>
    <li class="ui-state-default ui-corner-top" tabindex="0"><a class="ui-tabs-anchor">接入</a></li>
  </ul>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>只有此项为必填，其他的都是非必选！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top;">投放广告：</td>
            <td class="right">
            <div id="xzgg">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
            	<tr>
                	<th class="ui-widget-content uith" scope="col" style="width: 4em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 4.2em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 4.2em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 14em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 4.2em;"></th>
                </tr>
            </table>
            </div>
            </td>
        </tr>
    </table>
    </div>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left">&nbsp;</td>
            <td class="right"><button type="button" class="button" id="fromggk">从广告库中选择广告</button>
            <a href="addgg.php" target="_blank" class="button">添加新广告</a>
            </td>
        </tr>
    </table>
    <div id="listggku">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left">&nbsp;</td>
            <td class="right"><div id="listgg"></div></td>
        </tr>
    </table>
    </div>
    </div>
    <div class="cp" id="gglhcl">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left">广告轮换：</td>
            <td class="right">
            <select id="lhcl" name="lhcl" class="text ui-widget-content ui-corner-all">
            <option value="1">均匀随机</option>
            <option value="2">手动比例</option>
            <option value="3">幻灯片</option>
            </select>
            &nbsp;&nbsp;<span class="tip">固定占位的广告个数>1时生效</span>
            </td>
        </tr>
    </table>
    </div>
    <div class="cp" id="lhsjjg">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left">轮换时间间隔：</td>
            <td class="right"><input name="lhjg" id="lhjg" type="text" value="15" size="2" class="text ui-widget-content ui-corner-all" />秒
            <span class="tip" style="color:#E00">警告：本功能采用iframe播放广告，对于明确表示禁止iframe播放广告的广告请禁止使用本功能！以免被判断作弊！</span>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>时间策略：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放时间：</td>
            <td class="right">
            <div style="float:left;">
            <select id="sjeorne" name="sjeorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">等于</option>
                <option value="1">不等于</option>
            </select>
            </div>
            <ul id="sjsz" style="float:left;"></ul>
            <div style="float:left;">
            <select id="sjclxz" name="sjclxz" class="text ui-widget-content ui-corner-all">
            	<option value="0">-操作-</option>
                <option value="1">加年份</option>
                <option value="2">加月份</option>
                <option value="3">加日期</option>
                <option value="4">加星期</option>
                <option value="5">加小时</option>
            </select>
            <span class="tip">未选择年、月、日、周、时表示包括全部</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left">限制每日投放：</td>
            <td class="right">
            每天<select id="xzmrcs" name="xzmrcs" class="text ui-widget-content ui-corner-all">
           		<option value="0">-选择-</option>
                <option value="1">展现</option>
                <option value="2">点击</option>
            </select>
            <input type="text" name="mrcs" id="mrcs" class="text ui-widget-content ui-corner-all" value="" size="4" />次
            <span class="tip">不填为不限制（本功能需开启广告统计，不适合多广告轮播）</span>
            </td>
        </tr>
    </table>
    </div>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left">独立访客限制：</td>
            <td class="right">
            <select id="xzfkcs" name="xzfkcs" class="text ui-widget-content ui-corner-all">
            	<option value="0">-选择-</option>
                <option value="1">每天</option>
                <option value="2">小时</option>
                <option value="3">30分钟</option>
                <option value="4">10分钟</option>
                <option value="5">每分钟</option>
            </select>
            最多展现<input id="fkcs" name="fkcs" type="text" value="" size="4" class="text ui-widget-content ui-corner-all">次
            <span class="tip">不填为不限制（本功能不适合多广告轮播）</span>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>操作系统：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放操作系统：</td>
            <td class="right">
            <div style="float:left;">
            <select id="oseorne" name="oseorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">等于</option>
                <option value="1">不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="os" size="18" multiple="multiple" class="text ui-widget-content ui-corner-all">
            	<option value ="Windows xp">Windows xp</option>
                <option value ="Windows 7">Windows 7</option>
                <option value ="Windows 8">Windows 8</option>
                <option value="Windows vista">Windows vista</option>
                <option value="Windows 2000">Windows 2000</option>
                <option value ="Windows 98">Windows 98</option>
                <option value ="Windows 2003">Windows 2003</option>
                <option value="Windows 95">Windows 95</option>
                <option value="Windows NT 4.0">Windows NT 4.0</option>
                <option value ="Windows NT">Windows NT</option>
                <option value ="Macintosh">Macintosh</option>
                <option value="Linux">Linux</option>
                <option value="Android">Android</option>
                <option value="iphone">iphone</option>
                <option value="ipad">ipad</option>
                <option value="ipod">ipod</option>
                <option value ="iOS">iOS</option>
                <option value="other">其他</option>
            </select>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">可按Ctrl或Shift键进行多选或取消选择。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>分辨率：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放分辨率：</td>
            <td class="right">
            <div style="float:left;">
            <select id="fbleorne" name="fbleorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">等于</option>
                <option value="1">不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="fbl" size="19" multiple="multiple" class="text ui-widget-content ui-corner-all">
            	<option value ="320*480">320*480</option>
                <option value ="640*480">640*480</option>
                <option value="800*600">800*600</option>
                <option value="1024*768">1024*768</option>
                <option value ="1152*864">1152*864</option>
                <option value ="1280*720">1280*720</option>
                <option value="1280*768">1280*768</option>
                <option value="1280*800">1280*800</option>
                <option value ="1280*960">1280*960</option>
                <option value ="1280*1024">1280*1024</option>
                <option value="1360*768">1360*768</option>
                <option value="1366*768">1366*768</option>
                <option value ="1400*1050">1400*1050</option>
                <option value="1440*900">1440*900</option>
                <option value ="1600*900">1600*900</option>
                <option value ="1680*1050">1680*1050</option>
                <option value="1920*1080">1920*1080</option>
                <option value="1920*1200">1920*1200</option>
                <option value="other">其他</option>
            </select>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">可按Ctrl或Shift键进行多选或取消选择。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>浏览器：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放浏览器：</td>
            <td class="right">
            <div style="float:left;">
            <select id="llqeorne" name="llqeorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">等于</option>
                <option value="1">不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="llq" size="12" multiple="multiple" class="text ui-widget-content ui-corner-all">
            	<option value ="Internet Explorer 5">Internet Explorer 5</option>
                <option value ="Internet Explorer 6">Internet Explorer 6</option>
                <option value="Internet Explorer 7">Internet Explorer 7</option>
                <option value="Internet Explorer 8">Internet Explorer 8</option>
                <option value ="Internet Explorer 9">Internet Explorer 9</option>
                <option value ="Internet Explorer 10">Internet Explorer 10</option>
                <option value ="Firefox">Firefox</option>
                <option value="Mozilla">Mozilla</option>
                <option value="Chrome">Chrome</option>
                <option value ="Opera">Opera</option>
                <option value ="Safari">Safari</option>
                <option value="other">其他</option>
            </select>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">可按Ctrl或Shift键进行多选或取消选择。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>语言：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放语言：</td>
            <td class="right">
            <div style="float:left;">
            <select id="yuyeorne" name="yuyeorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">等于</option>
                <option value="1">不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="yuy" size="6" multiple="multiple" class="text ui-widget-content ui-corner-all">
            	<option value ="zh-cn">中文(简体)</option>
                <option value="zh-tw">中文(繁体)</option>
                <option value="en">英语</option>
                <option value ="jp">日语</option>
                <option value ="ko">韩语</option>
                <option value="other">其他</option>
            </select>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">可按Ctrl或Shift键进行多选或取消选择。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>来源：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放来源：</td>
            <td class="right">
            <div style="float:left;">
            <select id="lyeorne" name="lyeorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">包含</option>
                <option value="1">不包含</option>
            </select>
            </div>
            <div style="float:left;">
            <textarea name="vly" id="vly" cols="50" rows="6" class="text ui-widget-content ui-corner-all"></textarea>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">说明信息：<br />来源域用来定位来自特定域名的访客。<br />每行输入一个域名，以回车换行。<br />输入(direct)表示直达。<br />例如：输入niuxsoft.com域名，则只<br />对从niuxsoft.com来的访客展现广告。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>投放网址：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放网址：</td>
            <td class="right">
            <div style="float:left;">
            <select id="urleorne" name="urleorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">包含</option>
                <option value="1">不包含</option>
            </select>
            </div>
            <div style="float:left;">
            <textarea name="url" id="url" cols="50" rows="8" class="text ui-widget-content ui-corner-all"></textarea>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">说明信息：<br />投放网址用来定位访问特定页面的访客。<br />每行输入一个url，以回车换行。<br />例如：输入niuxsoft.com/news，则只在url中含<br />有niuxsoft.com/news的页面上展现广告。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>地域：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放地域：</td>
            <td class="right">
            <div style="float:left;">
            <select id="diyueorne" name="diyueorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">包含</option>
                <option value="1">不包含</option>
            </select>
            </div>
            <div style="float:left;">
            <textarea name="diyu" id="diyu" cols="50" rows="8" class="text ui-widget-content ui-corner-all"></textarea>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">说明信息：<br />每行输入一个地域，以回车换行。<br />例如：输入 深圳，则只对深圳的访客投放广告。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
  <div class="tabdiv ui-tabs-panel ui-widget-content ui-corner-bottom">
    <p>接入：非必选！需要时设置！</p>
    <div class="cp">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td class="left" style="vertical-align: top; padding-top: .4em;">投放接入：</td>
            <td class="right">
            <div style="float:left;">
            <select id="jreorne" name="jreorne" class="text ui-widget-content ui-corner-all">
            	<option value="0">等于</option>
                <option value="1">不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="jr" size="6" multiple="multiple" class="text ui-widget-content ui-corner-all">
            	<option value ="dx">电信</option>
                <option value="lt">联通</option>
                <option value="jyw">教育网</option>
                <option value ="tt">铁通</option>
                <option value ="wt">网通</option>
                <option value="other">其他</option>
            </select>
            </div>
            <div style="float:left;">
            &nbsp;<span class="tip">可按Ctrl或Shift键进行多选或取消选择。</span>
            </div>
            </td>
        </tr>
    </table>
    </div>
  </div>
</div>

</form>
</div>
<?php require 'mo.foot.php'; ?>