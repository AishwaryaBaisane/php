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
    header("Location:index.php");

}

if(isset($_POST['delete']))
{
   $id= $_POST['deleteId'];
   $c1->delete($id); 

   header("Location:index.php");
}


if(isset($_POST['update']))
{
    $id= $_POST['deleteId'];
    $name= $_POST['nameId'];
    $role = $_POST['roleId'];
    $salary = $_POST['salaryId'];
    $age = $_POST['ageId'];
    $address = $_POST['adressId'];
    $phone = $_POST['phoneId'];

    $c1->update($id,$name,$role,$salary,$age,$address,$phone);

    header("Location:index.php");
    // header("Location: update.php");

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Form with Update Dialog</title>
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
             background-color: rgba(255, 255, 255, 0.8); /* Optional: Add a semi-transparent background */
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mx-auto p-2" style="width: 350px;">
        <h1>Employee Form</h1>
        <form method="POST">
        
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role" required>
           
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" id="salary" name="salary" required>
          
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required min="20" max="100" title="Age must be between 1 and 100">
            
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
               
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number=10" class="form-control" id="phone" name="phone" required pattern="\d{10}" title="Phone number must be exactly 10 digits">
              
            </div>
            <button name="button" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <hr>
    <div class="container mx-auto p-2" style="width: 850px;">
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
                        <button type="button" class="btn btn-warning" onclick="showUpdateDialog(<?php echo htmlspecialchars(json_encode($data)) ?>)">Update</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" value="<?php echo $data['id']?>" name="deleteId">
                            <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="updateId" name="deleteId">
                        <div class="mb-3">
                            <label for="updateName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="updateName" name="nameId">
                        </div>
                        <div class="mb-3">
                            <label for="updateRole" class="form-label">Role</label>
                            <input type="text" class="form-control" id="updateRole" name="roleId">
                        </div>
                        <div class="mb-3">
                            <label for="updateSalary" class="form-label">Salary</label>
                            <input type="text" class="form-control" id="updateSalary" name="salaryId">
                        </div>
                        <div class="mb-3">
                            <label for="updateAge" class="form-label">Age</label>
                            <input type="number" class="form-control" id="updateAge" name="ageId">
                        </div>
                        <div class="mb-3">
                            <label for="updateAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="updateAddress" name="adressId">
                        </div>
                        <div class="mb-3">
                            <label for="updatePhone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="updatePhone" name="phoneId">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>

        function showUpdateDialog(data) {
            document.getElementById('updateId').value = data.id;
            document.getElementById('updateName').value = data.name;
            document.getElementById('updateRole').value = data.role;
            document.getElementById('updateSalary').value = data.salary;
            document.getElementById('updateAge').value = data.age;
            document.getElementById('updateAddress').value = data.address;
            document.getElementById('updatePhone').value = data.phone;

            var updateModal = new bootstrap.Modal(document.getElementById('updateModal'));
            updateModal.show();
        }
    </script>
  
</body>

</html>
