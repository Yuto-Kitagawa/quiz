<?php
include('./../function/function.php');

session_start();
$user_id = $_SESSION['user_id'];

$new_title = htmlspecialchars($_POST['newTitle'], ENT_QUOTES, 'UTF-8');
$quiz_id = htmlspecialchars($_POST['quiz_id'], ENT_QUOTES, 'UTF-8');


$func = new Functions;

$res = $func->resetTitle($user_id, $new_title, $quiz_id);

echo (json_encode($res));
