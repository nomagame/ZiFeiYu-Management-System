<?php

$config = array(
    SITENAME => '子非鱼素材管理系统',
    VERSION => '1.0',

    PREKEY4PASSWORD => 'padm_',
    SUPERUSER => 'root',
    SUPERUSERPASSWORD => 'zifeiyu-database-2014',

    DBDRIVER => array(
        DBHOST => 'localhost',
        DBUSER => 'zifeiyu',
        DBPASSWORD => 'zifeiyu-2015',
        DATABASE => 'mysql'
    ),
    TABLEPRE => array(
        FRONTEND => 'eshop_',
        BACKEND => 'adm_',
    ),
    NEEDDB => false,
);

if (isset($needDb) && true == $needDb) {
    $config[NEEDDB] = true;
}
