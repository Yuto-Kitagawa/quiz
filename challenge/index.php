<?php
session_start();
$n = $_GET['n'];
$q = $_GET['q'];

$counter = array_search($n, $_SESSION['counter']);

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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<style>
</style>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">yutons QUIZ</a>
        </div>
    </nav>

    <div class="mt-5">
        <?php
        if ($_GET['n'] < 0 || $_GET['n'] > count($_SESSION['question']) + 1) {
        ?>
            <div class="lead text-danger text-center">不正な操作です</div>
            <div class="col-12 text-center mt-5">
                <a href="../index.php" class="m-auto btn btn-outline-danger">戻る</a>
            </div>
        <?php
        } else {
        ?>
            <div class="d-flex align-items-center">
                <div class="lead col-2">問題:</div>
                <div class="text-center col-10 lead"><?= $_SESSION['question'][$n] ?></div>
            </div>

            <div class="mt-5 col-10 m-auto text-center">
                <input type="text" name="answer" id="answer" class="p-2" placeholder="答え" required>
            </div>

            <div class="">
                <div class="lead text-center display-6 d-none pt-3" id="state"></div>
                <div class="lead d-none text-center display-2 text-danger pt-2" id="correct-answer"></div>
            </div>

            <div class="col-12 text-center mt-5">
                <button id="decide" class="btn btn-outline-primary col-6 m-auto">答え合わせ</button>
                <?php
                if ($counter == count($_SESSION['question']) - 1) {
                ?>
                    <a id="next" href="../index.php" class="btn btn-outline-danger col-6 m-auto d-none">終了</a>
                <?php
                } else {
                ?>
                    <a id="next" href="./index.php?q=<?= $q ?>&n=<?= $_SESSION['counter'][$counter + 1]  ?>" class="btn btn-outline-primary col-6 m-auto d-none">次の問題</a>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>

    <script>
        $(function() {
            $('button#decide').click(() => {
                let ans = $('#answer').val();

                let arg = new Object;
                url = location.search.substring(1).split('&');

                for (i = 0; url[i]; i++) {
                    let k = url[i].split('=');
                    arg[k[0]] = k[1];
                }

                let number = arg.n;

                console.log(number);

                $.ajax({
                    type: 'GET',
                    url: '../action/get-answer.php',
                    dataType: 'json',
                    data: {
                        'number': number,
                        'answer': ans
                    },
                    success: function(data) {
                        console.log(data);

                        if (data[0] == true) {
                            $('#state').removeClass('d-none');
                            $('#state').text("正解!");
                            $('#decide').addClass('d-none');
                            $('#next').removeClass('d-none');
                        } else {
                            $('#state').removeClass('d-none');
                            $('#correct-answer').removeClass('d-none');
                            $('#state').addClass('text-danger');
                            $('#state').addClass('fw-bold');
                            $('#state').text("不正解!");
                            $('#correct-answer').text(data[1]);
                            $('#decide').addClass('d-none');
                            $('#next').removeClass('d-none');
                        }
                    }
                })
            })
        })
    </script>

</body>

</html>