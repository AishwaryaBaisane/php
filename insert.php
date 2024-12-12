<?php 

header("Access-Control-Allow-Method: POST");
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
} else
 {
    $arr['err']="insertion error ";
}
echo json_encode($arr);

?>


