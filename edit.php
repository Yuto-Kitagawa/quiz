<?php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == "") {
    header('Location: ./login.php');
    exit();
}

$_SESSION['title'] = "";
$_SESSION['quiz_id'] = "";
$_SESSION['mail'] = "";

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
                    <div class="">本当に削除しますか</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                    <button type="button" class="btn btn-danger d-block" id="deleteFinally">削除</button>
                </div>
            </div>
        </div>
    </div>

    <body>

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
                        <a href="#" class="h-100 d-flex justify-content-center align-items-center text-decoration-none text-dark lead fs-4 d-block">
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
                <div class="main-container bg-white mt-3 p-1 pt-4">
                    <div class=" col-10 m-auto d-flex align-items-center justify-content-center">
                        <div class="fs-4 text-center lead">登録済み問題</div>
                        <a href="./register/title.php" class="btn btn-outline-primary mx-3 d-flex" style="padding: 2px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>
                        </a>
                    </div>
                    <div class="pt-4">
                        <div class="lead text-danger" id="err" hidden>エラーが発生しました。</div>
                        <div class="lead" id="None" hidden>登録されている問題はありません。</div>
                        <div class="lead text-success" id="copylabel" hidden>コピーが完了しました</div>
                    </div>
                    <div class="pt-2">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="lead fs-6">問題名</th>
                                    <th scope="col" class="lead fs-6">編集</th>
                                    <th scope="col" class="lead fs-6">削除</th>
                                    <th scope="col" class="lead fs-6 text-center">共有</th>
                                </tr>
                            </thead>
                            <tbody id="quizBody">
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center align-items-center" id="load">
                            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <script>
            const xhr = new XMLHttpRequest();

            let user = "";

            xhr.open('get', './action/get-user.php');
            xhr.send();
            xhr.onload = (e) => {
                let res = e.target.response;
                user = JSON.parse(res);

                if (user != "") {
                    const fd = new FormData();
                    fd.append('user', user);
                    xhr.open('POST', './action/get-quiz.php');
                    xhr.send(fd);
                    xhr.onload = (e) => {
                        //登録されているタイトルを取得
                        q_array = JSON.parse(e.target.response);
                        if (q_array != "None") {
                            let parent = document.getElementById('quizBody');

                            // foreachの代わり
                            for (let obj of q_array) {
                                let tr = document.createElement('tr');
                                let title = document.createElement('td');
                                title.innerHTML = '<a href="./challenge/index.php?id=' + obj['quiz_id'] + '">' + obj['quiz_title'] + '</a>';
                                tr.appendChild(title);

                                let editbtn = document.createElement('td');
                                editbtn.innerHTML = '<a href="./edit-quiz.php?id=' + obj['quiz_id'] + '" class="btn btn-outline-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16"><path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/><path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/></svg></a>';
                                tr.appendChild(editbtn);

                                let deleteBtn = document.createElement('td');
                                deleteBtn.innerHTML = '<button data=' + obj['quiz_id'] + '" class="btn btn-outline-danger deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6.5 1a.5.5 0 0 0-.5.5v1h4v-1a.5.5 0 0 0-.5-.5h-3ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1H3.042l.846 10.58a1 1 0 0 0 .997.92h6.23a1 1 0 0 0 .997-.92l.846-10.58Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg></a>';
                                tr.appendChild(deleteBtn);

                                // let edittime = document.createElement('td');
                                // tr.appendChild(edittime);

                                let share_td = document.createElement('td');
                                let share_toggle_wrapper = document.createElement('div');
                                share_toggle_wrapper.setAttribute('class', 'form-check form-switch user-select-none d-flex justify-content-around align-items-center');
                                let share_toggle = document.createElement('input');
                                share_toggle.setAttribute('class', "form-check-input");
                                share_toggle.setAttribute('type', "checkbox");
                                share_toggle.setAttribute('data', obj['quiz_id']);

                                let copy_btn = document.createElement('button');
                                copy_btn.setAttribute('data', obj['quiz_id']);
                                copy_btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/><path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/></svg>';

                                if (obj['share_flag'] == 1) {
                                    share_toggle.setAttribute('checked', true);
                                    copy_btn.setAttribute('class', "copy-btn shadow-none btn btn-outline-warning");
                                } else {
                                    copy_btn.setAttribute('class', "copy-btn shadow-none btn btn-outline-warning d-none");
                                }


                                share_toggle_wrapper.appendChild(share_toggle);
                                share_toggle_wrapper.appendChild(copy_btn);

                                share_td.appendChild(share_toggle_wrapper);
                                tr.appendChild(share_td);

                                parent.appendChild(tr);
                            };
                            check_share();
                            deletebtn_click()
                            copyShareLink();
                        } else if (q_array == "None") {
                            document.getElementById('None').hidden = false;
                        }
                    }
                    document.getElementById('load').classList.add('d-none');
                }
            }

            //ロード画面を削除
            function delete_load() {
                document.getElementById('loadTmp').remove();
            };

            function load_tmp(flag, q_id) {
                let load_scr = document.createElement('div');
                load_scr.setAttribute('id', "loadTmp");
                load_scr.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';

                document.getElementsByTagName('body')[0].appendChild(load_scr);

                setTimeout(() => {
                    const xhr = new XMLHttpRequest();
                    const fd = new FormData();
                    fd.append("qid", q_id);
                    if (flag == false) {
                        fd.append("flag", "0");
                        document.querySelectorAll('button[data="' + q_id + '"]')[0].classList.add('d-none')
                    } else {
                        fd.append("flag", "1");
                        document.querySelectorAll('button[data="' + q_id + '"]')[0].classList.remove('d-none')
                    }
                    xhr.open("POST", "./action/share-toggle.php");
                    xhr.send(fd);
                    xhr.onload = (e) => {
                        let json = e.target.response;
                        let res = JSON.parse(json);
                        if (res == false) {
                            document.getElementById('err').hidden = false;
                        }
                    }
                    delete_load();
                }, 2000);
            };

            function check_share() {
                document.querySelectorAll('.form-check-input').forEach(el => {
                    el.addEventListener('change', () => {
                        let q_id = el.getAttribute('data');
                        if (el.checked == true) {
                            load_tmp(true, q_id);
                        } else {
                            load_tmp(false, q_id);
                        }
                    })
                })
            }

            // コピー
            function copyShareLink() {
                document.querySelectorAll('.copy-btn').forEach(el => {
                    el.addEventListener('click', () => {
                        let id = el.getAttribute('data');
                        let link = "https://yutons.com/quiz/share.php?id=" + id;
                        navigator.clipboard.writeText(link);
                        document.getElementById('copylabel').hidden = false;
                        setTimeout(() => {
                            document.getElementById('copylabel').hidden = true;
                        }, 2000);
                    })
                })
            }

            function deletebtn_click() {
                document.querySelectorAll('.deletebtn').forEach(el => {
                    el.addEventListener('click', () => {
                        d = el.getAttribute('data');
                        d = d.replace('\"', "");
                        document.getElementById('deleteFinally').setAttribute("data", d);
                    });
                });
                delete_quiz();
            }

            function delete_quiz() {
                document.getElementById('deleteFinally').addEventListener('click', () => {
                    if (document.getElementById('deleteFinally').getAttribute('data') != "") {

                        const delete_fd = new FormData()
                        let delete_quiz_id = document.getElementById('deleteFinally').getAttribute('data');
                        delete_fd.append("q", delete_quiz_id);

                        xhr.open("POST", "./action/delete-quiz.php");
                        xhr.send(delete_fd);
                        xhr.onload = (e) => {
                            res = JSON.parse(e.target.response);
                            if (res == "OK") {
                                location.reload();
                            } else {
                                document.getElementById('err').hidden = false;
                            }
                        }
                    }
                });
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