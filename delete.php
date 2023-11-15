<?php
    if(isset($_GET["iduser"])){
        $iduser = $_GET["iduser"];

        $host = "localhost:3306";
        $serverusername = "root";
        $password = "LUis21tecmont$%";
        $database = "firstdatabase";

        $connection = new mysqli($host, $serverusername, $password, $database);

        $sql = "DELETE FROM user WHERE iduser = $iduser";
        $connection->query($sql);
    }

    header("location: /crudproj1/index.php");
    exit;
?>