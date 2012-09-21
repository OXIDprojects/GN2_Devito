<?php
define('DEVITO', 1);
error_reporting(0);
ini_set('display_errors', 0);
$s = array('://', ':');
foreach ($s as $v) {
    $_REQUEST['src'] = str_replace($s, '',$_REQUEST['src']);
}
$_REQUEST['src'] = trim($_REQUEST['src'], '/');
require_once 'timthumb.php';