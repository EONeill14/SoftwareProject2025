<html>
    <head>
        <title>php variables</title>
    </head>
    <body>

    </body>
    <?php
    $s_Address1 = "123 fakestreet";
    $s_Address2 = "BakerStreet";
    echo "Address:" . $s_Address1 . " " . $s_Address2;
    echo ("<br>");

    $n_Age = 30;
    echo "your age is " . $n_Age;
    echo ("<br>");
    $d_today = date("d/m/y");
    echo "The date today is " . $d_today;
    echo("<br>");

    $b_Married = false;
    if ($b_Married == true) {
        echo "Your married";
    } else {
        echo "You're unmarried";
    }
    ?>



</html>

