<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Registry</title>
    <link rel = "stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href = "/crudproj1/create.php" role="button">New Register</a>
        <br>
        <table class ="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                // $host = 'localhost:3306';
                // $username = 'root';
                // $password = 'LUis21tecmont$%'; // Replace with your actual password
                // $database = 'firstdatabase';
                
                // try {
                //     $connection = new mysqli($host, $username, $password, $database);
                //     // Rest of your code for database operations    
                // } catch (mysqli_sql_exception $e) {
                //     die("Connection failed: " . $e->getMessage());
                // }

                include 'DatabaseConnection.php';


                //read all row from database table
                $sql = "SELECT * FROM  user";
                $result = $connection->query($sql);
                
                if(!$result){
                    die("Invalid query: " . $connection->error);
                }

                //read each row
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[iduser]</td>
                        <td>$row[username]</td>
                        <td>$row[phonenumber]</td>
                        <td>$row[email]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href ='/crudproj1/edit.php?iduser=$row[iduser]'>Edit</a>
                            <a class='btn btn-danger btn-sm' href ='/crudproj1/delete.php?iduser=$row[iduser]'>Delete</a>
                        </td>
                    </tr>
                    ";
                }
                ?>

                
            </tbody>
        </table>
    </div>
    
</body>
</html>