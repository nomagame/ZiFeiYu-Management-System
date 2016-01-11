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
$menu = $_REQUEST['menu'];
$maxupSize = 4;
$upimgtype = '.jpg|.gif|.png|.jpeg|.bmp|.swf';
///////////////////////////
if( $menu == 'upload' ){
if($_FILES['userfile']['error']==2){errwin('文件太大，请不要超过'.$maxupSize.'M！');}
if($_FILES['userfile']['size']>$maxupSize*1024*1024){errwin('文件太大，请不要超过'.$maxupSize.'M！');}
if($_FILES['userfile']['error']==4){errwin('没有文件被上传！');}
$filename = basename($_FILES['userfile']['name']);
$extend = explode('.', $filename);
$va = count($extend)-1;
$fileext = '.'.strtolower($extend[$va]);
$accfileext = explode('|', $upimgtype);
if( !in_array($fileext, $accfileext) ){errwin('文件类型错误！');}
if($_FILES['userfile']['error']==0 && is_uploaded_file($_FILES['userfile']['tmp_name'])){
	$uploaddir = $datadir . '/updata/';
	if ( !file_exists( $uploaddir ) ) {
		mkdir( $uploaddir , 0755 , true );
	}
	$upfilename = date("YmdHis",time()) . $fileext;
	$uploadfile = $uploaddir . $upfilename;
	move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile) or errwin('上传失败！');
}
$dx = filesize( $uploadfile );
$cc = getimagesize( $uploadfile );
require 'mo.head.php';
?>
<style type="text/css">
input.text,select.text,textarea.text {
	padding: .3em;
	font-size: 1em;
}
#kuan, #gao{
	width: 3em;
}
#imgdm{
	width:80%;
}
</style>
<script type="text/javascript">
$(function() {
	$( '#imgdm' ).select();
	$( '#imgdm' ).click(function(){$( this ).select();});
	var obj = $( "#ggdm", window.parent.document ).get(0);
	$( '#charu' ).click(function(){codecharu(obj, $( '#imgdm' ).val());});
	$( '#kuan' ).change(function(){
		$( '#imgdm' ).val( $( '#imgdm' ).val().replace(/width="(.+?)"/ig,'width="' + $( '#kuan' ).val() + '"') ).select();
	});
	$( '#gao' ).change(function(){
		$( '#imgdm' ).val( $( '#imgdm' ).val().replace(/height="(.+?)"/ig,'height="' + $( '#gao' ).val() + '"') ).select();
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">
<p class="cp"><strong>恭喜你！上传文件成功！</strong></p>
<p class="cp">上传后的文件名：<?php echo '<a href="'.$amsurl.$uploadfile.'" target="_blank">'.$upfilename.'</a>' ?></p>
<p class="cp">
	大小：<?php echo $dx?> byte. &nbsp;&nbsp;
    尺寸：<input class="text ui-widget-content ui-corner-all" id="kuan" name="kuan" value="<?php echo $cc[0] ?>" type="text" />&times;<input class="text ui-widget-content ui-corner-all" id="gao" name="gao" value="<?php echo $cc[1] ?>" type="text" /> px.
</p>
<p class="cp">
	图片代码：<input class="text ui-widget-content ui-corner-all" id="imgdm" name="imgdm" type="text" value="<?php echo htmlspecialchars ('<img src="'.$amsurl.$uploadfile.'" border="0" '.$cc[3].' />') ?>" />
</p>
<p class="cp" style="text-align:right;">
	<input id="charu" name="charu" class="button" type="button" title="插入图片代码到广告代码中" value="插入代码" />
	<a href="upload.php" class="button" title="继续上传文件">继续上传</a>
</p>
</body>
</html>
<?php
exit;
} elseif( $menu == 'nowgo' ) {
	require 'fun.yz.php';
}
///////////////////////////
require 'mo.head.php';
?>
<script type="text/javascript">
$(function() {
	$( "form" ).submit(function(){
		if( !$( "input[type='file']" ).val() ){
			alert("没有选择任何文件！");
			return false;
		} else {
			$( "input[type='submit']" ).addClass( "ui-state-error ").attr( "disabled" , true );
		}
	});
});
</script>
</head>
<body class="ui-widget-content" style="border:0">

<p class="cp" id="tips"><span>尺寸：小于 <strong><?php echo $maxupSize ?>MB</strong></span>. <span>扩展名：<strong><?php echo $upimgtype ?></strong></span></p>
<div class="cp" style="text-align:center">
<form enctype="multipart/form-data" method="POST">
<input type="hidden" name="menu" value="upload" />
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $maxupSize*1024*1024 ?>" />
<input class="button" name="userfile" type="file" />
<input class="button" type="submit" value=" 上 传 " />
</form>
</div>
</body>
</html>