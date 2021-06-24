<?php


class dataBase{
    
    public $servername='localhost';
    public $dbname='myBlog';
    public $user='user';
    public $pass='user';

    public function connect(){

        try {
           $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->user, $this->pass);
           return $conn;
           echo "success";
           
        }catch (PDOException $e) {
            echo "failed :" . $e->getMessage() . "<br>";
        }
    }
}