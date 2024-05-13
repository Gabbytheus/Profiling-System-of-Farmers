<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $household = $_POST['household'];
    $address = $_POST['address'] != '' ? $_POST['address'] : 0; 

    $sql = "UPDATE farmers SET name=?, age=?, sex=?, education=?, experience=?, household_members=?, address=? WHERE id=?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssii", $name, $age, $sex, $education, $experience, $household, $address, $id); 

    if ($stmt->execute()) {
        header("Location: admin-index.php");
        exit();
    } else {
        echo "Error updating farmer: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Form not submitted";
}

$conn->close();
?>

