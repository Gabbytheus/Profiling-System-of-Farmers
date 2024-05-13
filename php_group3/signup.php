<?php
$error = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    
    if (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters long';
    } else {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format';
        } else {
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            
            $db = new PDO('mysql:host=localhost;dbname=dbusers', 'root', '');

            
            $stmt = $db->prepare('INSERT INTO users (username, password, email, first_name, last_name, middle_name, birthday, age, gender) VALUES (:username, :password, :email, :first_name, :last_name, :middle_name, :birthday, :age, :gender)');
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password); 
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            if ($middle_name == '') {
                $stmt->bindValue(':middle_name', null); 
            } else {
                $stmt->bindParam(':middle_name', $middle_name);
            }
            $stmt->bindParam(':middle_name', $middle_name);
            $stmt->bindParam(':birthday', $birthday);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':gender', $gender);
            $stmt->execute();

            
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/skeleton/2.0.4/skeleton.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: left;
        }

        .input-group {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            flex-direction: column;
            gap: 10px;
        }

        .input-group label {
            font-weight: bold;
        }

        .input-group input,
        .input-group select {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            width: 100%;
            
        }

        .input-group>label {
            font-weight: bold;
            width: 33%;
            margin-bottom: 10px;
        }

        input[type="submit"],
        .back-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            
        }

        input[type="submit"]:hover,
        .back-button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        .success {
            color: green;
            margin-top: 5px;
        }

        .back-button {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            
            margin-top: 10px;
            
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
    </style>
</head>

<body>
    <div class="container" id="signUpForm">
        <h1>Sign Up</h1>
        <?php if ($error !== '') : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="signup.php">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>

                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" required>

                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" required>

                <label for="middle_name">Middle Name:</label>
                <input type="text" name="middle_name">
            </div>

            <div class="input-group">
                <label for="birthday">Birthday:</label>
                <input type="date" name="birthday" required>
                <label for="age">Age:</label>
                <input type="number" name="age" required>

                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <input type="button" value="Back" onclick="goBack()" class="back-button"> 

            <input type="submit" value="Sign Up" class="submit-button">
        </form>
    </div>

    <script>
        function goBack() {
            
            window.location.href = 'login.php';
        }
    </script>
    -
</body>
-

</html>
-