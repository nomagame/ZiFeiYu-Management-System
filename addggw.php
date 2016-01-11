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
define('NIUXAMS_ACCESS', 'addggw');
require 'common.php';
$menu = $_POST['menu'];
///////////////////////////
if( $menu == 'addggw' ){
$ggwtitle = insql($_POST['ggwtitle']);
$ggwclass = insql($_POST['ggwclass']);
$ggwwidth = insql($_POST['ggwwidth']);
$ggwheight = insql($_POST['ggwheight']);
$xzggcl = insql($_POST['xzggcl']);
$bjgg = insql($_POST['bjgg']);
$ggwlei = insql($_POST['ggwlei']);
$ggwzu = insql($_POST['ggwzu']);
$ontid = date("YmdHis",time());
$gid = $ggwthread.'-'.$ontid;
if( !$ggwtitle ){die('标题不能为空！');}
require 'func.gg.php';
$path = $datadir.'/'.$ggwthread.'-'.$ontid.'.js';
$path1= $datadir.'/'.$ggwthread.'-'.$ontid.'.php';
$path2= $datadir.'/ggwlist.php';
$ggwcon = ggwtojs($gid,$xzggcl,$ggwwidth,$ggwheight,$bjgg,$ggwclass);
$ggwcon1 = '<?php exit();?>'."\r\n".gnt()."\r\n".$ggwtitle."\r\n".$ggwclass."\r\n".$ggwwidth."\r\n".$ggwheight."\r\n".$xzggcl."\r\n".$bjgg."\r\n".$ggwzu."\r\n".$ggwlei;
file_put_contents($path, $ggwcon) or die('出错啦！无法创建.js文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
file_put_contents($path1, $ggwcon1) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');

$ggwlist = file( $path2 );
if( !is_array($ggwlist) ){ $ggwlist[] = ''; }
array_shift( $ggwlist );
array_unshift($ggwlist, $ggwthread.'-'.$ontid."\r\n");
array_unshift($ggwlist, '<?php exit();?>'."\r\n");
file_put_contents($path2, $ggwlist) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('添加广告位', $gid, 1, getname());
die('1');
}
///////////////////////////
$ggwlei = unescape($_COOKIE['ggwlei']);
$ggwzu = unescape($_COOKIE['ggwzu']);
$ggwleil = file_get_contents( $datadir . '/ggwleilist.php' );
$ggwll = explode("\r\n", $ggwleil);
array_shift( $ggwll );
$ggwleilist = '';
foreach($ggwll as $value){
	if( $value ){
		if( $value == $ggwlei ){
			$ggwleilist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggwleilist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$ggwzul = file_get_contents( $datadir . '/ggwzulist.php' );
$ggwz = explode("\r\n", $ggwzul);
array_shift( $ggwz );
$ggwzulist = '';
foreach($ggwz as $value){
	if( $value ){
		if( $value == $ggwzu ){
			$ggwzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggwzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$title = '添加新广告位';
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
.ui-tooltip {
	max-width: 2000px;
	word-break: break-all;
}
input.text,select.text,textarea.text {
	padding: .3em;
	font-size: 1em;
}
#ggwtitle{
	width: 24em;
}
</style>
<script type="text/javascript">
$(function() {
	$( "#listggclku" ).hide();
	$( "#listggku" ).hide();
	$( "#ggwlx_0" ).click(function(){
		$( "#listggcl" ).load("listggcl.php?menu=ajax",{ggwlx: 0}, function(){$( '.button' ).button();});
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx: 0}, function(){$( '.button' ).button();});
	});
	$( "#ggwlx_1" ).click(function(){
		$( "#listggcl" ).load("listggcl.php?menu=ajax",{ggwlx: 1}, function(){$( '.button' ).button();});
		$( "#listgg" ).load("listgg.php?menu=ajax", {wllx: 1}, function(){$( '.button' ).button();});
	});
	$( "#ggwlx_0" ).click();
	$( '#fromggclk' ).click(function(){$( "#listggclku" ).toggle();});
	$( document ).on("click", "#syggclsy", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), ggcllei:-1, ggclzu:-1, desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#ggclksy", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#clqpage", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), page:$("#clqpage").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#clhpage", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), page:$("#clhpage").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#ggclzhy", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), page:$("#ggclzhy").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#searchggcl", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("change", "#ggcllei", function() {
		setCookie('ggcllei', $(this).val(), 120, '/');
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("change", "#ggclzu", function() {
		setCookie('ggclzu', $(this).val(), 120, '/');
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", "#cldesc_0,#cldesc_1", function() {
		$( "#listggcl" ).load("listggcl.php?menu=ajax", {ggwlx:$("#ggwclass").val(), page:$("#clpage").val(), search:escape($("#searchcl").val()), ggcllei:$("#ggcllei").val(), ggclzu:$("#ggclzu").val(), desc:$("input[name='cldesc']:checked").val()}, function(){$( '.button' ).button();});
	});
	$( document ).on("click", ".selectggcl", function() {
		$( this ).parent().parent().clone().appendTo("#xzggcl table");
		$("#xzggcl table tr:last").children("td").eq(0).replaceWith('<td class="ui-widget-content uitd ct"><button type="button" class="button delselectggcl" title="'+$(this).val()+'" value="'+$(this).val()+'">移除</button></td>');
		$( '.button' ).button();
	});
	$( document ).on("click", ".delselectggcl", function() {
		$( this ).parent().parent().remove();
	});
	
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
		$("#xzgg table tr:eq(1)").remove();
		$( this ).parent().parent().clone().appendTo("#xzgg table");
		$("#xzgg table tr:last").children("td").eq(0).replaceWith('<td class="ui-widget-content uitd ct"><button type="button" class="button delselectgg" title="'+$(this).val()+'" value="'+$(this).val()+'">移除</button></td>');
		$( '.button' ).button();
	});
	$( document ).on("click", ".delselectgg", function() {
		$( this ).parent().parent().remove();
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
			ggwtitle = $( "#ggwtitle" ),
			ggwwidth = $( "#ggwwidth" ),
			ggwheight = $( "#ggwheight" );
			if( ggwtitle.val().length < 1 ){
				ggwtitle.focus();
				alert("标题不能为空！");
				return false;
			}
			if( ggwwidth.val().length > 0 && ggwwidth.val().match(/\D/g) ){
				ggwwidth.focus();
				alert("宽度必须是数字！");
				return false;
			}
			if( ggwheight.val().length > 0 && ggwheight.val().match(/\D/g) ){
				ggwheight.focus();
				alert("高度必须是数字！");
				return false;
			}
			action.addClass( "ui-state-error ").attr( "disabled" , true );
			setCookie('ggwlei', $( "#ggwlei option:selected" ).val(), 120, '/');
			setCookie('ggwzu', $( "#ggwzu option:selected" ).val(), 120, '/');
			var selectggcl = ''; selectgg = '';
			$( ".delselectggcl" ).each(function(){
				selectggcl += $( this ).val() + ". ";
			});
			$( ".delselectgg" ).each(function(){
				selectgg += $( this ).val();
			});
			$.ajax({
				type: "POST",
				url: location.href,
				data: {
					menu : 'addggw',
					ggwtitle : escape( $( "#ggwtitle" ).val() ),
					ggwclass : $( "input[name='ggwlx']:checked" ).val(),
					ggwwidth : $( "#ggwwidth" ).val(),
					ggwheight : $( "#ggwheight" ).val(),
					xzggcl : selectggcl,
					bjgg : selectgg,
					ggwlei : $( "#ggwlei option:selected" ).val(),
					ggwzu : $( "#ggwzu option:selected" ).val()
				},
				success: function( msg ){
					if ( msg == '1' ){
						if(confirm( '恭喜你，添加广告位成功！是否继续添加广告位？' )){
							location = location.href;
						} else {
							location = 'listggw.php';
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
    <td class="left">广告位名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="ggwtitle" name="ggwtitle" type="text" />
      &nbsp;&nbsp;广告位分类：<select class="text ui-widget-content ui-corner-all" id="ggwlei" name="ggwlei"><?php echo $ggwleilist ?></select>
      &nbsp;&nbsp;广告位分组：<select class="text ui-widget-content ui-corner-all" id="ggwzu" name="ggwzu"><?php echo $ggwzulist ?></select>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告位尺寸：</td>
    <td class="right">
    宽度<input class="text ui-widget-content ui-corner-all" name="ggwwidth" id="ggwwidth" type="text" value="" size="4" />&times;高度<input class="text ui-widget-content ui-corner-all" name="ggwheight" id="ggwheight" type="text" value="" size="4" />
<span class="tip">（需要自动适应宽度或高度、非固定占位就不填）</span>
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
      <input type="radio" name="ggwlx" value="1" id="ggwlx_0" checked />
      固定占位</label>
    <label>
      <input type="radio" name="ggwlx" value="2" id="ggwlx_1" />
      非固定占位（漂浮、弹窗）</label>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left" style="vertical-align: top;">插入广告策略：</td>
    <td class="right">
        <div id="xzggcl">
        	<span class="tip">条件投放广告。达到条件投放广告时背景广告不展现。固定占位策略权重优先顺序1级>2级..>10级，权重相同按其排位顺序决定优先。非固定占位策略无视权重！</span>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
            	<tr>
                	<th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2.6em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 29.4em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2.6em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 4em;"></th>
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
    <td class="right"><button type="button" class="button" id="fromggclk">从策略库中选择策略</button>
    <a href="addggcl.php" target="_blank" class="button">添加新广告策略</a>
    </td>
  </tr>
</table>
<div id="listggclku">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">&nbsp;</td>
    <td class="right"><div id="listggcl"></div></td>
  </tr>
</table>
</div>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left" style="vertical-align: top;">背景广告：</td>
    <td class="right">
        <div id="xzgg">
        	<span class="tip">当上面没有插入广告策略或插入的广告策略没有达到条件无输出广告的时候展现的广告。</span>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
            	<tr>
                	<th class="ui-widget-content uith" scope="col" style="width: 4em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2.6em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 18em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2.6em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2.6em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 2.6em;"></th>
                    <th class="ui-widget-content uith" scope="col" style="width: 5em;"></th>
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
</form>
</div>
<?php require 'mo.foot.php'; ?>