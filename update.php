<?php

header("Access-Control-Allow-Method: PUT");
header("Content-Type: application/json");

include'config.php';

$c1 = new Config();


if($_SERVER['REQUEST_METHOD']=="PUT")
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
    // header("Location:index.php");
} else
 {
    $arr['err']="Only PUT TYPE ALLOW ";
}
echo json_encode($arr);