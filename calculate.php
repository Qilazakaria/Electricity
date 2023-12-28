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
    function calculateElectricityRate($voltage, $current, $rate) {
        // Calculate power
        $power = ($voltage * $current) / 1000;

        // Calculate energy
        $energy = $power * 1; // Assuming 1 hour

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

        // Calculate electricity rate
        $result = calculateElectricityRate($voltage, $current, $rate);

        // Display the result
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>Result:</h4>";
        echo "<p class='card-text'>Power: {$result['power']} kW</p>";
        echo "<p class='card-text'>Energy: {$result['energy']} kWh</p>";
        echo "<p class='card-text'>Total Charge: RM {$result['totalCharge']}</p>";
        echo "</div>";
        echo "</div>";

        // Back button
        echo "<a href=\"index.html\" class=\"btn btn-secondary mt-3\">Back</a>";
    }
    ?>

  </div>

</body>
</html>
