<?php

include 'db_connect.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM farmers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        
        header("Location: admin-index.php"); 
        exit(); 
    } else {
        echo "Error removing farmer: " . $stmt->error;
    }

    
    $stmt->close();
} else {
    echo "ID parameter is missing.";
}


$conn->close();
?>
