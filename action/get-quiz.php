<?php

include("./../function/function.php");

$user = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
$func = new Functions;
$res = $func->getQuiz($user);

echo (json_encode($res));

exit();
