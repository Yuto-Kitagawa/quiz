<?php

include "../function/function.php";

$question = htmlspecialchars($_POST['q'], ENT_QUOTES, 'UTF-8', false);
$answer = htmlspecialchars($_POST['a'], ENT_QUOTES, 'UTF-8', false);

$func = new Functions;

$func->insertDatas($question, $answer);
exit();
