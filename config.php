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
            // if($res)
            //    {
            //     echo "Database Connect successfully !";
            //    }
            //    else{
            //     echo "Database Connect faild !";
            //    }
        }

        public function fetch()
        {
        $query = "SELECT * FROM employee";
        $res = mysqli_query($this->connection,$query);
        return $res;
        }

        public function delete($id)
        {
            $query = "DELETE FROM employee WHERE id = $id";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }

        public function update($id,$name,$role,$salary,$age,$address,$phone) {
            $query = "UPDATE employee SET name='$name', role='$role', salary=$salary,age=$age,address='$address',phone=$phone WHERE id=$id";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }
        
    }



    // <!-- name role salary age  address phone-->
   
?>

