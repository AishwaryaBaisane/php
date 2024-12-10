<?php 

include('config.php');

$c1 = new Config();
// $c1->connect();

// echo "Database Connect successfully !";
$is_btn_set = isset($_POST['button']);
if($is_btn_set)
{
    // <!-- name role salary age  address phone -->(name,role,salary,age,address,phone) 
    $name = $_POST['name'];
    $role = $_POST['role'];
    $salary = $_POST['salary'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $c1->insert($name,$role,$salary,$age,$address,$phone);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<body>
  <center>
  <h1>Employee Form</h1>
    <form method="POST">
        <input placeholder="Name" name="name"><br><br>
        <input placeholder="Role" name="role"><br><br>
        <input placeholder="Salary" name="salary"><br><br>
        <input placeholder="Age" name="age"><br><br>
        <input placeholder="Address" name="address"><br><br>
        <input placeholder="Phone" name="phone"><br><br>
        <button name = "button" type = "submit">Submit</button>
    </form>
</center>

</body>

</html>
