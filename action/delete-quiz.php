<?php
include('./../function/function.php');

$quiz_id = htmlspecialchars($_POST['q'], ENT_QUOTES, 'UTF-8');

$fun = new Functions;

$res = $fun->deleteQuiz($quiz_id);
echo (json_encode($res));
