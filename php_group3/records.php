<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Farmers</title>
</head>

<body>
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
