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
            return $res;
        }
        public function insertIamges($name,$id)
        { 
            $query = "INSERT INTO imagedata (name,id)  VALUES('$name',$id)";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }
        public function fetch()
        {
        $query = "SELECT * FROM employee";
        $res = mysqli_query($this->connection,$query);
        return $res;
        }
        public function getImageById($id)
{
    $query = "SELECT * FROM imagedata WHERE id = ?";
    $stmt = mysqli_prepare($this->connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null; // No image found
    }
}

public function getAllImages()
{
    $query = "SELECT * FROM imagedata";
    $result = mysqli_query($this->connection, $query);

    $images = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $images[] = $row;
        }
    }
    return $images;
}

        public function delete($id)
        {
            $query = "DELETE FROM employee WHERE id = $id";
            $res = mysqli_query($this->connection,$query);
            return $res;
        }
        public function fetchImage($id)
        {
        $query = "SELECT * FROM imagedata";
        $res = mysqli_query($this->connection,$query);
        return $res;
        }
        public function deleteImage($id)
        {
            $query = "DELETE FROM imagedata WHERE id = $id";
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

