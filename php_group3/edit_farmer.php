<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Farmer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input,
        select {
            margin-bottom: 10px;
            width: calc(100% - 12px);
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            padding: 10px 15px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: blue;
            cursor: pointer;
        }

        .button:hover {
            background-color: darkblue;
        }

        .back-button {
            display: inline-block;
            padding: 10px 15px;
            margin-bottom: 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            color: white;
            background-color: #999;
        }

        .back-button:hover {
            background-color: #777;
        }
    </style>
</head>

<body>

    <h1>Edit Farmer</h1>

    <?php
    include 'db_connect.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT * FROM farmers WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $age = $row['age'];
            $sex = $row['sex'];
            $education = $row['education'];
            $experience = $row['experience'];
            $address = $row['address'];
            $household = $row['household_members'];

            echo "<form action='update_farmer.php' method='post'>
                    <input type='hidden' name='id' value='$id'>
                    <label for='name'>Name:</label>
                    <input type='text' id='name' name='name' value='$name' required><br>
                    <label for='age'>Age:</label>
                    <select id='age' name='age'>
                        <option value='Less_than_39' " . ($age == 'Less_than_39' ? 'selected' : '') . ">Less than 39</option>
                        <option value='30-39' " . ($age == '30-39' ? 'selected' : '') . ">30 - 39</option>
                        <option value='40-49' " . ($age == '40-49' ? 'selected' : '') . ">40 - 49</option>
                        <option value='Above_50' " . ($age == 'Above_50' ? 'selected' : '') . ">Above 50</option>
                    </select><br>
                    <label for='sex'>Sex:</label>
                    <input type='radio' id='male' name='sex' value='male' " . ($sex == 'male' ? 'checked' : '') . " required>
                    <label for='male'>Male</label>
                    <input type='radio' id='female' name='sex' value='female' " . ($sex == 'female' ? 'checked' : '') . " required>
                    <label for='female'>Female</label><br>
                    <label for='education'>Education:</label>
                    <select id='education' name='education'>
                        <option value='no_edu' " . ($education == 'no_edu' ? 'selected' : '') . ">No formal education</option>
                        <option value='not_prim' " . ($education == 'not_prim' ? 'selected' : '') . ">Not finished primary school</option>
                        <option value='comp_prim' " . ($education == 'comp_prim' ? 'selected' : '') . ">Completed primary school</option>
                        <option value='comp_high' " . ($education == 'comp_high' ? 'selected' : '') . ">Completed high school</option>
                        <option value='higher' " . ($education == 'higher' ? 'selected' : '') . ">Higher than high school</option>
                    </select><br>
                    <label for='experience'>Farming Experience (years):</label>
                    <select id='experience' name='experience'>
                        <option value='lt1' " . ($experience == 'lt1' ? 'selected' : '') . ">Less than one year</option>
                        <option value='1-3' " . ($experience == '1-3' ? 'selected' : '') . ">1 to 3 years</option>
                        <option value='3-5' " . ($experience == '3-5' ? 'selected' : '') . ">3 to 5 years</option>
                        <option value='gt5' " . ($experience == 'gt5' ? 'selected' : '') . ">Above 5 years</option>
                    </select><br>
                    <label for='address'>Address:</label>
                    <input type='text' id='address' name='address' value='$address' required><br>
                    <label for='household'>Household Members:</label>
                    <select id='household' name='household'>
                        <option value='1' " . ($household == '1' ? 'selected' : '') . ">1</option>
                        <option value='2' " . ($household == '2' ? 'selected' : '') . ">2</option>
                        <option value='3' " . ($household == '3' ? 'selected' : '') . ">3</option>
                        <option value='4' " . ($household == '4' ? 'selected' : '') . ">4</option>
                        <option value='5' " . ($household == '5' ? 'selected' : '') . ">5</option>
                        <option value='6' " . ($household == '6' ? 'selected' : '') . ">6 or more</option>
                    </select><br>
                    <input type='submit' value='Save Changes' class='button'>   
                </form>";

            echo "<a href='admin-index.php' class='back-button'>Back</a>";
        } else {
            echo "No farmer found with that ID.";
        }

        $stmt->close();
    } else {
        echo "ID parameter is missing.";
    }
    ?>

</body>

</html>

