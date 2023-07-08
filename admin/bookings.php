<?php
function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'admin', 'admin12345', 'bookingsystem');
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT * FROM bookings_record WHERE MONTH(DATE) = ? AND YEAR(DATE) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[] = $row['DATE'];
            }
        }
        $stmt->close();
    } else {
        die("Query execution failed: " . $mysqli->error);
    }

    // Array containing days of the week    
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

    // First day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // Get the number of days in a month
    $numberDays = date('t', $firstDayOfMonth);

    // Getting the name of the month
    $monthName = date('F', $firstDayOfMonth);

    // Index value 0-6 of the first day of this month
    $daysOfWeekIndex = date('w', $firstDayOfMonth);

    // Current date
    $dateToday = date('Y-m-d');

    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-xs btn-success' href='?month=".($month-1)."&year=".$year."'>Previous Month</a> ";
    $calendar .= " <a class='btn btn-xs btn-danger' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=".($month+1)."&year=".$year."'>Next Month</a></center><br>";

    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    }

    $currentDay = 1;
    $calendar .= "</tr><tr>";

    if ($daysOfWeekIndex > 0) {
        for ($k = 0; $k < $daysOfWeekIndex; $k++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    while ($currentDay <= $numberDays) {
        if ($daysOfWeekIndex == 7) {
            $daysOfWeekIndex = 0;
            $calendar .= "</tr><tr>";
        }

        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
          
        $dayname = strtolower(date('l', strtotime($date)));
        $eventNum = 0;
        $today = $date == date('Y-m-d') ? "today" : "";

        if ($date < date('Y-m-d')) {
            $calendar .= "<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs' disabled>N/A</button></td>";
        } elseif (in_array($date, $bookings)) {
            $calendar .= "<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'> <span class='glyphicon glyphicon-lock'></span> Already Booked</button></td>";
        } else {
            $calendar .= "<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=" . $date . "' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Book Now</a></td>";
        }

        $currentDay++;
        $daysOfWeekIndex++;
    }

    if ($daysOfWeekIndex != 7) {
        $remainingDays = 7 - $daysOfWeekIndex;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    return $calendar;
}
?> 

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="booking.css">
     <style>
       @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
        Label the data
        */
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:#eee;
        }

    </style>
</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger" style="background:#2ecc71;border:none;color:#fff">
                <h1>Booking System</h1>
            </div>

            <?php
            $dateComponents = getdate();
            $month = $dateComponents['mon'];
            $year = $dateComponents['year'];

            if (isset($_GET['month']) && isset($_GET['year'])) {
                $month = (int)$_GET['month'];
                $year = (int)$_GET['year'];
            } else {
                $month = $dateComponents['mon'];
                $year = $dateComponents['year'];
            }

            $monthValue = date('m', strtotime($month));
            echo build_calendar($month, $year);
            ?>

        </div>
    </div>
</div>

</body>
</html>

</head>

