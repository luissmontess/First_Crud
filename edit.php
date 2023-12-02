<?php
// $host = "localhost:3306";
// $serverusername = "root";
// $password = "LUis21tecmont$%";
// $database = "firstdatabase";

// $connection = new mysqli($host, $serverusername, $password, $database);

include 'DatabaseConnection.php';

$iduser = "";
$username = "";
$email = "";
$phonenumber = "";

$errorMesage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //GET METHOD: show client data
    if(!isset($_GET["iduser"])){
        header("location: /crudproj1/index.php");
        exit;
    }else{

        $iduser = $_GET["iduser"];
        $sql = "SELECT * FROM user WHERE iduser = $iduser";

        $result = $connection->query($sql);
        
        $row = $result->fetch_assoc();

        if(!$row){
            header("location: /crudproj1/index.php");
            exit;
        }else{
            $username = $row["username"];
            $phonenumber = $row["phonenumber"];
            $email = $row["email"];
        }
    }
}else{

    //POST METHOD: update the data of the client
    $iduser = $_POST["iduser"];
    $username = $_POST["username"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];

    do{
        if(empty($iduser) || empty($username) || empty($phonenumber) || empty($email)){
            $errorMessage = "All fields are required";
            break;
        }else{  

            $sql = "UPDATE user SET username = '$username', phonenumber = '$phonenumber', email = '$email' 
                    WHERE iduser = '$iduser' ";

            $result = $connection->query($sql);

            if(!$result){
                $errorMessage = "Invalid query: " . $connection->error;
                break; 
            }else{

                $successMessage = "User added correctly!";

                header("location: /crudproj1/index.php");
                exit;
            }
        }
    }while(false);


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
            <input type="hidden" name = "iduser" value="<?php echo $iduser; ?>">
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