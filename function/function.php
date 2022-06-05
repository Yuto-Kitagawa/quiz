<?php

require_once __DIR__ . "/../function/database.php";

class Functions extends Database
{
    public function getTitles()
    {
        $sql = "SELECT DISTINCT(title) FROM quiz ORDER BY id DESC;";
        $sth = $this->conn->prepare($sql);

        $sth->execute();

        $result = [];

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row['title']);
        }

        return $result;
    }
    public function insertDatas($q, $a)
    {
        session_start();
        $title = $_SESSION['title'];
        $sql = "INSERT INTO quiz (title,question,answer) VALUES (:title,:question,:answer);";

        $sth = $this->conn->prepare($sql);

        $sth->bindValue(':title', $title, PDO::PARAM_STR);
        $sth->bindValue(':question', $q, PDO::PARAM_STR);
        $sth->bindValue(':answer', $a, PDO::PARAM_STR);

        $sth->execute();

        header('Location: ../register/question-and-answer.php');
        exit();
    }

    public function getQuestionsAndAnswers($q)
    {
        $sql = "SELECT * FROM quiz WHERE title = :title ORDER BY id;";
        $sth = $this->conn->prepare($sql);

        $sth->bindValue(':title', $q, PDO::PARAM_STR);
        $sth->execute();

        $counter = 0;

        session_start();

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $_SESSION['question'][$counter] = $row['question'];
            $_SESSION['answer'][$counter] = $row['answer'];

            $counter += 1;
        }

        for ($j = 0; $j < $counter; $j++) {
            $_SESSION['counter'][$j] = $j;
        }

        shuffle($_SESSION['counter']);

        header('Location: ../challenge/index.php?q=' . $q . '&n=' . $_SESSION['counter'][0]);
        exit();
    }
}
