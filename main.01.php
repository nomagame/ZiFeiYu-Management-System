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
$conn = new mysql();
?>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">服务器主机名：</td>
    <td><?php echo $_SERVER['SERVER_NAME']?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">服务器操作系统：</td>
    <td><?php $os = explode(" ", php_uname()); echo $os[0];?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">服务器解译引擎：</td>
    <td><?php echo $_SERVER['SERVER_SOFTWARE']?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">服务器语言：</td>
    <td><?php echo getenv("HTTP_ACCEPT_LANGUAGE")?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">php版本：</td>
    <td><?php echo phpversion()?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">MySQL版本：</td>
    <td><?php echo mysql_get_server_info()?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">NiuXams版本：</td>
    <td><?php echo NIUXAMS_VER?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">服务器php时钟：</td>
    <td><?php echo gnt()?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">上传文件最大限制：</td>
    <td><?php echo get_cfg_var("upload_max_filesize")?>&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">脚本超时时间：</td>
    <td><?php echo get_cfg_var("max_execution_time")?>秒&nbsp;</td>
  </tr>
</table>
</p>
<p class="cp">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="left">打开远程文件：</td>
    <td><?php echo get_cfg_var("allow_url_fopen")?'√':'×'?>&nbsp;</td>
  </tr>
</table>
</p>