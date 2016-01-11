<?php
//session start and enable gzip
session_start();
//ob_start('bg_gzhandler');

//require commons
$includePath = dirname(__FILE__);
require_once "{$includePath}/constant.php";
require_once "{$includePath}/sessionCheck.php";

require_once "{$includePath}/config.php";
require_once "{$includePath}/util.php";

require_once "{$includePath}/../lang/zh_cn.php";

require_once "{$includePath}/../dao/wrapper.php";
require_once "{$includePath}/../dao/implements.php";
require_once "{$includePath}/../dao/dbpool.php";

require_once "{$includePath}/menus.php";

if ($config[NEEDDB]) {  //if need db
    $dbLink = DBPool::getLink($config[DBDRIVER]);
    $daoImpl = DAOImpl::getImpl($dbLink, $config[TABLEPRE][BACKEND]);

    $config[DBLINK] = $dbLink;
    $config[DAOIMPL] = $daoImpl;
}

//filter get and post parameters
cleanParameters($_GET);
cleanParameters($_POST);
