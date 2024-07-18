<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find Weekends</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .container {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .weekends {
            margin-top: 20px;
        }
        .weekends p {
            margin: 5px 0;
            padding: 5px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Find Saturdays and Sundays in a Month</h2>
        <form method="post" action="">
            <label for="month">Month:</label>
            <select id="month" name="month" required>
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    $monthName = date('F', mktime(0, 0, 0, $i, 10));
                    echo "<option value=\"$i\">$monthName</option>";
                }
                ?>
            </select><br><br>
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="1900" max="2100" required><br><br>
            <input type="submit" value="Find Weekends">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $month = intval($_POST['month']);
            $year = intval($_POST['year']);
            echo "<div class='weekends'>";
            echo "<h3>Saturdays and Sundays in $month/$year:</h3>";
            findWeekends($month, $year);
            echo "</div>";
        }

        function findWeekends($month, $year) {
            $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $saturdaysCount = 0;
            $sundaysCount = 0;
            for ($day = 1; $day <= $numDays; $day++) {
                $date = strtotime("$year-$month-$day");
                if (date('N', $date) == 6) {
                    $saturdaysCount++;
                } elseif (date('N', $date) == 7) {
                    $sundaysCount++;
                }
            }
            echo "<p>Saturdays: $saturdaysCount</p>";
            echo "<p>Sundays: $sundaysCount</p>";
        }
        ?>


<?php
function countDaysOfWeekBetweenDates($date1, $date2) {
    $startDate = new DateTime($date1);
    $endDate = new DateTime($date2);
    $endDate->modify('+1 day'); // Include end date in the range

    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($startDate, $interval, $endDate);

    // Initialize an array to hold counts for each day of the week
    $daysOfWeek = [
        'Sunday' => 0,
        'Monday' => 0,
        'Tuesday' => 0,
        'Wednesday' => 0,
        'Thursday' => 0,
        'Friday' => 0,
        'Saturday' => 0,
    ];

    // Iterate through each date in the range and count the days of the week
    foreach ($dateRange as $date) {
        $dayOfWeek = $date->format('l'); // Get the day of the week as a full name
        $daysOfWeek[$dayOfWeek]++;
    }

    return $daysOfWeek;
}

$date1 = '2023-06-01';
$date2 = '2023-06-04';

$daysCount = countDaysOfWeekBetweenDates($date1, $date2);

echo "Days count between $date1 and $date2:\n";
foreach ($daysCount as $day => $count) {
    echo "$day: $count\n";
}
?>

    </div>
</body>
</html>
