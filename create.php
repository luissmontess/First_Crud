<?php

// $host = "localhost:3306";
// $serverusername = "root";
// $password = "LUis21tecmont$%";
// $database = "firstdatabase";

// $connection = new mysqli($host, $serverusername, $password, $database);

include 'DatabaseConnection.php';


$username = "";
$phonenumber = "";
$email = "";

$errorMessage = "";

$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST["username"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];

    
        if(empty($username) || empty($phonenumber) || empty($email) ){
            $errorMessage = "All the fields are required";
        }else{
            try{
                $sql = "INSERT INTO user (username, phonenumber, email)" . "VALUES('$username', '$phonenumber', '$email')";
                $result =  $connection->query($sql);
                if($result === false){
                    if($connection->errno == 1062){
                        $errorMessage = "Duplicate entry: The data you are trying to insert, already exists.";
                    }else{
                        $errorMessage = "Invalid query: " . $connection->error;
                    }
                }else{
                    $username = "";
                    $phonenumber = "";
                    $email = "";
                    $successMessage = "Register added correctly!";
                    header("location: /crudproj1/index.php");
                    exit;
                }
            }catch(mysqli_sql_exception $e){
                $errorMessage = "Database error: " . $e->getMessage();
            }
        }  
}    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registry</title>
    <link rel = "stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
   <div class = "container my-5">

        <h2>New Register</h2>

        <?php
        if(!empty($errorMessage)){
            echo"
            <div class = 'alert alert-warning alert-dismissible fade show' role = 'alert'>
                <strong>$errorMessage</strong>
                <button type = 'button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";        
        }
        ?>


        <form method = "post">
            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Username</label>
                <div class = "col-sm-6>">
                    <input type = "text" class = "form-control" name = "username" value = "<?php echo $username; ?>"> 
                </div>
            </div>

            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Phone Number</label>
                <div class = "col-sm-6>">
                    <input type = "text" class = "form-control" name = "phonenumber" value = "<?php echo $phonenumber;?>"> 
                </div>
            </div>

            <div class = "row mb-3">
                <label class = "col-sm-3 col-form-label">Email</label>
                <div class = "col-sm-6>">
                    <input type = "text" class = "form-control" name = "email" value = "<?php echo $email;?>"> 
                </div>
            </div>

            <?php 
            if(!empty($successMessage)){
                echo "
                <div class = 'row mb-3'>
                    <div class = 'offset-sm-3 col-sm-6'>
                    <div class = 'alert alert-success alert-dismissible fade show' role = 'alert'>
                    <strong>$successMessage</strong>
                    <button type = 'button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                </div>
                    </div>
                </div>
                ";
            }
            ?>
            
            <div class = "row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class = "btn btn-outline-primary" href="/crudproj1/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
        
   </div> 
</body>
</html>