<?php 
    define("SERVERNAME", 'localhost');
    define("USERNAME", 'root');
    define("PASSWORD", 'rolexdb');
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD);
    

    function connect_to_db() {
        global $conn;
        if($conn->connect_error) 
        { die('Connection failed: ' . $conn->connect_error); } else
        { echo 'Connected'; }
    }

    function createDB() {
        global $conn;
        $create_db = $conn->query("CREATE DATABASE myDB");
        if ($create_db) { echo "Database created successful";} else { echo "Error creating database: " . $conn->error;}
    }
        

?>