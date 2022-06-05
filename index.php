<?php

include "./function/function.php";
define('DB_CHARACTERSET', 'UTF8');

$func = new Functions;
$title_array = [];
$title_array = $func->getTitles();

session_start();
$_SESSION = array();
session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>yutons QUIZ</title>
    <meta name="description" content="QUIZZZZ">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
    <!-- google fonts -->
</head>
<style>
    .register>a {
        font-size: 2em;
        font-family: serif;
    }
</style>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">yutons QUIZ</a>
        </div>
    </nav>
    <div class="col-12 text-center mt-3 register">
        <a href="./register/title.php" class="btn btn-outline-primary col-10 m-auto p-4 ">問題登録</a>
    </div>
    <div class="quiz-wrapper col-10 m-auto mt-5">
        <div class="lead text-center">問題集</div>
        <ul class="list-group">
            <?php
            foreach ($title_array as $i) {
            ?>
                <li class="list-group-item p-0"><a href='./action/get-questions.php?q=<?= $i ?>&number=1' class="d-block p-2 ps-3"><?= $i ?></a></li>
            <?php
            }
            ?>
        </ul>
    </div>
</body>

</html>