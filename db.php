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

        if($result->num_rows)
        {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            return $data;
        } 
        else 
        { 
            echo "No data found"; 
            return null;
        }
    }
    function clear_db() {
        global $conn;
        $q_string = "DELETE FROM users";
        $conn->query($q_string);
    }

    function insert_data($fn, $ln, $email) {
        global $conn;
        try 
        {
            $q_stmt = $conn->prepare("INSERT INTO `users` (`firstname`, `lastname`, `email`) VALUES (?, ?, ?)");
            $q_stmt->bind_param("sss", $fn, $ln, $email);
            $result = $q_stmt->get_result();
            if($result->num_rows) 
            { $data = $result->fetch_assoc(); }

            if($q_stmt->execute()) 
            { 
                echo "Inserted data";
                return $data;
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

    function update_data($name, $id )
    {
        global $conn;
        try
        {
            $q_string = "UPDATE users SET firstname=? WHERE id=?";
            $q_stmt = $conn->prepare($q_string);
            $q_stmt->bind_param('sd', $name, $id);
            if($q_stmt->execute()) { echo "updated data";}
            else { echo "failed to update data";}

        }
        catch(Exception $e) { echo 'Error: '. $e;}

    }

    connect_to_db();

/*  

    insert_data('Rowland', 'Momoh', 'momohrowland@gmail.com');
    insert_data('Shedrack', 'Baka', 'bakashedrack@gmail.com');
    insert_data('Victor', 'Baka', 'bakavictor@gmail.com'); 
*/
    
    update_data('Shedy', 10);
    
    $info = query_db();
    $json = json_encode($info);

    echo '<br/> <br/>';

    echo($json);


    $conn->close();
?>