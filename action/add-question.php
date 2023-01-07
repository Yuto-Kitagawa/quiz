<?php
session_start();
$_SESSION['title'] = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$_SESSION['quiz_id'] = htmlspecialchars($_POST['qid'], ENT_QUOTES, 'UTF-8');
