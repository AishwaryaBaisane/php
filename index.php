<?php 

include('config.php');

$c1 = new Config();
$res = $c1->fetch();
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
    header("refresh:1");
}

if(isset($_POST['delete']))
{
    $id= $_POST['deleteId'];
   $c1->delete($id); 
   header("refresh:1");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('https://t4.ftcdn.net/jpg/06/39/58/95/240_F_639589574_BaoWjhM8fn8QOJbeRuXgJzKGDyidXwHb.jpg'); /* Replace with your image path */
            background-size: cover;
             background-repeat: no-repeat;
    background-position: center center;
    height: 100vh; /* Full viewport height */
    margin: 0; /* Remove default margin */
    display: flex; /* Enable Flexbox */
    align-items: center; /* Vertically center */
    justify-content: center; /* Horizontally center */
        }
        .container {
             background-color: rgba(255, 255, 255, 0.8);/* Optional: Add a semi-transparent background */
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body center >
    <div class="container mx-auto p-2" style="width: 350px;">
        <h1>Employee Form</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role">
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input class="form-control" id="salary" name="salary">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" id="phone" name="phone">
            </div>
            <button name="button" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <hr>
    <div class="container mx-auto p-2" style="width: 800px;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Employee's Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Role</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($data = mysqli_fetch_assoc($res)){?>
                <tr>
                    <th scope="row"><?php echo $data['id']?></th>
                    <td><?php echo $data['name']?></td>
                    <td><?php echo $data['age']?></td>
                    <td><?php echo $data['role']?></td>
                    <td><?php echo $data['salary']?></td>
                    <td><?php echo $data['address']?></td>
                    <td><?php echo $data['phone']?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" value="<?php echo $data['id']?>" name="deleteId">
                            <button type="button" class="btn btn-warning">Update</button>
                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
