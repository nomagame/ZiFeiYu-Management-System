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
define('NIUXAMS_ACCESS', 'editggw');
require 'common.php';
$menu = $_POST['menu'];
$gid = $_REQUEST['gid'];
$ggwd = file_get_contents($datadir . '/' . $gid . '.php') or errwin('出错啦！打开文件出错，请输入正确的gid！');
$arrayd = explode("\r\n", $ggwd);
array_shift( $arrayd );
///////////////////////////
if( $menu == 'editggw' ){
$ggwtitle = insql($_POST['ggwtitle']);
$ggwclass = insql($_POST['ggwclass']);
$ggwwidth = insql($_POST['ggwwidth']);
$ggwheight = insql($_POST['ggwheight']);
$xzggcl = insql($_POST['xzggcl']);
$bjgg = insql($_POST['bjgg']);
$ggwlei = insql($_POST['ggwlei']);
$ggwzu = insql($_POST['ggwzu']);
$gid = insql($_POST['gid']);
$gtime = insql($_POST['gtime']);
if( !$ggwtitle ){die('标题不能为空！');}
require 'func.gg.php';
$path = $datadir.'/'.$gid.'.js';
$path1= $datadir.'/'.$gid.'.php';
$ggwcon = ggwtojs($gid,$xzggcl,$ggwwidth,$ggwheight,$bjgg,$ggwclass);
$ggwcon1 = '<?php exit();?>'."\r\n".$gtime."\r\n".$ggwtitle."\r\n".$ggwclass."\r\n".$ggwwidth."\r\n".$ggwheight."\r\n".$xzggcl."\r\n".$bjgg."\r\n".$ggwzu."\r\n".$ggwlei;
file_put_contents($path, $ggwcon) or die('出错啦！无法创建.js文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
file_put_contents($path1, $ggwcon1) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('修改广告位', $gid, 1, getname());
die('1');
}
///////////////////////////
$ggwleil = file_get_contents( $datadir . '/ggwleilist.php' );
$ggwll = explode("\r\n", $ggwleil);
array_shift( $ggwll );
$ggwleilist = '';
foreach($ggwll as $value){
	if( $value ){
		if( $value == $arrayd[8] ){
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
		if( $value == $arrayd[7] ){
			$ggwzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggwzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}

$title = '修改广告位';
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
	$( "#ggwtitle" ).val( unescape($( "#ggwtitle" ).val()) );
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
	if( $( "#ggwlx_0" ).attr("checked") ){ $( "#ggwlx_0" ).click(); }
	if( $( "#ggwlx_1" ).attr("checked") ){ $( "#ggwlx_1" ).click(); }
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
		if( confirm('修改即刻生效！您确定要修改吗？') ){
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
					menu : 'editggw',
					ggwtitle : escape( $( "#ggwtitle" ).val() ),
					ggwclass : $( "input[name='ggwlx']:checked" ).val(),
					ggwwidth : $( "#ggwwidth" ).val(),
					ggwheight : $( "#ggwheight" ).val(),
					xzggcl : selectggcl,
					bjgg : selectgg,
					ggwlei : $( "#ggwlei option:selected" ).val(),
					ggwzu : $( "#ggwzu option:selected" ).val(),
					gid : $( "#gid" ).val(),
					gtime : $( "#gtime" ).val()
				},
				success: function( msg ){
					if ( msg == '1' ){
						alert("恭喜你，修改成功！");
						location = 'listggw.php';
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
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="ggwtitle" name="ggwtitle" type="text" value="<?php echo $arrayd[1] ?>" />
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
    宽度<input class="text ui-widget-content ui-corner-all" name="ggwwidth" id="ggwwidth" type="text" value="<?php echo  $arrayd[3] ?>" size="4" />&times;高度<input class="text ui-widget-content ui-corner-all" name="ggwheight" id="ggwheight" type="text" value="<?php echo  $arrayd[4] ?>" size="4" />
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
      <input type="radio" name="ggwlx" value="1" id="ggwlx_0"<?php if($arrayd[2]==1){echo " checked";} ?> />
      固定占位</label>
    <label>
      <input type="radio" name="ggwlx" value="2" id="ggwlx_1"<?php if($arrayd[2]==2){echo " checked";} ?> />
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
<?php 
if( $arrayd[5] ){
	$arraygg = explode('. ', $arrayd[5]);
	$size = count($arraygg);
	for ($i=0; $i<$size; $i++){
		if( $arraygg[$i] ){
			$ggd = file_get_contents( $datadir . '/' . $arraygg[$i] . '.php' );
			$arrayggd = array();
			$arrayggd = explode("\r\n", $ggd);
			array_shift( $arrayggd );
			if($arrayggd[3]==1){$class='固定';}else{$class='非固定';}
			$pattern = '|(, )(.+?)(\. )|is';
			$tfgg = '包含广告：'."\r\n".preg_replace($pattern, "\r\n", $arrayggd[5]);
			if($arrayggd[9]||($arrayggd[10]&&$arrayggd[11])||($arrayggd[12]&&$arrayggd[13])){$tfgg .= "时间条件：√\r\n";}
			if($arrayggd[15]){$tfgg .= "操作系统条件：√\r\n";}
			if($arrayggd[17]){$tfgg .= "分辨率条件：√\r\n";}
			if($arrayggd[19]){$tfgg .= "浏览器条件：√\r\n";}
			if($arrayggd[21]){$tfgg .= "语言条件：√\r\n";}
			if($arrayggd[23]){$tfgg .= "来源条件：√\r\n";}
			if($arrayggd[25]){$tfgg .= "url条件：√\r\n";}
			if($arrayggd[27]){$tfgg .= "地域条件：√\r\n";}
			if($arrayggd[29]){$tfgg .= "接入条件：√\r\n";}
			if($arrayggd[31]){$tfgg .= "策略分类：".$arrayggd[31]."\r\n";}
			if($arrayggd[30]){$tfgg .= "策略分组：".$arrayggd[30]."\r\n";}
			$tfgg.="策略描述说明：";
			echo '<tr class="list">';
			echo '<td class="ui-widget-content uitd ct"><button type="button" class="button delselectggcl" title="'.$arraygg[$i].'" value="'.$arraygg[$i].'">移除</button></td>';
			echo '<td class="ui-widget-content uitd ct">-</td>';
			echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayggd[31]).'">'.htmlspecialchars(cutstr($arrayggd[31],6)).'</span></td>';
			echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayggd[30]).'">'.htmlspecialchars(cutstr($arrayggd[30],6)).'</span></td>';
			echo '<td class="ui-widget-content uitd pl"><a href="editggcl.php?gid='.$arraygg[$i].'" title="'.$tfgg.htmlspecialchars(cutstr(unescape($arrayggd[2]),3000)).'" target="_blank">'.htmlspecialchars(cutstr(unescape($arrayggd[1]),38)).'</a></td>';
			echo '<td class="ui-widget-content uitd ct">'.$arrayggd[4].'</td>';
			echo '<td class="ui-widget-content uitd ct">'.$class.'</td>';
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
<?php 
if( $arrayd[6] ){
	$ggd = file_get_contents( $datadir . '/' . $arrayd[6] . '.php' );
	$arrayggd = array();
	$arrayggd = explode("\r\n", $ggd);
	array_shift( $arrayggd );
	if($arrayggd[2]==0){$gglx='固定';}else if($arrayggd[2]==1){$gglx='漂浮';}else{$gglx='弹窗';}
	if($arrayggd[3]==''){$arrayggd[3]='-';}
	if($arrayggd[4]==''){$arrayggd[4]='-';}
	if(!$arrayggd[8]){$jfclass='其他';}else if($arrayggd[8]==1){$jfclass='CPM';}else if($arrayggd[8]==2){$jfclass='CPC';}else if($arrayggd[8]==3){$jfclass='CPA';}else if($arrayggd[8]==4){$jfclass='CPS';}else if($arrayggd[8]==5){$jfclass='CPT';}
	echo '<tr class="list">';
	echo '<td class="ui-widget-content uitd ct"><button type="button" class="button delselectgg" title="'.$arrayd[6].'" value="'.$arrayd[6].'">移除</button></td>';
	echo '<td class="ui-widget-content uitd ct">-</td>';
	echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayggd[9]).'">'.htmlspecialchars(cutstr($arrayggd[9],6)).'</span></td>';
	echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars($arrayggd[6]).'">'.htmlspecialchars(cutstr($arrayggd[6],6)).'</span></td>';
	echo '<td class="ui-widget-content uitd pl"><a href="previewgg.php?gid='.$arrayd[6].'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayggd[1]),3000)).'">'.htmlspecialchars(cutstr(unescape($arrayggd[0]),22)).'</a></td>';
	echo '<td class="ui-widget-content uitd ct"><a href="editgg.php?gid='.$arrayd[6].'" target="_blank" title="'.htmlspecialchars(cutstr(unescape($arrayggd[0]),255)).'">修改</a></td>';
	echo '<td class="ui-widget-content uitd ct"><span title="'.htmlspecialchars(cutstr(unescape($arrayggd[1]),9000)).'" class="previewgg">'.$gglx.'</span></td>';
	echo '<td class="ui-widget-content uitd ct">'.$jfclass.'</td>';
	echo '<td class="ui-widget-content uitd ct">'.$arrayggd[3].'&times;'.$arrayggd[4].'</td>';
	echo '</tr>';
}
?>
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
    <input name="submit" id="submit" class="button" type="button" value=" 完 成 " /> <input name="reset" class="button" type="reset" value=" 重 置 " /><input id="gid" name="gid" type="hidden" value="<?php echo $gid ?>" /><input id="gtime" name="gtime" type="hidden" value="<?php echo $arrayd[0] ?>" />

    </td>
  </tr>
</table>
</div>

</div>
</form>
</div>
<?php require 'mo.foot.php'; ?>