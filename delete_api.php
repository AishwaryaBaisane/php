<?php

header("Access-Control-Allow-Method: DELETE");
header("Content-Type: application/json");

include'config.php';

$c1 = new Config();


if($_SERVER['REQUEST_METHOD']=="DELETE")
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
    // header("Location:index.php");
} else
 {
    $arr['err']="Only DELETE TYPE ALLOW ";
}
echo json_encode($arr);