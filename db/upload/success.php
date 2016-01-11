<?php 		
$name=$_POST['name'];
$email=$_POST['email'];
$detail=$_POST['message'];
$link = mysql_connect('localhost', 'zifeiyu', 'zifeiyu-2015');
mysql_select_db("mysql");
mysql_query("set names utf8");
$sqlinsert="insert into upload(name,email,detail) values('{$name}','{$email}','{$detail}')";
mysql_query($sqlinsert);
//echo "文件上传成功！";
mysql_close($link);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>子非鱼素材上传系统</title>
	<meta http-equiv="cleartype" content="on" />
	<meta name="viewport" content="width=device-width" />

	<link rel="stylesheet" type="text/css" href="css/page.css" />
	<link rel="stylesheet" type="text/css" href="css/base.css" />
	<link rel="stylesheet" type="text/css" href="themes/light/light.css" />
	<link href="base.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="template-outside">

    <!-- To copy the form HTML, start here -->
    <div class="quform-outer quform-theme-light-light">
        <form>

            <div class="quform-inner">
                <h3 class="quform-title">文件上传成功</h3>
                <p class="quform-description">File Upload Success!</p>
            </div>
        <form>
    </div>
</div>