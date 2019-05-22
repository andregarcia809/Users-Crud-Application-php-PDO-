<?php
    require 'database.php';

    // delete user by id
    if (isset($_GET['id'])) {
        $id =$_GET['id'];
        $sql = 'DELETE FROM users WHERE id = :id';
        $stmt = $conn->prepare($sql);
       if ( $stmt->execute(['id' => $id]))  {
            header('location: /phpsandbox/index.php');
        }
    }  else {
        exit('Something went wrong.');
    }
?>