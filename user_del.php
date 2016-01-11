<?php
/**
 * controller: delete user by uid
 * create by lane
 * @2012-01-01
 */
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
if (isset($_GET['uid']) && !empty($_GET['uid'])) {
    $uid = $_GET['uid'];

    $rs = $config[DAOIMPL]->getUserById($uid);
    $arr = mysql_fetch_array($rs);
    if ($arr) {
        if ($arr['username'] == $config[SUPERUSER]) {
            $errorMsg = '不能删除超级用户！';
        }else {
            $rs = $config[DAOIMPL]->deleteUserByUid($uid);
            $successMsg = '用户删除成功！';
        }
    }
}

//get user list
$userRs = $config[DAOIMPL]->getUsers();
$userList = rs2Array($userRs);

/**----------------
 * config title, description, keywords
*/
$pageTitle = '删除用户';
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
