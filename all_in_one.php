<?php 

header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Method: DELETE");
header("Access-Control-Allow-Method: PUT");
header("Content-Type: application/json");

include'config.php';

$c1 = new Config();


if($_SERVER['REQUEST_METHOD']=="POST")
{
    $name = $_POST['name'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $res = $c1->insert($name,$role,$salary,$age,$address,$phone);

    if($res)
       {
        $arr['msg'] = "Database Connect successfully !";
       }
       else{
        $arr['msg'] = "Database not found !";
       }
    // header("Location:index.php");
} else if($_SERVER['REQUEST_METHOD']=="GET")
 {$res = $c1->fetch();
    $arr = [];
    if($res)
       {
        while($data = mysqli_fetch_assoc($res))
        {
            array_push($arr,$data);
        }
       }
       else{
        $arr['msg'] = "Database not found !";
       } $arr['err']="insertion error ";
}
else if($_SERVER['REQUEST_METHOD']=="PUT")
{
    
    $data = file_get_contents("php://input");
    parse_str($data, $result);
    $id= $result["id"];
    $name= $result["name"];
    $role= $result["role"];
    $salary = $result["salary"];
    $age = $result["age"];
    $address = $result["address"];
    $phone = $result["phone"];


    $res = $c1->update($id, $name, $role, $salary, $age, $address, $phone);
    if($res)
       {
        $arr['msg'] = "Data update successfully !";
       }
       else{
        $arr['msg'] = "Database not update !";
       }
}
else if($_SERVER['REQUEST_METHOD']=="DELETE")
{
    
    $data = file_get_contents("php://input");
    parse_str($data, $result);
    $id= $result["id"];
    $res = $c1->delete($id);
    if($res)
       {
        $arr['msg'] = "Data Deleted successfully !";
       }
       else{
        $arr['msg'] = "Database not delete !";
       }
}
else{
    $arr["msg"] = "only get, insert,update,delete  allow !!";
}
echo json_encode($arr);

?>


