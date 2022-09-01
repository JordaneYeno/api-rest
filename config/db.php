<?php 

class DB
{

    private $host = 'localhost';
    private $database = 'eshop';
    private $username = 'root';
    private $password  = '';

    public function connect()
    {
        $pdo_conn = "mysql:host=$this->host; dbname=$this->database";
        $pdo = new PDO($pdo_conn, $this->username,  $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    
}

?>