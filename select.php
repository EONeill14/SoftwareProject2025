<?php
    print "Connecting...";
    echo "<br>";
    $con = mysqli_connect("localhost", "root", "", "teetime");
    if (!$con) {
        die('Could not connect: ' . mysqli_error());
    }

    $result = mysqli_query($con, "SELECT * FROM Contact"); // Using uppercase SELECT for consistency
    while ($row = mysqli_fetch_array($result)) {
        echo $row['name'] . " - " . $row['email'] . " - " . $row['age'];
        echo "<br>";
    }
    mysqli_close($con);
?>