<?php
session_start();
$_SESSION['title'] = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$_SESSION['quiz_id'] = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 64);