<?php

require_once(__DIR__ . "/database.php");

class Functions extends Database
{
    //========================================
    //          ユーザー登録関係
    public function register_user($usermail)
    {
        try {
            $sql = "SELECT * FROM user WHERE user_mail = :usermail;";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':usermail', $usermail, PDO::PARAM_STR);
            $sth->execute();

            if ($sth->rowCount() == 0) {
                $user_id = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 64);
                $row = $this->check_userid($user_id);
                if($row == 0){
                    $sql3 = "INSERT INTO user (user_id,user_mail) VALUES (:userid,:usermail);";
                    $sth3 = $this->conn->prepare($sql3);
                    $sth3->bindValue(':userid', $user_id, PDO::PARAM_STR);
                    $sth3->bindValue(':usermail', $usermail, PDO::PARAM_STR);
                    $sth3->execute();
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    return "True";
                }else{
                    return "False";
                }
            } else {
                return "False";
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            return $message;
        }
    }

    public function check_userid($userid)
    {
        $sql = "SELECT user_id FROM user WHERE user_id = :userid";
        $sth2 = $this->conn->prepare($sql);
        $sth2->bindValue(':userid', $userid, PDO::PARAM_STR);
        $sth2->execute();
        $row = $sth2->rowCount();
        return $row;
    }


    //データベースを使用した認証用関数(使用していない)
    // function cognit_token_db($token)
    // {
    //     $sql = "SELECT token FROM cognit WHERE user_mail = :usermail";
    //     $sth2 = $this->conn->prepare($sql);
    //     $user_mail = $_SESSION['user_mail'];
    //     $sth2->bindValue(':usermail', $user_mail, PDO::PARAM_STR);
    //     $sth2->execute();
    //     if ($sth2->rowCount() == 1) {
    //         $r = $sth2->fetch(PDO::FETCH_ASSOC);
    //         if ($r['token'] == $token) {
    //             $user_id = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 64);
    //             $res = $this->check_userid($user_id);
    //             if ($res == 0) {
    //                 $res = $this->register_user($user_id, $user_mail);
    //             }
    //         } else {
    //             $res = "False";
    //         }
    //     } else {
    //         $res = "False";
    //     }
    //     return $res;
    // }

    // public function cognit($user_mail, $token)
    // {
    //     //認証
    //     date_default_timezone_set('Asia/Tokyo');
    //     $objDateTime = new DateTime();
    //     $now = $objDateTime->format('Y-m-d H:i:s');

    //     $sql = "SELECT * FROM cognit WHERE user_mail = :usermail";
    //     $sth = $this->conn->prepare($sql);
    //     $sth->bindValue(':usermail', $user_mail, PDO::PARAM_STR);
    //     $sth->execute();

    //     $row = $sth->rowCount();
    //     if ($row == 0) {
    //         $sql = "INSERT INTO cognit (user_mail,token,make_time) VALUES (:usermail,:token,:maketime);";
    //         $sth = $this->conn->prepare($sql);
    //         $sth->bindValue(':usermail', $user_mail, PDO::PARAM_STR);
    //         $sth->bindValue(':token', $token, PDO::PARAM_STR);
    //         $sth->bindValue(':maketime', date("Y/m/d H:i:s", strtotime($now)), PDO::PARAM_STR);
    //         $sth->execute();
    //     } else {
    //         $sql = "UPDATE cognit SET token = :token,make_time = :maketime WHERE user_mail = :usermail";
    //         $sth = $this->conn->prepare($sql);
    //         $sth->bindValue(':usermail', $user_mail, PDO::PARAM_STR);
    //         $sth->bindValue(':token', $token, PDO::PARAM_STR);
    //         $sth->bindValue(':maketime', date("Y/m/d H:i:s", strtotime($now)), PDO::PARAM_STR);
    //         $sth->execute();
    //     }

    //     $res = $this->send_mail($user_mail, $token);
    //     return $res;
    // }

    public function send_mail($mailaddress, $token)
    {
        try {
            mb_language("ja");
            mb_internal_encoding("utf-8");

            $to = $mailaddress;
            $title = "【yutons quiz】メール認証";
            $message = "こちらはyutons quizの認証用メールアドレスです。\r\r以下のURLをクリックして認証してください。\r\r\r メール認証URL\r https://yutons.com/quiz/cognit.php?token=" . $token . "\r\r          \r\r このメールアドレスに当メールに心当たりの無い場合は、本メールを削除していただくよう宜しくお願い致します。";

            mb_send_mail($to, $title, $message);

            return "Cognit";
        } catch (Exception $e) {
            $message = $e->getMessage();
            return $message;
        }
    }

    public function login($user_mail)
    {
        try {
            //userテーブルに登録されているか検証
            $sql = "SELECT * FROM user WHERE user_mail = :usermail;";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':usermail', $user_mail, PDO::PARAM_STR);
            $sth->execute();
        } catch (Exception $e) {
            $message = $e->getMessage();
            return $message;
        }
        $numrows = $sth->rowCount();

        if ($numrows == 1) {
            //登録済みの場合はuser_idをセッションに格納してページ遷移
            $r = $sth->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['user_id'] = $r['user_id'];
            return "True";
        } else if ($numrows == 0) {
            //登録されていない場合、tokenを生成してメール認証する
            $token = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 64);
            $_SESSION['mail'] = $user_mail;
            $_SESSION['token'] = $token;

            $res = $this->send_mail($user_mail, $token);
            //メール送信が成功すればCognit,失敗すればFalseが返却される
            return $res;
        }
    }
    //====================================================


    //====================================================
    //                 問題登録関係
    public function check_title($title)
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        //登録したユーザーがクイズのタイトルを登録済みかをチェック
        $sql = "SELECT quiz_title FROM quiz_info WHERE quiz_title = :title AND registered_user = :userid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':title', $title, PDO::PARAM_STR);
        $sth->bindValue(':userid', $user_id, PDO::PARAM_STR);

        $sth->execute();
        if ($sth->rowCount() == 0) {
            return "True";
        } else {
            return "False";
        }
    }

    public function update_changetime($quiz_id)
    {
        //現在時刻の取得
        date_default_timezone_set('Asia/Tokyo');
        $objDateTime = new DateTime();
        $now = $objDateTime->format('Y-m-d H:i:s');
        $sql = "UPDATE quiz_info SET changed_time = :changetime WHERE quiz_id = :quizid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':quizid', $quiz_id, PDO::PARAM_STR);
        $sth->bindValue(':changetime', date("Y/m/d H:i:s", strtotime($now)), PDO::PARAM_STR);
        $sth->execute();
    }

    public function register_quiz_info($user_id, $quiz_id, $title)
    {
        $sql = "SELECT quiz_id FROM quiz_info WHERE quiz_id = :quizid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':quizid', $quiz_id, PDO::PARAM_STR);
        $sth->execute();
        if ($sth->rowCount() == 0) {
            $sql = "INSERT INTO quiz_info (quiz_id,quiz_title,registered_user) VALUES (:quizid,:title,:userid);";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':quizid', $quiz_id, PDO::PARAM_STR);
            $sth->bindValue(':title', $title, PDO::PARAM_STR);
            $sth->bindValue(':userid', $user_id, PDO::PARAM_STR);
            $sth->execute();
        }
    }

    public function insertQuiz($q, $a)
    {
        session_start();
        $title = $_SESSION['title'];
        $user_id = $_SESSION['user_id'];
        $quiz_id = $_SESSION['quiz_id'];

        while (True) {
            $originalid = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 64);
            //オリジナルIDの検証と格納
            $sql = "SELECT * FROM quiz WHERE quiz_original_id = :originid;";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':originid', $originalid, PDO::PARAM_STR);
            $row = $sth->rowCount();
            if ($row == 0) {
                $sql = "INSERT INTO quiz (quiz_id,quiz_original_id,question,answer) VALUES (:quizid,:originalid,:question,:answer);";
                $sth = $this->conn->prepare($sql);
                //settitleで設定済み
                $sth->bindValue(':quizid', $quiz_id, PDO::PARAM_STR);
                $sth->bindValue(':originalid', $originalid, PDO::PARAM_STR);
                $sth->bindValue(':question', $q, PDO::PARAM_STR);
                $sth->bindValue(':answer', $a, PDO::PARAM_STR);

                $sth->execute();
                $this->register_quiz_info($user_id, $quiz_id, $title);
                $this->update_changetime($quiz_id);

                header('Location: ../register/question-and-answer.php');
                exit();
                break;
            }
        }
    }
    //====================================================

    //====================================================
    //                     出題関係

    public function getQuiz($user)
    {
        $sql = "SELECT * FROM quiz_info WHERE registered_user = :user;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':user', $user, PDO::PARAM_STR);
        $sth->execute();
        if ($sth->rowCount() == 0) {
            return "None";
        } else {
            $quiz_id_array = [];

            while ($r = $sth->fetch(PDO::FETCH_ASSOC)) {

                $sql = "SELECT COUNT(quiz_id) FROM quiz WHERE quiz_id = :quizid;";
                $sth2 = $this->conn->prepare($sql);
                $sth2->bindValue(':quizid', $r['quiz_id'], PDO::PARAM_STR);
                $sth2->execute();
                $counter = $sth2->fetch(PDO::FETCH_ASSOC);

                array_push($r, $counter['COUNT(quiz_id)']);
                array_push($quiz_id_array, $r);
            }
            return $quiz_id_array;
        }
    }

    public function check_share($id)
    {
        $sql = "SELECT share_flag FROM quiz_info WHERE quiz_id = :quizid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':quizid', $id, PDO::PARAM_STR);
        $sth->execute();
        $r = $sth->fetch(PDO::FETCH_ASSOC);

        //選択した行が0の時
        if ($sth->rowCount() > 0) {
            if ($r['share_flag'] == 1) {
                return "True";
            } else {
                return "False";
            }
        } else {
            return "False";
        }
    }

    public function getQuiz_one($id)
    {

        $sql = "SELECT * FROM quiz_info WHERE quiz_id = :quizid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':quizid', $id, PDO::PARAM_STR);
        $sth->execute();
        $r1 = $sth->fetch(PDO::FETCH_ASSOC);

        session_start();
        $title = $r1['quiz_title'];

        $sql2 = "SELECT * FROM quiz WHERE quiz_id = :quizid;";
        $sth2 = $this->conn->prepare($sql2);
        $sth2->bindValue(':quizid', $id, PDO::PARAM_STR);
        $sth2->execute();

        if ($sth2->rowCount() > 0) {
            $question = [];
            $answer = [];
            $quiz_original_id = [];
            while ($r2 = $sth2->fetch(PDO::FETCH_ASSOC)) {
                array_push($question, $r2['question']);
                array_push($answer, $r2['answer']);
                array_push($quiz_original_id, $r2['quiz_original_id']);
            }

            return ["True", $title, $question, $answer, $quiz_original_id];
        } else {
            return ["False"];
        }
    }
    //====================================================

    //====================================================
    //                   問題編集関係

    public function resetTitle($user_id, $title, $quizid)
    {
        $sql = "SELECT * FROM quiz_info WHERE quiz_id = :quizid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':quizid', $quizid, PDO::PARAM_STR);
        $sth->execute();

        if ($sth->rowCount() == 1) {
            $r = $sth->fetch(PDO::FETCH_ASSOC);
            $registered_user_id = $r['registered_user'];
            if ($user_id == $registered_user_id) {
                date_default_timezone_set('Asia/Tokyo');
                $objDateTime = new DateTime();
                $now = $objDateTime->format('Y-m-d H:i:s');
                try {
                    $update_sql = "UPDATE quiz_info SET quiz_title = :quiztitle,changed_time = :changetime WHERE quiz_id = :quizid;";
                    $sth2 = $this->conn->prepare($update_sql);
                    $sth2->bindValue(':quiztitle', $title, PDO::PARAM_STR);
                    $sth2->bindValue(':changetime', date("Y/m/d H:i:s", strtotime($now)), PDO::PARAM_STR);
                    $sth2->bindValue(':quizid', $quizid, PDO::PARAM_STR);
                    $sth2->execute();
                    return "True";
                } catch (Exception $e) {
                    return "False";
                }
            } else {
                "False";
            }
        } else {
            return "False";
        }
    }

    public function changeShare($quizid, $flag, $user_id)
    {
        $sql = "SELECT * FROM quiz_info WHERE quiz_id = :quizid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':quizid', $quizid, PDO::PARAM_STR);
        $sth->execute();

        if ($sth->rowCount() == 1) {
            $r = $sth->fetch(PDO::FETCH_ASSOC);
            $registered_user_id = $r['registered_user'];
            if ($user_id == $registered_user_id) {
                try {
                    $update_sql = "UPDATE quiz_info SET share_flag = :shareflag WHERE quiz_id = :quizid;";
                    $sth2 = $this->conn->prepare($update_sql);
                    $sth2->bindValue(':shareflag', $flag, PDO::PARAM_INT);
                    $sth2->bindValue(':quizid', $quizid, PDO::PARAM_STR);
                    $sth2->execute();
                    return "True";
                } catch (Exception $e) {
                    return "False";
                }
            } else {
                return "False";
            }
        } else {
            return "False";
        }
    }

    public function deleteQuiz($quizid)
    {
        try {
            $sql = "DELETE FROM quiz WHERE quiz_id = :quizid; DELETE FROM quiz_info WHERE quiz_id = :quizid;";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':quizid', $quizid, PDO::PARAM_STR);
            $sth->execute();
            return "OK";
        } catch (Exception $e) {
            return $e;
        }
    }

    public function getQuizAndAnswer($quizid)
    {
        $sql = "SELECT * FROM quiz WHERE quiz_original_id = :qid;";
        $sth = $this->conn->prepare($sql);
        $sth->bindValue(':qid', $quizid, PDO::PARAM_STR);
        $sth->execute();
        $row = $sth->rowCount();
        if ($row == 1) {
            $r = $sth->fetch(PDO::FETCH_ASSOC);
            $res = [];
            array_push($res, $r['question']);
            array_push($res, $r['answer']);
            return $res;
        } else {
            return "False";
        }
    }

    public function deleteQuiz_one($original_id, $user_id)
    {
        try {

            $sql = "SELECT quiz_id FROM quiz WHERE quiz_original_id = :originalid;";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':originalid', $original_id, PDO::PARAM_STR);
            $sth->execute();
            $r = $sth->fetch(PDO::FETCH_ASSOC);
            $qid = $r['quiz_id'];
            $sql2 = "SELECT registered_user FROM quiz_info WHERE quiz_id = :quizid;";
            $sth2 = $this->conn->prepare($sql2);
            $sth2->bindValue(':quizid', $qid, PDO::PARAM_STR);
            $sth2->execute();
            $r2 = $sth2->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "False";
        }
        if ($r2['registered_user'] == $user_id) {
            $update_sql = "DELETE FROM quiz WHERE quiz_original_id = :originalid;";
            $sth3 = $this->conn->prepare($update_sql);
            $sth3->bindValue(':originalid', $original_id, PDO::PARAM_STR);
            $sth3->execute();
            $sth3->fetch(PDO::FETCH_ASSOC);
        } else {
            return "False";
        }
    }

    public function refreshQuiz($quiz, $answer, $quizid, $user_id)
    {
        try {

            $sql = "SELECT quiz_id FROM quiz WHERE quiz_original_id = :originalid;";
            $sth = $this->conn->prepare($sql);
            $sth->bindValue(':originalid', $quizid, PDO::PARAM_STR);
            $sth->execute();
            $r = $sth->fetch(PDO::FETCH_ASSOC);
            $qid = $r['quiz_id'];
            $sql2 = "SELECT registered_user FROM quiz_info WHERE quiz_id = :quizid;";
            $sth2 = $this->conn->prepare($sql2);
            $sth2->bindValue(':quizid', $qid, PDO::PARAM_STR);
            $sth2->execute();
            $r2 = $sth2->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "False";
        }
        if ($r2['registered_user'] == $user_id) {
            $update_sql = "UPDATE quiz SET question = :quiz,answer=:answer WHERE quiz_original_id = :originalid;";
            $sth3 = $this->conn->prepare($update_sql);
            $sth3->bindValue(':quiz', $quiz, PDO::PARAM_STR);
            $sth3->bindValue(':answer', $answer, PDO::PARAM_STR);
            $sth3->bindValue(':originalid', $quizid, PDO::PARAM_STR);
            $sth3->execute();
            $sth3->fetch(PDO::FETCH_ASSOC);
            return "True";
        } else {
            return "False";
        }
    }
}
