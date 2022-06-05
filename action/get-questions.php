<?php

include "../function/function.php";

$q = htmlspecialchars($_GET['q'], ENT_QUOTES, 'UTF-8', false);


$func = new Functions;

$func->getQuestionsAndAnswers($q);

exit();
