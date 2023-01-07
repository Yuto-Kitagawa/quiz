<?php
include('./../function/function.php');

$quiz = htmlspecialchars($_POST['quiz'], ENT_QUOTES, 'UTF-8');
$answer = htmlspecialchars($_POST['answer'], ENT_QUOTES, 'UTF-8');
$quiz_id = htmlspecialchars($_POST['qid'], ENT_QUOTES, 'UTF-8');
session_start();
$user_id = $_SESSION['user_id'];

$func = new Functions;
$res = $func->refreshQuiz($quiz, $answer, $quiz_id, $user_id);
echo (json_encode($res));
