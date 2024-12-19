<?php

header("Access-Control-Allow-Methods: POST, DELETE, GET");
header("Content-Type: application/json");

include('config.php');

$c1 = new Config();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $img = $_FILES['name'];
    print_r($img);
    $uid = uniqid();

    $isImageUpload = move_uploaded_file($img['tmp_name'], 'Images/' . $uid . $img['name']);
    
    $res = $c1->insertIamges($uid . $img['name'], $id); // Updated to save unique file name
    
    if ($isImageUpload) {
        if ($res) {
            echo json_encode(['msg' => 'Image uploaded successfully!']);
        } else {
            echo json_encode(['msg' => 'Image not uploaded!']);
        }
    } else {
        echo json_encode(['msg' => 'Error uploading image!']);
    }

} elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    
    $data = file_get_contents("php://input");
    parse_str($res,$data);
    if($data)
    {
     while($data = mysqli_fetch_assoc($res))
     {
         array_push($arr,$data);
     }
    }
    else{
     $arr['msg'] = "Database not found !";
    }
     print($res["id"]);
//     $data = file_get_contents("php://input");
//     parse_str($data, $result);
//     $id= $data["id"];// Employee ID to delete

    // $data = file_get_contents("php://input");
    // parse_str($data, $result);
    // $id= $data['id'];
    // parse_str($id, $uid);
    // print($uid);
    // $res = $c1->deleteImage($uid);
    // if($res)
    //    {
    //     $arr['msg'] = "Data Deleted successfully !";
    //    }
    //    else{
    //     $arr['msg'] = "Database not delete !";
    //    }
    
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Fetch query parameters
    $id = isset($_GET['id']) ? $_GET['id'] : null;
    
    if ($id) {
        // Fetch specific image data based on ID
        $imageData = $c1->getImageById($id);
    } else {
        // Fetch all image data
        $imageData = $c1->getAllImages();
    }
    
    if ($imageData) {
        echo json_encode(['msg' => 'Data retrieved successfully!', 'data' => $imageData]);
    } else {
        echo json_encode(['msg' => 'No data found!']);
    }

} else {
    echo json_encode(['msg' => 'Invalid request method!']);
}
