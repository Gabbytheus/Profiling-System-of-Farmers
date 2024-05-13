<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List of Farmers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://i0.wp.com/neutrinobursts.com/wp-content/uploads/2020/12/farm-management-system-neutrino-burst.jpg?resize=960%2C540&ssl=1');
            width: 100%;
            height: 100%;
        }


        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: white;
            padding-top: 20px;
        }


        .top-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .top-box img {
            max-width: 100%;
            height: auto;
        }

        .tab {
            padding: 10px;
            color: black;
            cursor: pointer;
        }

        .tab:hover {
            background-color: green;
        }

        .tab:nth-child(1):hover {
            background-color: red;

        }

        .tab:nth-child(2):hover {
            background-color: blue;

        }

        .tab:nth-child(3):hover {
            background-color: yellow;

        }


        .main-content {
            margin-left: 200px;

            padding: 20px;
        }


        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button {
            padding: 10px 15px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            color: white;
            margin: 10px 0;
        }

        .button-logout {
            background-color: #333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            background-color: white;
            color: black;
            padding: 15px;
            font-size: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .blur {
            filter: blur(8px);
        }

        #tab2 {
            background-color: white;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <div class="top-box">
            <img src="https://khetibuddy.com/wp-content/uploads/2022/03/Farm-Management.png" alt="Farm Management Image">
        </div>


        <div class="tab" onclick="openTab('tab1')">Dashboard</div>
        <div class="tab" onclick="openModal()">Add Farmers</div>
        <div class="tab" onclick="openTab('tab2')">Records</div>
        <button class="button button-logout" onclick="logout()">Logout</button>
    </div>


    <div class="main-content">





        <div id="tab1" class="tab-content" style="display: none;">


            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Summary of Farmers</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f8f8f8;
                        padding: 20px;
                    }

                    h1,
                    h2,
                    p {
                        color: #333;
                    }

                    .summary-section {
                        margin-bottom: 20px;
                        border: 1px solid #ddd;
                        padding: 10px;
                        background-color: #fff;
                        display: grid;
                        grid-template-columns: repeat(2, 1fr);
                        grid-column-gap: 20px;
                    }

                    .summary-item {
                        margin-bottom: 10px;
                    }

                    .address-section {
                        margin-bottom: 30px;
                    }

                    .address-title {
                        font-weight: bold;
                        margin-bottom: 5px;
                    }

                    .farmers-table {
                        border-collapse: collapse;
                        width: 100%;
                    }

                    .farmers-table th,
                    .farmers-table td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }

                    .farmers-table th {
                        background-color: #f2f2f2;
                    }

                    .address-info {
                        margin-bottom: 20px;
                        border: 1px solid #ddd;
                        padding: 10px;
                        background-color: #fff;
                    }
                </style>
            </head>

            <body>
                <h1>Summary of Farmers</h1>

                <div class="summary-section">
                    <?php
                    include 'db_connect.php';


                    $sqlTotalFarmers = "SELECT COUNT(*) AS totalFarmers, GROUP_CONCAT(name) AS allNames FROM farmers";
                    $resultTotalFarmers = $conn->query($sqlTotalFarmers);
                    $rowTotalFarmers = $resultTotalFarmers->fetch_assoc();
                    $totalFarmers = $rowTotalFarmers['totalFarmers'];
                    $allNames = $rowTotalFarmers['allNames'];

                    echo "<div class='summary-item'><p>Total number of farmers:</p><p>$totalFarmers</p></div>";
                    echo "<div class='summary-item'><p>All farmer names:</p><p>$allNames</p></div>";


                    $sqlMaleFarmers = "SELECT COUNT(*) AS maleFarmers, GROUP_CONCAT(name) AS maleNames FROM farmers WHERE sex = 'male'";
                    $resultMaleFarmers = $conn->query($sqlMaleFarmers);
                    $rowMaleFarmers = $resultMaleFarmers->fetch_assoc();
                    $maleFarmers = $rowMaleFarmers['maleFarmers'];
                    $maleNames = $rowMaleFarmers['maleNames'];


                    $sqlFemaleFarmers = "SELECT COUNT(*) AS femaleFarmers, GROUP_CONCAT(name) AS femaleNames FROM farmers WHERE sex = 'female'";
                    $resultFemaleFarmers = $conn->query($sqlFemaleFarmers);
                    $rowFemaleFarmers = $resultFemaleFarmers->fetch_assoc();
                    $femaleFarmers = $rowFemaleFarmers['femaleFarmers'];
                    $femaleNames = $rowFemaleFarmers['femaleNames'];

                    echo "<div class='summary-item'><p>Number of male farmers:</p><p>$maleFarmers</p></div>";
                    echo "<div class='summary-item'><p>Male farmer names:</p><p>$maleNames</p></div>";
                    echo "<div class='summary-item'><p>Number of female farmers:</p><p>$femaleFarmers</p></div>";
                    echo "<div class='summary-item'><p>Female farmer names:</p><p>$femaleNames</p></div>";

                    $conn->close();
                    ?>
                </div>

                <div class="address-section">
                    <h2>Farmers with the Same Address:</h2>
                    <?php
                    include 'db_connect.php';

                    $sqlSameAddressFarmers = "SELECT address, 
                                  GROUP_CONCAT(CASE WHEN sex='male' THEN name END) AS maleNames,
                                  GROUP_CONCAT(CASE WHEN sex='female' THEN name END) AS femaleNames
                                  FROM farmers GROUP BY address";
                    $resultSameAddressFarmers = $conn->query($sqlSameAddressFarmers);

                    if ($resultSameAddressFarmers->num_rows > 0) {
                        while ($row = $resultSameAddressFarmers->fetch_assoc()) {
                            echo "<div class='address-info'>";
                            echo "<p class='address-title'>Address: " . $row['address'] . "</p>";
                            echo "<table class='farmers-table'>";
                            echo "<tr><th>Male Farmers</th><th>Female Farmers</th></tr>";
                            echo "<tr><td>" . ($row['maleNames'] ?? '') . "</td><td>" . ($row['femaleNames'] ?? '') . "</td></tr>";
                            echo "</table>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No farmers share the same address.</p>";
                    }

                    $conn->close();
                    ?>
                </div>
            </body>

            </html>



        </div>








        <div id="tab2" class="tab-content" style="display: none;">
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>List of Farmers</title>
            </head>

            <body>
                <h1>Farmers</h1>
                <button class="button button-add" onclick="openModal()">Add Farmers</button>

                <table>
                    <?php
                    include 'db_connect.php';
                    $sql = "SELECT * FROM farmers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<table>
                           <tr>
                               <th>Name</th>
                               <th>Age</th>
                               <th>Sex</th>
                               <th>Education</th>
                               <th>Experience</th>
                               <th>Household Members</th>
                               <th>Address</th>
                               <th>Action</th>
                           </tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                       <td>" . $row["name"] . "</td>
                                       <td>" . getAgeRange($row["age"]) . "</td>
                                       <td>" . $row["sex"] . "</td>
                                       <td>" . getEducationLevel($row["education"]) . "</td>
                                       <td>" . getExperience($row["experience"]) . "</td>
                                       <td>" . $row['household_members'] . "</td>
                                       <td>" . $row['address'] . "</td>";
                            echo "<td>
                                           <a href='edit_farmer.php?id=" . $row["id"] . "'>Edit</a> |
                                           <a href='delete_farmer.php?id=" . $row["id"] . "' onclick='return confirmDelete();'>Remove</a>
                                       </td>
                                   </tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "0 results";
                    }

                    function getAgeRange($age)
                    {
                        switch ($age) {
                            case "Less_than_39":
                                return "Less than 39";
                            case "30-39":
                                return "30 - 39";
                            case "40-49":
                                return "40 - 49";
                            case "Above_50":
                                return "Above 50";
                            default:
                                return "Unknown";
                        }
                    }

                    function getEducationLevel($education)
                    {
                        switch ($education) {
                            case "no_edu":
                                return "No formal education";
                            case "not_prim":
                                return "Not finished primary school";
                            case "comp_prim":
                                return "Completed primary school";
                            case "comp_high":
                                return "Completed high school";
                            case "higher":
                                return "Higher than high school";
                            default:
                                return "Unknown";
                        }
                    }

                    function getExperience($experience)
                    {
                        switch ($experience) {
                            case "lt1":
                                return "Less than one year";
                            case "1-3":
                                return "1 to 3 years";
                            case "3-5":
                                return "3 to 5 years";
                            case "gt5":
                                return "Above 5 years";
                            default:
                                return "Unknown";
                        }
                    }

                    $conn->close();
                    ?>
                </table>
            </body>

            </html>

        </div>
</body>
</div>


</div>











<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Add Farmer</h2>
        <form action="submit_farmer.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" min="0" max="150" required>

            <label for="sex">Sex:</label>
            <input type="radio" id="male" name="sex" value="male" required>
            <label for="male">Male</label>
            <input type="radio" id="female" name="sex" value="female" required>
            <label for="female">Female</label><br><br>

            <label for="education">Education:</label>
            <select id="education" name="education">
                <option value="no_edu">No formal education</option>
                <option value="not_prim">Not finished primary school</option>
                <option value="comp_high">Completed high school</option>
                <option value="higher">Higher than high school</option>
            </select><br><br>
            <label for="experience">Farming Experience (years):</label>
            <select id="experience" name="experience">
                <option value="lt1">Less than one year</option>
                <option value="1-3">1 to 3 years</option>
                <option value="3-5">3 to 5 years</option>
                <option value="gt5">Above 5 years</option>
            </select><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br><br>

            <label for="household">Household Members:</label>
            <select id="household" name="household">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6 or more</option>
            </select><br><br>
            <input type="submit" value="Add Farmer">
        </form>
    </div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var mainContent = document.querySelector(".main-content");

    function openModal() {
        modal.style.display = "block";
        mainContent.classList.add("blur");
    }

    function closeModal() {
        modal.style.display = "none";
        mainContent.classList.remove("blur");
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }

    function logout() {
        window.location.href = "logout.php";
    }

    function openTab(tabName) {
        var i, tabContent;
        tabContent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabContent.length; i++) {
            tabContent[i].style.display = "none";
        }
        document.getElementById(tabName).style.display = "block";
    }
</script>
</body>

</html>