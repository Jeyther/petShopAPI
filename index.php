<?php

    include 'db/db.php';

    header('Access-Control-Allow-Origin: *');

    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            $query="SELECT * FROM toys WHERE id=".$_GET['id'];
            $result = Get($query);
            echo json_encode($result -> fetch(PDO::FETCH_ASSOC));
        }else{
            $query="select * from toys";
            $result = Get($query);
            echo json_encode($result->fetchAll());
        }

        header("HTTP/1.1 200 OK");
        exit();
    }

    if($_POST['METHOD']=='POST'){

        unset($_POST['METHOD']);
        $name =  $_POST['name'];
        $price = $_POST['price'];
        $query= "INSERT INTO toys (name, price) VALUES ('$name', '$price')";
        $queryAutoincrement= "SELECT MAX(id) as id FROM toys";
        $result = Post($query, $queryAutoincrement);
        echo json_encode($result);
        header("HTTP/1.1 200 OK");
        exit();
        
    }

    if($_POST['METHOD']=='PUT'){

        unset($_POST['METHOD']);
        $id= $_GET['id'];
        $name =  $_POST['name'];
        $price = $_POST['price'];
        $query= "UPDATE toys SET name = '$name', price= '$price' WHERE id = '$id'";
        $result = Put($query);
        echo json_encode($result);
        header("HTTP/1.1 200 OK");
        exit();
        
    }

    if($_POST['METHOD']=='DELETE'){
        unset($_POST['METHOD']);
        $id= $_GET['id'];
        $query= "DELETE FROM toys WHERE id = '$id'";
        $result = Delete($query);
        echo json_encode($result);
        header("HTTP/1.1 200 OK");
        exit();
        
    }
