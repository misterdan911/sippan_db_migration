<?php
ini_set("memory_limit", -1);
set_time_limit(0);

require_once('init.php');

$dbOld = $GLOBALS['db_old'];
$dbNew = $GLOBALS['db_new'];

include('src/helper_func.php');

include('src/migration/tbl_rup_ut.php');
