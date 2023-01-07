<?php
include('./../function/function.php');

session_start();
if (isset($_SESSION['user_id']) || $_SESSION['user_id'] != "") {
    $q_id = htmlspecialchars($_POST['qid'], ENT_QUOTES, 'UTF-8');
    $flag = htmlspecialchars($_POST['flag'], ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id'];
    $func = new Functions;
    $res = $func->changeShare($q_id, $flag, $user_id);
    echo (json_encode($res));
} else {
    echo (json_encode("False"));
}
