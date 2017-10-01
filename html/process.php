<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "root";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function incrementDuration($conn){
    $sql = "SELECT " . $_GET['duration'] . " FROM Duration";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $value = $row[$_GET['duration']];
    if (empty($value))
        $value = 0;
    $value+=1;
    $sql = "UPDATE Duration SET " . $_GET['duration'] . "=$value";
    $conn->query($sql);
}

if ($_GET['duration'] == "one_month" ||
    $_GET['duration'] == "three_months" ||
    $_GET['duration'] == "three_to_six_months" ||
    $_GET['duration'] == "one_year" ||
    $_GET['duration'] ==  "five_years" ||
    $_GET['duration'] ==  "ten_years" ||
    $_GET['duration'] ==  "twenty_years" ||
    $_GET['duration'] ==  "fifty_years" ||
    $_GET['duration'] ==  "seventy_years" ||
    $_GET['duration'] ==  "seventy_plus_years")
    incrementDuration($conn);

    $sql = "SELECT * FROM Duration";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $a_values = array_values($row);
    $values= json_encode($a_values);
/*  $sum = 0;
    foreach ($a_values as $value)
        $sum += $value;
    $avg = $sum/sizeof($a_values);
    echo $sum;
    echo sizeof($a_values);
 */
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
<canvas id="myChart" width="400" height="150"></canvas>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["One month", "Three Months", "Six Months", "One Year", "Five Years", "Ten Years", "Twenty Years", 
"Fifty Years", "Seventy Years", "Seventy Plus Years"],
        datasets: [{
            label: "# of Votes",
                data: <?=$values?>,
            backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(54, 162, 235, 0.2)",
                "rgba(255, 206, 86, 0.2)",
                "rgba(75, 192, 192, 0.2)",
                "rgba(153, 102, 255, 0.2)",
                "rgba(255, 159, 64, 0.2)"
            ],
            borderColor: [
                "rgba(255,99,132,1)",
                "rgba(54, 162, 235, 1)",
                "rgba(255, 206, 86, 1)",
                "rgba(75, 192, 192, 1)",
                "rgba(153, 102, 255, 1)",
                "rgba(255, 159, 64, 1)"
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
