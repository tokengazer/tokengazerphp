<?php
include('bootstraps.php');
$sql="select githuburl from project_list where githuburl <> ''";
$list=MySQLGetData($sql);
print_r($list);
