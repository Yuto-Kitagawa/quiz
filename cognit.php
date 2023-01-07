<?php
include('./function/function.php');
session_start();
$token = $_GET['token'];
if ((isset($_GET['token']) && $_GET['token'] != "") && (isset($_SESSION['token']) && $_SESSION['token'] == $token)  && (isset($_SESSION['mail']) && $_SESSION['mail'] != "")) {

    $api = new Functions;

    $mail = $_SESSION['mail'];
    $res = $api->register_user($mail);

    if ($res == "True") {
        header('Location: ./index.php');
        exit();
    }
} else {
?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="theme-color" content="#e1d887">
        <meta name="robots" content="noarchive">
        <meta name="description" content="自分だけの問題集を作れる問題作成サイト！友達とシェアして一緒に勉強しよう！">
        <meta name="keywords" content="問題作成,クイズ,クイズ問題,問題">

        <meta property="og:title" content="Yutons QUIZ">
        <meta property="og:description" content="自分だけの問題集を作れる問題作成サイト！友達とシェアして一緒に勉強しよう！">
        <meta property="og:site_name" content="Yutons QUIZ">
        <meta property="og:url" content="https://yutons.com/quiz">
        <meta property="og:locale" content="ja_JP">
        <meta property="og:image" content="https://yutons.com/header-dog.jpg">
        <meta property="og:type" content="article">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="https://yutons.com/header-dog.jpg">

        <title>yutons QUIZ</title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta http-equiv="Expires" content="0">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/main.css">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-MFLPVKQRJN"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'G-MFLPVKQRJN');
        </script>
    </head>

    <body>

        <body>
            <nav class="bg-dark">
                <div class="d-flex justify-content-around align-items-center">
                    <div class="nav-logo w-100 ms-5 text-white pt-2">yutons QUIZ</div>

                </div>
            </nav>

            <main class="d-flex">

                <section class="submenu col-3" id="submenu">
                    <div class="d-flex flex-column h-100">
                        <div class="border border-bottom-1 submenu-list">
                            <a href="./index.php" class="h-100 d-flex justify-content-center align-items-center text-decoration-none text-dark lead fs-4 d-block">
                                <div class="pe-3 d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                </div>
                                ホーム
                            </a>
                        </div>
                        <div class="border border-bottom-1 submenu-list">
                            <a href="./edit.php" class="h-100 d-flex justify-content-center align-items-center text-decoration-none text-dark lead fs-4 d-block">
                                <div class="pe-3 d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                    </svg>
                                </div>
                                問題設定
                            </a>
                        </div>
                    </div>
                </section>

                <section class="col-12 position-fixed bottom-0" id="phonemenu">
                    <div class="d-flex">
                        <div class="border border-bottom-1 submenu-list bg-white">
                            <a href="./index.php" class="py-4 h-100 d-flex justify-content-center align-items-center text-decoration-none text-dark lead fs-4 d-block">
                                <div class="d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        <div class="border border-bottom-1 submenu-list bg-white">
                            <a href="./edit.php" class="py-4 h-100 d-flex justify-content-center align-items-center text-decoration-none text-dark lead fs-4 d-block">
                                <div class="d-flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                        <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>

                <section id="mainSection" class="col-12 col-sm-12 col-md-12 col-lg-9 main-section p-2">
                    <div class="main-container bg-white mt-3 p-4 d-flex justify-content-center flex-column ">
                        <div class="text-center">
                            もう一度メールアドレスを入力して認証してください。
                            <br>
                            ※認証の際だけシークレットモードを外してください。
                        </div>
                        <div class="lead text-center">
                            <a href="./login.php">登録</a>
                        </div>
                    </div>
                </section>

            </main>

            <script>
                //画面サイズ
                function rearrange() {
                    let submenu = document.getElementById('submenu');
                    let main = document.getElementById('mainSection');
                    main.style.marginLeft = (submenu.clientWidth) + "px";
                }
                rearrange()

                window.addEventListener('resize', rearrange);
            </script>
        </body>

    </html>

<?php
}
?>