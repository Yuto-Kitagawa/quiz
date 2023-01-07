<?php

$num = htmlspecialchars($_GET['number'], ENT_QUOTES, 'UTF-8', false);
$ans = htmlspecialchars($_GET['answer'], ENT_QUOTES, 'UTF-8', false);

session_start();
$res = [];

$c = $_SESSION['answer'][$num];


if ($_SESSION['answer'][$num] == $ans) {
    array_push($res, true);
    array_push($res, $c);
} else {
    array_push($res, false);
    array_push($res, $c);
}

echo json_encode($res);
