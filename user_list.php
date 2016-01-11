<?php

$pageName = 'userlist';
$needDb = true; //enable db

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";

//admin user check
if ($_SESSION[SESSIONUSER] != $config[SUPERUSER]) {
    header('Content-type: text/html; charset=utf-8');
    die('您无权查看此页！');
}

/**----------------
 * controll logical code here
 */
$userRs = $config[DAOIMPL]->getUsers();
$userList = rs2Array($userRs);
//print_r($userList);

/**----------------
 * config title, description, keywords
*/
$pageTitle = '用户列表';
$pageDescription = '';
$pageKeywords = '';

/**----------------
 * render views
 * layout and views
*/
$layoutName = 'main';
$viewGroup = 'user';
$viewName = 'list';

$layoutPath = "{$incPath}/views/layout/";
include_once "{$layoutPath}/{$layoutName}.php";
