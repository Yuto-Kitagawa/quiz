<?php

include('./../function/function.php');

$quiz_id = htmlspecialchars($_POST['qid'], ENT_QUOTES, "UTF-8");
$func = new Functions;

$res = $func->getQuizAndAnswer($quiz_id);
echo (json_encode($res));
