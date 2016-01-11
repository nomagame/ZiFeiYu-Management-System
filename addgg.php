<?php

define('NIUXAMS_ACCESS', 'addgg');
require 'common.php';
$menu = $_REQUEST['menu'];
///////////////////////////
if( $menu == 'addgg' ){
$ggtitle = insql($_POST['ggtitle']);
$ggdm = insql($_POST['ggdm']);
$ggclass = insql($_POST['ggclass']);
$ggwidth = insql($_POST['ggwidth']);
$ggheight = insql($_POST['ggheight']);
$gglei = insql($_POST['gglei']);
$ggzu = insql($_POST['ggzu']);
$ggtj = insql($_POST['ggtj']);
$ggjfclass = insql($_POST['ggjfclass']);
$ontid = date("YmdHis",time());
$path = $datadir.'/'.$thread.'-'.$ontid.'.js';
$path1 = $datadir.'/'.$thread.'-'.$ontid.'.php';
$path2 = $datadir.'/gglist.php';
if( $ggtj ){
	$ggcon = 'document.write(unescape("'.$ggdm.'"));'."\r\n".'document.write(amsurl+\'counter.js?gid='.$thread.'-'.$ontid.'&atyh=\'+atyh+\'"></script>\');';
}else{
	$ggcon = 'document.write(unescape("'.$ggdm.'"));';
}
$ggcon1 = '<?php exit();?>'."\r\n".$ggtitle."\r\n".$ggdm."\r\n".$ggclass."\r\n".$ggwidth."\r\n".$ggheight."\r\n".gnt()."\r\n".$ggzu."\r\n".$ggtj."\r\n".$ggjfclass."\r\n".$gglei;

file_put_contents($path, $ggcon) or die('出错啦！无法创建.js文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
file_put_contents($path1, $ggcon1) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$gglist = file( $path2 );
if( !is_array($gglist) ){ $gglist[] = ''; }
array_shift( $gglist );
array_unshift($gglist, $thread.'-'.$ontid."\r\n");
array_unshift($gglist, '<?php exit();?>'."\r\n");
file_put_contents($path2, $gglist) or die('出错啦！无法创建.php文件！请将程序目录和所有文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('添加广告', $ontid, 1, getname());
die('1');
}
///////////////////////////
$ggiftj = $_COOKIE['ggiftj'];
$gglei = unescape($_COOKIE['gglei']);
$ggzu = unescape($_COOKIE['ggzu']);
$ggleil = file_get_contents( $datadir . '/ggleilist.php' );
$ggll = explode("\r\n", $ggleil);
array_shift( $ggll );
$ggleilist = '';
foreach($ggll as $value){
	if( $value ){
		if( $value == $gglei ){
			$ggleilist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggleilist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$ggzul = file_get_contents( $datadir . '/ggzulist.php' );
$ggz = explode("\r\n", $ggzul);
array_shift( $ggz );
$ggzulist = '';
foreach($ggz as $value){
	if( $value ){
		if( $value == $ggzu ){
			$ggzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'" selected="selected">'.htmlspecialchars(cutstr($value,10)).'</option>';
		} else {
			$ggzulist .= '<option value="'.htmlspecialchars($value).'" title="'.htmlspecialchars($value).'">'.htmlspecialchars(cutstr($value,10)).'</option>';
		}
	}
}
$ggtjlist = '<option value="0">关闭统计</option><option value="1"'.($ggiftj == 1 ? ' selected="selected"' : '').'>开启统计</option>';

$ggtl = file_get_contents( $datadir . '/ggtemplist.php' );
$ggtla = explode("\r\n", $ggtl);
array_shift( $ggtla );
array_pop( $ggtla );
$ggtemp_list = '<option value="">〖广告模板〗</option>';
foreach($ggtla as $key=>$value){
	if( $value && file_exists($datadir . '/' . $value . '.php') ){
		$mbnr = file($datadir . '/' . $value . '.php');
		array_shift($mbnr);
		$mbsm = htmlspecialchars(rtrim(array_shift($mbnr)));
		$ggtemp_list .= '<option value="'.$value.'" title="'.htmlspecialchars($mbsm).'">'.htmlspecialchars(cutstr($mbsm,10)).'</option>';
	}
}

$title = '添加新广告';
require 'mo.head.php';
?>
<style type="text/css">
td.left {
	width: 12%;
	text-align: right;
}
input.text,select.text,textarea.text {
	padding: .3em;
	font-size: 1em;
}
#ggtitle{
	width: 24em;
}
#ggdm{
	width: 850px;
	height: 322px;
}
</style>
<script type="text/javascript">
$(function() {
	var obj = $( '#ggdm' ).get(0);
	$( '#textlink' ).click(function(){codecharu(obj, '<a href="链接地址" target="_blank" title="链接说明">显示文本</a>');});
	$( '#imglink' ).click(function(){codecharu(obj, '<a href="链接地址" target="_blank" title="链接说明"><img src="图片地址" alt="图片说明" border="0" width="图片宽度" height="图片高度" /></a>');});
	$( '#flash' ).click(function(){codecharu(obj, '<embed src="flash地址" quality="high" width="宽度" height="高度" align="middle" allowScriptAccess="sameDomain" allowFullscreen="true" type="application/x-shockwave-flash"></embed>');});
	$( '#iframe' ).click(function(){codecharu(obj, '<iframe src="链接地址" frameborder="0" scrolling="no" height="100%" width="100%"></iframe>');});
	$( '#ulli' ).click(function(){codecharu(obj, '<ul><li>显示文本1</li><li>显示文本2</li></ul>');});
	$( '#jscode' ).click(function(){codecharu(obj, '<script language="JavaScript" type="text/javascript"> <\/script>\r\n');});
	$( '#jswj' ).click(function(){codecharu(obj, '<script src="链接地址" charset="utf-8" language="JavaScript" type="text/javascript"><\/script>');});
	$( '#jstc' ).click(function(){codecharu(obj, '<script type="text/javascript">\r\nfunction open_win(){document.getElementById("niuxtcgg").style.display="none";\r\nwindow.open("窗口链接");}\r\n<\/script>\r\n<div id="niuxtcgg" style="width:100%;height:100%;position:absolute;top:0;left:0;z-index:99;cursor:text;" onclick="open_win()"></div>');});
	$( '#ggmb' ).change(function(){
		if( $( this ).val() ){
			$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
			$.post( 'ggtemplates.php', {
				menu: 'getmbcon',
				selectggmb: $( '#ggmb' ).val()
			},
			function( data ){
				var dd = eval( '(' + data + ')' );
				codecharu(obj, unescape(dd.content));
				$( "#Coverlayer" ).toggle();
			});
		}
	});
	$( '#upload' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( "#dialog_form" ).dialog({
		autoOpen: false,
		width: 540,
		height: 240,
		position: {
			my: "right top",
			at: "right bottom",
			of: $( '#upload' )
		},
		show: {
			effect: "blind",
			duration: 400
		},
		hide: {
			effect: "puff",
			duration: 400
		}
	});
	$( '#yulan' ).click(function() {
		myWindow = window.open('');
		myWindow.document.write( $( '#ggdm' ).val() );
	});
	$( '#submit' ).click(function(){
		if(confirm('您确定吗？')){
			var action = $( this ),
			ggtitle = $( "#ggtitle" ),
			ggdm = $( "#ggdm" ),
			ggwidth = $( "#ggwidth" ),
			ggheight = $( "#ggheight" );
			if( ggtitle.val().length < 1 ){
				ggtitle.focus();
				alert("标题不能为空！");
				return false;
			}
			if( ggdm.val().length < 1 ){
				ggdm.focus();
				alert("代码不能为空！");
				return false;
			}
			if( ggwidth.val().length > 0 && ggwidth.val().match(/\D/g) ){
				ggwidth.focus();
				alert("宽度必须是数字！");
				return false;
			}
			if( ggheight.val().length>0 && ggheight.val().match(/\D/g) ){
				ggheight.focus();
				alert("高度必须是数字！");
				return false;
			}
			action.addClass( "ui-state-error ").attr( "disabled" , true );
			setCookie('gglei', $( "#gglei option:selected" ).val(), 120, '/');
			setCookie('ggzu', $( "#ggzu option:selected" ).val(), 120, '/');
			setCookie('ggiftj', $( "#ggtj option:selected" ).val(), 120, '/');
			$.ajax({
				type: "POST",
				url: location.href,
				data: {
					menu : 'addgg',
					ggtitle : escape(ggtitle.val()),
					ggdm : escape(ggdm.val()),
					ggclass : $( "input[name='ggClass']:checked" ).val(),
					ggjfclass : $( "input[name='ggjfClass']:checked" ).val(),
					ggwidth  : ggwidth.val(),
					ggheight : ggheight.val(),
					gglei : $( "#gglei option:selected" ).val(),
					ggzu : $( "#ggzu option:selected" ).val(),
					ggtj : $( "#ggtj option:selected" ).val()
				},
				success: function( msg ){
					if ( msg == '1' ){
						if(confirm( '恭喜你，添加广告成功！是否继续添加广告？' )){
							location = location.href;
						} else {
							location = 'listgg.php';
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
    <td class="left">广告名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="ggtitle" name="ggtitle" type="text" />
      &nbsp;&nbsp;广告分类：<select class="text ui-widget-content ui-corner-all" id="gglei" name="gglei"><?php echo $ggleilist ?></select>
      &nbsp;&nbsp;广告分组：<select class="text ui-widget-content ui-corner-all" id="ggzu" name="ggzu"><?php echo $ggzulist ?></select>
      &nbsp;&nbsp;广告统计：<select class="text ui-widget-content ui-corner-all" id="ggtj" name="ggtj"><?php echo $ggtjlist ?></select>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告HTML代码：</td>
    <td class="right">
    	<button type="button" class="button" id="textlink" title="">文字连接</button>
        <button type="button" class="button" id="imglink" title="">图片连接</button>
        <button type="button" class="button" id="flash" title="">flash</button>
        <button type="button" class="button" id="iframe" title="">iframe</button>
        <button type="button" class="button" id="ulli" title="">无序列表</button>
        <button type="button" class="button" id="jscode" title="">js代码</button>
        <button type="button" class="button" id="jswj" title="">js文件</button>
        <button type="button" class="button" id="jstc" title="">js弹窗</button>
        <button type="button" class="button" id="upload" title="">上传文件</button>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left" style="vertical-align:top"><select class="text ui-widget-content ui-corner-all" id="ggmb" name="ggmb"><?php echo $ggtemp_list ?></select></td>
    <td class="right"><textarea class="text ui-widget-content ui-corner-all" name="ggdm" id="ggdm"></textarea></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告计费模式：</td>
    <td class="right">
    <label title="您未分类或其他类型的计费模式">
      <input type="radio" name="ggjfClass" value="0" id="ggjfClass_0" checked />
      其他</label>
    &nbsp;
    <label title="CPM（按展示付费）CPM—英文全称Cost Per Mille 或者是Cost Per ThousandImpression。CPM是一种展示付费广告，只要展示了广告主的广告内容，广告主就为此付费。这种广告的效果不是很好，但是却能给有一定流量的网站、博客带来稳定的收入。通常表现为 1000显示/ 元。">
      <input type="radio" name="ggjfClass" value="1" id="ggjfClass_1" />
      CPM</label>
    &nbsp;
    <label title="CPC（按点击付费）CPC—英文全称Cost Per Click。CPC是一种点击付费广告，根据广告被点击的次数收费。在这种模式下广告主仅为用户点击广告的行为付费，而不再为广告的显示次数付费。">
      <input type="radio" name="ggjfClass" value="2" id="ggjfClass_2" />
      CPC</label>
    &nbsp;
    <label title="CPA（按行为付费）CPA—英文全称Cost Per Action。CPA是一种按广告投放实际效果计价方式的广告，即按回应的有效问卷或定单来计费，而不限广告投放量。CPA的计价方式对于网站而言有一定的风险，但若广告投放成功 ，其收益也比CPM的计价方式要大得多。">
      <input type="radio" name="ggjfClass" value="3" id="ggjfClass_3" />
      CPA</label>
    &nbsp;
    <label title="CPS（按销售付费）CPS—英文全称Cost Per Sales。CPS是一种以实际销售产品数量来计算广告费用的广告，这种广告更多的适合购物类、导购类、网址导航类的网站，需要精准的流量才能带来转化。">
      <input type="radio" name="ggjfClass" value="4" id="ggjfClass_4" />
      CPS</label>
    &nbsp;
    <label title="CPT（按时长付费）CPT—英文全称Cost Per Time。 CPT是一种以时间来计费的广告，国内很多的网站都是按照'一个月多少钱'这种固定收费模式来收费的，这种广告形式很粗糙，无法保障客户的利益。但是 CPT的确是一种很省心的广告，能给你的网站、博客带来稳定的收入。">
      <input type="radio" name="ggjfClass" value="5" id="ggjfClass_5" />
      CPT</label>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告展示类型：</td>
    <td class="right">
    <label>
      <input type="radio" name="ggClass" value="0" id="ggClass_0" checked />
      固定</label>
    &nbsp;
    <label>
      <input type="radio" name="ggClass" value="1" id="ggClass_1" />
      漂浮</label>
    &nbsp;
    <label>
      <input type="radio" name="ggClass" value="2" id="ggClass_2" />
      弹窗</label>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">广告展示尺寸：</td>
    <td class="right">
    宽度<input class="text ui-widget-content ui-corner-all" name="ggwidth" id="ggwidth" type="text" value="" size="4" />&times;高度<input class="text ui-widget-content ui-corner-all" name="ggheight" id="ggheight" type="text" value="" size="4" />&nbsp;<span class="tip">（需要自动适应宽度或高度、漂浮、弹窗就不填）</span>
    </td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">&nbsp;</td>
    <td class="right">
    <input name="submit" id="submit" class="button" type="button" value=" 完 成 " /><input name="reset" class="button" type="reset" value=" 重 置 " />
    &nbsp;&nbsp;<input id="yulan" name="yulan" type="button" value=" 预 览 " class="button" title="有些智能广告在虚拟页面是不显示的。" /> 
    </td>
  </tr>
</table>
</div>
</div>
</form>
</div>

<div id="dialog_form" title="上传文件：">
  <p class="cp" style="height:158px;"><iframe src="uploads.php" name="uploadiframe" frameborder="0" scrolling="no" height="100%" width="100%"></iframe></p>
</div>
<?php require 'mo.foot.php'; ?>