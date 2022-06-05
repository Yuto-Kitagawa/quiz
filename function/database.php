<?php

class Database
{
    private $dsn = 'mysql:dbname=quiz;host=localhost';
    private $username = 'root';
    private $password = '';
    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            var_dump('Error');
            exit();
        }
    }
}
