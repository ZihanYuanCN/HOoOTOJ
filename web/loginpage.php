<?php
//$cache_time=1;
require_once('include/do_cache.php');
require_once("include/db_info.php");
//$view_title="登陆";
//if(isset($_SESSION['user_id'])){
//    echo "<a href=logout.php>请先退出登录！</a>";
//    exit(1);
//}
require("template/loginpage_t.php");
//if(file_exists('./include/cache_end.php'))
//    require_once('./include/cache_end.php');
?>
