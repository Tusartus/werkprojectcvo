<?php


class DB {

    	//local devel
		private $host = 'localhost';
		private $dbName = 'werkprojectcvodb';
		private $user = 'root';
		private $pass = '';



    protected $conn;

    protected $db =  "database.sqlite";
    protected $showErrors = true;

    public function __construct(){
        //met mysql phpmyadmin 
        $conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass);
        

         if($this->showErrors){
              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }

         $this->conn = $conn;
    }

    public function doQuery($query, $data=[]){
         try{
             $stmt = $this->conn->prepare($query);
             $stmt->execute($data);

         }catch (PDOException $e){
             die($e->getMessage());

         }

         return $stmt;
    }

    public function lastInsertId(){
         return $this->conn->lastInsertId();
    }



} 