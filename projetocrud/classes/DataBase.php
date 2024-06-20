<?php
    class DataBase{
        private $host = "localhost";
        private $db_name = "bdprojetocrud";
        private $userName = "root";
        private $password = "";
        public $conn;
        
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->userName, $this->password);
            } catch(PDOException $exception){
                echo "Erro de conexão:".$exception->getMessage();
            }
            return $this->conn;
        }
    }
    ?>