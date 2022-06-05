<?php

session_start();
if (!empty($_POST['t'])) {
    $_SESSION['title'] = htmlspecialchars($_POST['t'], ENT_QUOTES, 'UTF-8', false);
} else if (!$_SESSION['title']) {
    header('Location: ./title.php');
}

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

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">yutons QUIZ</a>
        </div>
    </nav>

    <div class="mt-5">
        <div class="lead text-center">問題と答えを入力してください</div>
        <form action="../action/register.php" method="POST">
            <div class="">
                <div class="mt-5 lead text-center">問題</div>
                <div class="col-10 m-auto">
                    <input type="text" name="q" class="form-control" required autofocus>
                </div>
            </div>
            <div class="">
                <div class="mt-3 lead text-center">答え</div>
                <div class="col-10 m-auto">
                    <input type="text" name="a" class="form-control" required>
                </div>
            </div>

            <div class="d-flex justify-content-around text-center p-3 mt-4">
                <a href="../index.php" class="btn btn-outline-danger">終了する</a>
                <button type="submit" class="btn btn-outline-primary">登録</a>
            </div>
        </form>
    </div>

</body>

</html>