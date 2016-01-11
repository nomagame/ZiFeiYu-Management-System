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
define('NIUXAMS_ACCESS', 'editggcl');
require 'common.php';
$menu = $_POST['menu'];
$gid = $_REQUEST['gid'];
$ggcld = file_get_contents($datadir . '/' . $gid . '.php') or errwin('出错啦！打开文件出错，请输入正确的gid！');
$arrayd = explode("\r\n", $ggcld);
array_shift( $arrayd );
///////////////////////////
if( $menu == 'editggcl' ){
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
$gid = insql($_POST['gid']);
$gtime = insql($_POST['gtime']);
if( !$cltitle ){die('标题不能为空！');}
if( !$wllx ){die('广告类型不能为空！');}
if( !$xzgg ){die('广告不能为空！');}
require 'func.gg.php';
$path = $datadir.'/'.$gid.'.js';
$path1= $datadir.'/'.$gid.'.php';

$ggclcon = cltojs($gid,$wllx,$clqz,$xzgg,$lhcl,$lhjg,$sjeorne,$sjsz,$xzmrcs,$mrcs,$xzfkcs,$fkcs,$oseorne,$os,$fbleorne,$fbl,$llqeorne,$llq,$yuyeorne,$yuy,$lyeorne,$vly,$urleorne,$url,$diyueorne,$diyu,$jreorne,$jr);
$ggclcon1 = '<?php exit();?>'."\r\n".$gtime."\r\n".$cltitle."\r\n".$clsm."\r\n".$wllx."\r\n".$clqz."\r\n".$xzgg."\r\n".$lhcl."\r\n".$lhjg."\r\n".$sjeorne."\r\n".$sjsz."\r\n".$xzmrcs."\r\n".$mrcs."\r\n".$xzfkcs."\r\n".$fkcs."\r\n".$oseorne."\r\n".$os."\r\n".$fbleorne."\r\n".$fbl."\r\n".$llqeorne."\r\n".$llq."\r\n".$yuyeorne."\r\n".$yuy."\r\n".$lyeorne."\r\n".$vly."\r\n".$urleorne."\r\n".$url."\r\n".$diyueorne."\r\n".$diyu."\r\n".$jreorne."\r\n".$jr."\r\n".$ggclzu."\r\n".$ggcllei;

file_put_contents($path, $ggclcon) or die('出错啦！无法创建.js文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
file_put_contents($path1, $ggclcon1) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');

$pattern = '|(/\*begin '.$gid.'\*/)(.+?)(/\*end '.$gid.'\*/)|is';
if( $dh = opendir($datadir) ){
	while( ($file=readdir($dh)) !== false ){
		if( $file != "." && $file != ".." ){
			if( strpos( $file , $ggwthread ) !== false && strpos( $file , '.js' ) !== false ){
				$ggwdm = insou1( file_get_contents( $datadir.'/'.$file ) );
				if( preg_match( $pattern , $ggwdm ) ){
					$ggwdm = preg_replace( $pattern, '${1}'."\r\n".$ggclcon."\r\n".'$3', $ggwdm );
					file_put_contents( $datadir.'/'.$file, $ggwdm );
				}
			}
		}
	}
	closedir($dh);
}
$conn = new mysql();
$conn->inoplog('修改广告策略', $gid, 1, getname());
die('1');
}
///////////////////////////
$ggclleil = file_get_contents( $datadir . '/ggclleilist.php' );
$ggclll = explode("\r\n", $ggclleil);
array_shift( $ggclll );
$ggclleilist = '';
foreach($ggclll as $value){
	if( $value ){
		if( $value == $arrayd[31] ){
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
		if( $value == $arrayd[30] ){
			$ggclzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggclzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$title = '修改广告策略';
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
	$( "#cltitle" ).val( unescape($( "#cltitle" ).val()) );
	$( "#clsm" ).val( unescape($( "#clsm" ).val()) );
	$( "#vly" ).val( unescape($( "#vly" ).val()) );
	$( "#url" ).val( unescape($( "#url" ).val()) );
	$( "#diyu" ).val(unescape($( "#diyu" ).val()));
	<?php if($arrayd[9]||($arrayd[10]&&$arrayd[11])||($arrayd[12]&&$arrayd[13])){echo '$( ".tabpanels li" ).eq(1).addClass( "ui-state-highlight" );';}?>
	if($( "select[name='os']" ).val()){$(".tabpanels li").eq(2).addClass( "ui-state-highlight" );}
	if($( "select[name='fbl']" ).val()){$(".tabpanels li").eq(3).addClass( "ui-state-highlight" );}
	if($( "select[name='llq']" ).val()){$(".tabpanels li").eq(4).addClass( "ui-state-highlight" );}
	if($( "select[name='yuy']" ).val()){$(".tabpanels li").eq(5).addClass( "ui-state-highlight" );}
	if($( "#vly" ).val()){$(".tabpanels li").eq(6).addClass( "ui-state-highlight" );}
	if($( "#url" ).val()){$(".tabpanels li").eq(7).addClass( "ui-state-highlight" );}
	if($( "#diyu" ).val()){$(".tabpanels li").eq(8).addClass( "ui-state-highlight" );}
	if($( "select[name='jr']" ).val()){$(".tabpanels li").eq(9).addClass( "ui-state-highlight" );}
	
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
	if( $( "#wllx_0" ).attr( "checked" ) ){$( "#wllx_0" ).click();}
	if( $( "#wllx_1" ).attr( "checked" ) ){$( "#wllx_1" ).click();}
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
		if( confirm('修改即刻生效！您确定要修改吗？') ){
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
					menu : 'editggcl',
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
					ggclzu : $( "#ggclzu option:selected" ).val(),
					gid : $( "#gid" ).val(),
					gtime : $( "#gtime" ).val()
				},
				success: function( msg ){
					if ( msg == '1' ){
						alert("恭喜你，修改成功！");
						location = 'listggcl.php';
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
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="cltitle" name="cltitle" type="text" value="<?php echo $arrayd[1] ?>" />
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
    <td class="right"><textarea class="text ui-widget-content ui-corner-all" name="clsm" id="clsm"><?php echo $arrayd[2] ?></textarea> <span class="tip">（例如:午夜0-5点，投放某某广告）</span>
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
      <input type="radio" name="wllx" value="1" id="wllx_0"<?php if($arrayd[3]==1){echo " checked";}?> />
      固定占位</label>
    &nbsp;
    <label>
      <input type="radio" name="wllx" value="2" id="wllx_1"<?php if($arrayd[3]==2){echo " checked";}?> />
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
<?php
for($i=1; $i<=10; $i++){
	if($i == $arrayd[4]){
		echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
	} else {
		echo '<option value="'.$i.'">'.$i.'</option>';
	}
}
?>
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
    <input name="submit" id="submit" class="button" type="button" value=" 修 改 " /> <input name="reset" class="button" type="reset" value=" 重 置 " />
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
<?php 
if( $arrayd[5] ){
	$arraygg = explode('. ', $arrayd[5]);
	$size = count($arraygg);
	for ($i=0; $i<$size; $i++){
		if( $arraygg[$i] ){
			$arraygid = explode(', ', $arraygg[$i]);
			$ggd = file_get_contents( $datadir . '/' . $arraygid[0] . '.php' );
			$arrayggd = array();
			$arrayggd = explode("\r\n", $ggd);
			array_shift( $arrayggd );
			if($arrayggd[2]==0){$gglx='固定';}else if($arrayggd[2]==1){$gglx='漂浮';}else{$gglx='弹窗';}
			if($arrayggd[3]==''){$arrayggd[3]='-';}
			if($arrayggd[4]==''){$arrayggd[4]='-';}
			if(!$arrayggd[8]){$jfclass='其他';}else if($arrayggd[8]==1){$jfclass='CPM';}else if($arrayggd[8]==2){$jfclass='CPC';}else if($arrayggd[8]==3){$jfclass='CPA';}else if($arrayggd[8]==4){$jfclass='CPS';}else if($arrayggd[8]==5){$jfclass='CPT';}
			$wlqz = '';
			for($j=1; $j<=10; $j++){
				if( $j == $arraygid[1] ){
					$wlqz .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
				} else {
					$wlqz .= '<option value="'.$j.'">'.$j.'</option>';
				}
			}
			echo '<tr class="list">';
			echo '<td class="ui-widget-content uitd ct"><button type="button" class="button delselectgg" title="'.$arraygid[0].'" value="'.$arraygid[0].'">移除</button></td>';
			echo '<td class="ui-widget-content uitd ct">-</td>';
			echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayggd[9]).'">'.htmlspecialchars(cutstr($arrayggd[9],6)).'</span></td>';
			echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayggd[6]).'">'.htmlspecialchars(cutstr($arrayggd[6],6)).'</span></td>';
			echo '<td class="ui-widget-content uitd pl"><a href="previewgg.php?gid='.$arraygid[0].'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayggd[1]),3000)).'">'.htmlspecialchars(cutstr(unescape($arrayggd[0]),22)).'</a></td>';
			echo '<td class="ui-widget-content uitd ct">比例<select class="wlqz text ui-widget-content ui-corner-all" name="wlqz" title="广告手动轮换比例">'.$wlqz.'</select></td>';
			echo '<td class="ui-widget-content uitd ct"><a href="editgg.php?gid='.$arraygid[0].'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayggd[0]),255)).'">修改</a></td>';
			echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars(cutstr(unescape($arrayggd[1]),9000)).'" class="previewgg">'.$gglx.'</span></td>';
			echo '<td class="ui-widget-content uitd ct">'.$jfclass.'</td>';
			echo '<td class="ui-widget-content uitd ct">'.$arrayggd[3].'&times;'.$arrayggd[4].'</td>';
			echo '</tr>';
		}
	}
}
?>
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
            <option value="1"<?php echo $arrayd[6]==1?' selected="selected"':'' ?>>均匀随机</option>
            <option value="2"<?php echo $arrayd[6]==2?' selected="selected"':'' ?>>手动比例</option>
            <option value="3"<?php echo $arrayd[6]==3?' selected="selected"':'' ?>>幻灯片</option>
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
            <td class="right"><input name="lhjg" id="lhjg" type="text" value="<?php echo $arrayd[7] ?>" size="2" class="text ui-widget-content ui-corner-all" />秒
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
                <option value="1"<?php echo $arrayd[8]?' selected="selected"':'' ?>>不等于</option>
            </select>
            </div>
            <ul id="sjsz" style="float:left;">
<?php 
if( $arrayd[9] ){
	$arraysj = explode('. ', $arrayd[9]);
	$size = count($arraysj) - 1;
	for ($i=0; $i<$size; $i++){
		$sjd = $arraysj[$i];
		if( $sjd ){
			$arraysjjb = explode(', ', $sjd);
			$arraysjqs = explode('-', $arraysjjb[1]);
			if( $arraysjjb[0] == 'nianfen' ){
				$ksnianfen = '';$jsnianfen = '';
				for($j=0; $j<10; $j++){
					if( date("Y",time())+$j == $arraysjqs[0] ){
						$ksnianfen .= '<option value="'.(date("Y",time())+$j).'" selected="selected">'.(date("Y",time())+$j).'</option>';
					}else{
						$ksnianfen .= '<option value="'.(date("Y",time())+$j).'">'.(date("Y",time())+$j).'</option>';
					}
					if( date("Y",time())+$j == $arraysjqs[1] ){
						$jsnianfen .= '<option value="'.(date("Y",time())+$j).'" selected="selected">'.(date("Y",time())+$j).'</option>';
					}else{
						$jsnianfen .= '<option value="'.(date("Y",time())+$j).'">'.(date("Y",time())+$j).'</option>';
					}
				}
				echo '<li class="nianfen ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:2em;">年份：</strong><select class="ksnian text ui-widget-content ui-corner-all" name="ksnian">'.$ksnianfen.'</select>至<select class="jsnian text ui-widget-content ui-corner-all" name="jsnian">'.$jsnianfen.'</select></li>';
			} elseif ( $arraysjjb[0] == 'yuefen' ) {
				$ksyuefen='';$jsyuefen='';
				for($j=1; $j<13; $j++){
					if( $j == $arraysjqs[0] ){
						$ksyuefen .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$ksyuefen .= '<option value="'.$j.'">'.$j.'</option>';
					}
					if( $j == $arraysjqs[1] ){
						$jsyuefen .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$jsyuefen .= '<option value="'.$j.'">'.$j.'</option>';
					}
				}
				echo '<li class="yuefen ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:4em;">月份：</strong><select class="ksyue text ui-widget-content ui-corner-all" name="ksyue">'.$ksyuefen.'</select>至<select class="jsyue text ui-widget-content ui-corner-all" name="jsyue">'.$jsyuefen.'</select></li>';
			} elseif ( $arraysjjb[0] == 'riqi' ) {
				$ksriqi='';$jsriqi='';
				for($j=1; $j<32; $j++){
					if( $j == $arraysjqs[0] ){
						$ksriqi .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$ksriqi .= '<option value="'.$j.'">'.$j.'</option>';
					}
					if( $j == $arraysjqs[1] ){
						$jsriqi .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$jsriqi .= '<option value="'.$j.'">'.$j.'</option>';
					}
				}
				echo '<li class="riqi ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:6em;">日期：</strong><select class="ksriqi text ui-widget-content ui-corner-all" name="ksriqi">'.$ksriqi.'</select>至<select class="jsriqi text ui-widget-content ui-corner-all" name="jsriqi">'.$jsriqi.'</select></li>';
			} elseif ( $arraysjjb[0] == 'xingqi' ){
				$ksxingqi='';$jsxingqi='';
				for($j=1; $j<8; $j++){
					if( $j == $arraysjqs[0] ){
						$ksxingqi .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$ksxingqi .= '<option value="'.$j.'">'.$j.'</option>';
					}
					if( $j == $arraysjqs[1] ){
						$jsxingqi .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$jsxingqi .= '<option value="'.$j.'">'.$j.'</option>';
					}
				}
				echo '<li class="xingqi ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:8em;">星期：</strong><select class="ksxingqi text ui-widget-content ui-corner-all" name="ksxingqi">'.$ksxingqi.'</select>至<select class="jsxingqi text ui-widget-content ui-corner-all" name="jsxingqi">'.$jsxingqi.'</select></li>';
			} elseif ( $arraysjjb[0] == 'xiaoshi' ){
				$ksxiaoshi='';$jsxiaoshi='';
				for($j=0; $j<24; $j++){
					if( $j == $arraysjqs[0] ){
						$ksxiaoshi .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$ksxiaoshi .= '<option value="'.$j.'">'.$j.'</option>';
					}
					if( $j == $arraysjqs[1] ){
						$jsxiaoshi .= '<option value="'.$j.'" selected="selected">'.$j.'</option>';
					} else {
						$jsxiaoshi .= '<option value="'.$j.'">'.$j.'</option>';
					}
				}
				echo '<li class="xiaoshi ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除"></span><strong style="margin-left:10em;">小时：</strong><select class="ksxiaoshi text ui-widget-content ui-corner-all" name="ksxiaoshi">'.$ksxiaoshi.'</select>至<select class="jsxiaoshi text ui-widget-content ui-corner-all" name="jsxiaoshi">'.$jsxiaoshi.'</select></li>';
			}
		}
	}
}
?>
            </ul>
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
                <option value="1"<?php echo ($arrayd[10]==1)?' selected="selected"':'' ?>>展现</option>
                <option value="2"<?php echo ($arrayd[10]==2)?' selected="selected"':'' ?>>点击</option>
            </select>
            <input type="text" name="mrcs" id="mrcs" class="text ui-widget-content ui-corner-all" value="<?php echo $arrayd[11] ?>" size="4" />次
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
                <option value="1"<?php echo ($arrayd[12]==1)?' selected="selected"':'' ?>>每天</option>
                <option value="2"<?php echo ($arrayd[12]==2)?' selected="selected"':'' ?>>小时</option>
                <option value="3"<?php echo ($arrayd[12]==3)?' selected="selected"':'' ?>>30分钟</option>
                <option value="4"<?php echo ($arrayd[12]==4)?' selected="selected"':'' ?>>10分钟</option>
                <option value="5"<?php echo ($arrayd[12]==5)?' selected="selected"':'' ?>>每分钟</option>
            </select>
            最多展现<input id="fkcs" name="fkcs" type="text" value="<?php echo $arrayd[13]?>" size="4" class="text ui-widget-content ui-corner-all">次
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
                <option value="1"<?php echo $arrayd[14]?' selected="selected"':'' ?>>不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="os" size="18" multiple="multiple" class="text ui-widget-content ui-corner-all">
<?php 
$arrayos = explode(', ', $arrayd[15]);
$allosnames = array('Windows xp','Windows 7','Windows 8','Windows vista','Windows 2000','Windows 98','Windows 2003','Windows 95','Windows NT 4.0','Windows NT','Macintosh','Linux','Android','iphone','ipad','ipod','iOS','other');
foreach($allosnames as $osval){
	if( in_array($osval, $arrayos) ){
		echo '<option value ="'.$osval.'" selected>'.($osval=='other'?'其他':$osval).'</option>';
	} else {
		echo '<option value ="'.$osval.'">'.($osval=='other'?'其他':$osval).'</option>';
	}
}
?>
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
                <option value="1"<?php echo $arrayd[16]?' selected="selected"':'' ?>>不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="fbl" size="19" multiple="multiple" class="text ui-widget-content ui-corner-all">
<?php 
$arrayfbl = explode(', ', $arrayd[17]);
$allfblnames = array('320*480','640*480','800*600','1024*768','1152*864','1280*720','1280*768','1280*800','1280*960','1280*1024','1360*768','1366*768','1400*1050','1440*900','1600*900','1680*1050','1920*1080','1920*1200','other');
foreach($allfblnames as $fblval){
	if( in_array($fblval, $arrayfbl) ){
		echo '<option value ="'.$fblval.'" selected>'.($fblval=='other'?'其他':$fblval).'</option>';
	}else{
		echo '<option value ="'.$fblval.'">'.($fblval=='other'?'其他':$fblval).'</option>';
	}
}
?>
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
                <option value="1"<?php echo $arrayd[18]?' selected="selected"':'' ?>>不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="llq" size="12" multiple="multiple" class="text ui-widget-content ui-corner-all">
<?php 
$arrayllq = explode(', ', $arrayd[19]);
$allllqnames = array('Internet Explorer 5','Internet Explorer 6','Internet Explorer 7','Internet Explorer 8','Internet Explorer 9','Internet Explorer 10','Firefox','Mozilla','Chrome','Opera','Safari','other');
foreach($allllqnames as $llqval){
	if( in_array($llqval, $arrayllq) ){
		echo '<option value ="'.$llqval.'" selected>'.($llqval=='other'?'其他':$llqval).'</option>';
	}else{
		echo '<option value ="'.$llqval.'">'.($llqval=='other'?'其他':$llqval).'</option>';
	}
}
?>
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
                <option value="1"<?php echo $arrayd[20]?' selected="selected"':'' ?>>不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="yuy" size="6" multiple="multiple" class="text ui-widget-content ui-corner-all">
<?php 
$arrayyuy = explode(', ', $arrayd[21]);
$allyuynames = array('zh-cn','zh-tw','en','jp','ko','other');
$allyuynames1 = array('中文(简体)','中文(繁体)','英语','日语','韩语','其他');
$k = 0;
foreach($allyuynames as $yuyval){
	if( in_array($yuyval, $arrayyuy) ){
		echo '<option value ="'.$yuyval.'" selected>'.$allyuynames1[$k].'</option>';
	}else{
		echo '<option value ="'.$yuyval.'">'.$allyuynames1[$k].'</option>';
	}
	$k++;
}
?>
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
                <option value="1"<?php echo $arrayd[22]?' selected="selected"':'' ?>>不包含</option>
            </select>
            </div>
            <div style="float:left;">
            <textarea name="vly" id="vly" cols="50" rows="6" class="text ui-widget-content ui-corner-all"><?php echo $arrayd[23] ?></textarea>
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
                <option value="1"<?php echo $arrayd[24]?' selected="selected"':'' ?>>不包含</option>
            </select>
            </div>
            <div style="float:left;">
            <textarea name="url" id="url" cols="50" rows="8" class="text ui-widget-content ui-corner-all"><?php echo $arrayd[25] ?></textarea>
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
                <option value="1"<?php echo $arrayd[26]?' selected="selected"':'' ?>>不包含</option>
            </select>
            </div>
            <div style="float:left;">
            <textarea name="diyu" id="diyu" cols="50" rows="8" class="text ui-widget-content ui-corner-all"><?php echo $arrayd[27] ?></textarea>
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
                <option value="1"<?php echo $arrayd[28]?' selected="selected"':'' ?>>不等于</option>
            </select>
            </div>
            <div style="float:left;">
            <select name="jr" size="6" multiple="multiple" class="text ui-widget-content ui-corner-all">
 <?php 
$arrayjr = explode(', ', $arrayd[29]);
$alljrnames = array('dx','lt','jyw','tt','wt','other');
$alljrnames1 = array('电信','联通','教育网','铁通','网通','其他');
$k = 0;
foreach($alljrnames as $jrval){
	if( in_array($jrval, $arrayjr) ){
		echo '<option value ="'.$jrval.'" selected>'.$alljrnames1[$k].'</option>';
	}else{
		echo '<option value ="'.$jrval.'">'.$alljrnames1[$k].'</option>';
	}
	$k++;
}
?>
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
<input id="gid" name="gid" type="hidden" value="<?php echo $gid ?>">
<input id="gtime" name="gtime" type="hidden" value="<?php echo $arrayd[0] ?>">

</form>
</div>
<?php require 'mo.foot.php'; ?>