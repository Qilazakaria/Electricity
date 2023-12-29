<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <title>Electricity Calculator Result</title>
</head>
<body>

  <div class="container mt-5">
    <h1 class="mb-4">Electricity Calculator Result</h1>

    <?php
    function calculateElectricityRate($voltage, $current, $rate, $hour) {
        // Calculate power Wh
        $power = ($voltage * $current);

        // Calculate energy for the given hour kWh
        $energy = ($power / 1000) * $hour; 

        // Calculate total charge 
        $totalCharge = $energy * ($rate / 100);

        return [
            'power' => $power,
            'energy' => $energy,
            'totalCharge' => $totalCharge
        ];
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve input
        $voltage = $_POST['voltage'];
        $current = $_POST['current'];
        $rate = $_POST['rate'];

        // Display  power in kw
        $totalPower = ($voltage * $current)/1000;
        $totalRate = $rate/100;

        echo "<p>Power: {$totalPower} kW</p>";
        echo "<p>Rate: {$totalRate} RM</p>";

        // Display results in a table
        echo "<table class='table'>";
        echo "<thead>
                <tr>
                <th><strong>#</strong></th>
                <th>Hour</th>
                <th>Energy (kWh)</th>
                <th>TOTAL (RM)</th>
                </tr>
              </thead>";
        echo "<tbody>";

        $number = 1; 

        for ($hour = 1; $hour <= 24; $hour++) {
            // Calculate results for each hour
            $hourlyResult = calculateElectricityRate($voltage, $current, $rate, $hour);

            // Display results in table rows
            echo "<tr>";
            echo "<td><strong>{$number}</strong></td>";
            echo "<td>{$hour}</td>";
            echo "<td>{$hourlyResult['energy']}</td>";
            // Format two decimal places
            $formattedTotal = number_format($hourlyResult['totalCharge'], 2);
            echo "<td>{$formattedTotal}</td>";
            echo "</tr>";

            $number++;
        }

        echo "</tbody>";
        echo "</table>";

        echo "<a href=\"index.html\" class=\"btn btn-secondary mt-3\">Back</a>";
    }
    ?>

  </div>

</body>
</html>
