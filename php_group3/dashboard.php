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