<?php
include('./../function/function.php');
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');

$api = new Functions;

$res = $api->check_title($title);
echo (json_encode($res));
