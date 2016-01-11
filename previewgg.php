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
$gid = $_REQUEST['gid'];
$results = $datadir.'/'.$gid.'.js';
$title = '代码预览';
require 'mo.head.php';
?>
<script type="text/javascript">
var atyh=0,datadir='<?php echo $datadir?>/',amsurl='<script charset="utf-8" language="JavaScript" type="text/javascript" src="<?php echo $amsurl?>';
</script>
</head>
<body class="ui-widget-content" style="border:0">

<h3>代码预览</h3>
<div id="results" style="height:1800px" class="ui-widget-content ui-corner-all">
<div class="<?php echo $gid ?>">
<script charset="utf-8" language="JavaScript" type="text/javascript" src="<?php echo $amsurl.$results?>"></script>
</div>
</div>
<?php require 'mo.foot.php'; ?>