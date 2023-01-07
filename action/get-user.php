<?php

session_start();

$user = $_SESSION['user_id'];
echo (json_encode($user));
