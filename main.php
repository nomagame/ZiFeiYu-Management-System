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
require 'common.php';
if(file_exists('common.php')) {
	$lastday = date("Y-m-d", filemtime('common.php'));
}
$fofile = $datadir . '/fo.' . md5(getname()) . '.php';
$focontent = file($fofile);
array_shift($focontent);
$fodata = '';
$fo_list = '';
$fosortable = '';
foreach ($focontent as $value){
	$value = rtrim($value);
	$nameurl = explode(' ', $value);
	if( $nameurl[0] && $nameurl[1] ){
		$fodata .= '<a class="button" href="'.htmlspecialchars($nameurl[1]).'">'.htmlspecialchars($nameurl[0]).'</a>&nbsp;';
		$fo_list .= '<option value="'.htmlspecialchars($nameurl[1]).'" title="'.htmlspecialchars($nameurl[1]).'">'.htmlspecialchars(cutstr($nameurl[0],10)).'</option>';
		$fosortable .= '<li class="val ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" title="可上下移动"></span><span class="ui-icon ui-icon-close" title="删除此项"></span>'.htmlspecialchars($nameurl[0]).'<input type="hidden" value="'.htmlspecialchars($nameurl[1]).'" /></li>';
	}
}
if( cforr() != '1' ){
	$ggdata = insou1(file_get_contents( $datadir . '/maingg.htm' ));
	$mainggdata = '<div class="cc ui-widget-content ui-corner-all" id="ggdiv"><p class="tt ui-widget-header ui-corner-all">赞助商链接（<a href="http://www.niuxsoft.com/ad/" target="_blank">说明</a>）</p><div class="cp twoem" id="gg">'.$ggdata.'</div></div>';
}
$title = '系统主页';
require 'mo.head.php';
?>
<style>
.twoem{
	line-height: 2em;
}
.threeem{
	line-height: 3em;
}
label.tip {
	display:inline-block;
	width:30%;
	text-align:right;
}
input.text,select.text,textarea.text {
	padding:.3em;
	font-size:1em;
}
.tips {
	padding:.4em 1em;
}
#fosortable li {
	position: relative;
	margin: 0 3px 3px 3px;
	padding: 0.4em;
	padding-left: 1.3em;
	height: 18px;
}
#fosortable li span {
	position: absolute;
	margin-left: 90%;
}
#fosortable li span.ui-icon-close {
	margin-left: -1.2em;
	cursor: pointer;
}
#gg{
	min-height:120px;
}
#sysinfo{
	min-height:316px;
}
td.left {
	width:12em;
	text-align:right;
}
</style>
<script type="text/javascript">
$(function() {
	$( "#sysinfo" ).load( "main.01.php" );
	$( "#getUpdata" ).click(function() {
		$( "#Coverlayer" ).toggle().find('div.ui-corner-all').css("top",screen.height*3/10+$( document ).scrollTop());
		$.get( 'updata.php',
		function( data ){
			if ( data == '1' ){
				alert( '恭喜你，在线升级成功！' );
				window.parent.document.location = '<?php echo $amsurl ?>';
			} else if ( data.length > 200 ) {
				alert( '抱歉，您没有此功能权限，操作失败！' );
			} else {
				alert( data );
			}
			$( "#Coverlayer" ).toggle();
		});
	});
	$( '#addfo' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( '#editfo' ).click(function(){
		$( '#dialog_form1' ).dialog( "open" );
	});
	$( '#delfo' ).click(function(){
		$( '#dialog_form2' ).dialog( "open" );
	});
	$( '#dialog_form' ).dialog({
		autoOpen: false,
		width: 400,
		modal: true,
		position: {
			my: "left bottom",
			at: "left top",
			of: $( '#addfo' )
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
				foname = $( "#foname" ),
				fourl = $( "#fourl" ),
				allFields = $( [] ).add( foname ).add( fourl );
				allFields.removeClass( "ui-state-error" );
				chk = chk && checkRegexp( foname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "不超过20个字母或数字或汉字或下划线", "#addtips");
				chk = chk && checkRegexp( fourl, /^([^\s'"]){1,200}$/, "不超过200个网址字符", "#addtips");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( 'main.02.php', {
						menu: 'addfo',
						foname: foname.val(),
						fourl: fourl.val()
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，添加快捷按钮成功啦！' );
							location = location.href;
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
	$( '#oldfo' ).change(function(){
		$( "#newfoname" ).val($( "#oldfo option:selected" ).text());
		$( "#newfourl" ).val($( "#oldfo option:selected" ).val());
	});
	$( '#dialog_form1' ).dialog({
		autoOpen: false,
		width: 400,
		modal: true,
		position: {
			my: "left bottom",
			at: "left top",
			of: $( '#editfo' )
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
					newfoname = $( "#newfoname" ),
					newfourl = $( "#newfourl" ),
					allFields = $( [] ).add( newfoname ).add( newfourl );
					allFields.removeClass( "ui-state-error" );
					chk = chk && checkRegexp( newfoname, /^([0-9a-zA-Z_\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "不超过20个字母或数字或汉字或下划线", "#changetips");
					chk = chk && checkRegexp( newfourl, /^([^\s'"]){1,200}$/, "不超过200个网址字符", "#changetips");

					if ( chk ) {
						$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
						$.get( 'main.02.php', {
							menu: 'editfo',
							oldfo: $( "#oldfo option:selected"  ).text(),
							newfoname: newfoname.val(),
							newfourl: newfourl.val()
						},
						function( data ){
							if ( data == '1' ){
								alert( '恭喜你，修改快捷按钮成功啦！' );
								location = location.href;
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
		width: 400,
		modal: true,
		position: {
			my: "left bottom",
			at: "left top",
			of: $( '#delfo' )
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
					var fov = '';
					$( "#fosortable li.val" ).each(function(){
						fov = fov + $( this ).text() + " " + $( this ).children( "input" ).val() + "\r\n";
					});
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( 'main.02.php', {
						menu: 'delfo',
						fov: fov
						},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，排列/删除快捷按钮成功啦！' );
							location = location.href;
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
	$( "#fosortable" ).sortable({
		placeholder: "ui-state-highlight"
    });
    $( "#fosortable" ).disableSelection();
	$( ".ui-icon-close" ).click(function() {
		$( this ).parent().removeClass( "val" ).hide( "drop" ,400 );
	});
	$( "#authorization" ).click(function() {
		$.get( 'upload.php?menu=nowgo' );
	});
	$( "#slider-range-min" ).slider({
		range: "min",
		value: getCookie('niuxams_delay') ? getCookie('niuxams_delay') : 400,
		min: 1,
		max: 10000,
		slide: function( event, ui ) {
			setCookie('niuxams_delay', ui.value, 120, '/')
			$( "#delay" ).text( ui.value );
		}
    });
    $( "#delay" ).text( $( "#slider-range-min" ).slider( "value" ) );
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置：<?php echo $title ?></p>

<div class="fw">
<div class="hfw">

<div class="cc ui-widget-content ui-corner-all">
<p class="tt ui-widget-header ui-corner-all">在线升级</p>
<p class="cp twoem">程序文件指纹识别，智能在线升级新文件，无需更新全部文件，配置文件不会修改。<br />欢迎使用NiuXams！您当前的使用版本：<?php echo NIUXAMS_VER?>&nbsp;&nbsp;最后更新时间：<?php echo $lastday?></p>
<p class="cp" style="text-align:right;"><button type="button" class="button" id="getUpdata">在线升级</button></p>
</div>

<div class="cc ui-widget-content ui-corner-all">
<p class="tt ui-widget-header ui-corner-all">商业授权查询</p>
<p class="cp twoem">如果您已购买NiuXams产品商业使用授权，您可以在我们的授权中心查询到授权信息。</p>
<p class="cp" style="text-align:right;"><a href="http://www.niuxsoft.com/authorization/?action=query&class=niuxams&domain=<?php echo $_SERVER['SERVER_NAME']?>" target="_blank" class="button" id="authorization">商业授权查询</a></p>
</div>

<div class="cc ui-widget-content ui-corner-all">
<p class="tt ui-widget-header ui-corner-all">快捷操作</p>
<p class="cp threeem" id="fastoperation"><?php echo $fodata?></p>
<p class="cp" style="text-align:right;">
<button type="button" class="button" id="addfo">增加</button>
<button type="button" class="button" id="editfo">修改</button>
<button type="button" class="button" id="delfo">删除</button>
</p>
</div>

<div class="cc ui-widget-content ui-corner-all">
<p class="tt ui-widget-header ui-corner-all">个人喜好设置：</p>
<p class="cc">提示小窗口显示延迟时间：<span id="delay" class="ui-state-highlight"></span>ms</p>
<div id="slider-range-min" class="cp"></div>
</div>

</div>

<div class="hfw">

<?php echo $mainggdata?>


<div class="cc ui-widget-content ui-corner-all">
<p class="tt ui-widget-header ui-corner-all">系统基本信息</p>
<div class="cp twoem" id="sysinfo"></div>
</div>

</div>

<div class="clear"></div>
</div>

</div>

<div id="dialog_form" title="添加快捷按钮：">
  <p id="addtips" class="cp tips">不要有特殊字符。</p>
  <div class="cp">
  <label class="tip" for="foname">快捷名称：</label>
  <input id="foname" name="foname" type="text" size="20" maxlength="20" class="text ui-widget-content ui-corner-all" title="不超过20个字母或数字或汉字或下划线." /><br /><br />
  <label class="tip" for="fourl">链接网址：</label>
  <input id="fourl" name="fourl" type="text" size="20" class="text ui-widget-content ui-corner-all" title="不要有特殊字符." />
  </div>
</div>
<div id="dialog_form1" title="修改快捷按钮：">
  <p id="changetips" class="cp tips">不要有特殊字符！</p>
  <div class="cp">
  <label class="tip" for="oldfo">选个修改：</label>
  <select id="oldfo" name="oldfo" class="text ui-widget-content ui-corner-all"><?php echo $fo_list ?></select><br /><br />
  <label class="tip" for="newfoname">快捷名称：</label>
  <input id="newfoname" name="newfoname" type="text" size="20" maxlength="20" class="text ui-widget-content ui-corner-all" title="不超过20个字母或数字或汉字或下划线." /><br /><br />
  <label class="tip" for="newfourl">链接网址：</label>
  <input id="newfourl" name="newfourl" type="text" size="20" class="text ui-widget-content ui-corner-all" title="不要有特殊字符." />
  </div>
</div>
<div id="dialog_form2" title="排列/删除快捷按钮：">
  <p id="deltips" class="cp tips">点击<span class="ui-icon ui-icon-close" style="display:inline-block"></span>删除。可拖动排序！</p>
  <div class="cp">
  <ul id="fosortable"><?php echo $fosortable ?></ul>
  </div>
</div>
<?php require 'mo.foot.php'; ?>