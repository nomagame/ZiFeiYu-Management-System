<?php
/**
 * controller: login page
 * create by lane
 * @2012-01-01
 */
echo "用户名或者密码输入错误";
$pageName = 'login';
$needDb = true; //enable db

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";


/**----------------
 * controll logical code here
 */
//user login
if (isset($_POST['username']) && isset($_POST['password'])
    && !empty($_POST['username']) && !empty($_POST['password'])
) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rs = $config[DAOIMPL]->getUserByName($username);
    $arr = mysql_fetch_array($rs);
    if ($arr && $arr['password'] == generateUserPassword($password)) {
        $_SESSION[SESSIONUSER] = $username;
        header("Location: index.php");
        exit(0);
    }else {
        header("Location: login.html");
        exit(0);
    }
}


