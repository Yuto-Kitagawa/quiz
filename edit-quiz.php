<?php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
    header('Location: ./login.php');
    exit();
}

if (!isset($_GET['id']) || $_GET['id'] == "") {
    header('Location: ./index.php');
    exit();
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">確認</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    本当に削除しますか?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                    <button class="btn btn-danger" id="deleteBtn">削除</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="bg-dark">
        <div class="d-flex justify-content-around align-items-center">
            <div class="nav-logo w-100 ms-5 text-white pt-2">yutons QUIZ</div>
            <div class="me-5 dropdown">
                <button class="border-0 bg-transparent" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    </svg>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="./action/logout.php">logout</a></li>
                </ul>
            </div>
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
            <div class="main-container bg-white mt-3 p-1">
                <div class="lead small fs-6 px-5 pt-3">
                    <a href="./edit.php">←編集一覧</a>
                </div>
                <div class=" col-10 m-auto d-flex align-items-center justify-content-center">
                    <div class="fs-4 text-center lead d-flex align-items-center justify-content-center col-12 mt-4">
                        <div class="" id="quizTitle"></div>
                        <div class="col-9 m-auto d-none" id="inputTitlteWrapper">
                            <input class="form-control" id="inputTitle">
                        </div>
                        <button class="btn btn-outline-success mx-1" id="editTitle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                            </svg>
                        </button>
                        <button class="d-none btn btn-outline-success mx-1" id="resetTitle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="text-danger small fs-6 d-none" id="titleerr">エラーが発生しました。ページを更新してやり直してください。</div>
                </div>

                <div class="d-flex flex-wrap justify-content-around align-items-stretch mt-2" id="appendPlace"></div>
                <div class="" style="height: 20vh;"></div>
            </div>
        </section>

    </main>

    <script>
        let xhr = new XMLHttpRequest();
        let fd = new FormData();
        let title = "";

        const id = "<?= $quiz_id ?>";
        fd.append("quizid", id)
        xhr.open('POST', "./action/get-quiz-one.php");
        xhr.send(fd);
        xhr.onload = (e) => {
            let json = e.target.response;
            let res = JSON.parse(json);

            if (res[0] == "True") {
                document.getElementById('quizTitle').textContent = res[1];
                title = res[1];

                let counter = 0;
                for (let i = 0; i < res[2].length; i++) {
                    let question = res[2][i];
                    let answer = res[3][i];
                    let q_id = res[4][i];

                    let wrapper = document.createElement('div');
                    wrapper.setAttribute('class', "col-12 col-sm-12 col-md-6 col-lg-4 p-2");

                    let card = document.createElement('div');
                    card.setAttribute('class', "card col-12 h-100");

                    let card_header = document.createElement('div');
                    card_header.setAttribute('class', "card-header");
                    card_header.textContent = "問題" + (i + 1);

                    let list_group = document.createElement('ul');
                    list_group.setAttribute('class', "list-group list-group-flush");
                    let question_list = document.createElement('li');
                    question_list.setAttribute('class', 'list-group-item');
                    question_list.textContent = question;
                    let answer_list = document.createElement('li');
                    answer_list.setAttribute('class', 'list-group-item');
                    answer_list.textContent = answer;

                    list_group.appendChild(question_list);
                    list_group.appendChild(answer_list);

                    let card_body = document.createElement('div');
                    card_body.setAttribute('class', 'card-body');

                    let edit_btn = document.createElement('a');
                    edit_btn.setAttribute('href', "./edit-one.php?id=" + q_id);
                    edit_btn.textContent = "編集";
                    edit_btn.setAttribute('class', 'btn btn-outline-success mx-1');
                    card_body.appendChild(edit_btn);

                    let delete_btn = document.createElement('button');
                    delete_btn.setAttribute('data', q_id);
                    delete_btn.setAttribute('data-bs-toggle', "modal");
                    delete_btn.setAttribute('data-bs-target', "#deleteModal");
                    delete_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg>';
                    delete_btn.setAttribute('class', 'btn btn-outline-danger mx-1 delete-btn');
                    card_body.appendChild(delete_btn);


                    card.appendChild(card_header);
                    card.appendChild(list_group);
                    card.appendChild(card_body);

                    wrapper.appendChild(card);

                    document.getElementById('appendPlace').appendChild(wrapper);
                }

                wrapper = document.createElement('div');
                wrapper.setAttribute('class', "col-12 col-sm-12 col-md-6 col-lg-4 p-2");

                let addQ = document.createElement('div');
                addQ.setAttribute('class', "card col-12 h-100 d-flex justify-content-center align-items-center")
                addQ.setAttribute('id', "addQ");
                addQ.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16"><path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0zM6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458L4.46.824zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66zm1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8zM.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752zm-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/></svg>';
                wrapper.appendChild(addQ);
                document.getElementById('appendPlace').appendChild(wrapper);

                addQuestion();
                deleteQuiz_one();
            } else {
                window.location.href = "./edit.php";
            }
        }

        function deleteQuiz_one() {
            document.querySelectorAll('.delete-btn').forEach(el => {
                el.addEventListener('click', () => {
                    let one_id = el.getAttribute('data');
                    document.getElementById('deleteBtn').setAttribute('data', one_id);
                })
            })
        }

        document.getElementById('deleteBtn').addEventListener('click', () => {
            let id = document.getElementById('deleteBtn').getAttribute('data');
            let xhr = new XMLHttpRequest();
            let fd = new FormData();
            fd.append("id", id);
            xhr.open("POST", "./action/delete-quiz-one.php");
            xhr.send(fd);
            xhr.onload = () => {
                window.location.reload();
            }
        })

        function addQuestion() {
            document.getElementById('addQ').addEventListener('click', () => {

                let xhr = new XMLHttpRequest();
                let fd = new FormData();
                fd.append("title", title);
                fd.append("qid", "<?= $quiz_id ?>");
                xhr.open("POST", "./action/add-question.php");
                xhr.send(fd);
                xhr.onload = () => {
                    window.location.href = "./register/question-and-answer.php";
                }
            })
        }



        document.getElementById('editTitle').addEventListener('click', () => {
            let title = document.getElementById('quizTitle').textContent;
            document.getElementById('quizTitle').classList.add('d-none');
            document.getElementById('inputTitle').value = title;
            document.getElementById('inputTitlteWrapper').classList.remove('d-none');
            document.getElementById('editTitle').classList.add('d-none');
            document.getElementById('resetTitle').classList.remove('d-none');
        });

        document.getElementById('resetTitle').addEventListener('click', () => {
            let newtitle = document.getElementById('inputTitle').value;
            let xhr = new XMLHttpRequest();
            let fd = new FormData();
            fd.append('newTitle', newtitle);
            fd.append('quiz_id', id);

            xhr.open('POST', './action/reset-title.php');
            xhr.send(fd);
            xhr.onload = (e) => {
                let json = e.target.response;
                let res = JSON.parse(json);
                console.log(res);
                if (res == "True") {
                    document.getElementById('quizTitle').textContent = newtitle;
                    document.getElementById('quizTitle').classList.remove('d-none');
                    document.getElementById('inputTitlteWrapper').classList.add('d-none');
                    document.getElementById('editTitle').classList.remove('d-none');
                    document.getElementById('resetTitle').classList.add('d-none');
                } else {
                    document.getElementById('titleerr').classList.remove('d-none');
                }
            }
        });


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