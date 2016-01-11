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
define('NIUXAMS_ACCESS', 'sadm');
require 'common.php';
if ( $_REQUEST['menu'] == 'addsub' ){
/////////////////////
$sublgname = htmlspecialchars(insql($_REQUEST['sublgname']));
$sublgpassword = md5(insql($_REQUEST['sublgpassword']));
$yhzselect = htmlspecialchars(insql($_REQUEST['yhzselect']));
if ( $sublgname == $adname ) {
	die('用户登录ID和boss的名称重复，请换名重来噢！');
}
foreach ($subadmin as $key => $value) {
	if ( $sublgname == $key ) {
		die('用户登录ID名称重复，请换名重来！');
	}
}
$subdata = insou1(file_get_contents( 'subadmin.php' ));
$subdata .= "
\$subadmin['$sublgname'][0] = '$sublgpassword';
\$subadmin['$sublgname'][1] = '$yhzselect';";
file_put_contents( 'subadmin.php', $subdata ) or die('出错啦！subadmin.php无法修改！请将程序目录和文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('新增管理员', $sublgname, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'editsub' ){
/////////////////////
$sublgname = htmlspecialchars(insql($_REQUEST['sublgname']));
$sublgpassword = md5(insql($_REQUEST['sublgpassword']));
$yhzselect = htmlspecialchars(insql($_REQUEST['yhzselect']));
if ( $sublgname == $adname ) {
	die('用户登录ID和boss的名称重复，请换名重来噢！');
}
foreach ($subadmin as $key => $value) {
	if ( $sublgname == $key ) {
		$subdata = insou1(file_get_contents( 'subadmin.php' ));
		if ( strlen($_REQUEST['sublgpassword']) > 5 ){
			$subdata = str_replace("\$subadmin['$key'][0] = '$value[0]'", "\$subadmin['$key'][0] = '$sublgpassword'", $subdata);
		}
		$subdata = str_replace("\$subadmin['$key'][1] = '$value[1]'", "\$subadmin['$key'][1] = '$yhzselect'", $subdata);
		file_put_contents( 'subadmin.php', $subdata ) or die('出错啦！subadmin.php无法修改！请将程序目录和文件的文件权限设置属性0755或0777。');
		$conn = new mysql();
		$conn->inoplog('修改管理员', $sublgname, 1, getname());
		die('1');
	}
}
die('貌似没找到你要修改的管理员！');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'delsub' ){
/////////////////////
$sublgname = htmlspecialchars(insql($_REQUEST['sublgname']));
$subdata = '';
$subarr = insou1(file( 'subadmin.php' ));
foreach ($subarr as $value){
	if ( strpos( $value, "\$subadmin['$sublgname']" ) === false){
		$subdata .= $value;
	}
}
$subdata = rtrim( $subdata );
file_put_contents( 'subadmin.php', $subdata ) or die('出错啦！subadmin.php无法修改！请将程序目录和文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('删除管理员', $sublgname, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'addyhz' ){
/////////////////////
$rank = htmlspecialchars(insql($_REQUEST['rank']));
$yhzname = htmlspecialchars(insql($_REQUEST['yhzname']));
$funcselect = rtrim(htmlspecialchars(insql($_REQUEST['funcselect'])), '|');
$accessdir = $datadir.'/access/';
$rankfile = $accessdir.$rank.'.access.php';
if ( !file_exists( $accessdir ) ) {
	mkdir( $accessdir , 0755 , true );
}
if ( is_file( $rankfile ) ) {
	die('用户组序号重复，请换个重来！');
}
$yhznr = '<?php exit();?>'."\r\n".$yhzname."\r\n".$funcselect;
file_put_contents( $rankfile, $yhznr ) or die('出错啦！'.$rankfile.' 无法创建！请将程序目录和文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('新增用户组', $rank, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'edityhz' ){
/////////////////////
$rank = htmlspecialchars(insql($_REQUEST['rank']));
$yhzname = htmlspecialchars(insql($_REQUEST['yhzname']));
$funcselect = rtrim(htmlspecialchars(insql($_REQUEST['funcselect'])), '|');
$rankfile = $datadir.'/access/'.$rank.'.access.php';
if ( !is_file( $rankfile ) ) {
	die('用户组序号不存在，无法修改！');
}
$yhznr = '<?php exit();?>'."\r\n".$yhzname."\r\n".$funcselect;
file_put_contents( $rankfile, $yhznr ) or die('出错啦！'.$rankfile.' 无法修改！请将程序目录和文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('修改用户组', $rank, 1, getname());
die('1');
/////////////////////
} elseif ( $_REQUEST['menu'] == 'delyhz' ){
/////////////////////
$rank = htmlspecialchars(insql($_REQUEST['rank']));
$rankfile = $datadir.'/access/'.$rank.'.access.php';
if ( !is_file( $rankfile ) ) {
	die('用户组 '.$rank.' 不存在，删除失败！');
}
unlink( $rankfile ) or die('出错啦！'.$rankfile.' 无法删除！请将程序目录和文件的文件权限设置属性0755或0777。');
$conn = new mysql();
$conn->inoplog('删除用户组', $rank, 1, getname());
die('1');
/////////////////////
} else {
/////////////////////
$subadminlist = '';
foreach ( $subadmin as $key => $value ) {
	$accessdata = file( $datadir.'/access/'.$value[1].'.access.php' );
	array_shift( $accessdata );
	$zuname = htmlspecialchars(rtrim(array_shift( $accessdata )));
	$subadminlist .= '<tr class="list">';
	$subadminlist .= '<td class="ui-widget-content uitd ct">'.htmlspecialchars($key).'</td>';
	$subadminlist .= '<td class="ui-widget-content uitd ct">'.$zuname.'</td>';
	$subadminlist .= '<td class="ui-widget-content uitd ct"><button type="button" class="button editsa" value="'.htmlspecialchars($value[1]).'" title="修改此管理员属性" />修改</button> <button type="button" class="button delsa" value="'.htmlspecialchars($key).'" title="删除此管理员" />删除</button></td>';
	$subadminlist .= '</tr>';
}
$yhzlist = '';
$yhzselect = '';
$accessdir = $datadir.'/access/';
foreach( scandir( $accessdir ) as $file ){
	if ($file != "." && $file != ".." && !is_dir( $accessdir.$file ) && strpos( $file , '.access.php' ) !== false) {
		$Rank = explode('.', $file);
		$accessnr = file($accessdir.$file);
		array_shift($accessnr);
		$accesssm = htmlspecialchars(rtrim(array_shift($accessnr)));
		$accessqx = htmlspecialchars(rtrim(array_shift($accessnr)));
		$accessqx = strpos( $accessqx, '-' ) !== false ? '全部功能' : $accessqx;
		$yhzlist .= '<tr class="list">';
		$yhzlist .= '<td class="ui-widget-content uitd ct">'.htmlspecialchars($Rank[0]).'</td>';
		$yhzlist .= '<td class="ui-widget-content uitd ct">'.$accesssm.'</td>';
		$yhzlist .= '<td class="ui-widget-content uitd ct"><span title="'.$accessqx.'">'.cutstr($accessqx,100).'</span></td>';
		$yhzlist .= '<td class="ui-widget-content uitd ct"><button type="button" class="button edityhz" value="'.htmlspecialchars($Rank[0]).'" title="修改此用户组属性" />修改</button> <button type="button" class="button delyhz" value="'.htmlspecialchars($Rank[0]).'" title="删除此用户组" />删除</button></td>';
		$yhzlist .= '</tr>';
		$yhzselect .= '<option value="'.htmlspecialchars($Rank[0]).'">'.$accesssm.'</option>';
	}
}
$funcselect = '<option value="-">全部功能</option>';
$funcmenu = file('menu.php');
array_shift($funcmenu);
foreach( $funcmenu as $val ){
	$gnsm = explode(' ', $val);
	if ( $gnsm[0] && $gnsm[1] ) {
		$funcsm = htmlspecialchars(rtrim($gnsm[1]));
		$funcselect .= '<option value="'.$gnsm[0].'">'.$gnsm[1].'：'.$gnsm[0].'</option>';
	}
}
$title="系统用户管理";
require 'mo.head.php';
?>
<style>
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
	text-align: center;
	height: 3em;
}
td.left {
	width:8em;
	text-align:right;
}
input.text,select.text,textarea.text {
	padding:.3em;
}
.ui-tooltip {
    max-width: 350px;
	word-break:break-all;
}
</style>
<script type="text/javascript">
$(function() {
	$( '#addsubadmin' ).click(function(){
		$( '#dialog_form' ).dialog( "open" );
	});
	$( '#dialog_form' ).dialog({
		autoOpen: false,
		width: 450,
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
			"增加": function() {
				var chk = true,
				sublgname = $( "#sublgname" ),
				sublgpassword = $( "#sublgpassword" ),
				yhz = $( "#yhzselect" ),
				allFields = $( [] ).add( sublgname ).add( sublgpassword ).add( yhz ),
				yhzselect = $( "#yhzselect option:selected"  ).val();
				allFields.removeClass( "ui-state-error" );
				if ( !yhzselect ){
					updateTips('用户组不能为空！先去建用户组吧！');
					yhz.addClass("ui-state-error").focus();
					return false;
				}
				chk = chk && checkRegexp( sublgname, /^([0-9a-zA-Z]){3,20}$/, "用户登录ID:3-20个字符的字母、数字的组合.");
				chk = chk && checkLength( sublgpassword, "用户登录密码:", 6, 40);
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( location.href, {
						menu: 'addsub',
						sublgname: sublgname.val(),
						sublgpassword: sublgpassword.val(),
						yhzselect: yhzselect
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，新增管理员成功啦！' );
							location = location.href;
						} else if ( data.length > 200 ) {
							alert( '抱歉，您没有此功能权限，操作失败！' );
						} else {
							alert( data );
						}
						$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false )
					});
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	var ua = '', uc= '';
	$( '.editsa' ).click(function(){
		ua = $( this ).parent( "td" ).parent( "tr" ).children( "td" ).eq(0).text();
		uc = $( this ).val();
		$( "#sublgname1" ).val(ua);
		$( "#yhzselect1 option" ).each(function(){this.selected=false;if($(this).val()==uc){this.selected=true;}});
		$( '#dialog_form1' ).dialog( "open" );
	});
	$( '#dialog_form1' ).dialog({
		autoOpen: false,
		width: 450,
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
				sublgname = $( "#sublgname1" ),
				sublgpassword = $( "#sublgpassword1" ),
				yhz = $( "#yhzselect1" ),
				allFields = $( [] ).add( sublgname ).add( sublgpassword ).add( yhz ),
				yhzselect = $( "#yhzselect1 option:selected" ).val();
				allFields.removeClass( "ui-state-error" );
				if ( !yhzselect ){
					updateTips('用户组不能为空！先去建用户组吧！', "#Tips1");
					yhz.addClass("ui-state-error").focus();
					return false;
				}
				chk = chk && checkRegexp( sublgname, /^([0-9a-zA-Z]){3,20}$/, "用户登录ID:3-20个字符的字母、数字的组合.", "#Tips1");
				chk = chk && checkLength( sublgpassword, "用户登录密码:", 0, 40, "#Tips1");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( location.href, {
						menu: 'editsub',
						sublgname: sublgname.val(),
						sublgpassword: sublgpassword.val(),
						yhzselect: yhzselect
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，修改管理员属性成功啦！' );
							location = location.href;
						} else if ( data.length > 200 ) {
							alert( '抱歉，您没有此功能权限，操作失败！' );
						} else {
							alert( data );
						}
						$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false )
					});
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	$( '.delsa' ).click(function(){
		var sublgname = $( this ).val();
		if(confirm('您确定要删除管理员 ' + sublgname + ' 吗?')){
			$.get( location.href, { menu: 'delsub', sublgname: sublgname },
			function( data ){
				if ( data == '1' ){
					alert( '恭喜你，删除管理员成功啦！' );
					location = location.href;
				} else {
					alert( data );
				}
			});
		}
	});
	$( '#addyhz' ).click(function(){
		$( '#dialog_form2' ).dialog( "open" );
	});
	$( '#dialog_form2' ).dialog({
		autoOpen: false,
		width: 450,
		modal: true,
		show: {
			effect: "slide",
			duration: 400
		},
		hide: {
			effect: "size",
			duration: 400
		},
		buttons: {
			"增加": function() {
				var chk = true,
				rank = $( "#rank" ),
				yhzname = $( "#yhzname" ),
				allFields = $( [] ).add( rank ).add( yhzname ),
				funcselect = '';
				$( "#funcselect option:selected" ).each(function(){ funcselect = funcselect + this.value + "|"; });
				allFields.removeClass( "ui-state-error" );
				chk = chk && checkRegexp( rank, /^([0-9a-zA-Z]){1}$/, "用户组序号：1个字符的数字或大小写字母.", "#Tips2");
				chk = chk && checkRegexp( yhzname, /^([0-9a-zA-Z\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "用户组名称:1-20个字符的汉字、字母、数字的组合.", "#Tips2");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( location.href, {
						menu: 'addyhz',
						rank: rank.val(),
						yhzname: yhzname.val(),
						funcselect: funcselect
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，新增用户组成功啦！' );
							location = location.href;
						} else if ( data.length > 200 ) {
							alert( '抱歉，您没有此功能权限，操作失败！' );
						} else {
							alert( data );
						}
						$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false )
					});
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	var ya = '', yb = '', yc= '';
	$( '.edityhz' ).click(function(){
		ya = $( this ).parent( "td" ).parent( "tr" ).children( "td" ).eq(0).text();
		yb = $( this ).parent( "td" ).parent( "tr" ).children( "td" ).eq(1).text();
		yc = $( this ).parent( "td" ).parent( "tr" ).children( "td" ).eq(2).children( "span" ).attr("title");
		yc = yc == '全部功能' ? '-' : yc;
		var ycd= yc.split("|");
		$( "#rank1" ).val(ya);
		$( "#yhzname1" ).val(yb);
		$( "#funcselect1 option" ).each(function(){this.selected=false;for(x in ycd){if($(this).val()==ycd[x]){this.selected=true;}}});
		$( '#dialog_form3' ).dialog( "open" );
	});
	$( '#dialog_form3' ).dialog({
		autoOpen: false,
		width: 450,
		modal: true,
		show: {
			effect: "scale",
			duration: 400
		},
		hide: {
			effect: "clip",
			duration: 400
		},
		buttons: {
			"修改": function() {
				var chk = true,
				rank = $( "#rank1" ),
				yhzname = $( "#yhzname1" ),
				allFields = $( [] ).add( rank ).add( yhzname ),
				funcselect = '';
				$( "#funcselect1 option:selected" ).each(function(){ funcselect = funcselect + this.value + "|"; });
				allFields.removeClass( "ui-state-error" );
				chk = chk && checkRegexp( rank, /^([0-9a-zA-Z]){1}$/, "用户组序号：1个字符的数字或大小写字母.", "#Tips2");
				chk = chk && checkRegexp( yhzname, /^([0-9a-zA-Z\u4e00-\u9fa5\uf900-\ufa2d]){1,20}$/, "用户组名称:1-20个字符的汉字、字母、数字的组合.", "#Tips2");
				if ( chk ) {
					$( this ).next( "div" ).find( "button:eq(0)" ).addClass( "ui-state-error ").attr( "disabled" , true );
					$.get( location.href, {
						menu: 'edityhz',
						rank: rank.val(),
						yhzname: yhzname.val(),
						funcselect: funcselect
					},
					function( data ){
						if ( data == '1' ){
							alert( '恭喜你，修改用户组成功啦！' );
							location = location.href;
						} else if ( data.length > 200 ) {
							alert( '抱歉，您没有此功能权限，操作失败！' );
						} else {
							alert( data );
						}
						$( "button:disabled" ).removeClass( "ui-state-error" ).attr( "disabled" , false )
					});
				}
			},
			"取消": function() {
				$( this ).dialog( "close" );
			}
		}
	});
	$( '.delyhz' ).click(function(){
		var rank = $( this ).val();
		if(confirm('您确定要删除用户组 ' + rank + ' 吗?')){
			$.get( location.href, { menu: 'delyhz', rank: rank },
			function( data ){
				if ( data == '1' ){
					alert( '恭喜你，删除用户组成功啦！' );
					location = location.href;
				} else {
					alert( data );
				}
			});
		}
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<div class="fullscreen">

<p class="cp">当前位置：系统用户管理</p>
<br />
&nbsp;&nbsp;<button type="button" class="button" id="addsubadmin" title="新增管理员" />新增管理员</button>
<div class="cc ui-widget-content ui-corner-all" style="width: 50%">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width:30%;">登录ID</th>
    <th class="ui-widget-header uith" scope="col" style="width:30%;">用户组</th>
    <th class="ui-widget-header uith" scope="col" style="width:40%;">管理项</th>
  </tr>
<?php echo $subadminlist ?>
</table>
</div>
<br />
&nbsp;&nbsp;<button type="button" class="button" id="addyhz" title="新增用户组" />新增用户组</button>
<div class="cc ui-widget-content ui-corner-all">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ui-widget-content" style="border-width:0px 0px 0px 1px;">
  <tr>
    <th class="ui-widget-header uith" scope="col" style="width:5%;">序号</th>
    <th class="ui-widget-header uith" scope="col" style="width:10%;">用户组名</th>
    <th class="ui-widget-header uith" scope="col">用户组权限</th>
    <th class="ui-widget-header uith" scope="col" style="width:14%;">管理项</th>
  </tr>
<?php echo $yhzlist ?>
</table>
</div>

</div>

<div id="dialog_form" title="新增管理员！">
<div class="cp">
<span id="Tips">正确填写以下管理员信息。</span>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户登录ID：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="sublgname" name="sublgname" type="text" size="20" maxlength="20" value="" title="登录用户名！3-20个字符的字母、数字的组合。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户登录密码：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="sublgpassword" name="sublgpassword" type="text" size="20" maxlength="40" value="" title="6-40个字符的各种字符的组合。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组：</td>
    <td class="right"><select id="yhzselect" name="yhzselect" class="text ui-widget-content ui-corner-all"><?php echo $yhzselect ?></select></td>
  </tr>
</table>
</div>
</div>

<div id="dialog_form1" title="修改管理员属性！">
<div class="cp">
<span id="Tips1">正确填写以下管理员信息。</span>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户登录ID：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="sublgname1" name="sublgname1" type="text" size="20" readonly maxlength="20" value="" title="用户登录ID禁止修改。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户登录密码：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="sublgpassword1" name="sublgpassword1" type="text" size="20" maxlength="40" value="" title="6-40个字符的各种字符的组合。不填表示不修改，修改需要输入大于5位的新密码。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组：</td>
    <td class="right"><select id="yhzselect1" name="yhzselect1" class="text ui-widget-content ui-corner-all"><?php echo $yhzselect ?></select></td>
  </tr>
</table>
</div>
</div>

<div id="dialog_form2" title="新增用户组！">
<div class="cp">
<span id="Tips2">选择用户组具有的权限。</span>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组序号：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="rank" name="rank" type="text" size="1" maxlength="1" value="" title="用户组序号：排序用户组。1位数字或大小写字母。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="yhzname" name="yhzname" type="text" size="20" maxlength="20" value="" title="用户组名称！1-20个字符的汉字、字母、数字的组合。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组功能授权：</td>
    <td class="right"><select id="funcselect" name="funcselect" multiple="true" size="18" class="text ui-widget-content ui-corner-all" title="(按 Ctrl 或 Shift 可以进行多选)"><?php echo $funcselect ?></select></td>
  </tr>
</table>
</div>
</div>

<div id="dialog_form3" title="修改用户组！">
<div class="cp">
<span id="Tips3">选择用户组具有的权限。</span>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组序号：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="rank1" name="rank1" type="text" size="1" readonly maxlength="1" value="" title="用户组序号：排序用户组。1位数字或大小写字母。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组名称：</td>
    <td class="right"><input class="text ui-widget-content ui-corner-all" id="yhzname1" name="yhzname1" type="text" size="20" maxlength="20" value="" title="用户组名称！1-20个字符的汉字、字母、数字的组合。" /></td>
  </tr>
</table>
</div>
<div class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">用户组功能授权：</td>
    <td class="right"><select id="funcselect1" name="funcselect1" multiple="true" size="18" class="text ui-widget-content ui-corner-all" title="(按 Ctrl 或 Shift 可以进行多选)"><?php echo $funcselect ?></select></td>
  </tr>
</table>
</div>
</div>
<?php require 'mo.foot.php';
//////////////////////////
}
?>