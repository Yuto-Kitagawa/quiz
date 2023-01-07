<?php
include('./../function/function.php');

session_start();
$user_id = $_SESSION['user_id'];
$quiz_id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$fun = new Functions;

$res = $fun->deleteQuiz_one($quiz_id,$user_id);
