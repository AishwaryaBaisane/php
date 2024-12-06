<?php 

    class Config
    {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "demo";

        public function connect()
        {
           $res =  mysqli_connect($this->host,$this->username,$this->password,$this->database);
           if($res)
           {
            echo "Database Connect successfully !";
           }
           else{
            echo "Database Connect faild !";
           }
        }
        
    }
   
?>