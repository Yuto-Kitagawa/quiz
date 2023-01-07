<?php

include("./../function/function.php");

$quiz_id = htmlspecialchars($_POST['quizid'], ENT_QUOTES, 'UTF-8');
$func = new Functions;
$res = $func->getQuiz_one($quiz_id);

echo (json_encode($res));

exit();
