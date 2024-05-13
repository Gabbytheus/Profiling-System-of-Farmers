<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $household = $_POST['household'];
    $address = $_POST['address'];

    $sql = "INSERT INTO farmers (name, age, sex, education, experience, household_members, address) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sisssis", $name, $age, $sex, $education, $experience, $household, $address);


    if ($stmt->execute()) {
        header("Location: admin-index.php");
        exit();
    } else {
        echo "Error submitting farmer: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Form not submitted";
}

$conn->close();

?>
