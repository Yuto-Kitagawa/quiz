<?php
include(__DIR__ . '/../function/function.php');

$user_name = htmlspecialchars($_POST['user_mail'], ENT_QUOTES, 'UTF-8');

$api = new Functions;
$res = $api->login($user_name);
echo (json_encode($res));
