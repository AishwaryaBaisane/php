<?php 

    class Config
    {
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "demo";
        private $connection;

        public function connect()
        {
           $this->connection =  mysqli_connect($this->host,$this->username,$this->password,$this->database);
        //    if($res)
        //    {
        //     echo "Database Connect successfully !";
        //    }
        //    else{
        //     echo "Database Connect faild !";
        //    }
        }

        public function __construct()
        {
            $this->connect();
        }

        public function insert($name,$role,$salary,$age,$address,$phone)
        { 
            $query = "INSERT INTO employee (name,role,salary,age,address,phone)  VALUES('$name','$role',$salary,$age,'$address',$phone)";
            $res = mysqli_query($this->connection,$query);
            if($res)
               {
                echo "Database Connect successfully !";
               }
               else{
                echo "Database Connect faild !";
               }
        }
        
    }
    // <!-- name role salary age  address phone-->
   
?>

