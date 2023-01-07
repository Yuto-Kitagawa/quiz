<?php

session_start();

if ((!isset($_GET['id'])) || $_GET['id'] == "") {
    header('Location: ./index.php');
}

$quiz_id = $_GET['id'];

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
                <div class="title main-container bg-white my-3 p-4 d-flex justify-content-center align-items-center">
                    <div class="" id="load">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 d-none" id="firstWindow">
                        <div class="lead display-6 text-center" id="title"></div>
                        <div class="text-center col-12">
                            <div class="my-4 d-flex justify-content-center align-items-center">
                                <input type="checkbox" class="form-check-input mx-2" id="random">
                                <label for="random" class="lead user-select-none">ランダム</label>
                            </div>
                            <button id="start" class="btn btn-outline-secondary col-6 m-auto">問題を解く</button>
                        </div>
                    </div>
                    <div class="d-none col-12" id="secondWindow">
                        <div class="text-center lead fs-6 pb-5">
                            <span id="now"></span>/<span id="all"></span>
                        </div>
                        <div class="">
                            <div class="text-center">
                                <div class="lead text-center border small w-fit px-2 m-auto">問題</div>
                            </div>
                            <div class="lead mt-2 text-center" id="question"></div>
                        </div>
                        <hr>
                        <div class="d-flex mt-3">
                            <div class="lead">答え:&nbsp;</div>
                            <div class="lead" id="answer"></div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-outline-danger col-12" id="answerBtn">答え</button>
                            <button class="btn btn-outline-success col-12" id="next">次の問題</button>
                            <div class="d-flex justify-content-around align-items-center">
                                <a href="./index.php" class="btn btn-outline-danger col-5 d-none" id="finish">終了</a>
                                <button class="btn btn-outline-primary col-5 d-none" id="onemore">もう一度解く</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script>
            let counter = 0;
            let question_array = [];
            let answer_array = [];
            let index_array = [];
            let finish_index = 0;

            //配列をシャッフルする関数
            function shuffleArray() {
                newArray = [];
                while (index_array.length > 0) {
                    n = index_array.length;
                    k = Math.floor(Math.random() * n);

                    newArray.push(index_array[k]);
                    index_array.splice(k, 1);
                }
                index_array = newArray;
            }


            function getQuiz() {
                const xhr = new XMLHttpRequest();
                const fd = new FormData();

                const id = "<?= $quiz_id ?>";
                fd.append("quizid", id)
                xhr.open('POST', "./action/check-share.php");
                xhr.send(fd);
                xhr.onload = (e) => {
                    let json = e.target.response;
                    let res = JSON.parse(json);
                    if (res == "False") {
                        location.href = "./index.php";
                    } else {
                        xhr.open('POST', "./action/get-quiz-one.php");
                        xhr.send(fd);
                        xhr.onload = (e) => {
                            json = e.target.response;
                            res = JSON.parse(json);

                            question_array = res[2];
                            answer_array = res[3];
                            document.getElementById('title').textContent = res[1];

                            let q_counter = [];
                            finish_index = res[2].length;
                            for (let i = 0; i < res[2].length; i++) {
                                q_counter.push(i);
                            }

                            document.getElementById('now').textContent = 1;
                            document.getElementById('all').textContent = res[2].length;

                            index_array = q_counter;

                            document.getElementById('load').classList.add('d-none');
                            document.getElementById('firstWindow').classList.remove('d-none');
                        }
                    }


                }
            }

            function showQuestion(coutner) {
                document.getElementById('question').textContent = question_array[index_array[counter]];
            }

            function showAnswer(counter) {
                document.getElementById('answer').textContent = answer_array[index_array[counter]];
            }

            document.getElementById('start').addEventListener('click', () => {
                if (document.getElementById('random').checked == true) {
                    shuffleArray();
                }
                console.log(index_array);
                document.getElementById('firstWindow').classList.add('d-none');
                document.getElementById('secondWindow').classList.remove('d-none');
                document.getElementById('next').classList.add('d-none');
                showQuestion(counter);
            });

            document.getElementById('answerBtn').addEventListener('click', () => {
                document.getElementById('answerBtn').classList.add('d-none');
                showAnswer(counter);
                if (counter == finish_index - 1) {
                    document.getElementById('finish').classList.remove('d-none');
                    document.getElementById('onemore').classList.remove('d-none');
                } else {
                    document.getElementById('next').classList.remove('d-none');
                }
            });

            document.getElementById('next').addEventListener('click', () => {
                counter++;
                document.getElementById('now').textContent = counter + 1;
                document.getElementById('next').classList.add('d-none');
                document.getElementById('answerBtn').classList.remove('d-none');
                document.getElementById('answer').textContent = "";
                showQuestion(counter);
            });

            document.getElementById('onemore').addEventListener('click', () => {
                location.reload();
            });

            window.onload = () => {
                getQuiz();
            }

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