<?php

include "../function/function.php";

$question = htmlspecialchars($_POST['q'], ENT_QUOTES, 'UTF-8');
$answer = htmlspecialchars($_POST['a'], ENT_QUOTES, 'UTF-8');

$func = new Functions;

$func->insertQuiz($question, $answer);
exit();
