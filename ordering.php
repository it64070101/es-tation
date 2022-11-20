<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>es'tation: Books, Stationeries, and Board games</title>
    <link rel="icon" href="images/icon.png">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css” />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body>
    <?php include 'header.php'; ?>

    <?php
    // Connect to Database 

    class MyDB3 extends SQLite3
    {
        function __construct()
        {
            $this->open('purchases.db');
        }
    }

    // Open Database 
    $db1 = new MyDB3();
    if (!$db1) {
        echo $db1->lastErrorMsg();
    }

    // Query process 
    $date = new DateTime("now", new DateTimeZone('Antarctica/Davis'));
    $email = $_POST['email'];
    $date = $date->format('y/m/d (H:i:s)');
    $payment = $_POST['payment'];
    $total = floatval($_POST['total']);
    $points = intval($total / 10);
    $list = $_POST['list'];
    $id = intval(date("YmdHis)") . rand(10, 99));


    $sql1 = <<<EOF
    INSERT INTO PURCHASES (ID, EMAIL, DATE, TOTAL, PAYMENT, LIST, POINTS)
        VALUES ($id, '$email', '$date', '$total', '$payment', '$list', '$points');
    EOF;
    $db1->exec($sql1);

    class MyDB4 extends SQLite3
    {
        function __construct()
        {
            $this->open('register.db');
        }
    }

    unset($_SESSION['cart']);

    // Open Database 
    $db1 = new MyDB4();
    if (!$db1) {
        echo $db1->lastErrorMsg();
    }

    $sql = "UPDATE REGISTER SET POINTS = POINTS + $points WHERE EMAIL =  '$email' ;";

    $db1->exec($sql);

    $db1->close();
    echo "<script> location.href='complete.php'; </script>";
    ?>

</body>

</html>