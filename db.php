<?php 
    define("SERVERNAME", 'localhost');
    define("USERNAME", 'root');
    define("PASSWORD", 'rolexdb');
    define("DB", "practice");
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DB);
    
    /*   
       function createDB() {
           global $conn;
           $create_db = $conn->query("CREATE DATABASE myDB");
           if ($create_db) { echo "Database created successful";} else { echo "Error creating database: " . $conn->error;}
       } 
   */

    function connect_to_db() {
        global $conn;
        if($conn->connect_error) 
        { die('Connection failed: ' . $conn->connect_error); } else { echo 'Connected'; }
    }

    function query_db() {
        global $conn;
        $q_string = "SELECT * FROM users";
        $result = $conn->query($q_string);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return $data;
    }

    function insert_data($fn, $ln, $email) {
        global $conn;
        try 
        {
            $q_stmt = $conn->prepare("INSERT INTO `users` (`firstname`, `lastname`, `email`) VALUES (?, ?, ?)");
            $q_stmt->bind_param("sss", $fn, $ln, $email);

            if($q_stmt->execute()) 
            { 
                echo "Inserted data";
                return $q_stmt; 
            }
            else 
            { 
                echo "Error inserting data: ". $q_stmt->error;
                return null;
            }

        }
        catch (Exception $e)
        { echo "Error: ". $e->getMessage(); }
    }

    connect_to_db();
    /*     
        insert_data('Rowland', 'Momoh', 'momohrowland@gmail.com');
        insert_data('Sandra', 'Eleojo', 'sandraeleojo@gmail.com'); 
    */
    $info = query_db();
    $json = json_encode($info);

    print_r($json);


    $conn->close();
?>