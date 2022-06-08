<?php

$pdo = null;
$host = "bgmrdulic9zkqgpmmug1-mysql.services.clever-cloud.com";
$user = "ua6z3noeew3r5bs4";
$password = "SUHjYmZxYZjGhuZFsFxw";
$db = "bgmrdulic9zkqgpmmug1";

function connect()
{
    try {
        $GLOBALS['pdo'] = new PDO("mysql:host=" . $GLOBALS['host'] . ";dbname=" . $GLOBALS['db'] . "", $GLOBALS['user'], $GLOBALS['password']);
        $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        print "Error!: there's an error trying to connect to the database!";
        print "\nError!: " . $e . "<br/>";
        die();
    }
}

function disconnect()
{
    $GLOBALS['pdo'] = null;
}


function Get($query){
    
    try{
        connect();
        $statement=$GLOBALS['pdo']->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        disconnect();
        return $statement;

    }catch(Exception $e){
        die("Erorr:".$e);
    }
    
}

function Post($query, $queryAutoIncrement){
    
    try{
        connect();
        $statement=$GLOBALS['pdo']->prepare($query);
        $statement->execute();
        $idAutoIncrement = Get($queryAutoIncrement)-> fetch(PDO::FETCH_ASSOC);
        $result = array_merge($idAutoIncrement,$_POST);
        $statement->closeCursor();
        disconnect();
        return $result;

    }catch(Exception $e){
        die("Erorr:".$e);
    }
    
}

function Put($query){
    
    try{
        connect();
        $statement=$GLOBALS['pdo']->prepare($query);
        $statement->execute();
        $result = array_merge($_GET,$_POST);
        $statement->closeCursor();
        disconnect();
        return $result;

    }catch(Exception $e){
        die("Erorr:".$e);
    }
    
}

function Delete($query){
    
    try{
        connect();
        $statement=$GLOBALS['pdo']->prepare($query);
        $statement->execute();
        $statement->closeCursor();
        disconnect();
        return $_GET['id'];

    }catch(Exception $e){
        die("Erorr:".$e);
    }
    
}
