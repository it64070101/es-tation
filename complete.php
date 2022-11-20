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

<body style="background-size:cover;background-image: url('./images/background.jpg');">
    <?php include 'header.php'; ?>

    <?php
    // Connect to Database 


    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('purchases.db');
        }
    }

    // Open Database 
    $db = new MyDB();


    if (!$db) {
        echo $db->lastErrorMsg();
    }

    $sql = 'SELECT * FROM PURCHASES ORDER BY ID DESC LIMIT 1;';
    $ret = $db->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    exec($sql);

    $date = $row['DATE'];
    $id = $row['ID'];
    $list = $row['LIST'];
    $total = $row['TOTAL'];
    $points = $row['POINTS'];
    $payment = $row['PAYMENT'];

    $db->close();
    ?>

    <br><br><br>
    <div class="container col-md-6" style="margin: auto;" id="receiptHeaderDiv">
        <h1 class="text-white">es'tation</h1>
        <p class="text-white">Thank you for your purchase.</p>
    </div>
    <div class="container col-md-6" style="margin: auto;" id="receiptBodyDiv">
        <p class="receiptTitle">Date of order</p>
        <p class="receiptField"><?php echo $date; ?></p><br>
        <p class="receiptTitle">Your Order number</p>
        <p class="receiptField"><?php echo $id; ?></p><br>
        <p class="receiptTitle">Item(s)</p>
        <p class="receiptField"><?php echo $list; ?></p><br>
        <p class="receiptTitle">Total</p>
        <p class="receiptField"><?php echo '$' . number_format($total, 2); ?> (tax included)</p>
        <p class="receiptFieldPoints">point received : <?php echo $points; ?></p>
        <br>
        <p class="receiptTitle">Payment Method</p>
        <p class="receiptField"><?php echo $payment; ?></p><br>
        <div>
            <a href="index.php"><button class="mainButton btn btn-primary" style="padding:2% 25% 2% 25%; display:flex; margin-left:auto; margin-right:auto;">Return to homepage</button></a>
        </div>
    </div>
    <br><br><br>
</body>

</html>