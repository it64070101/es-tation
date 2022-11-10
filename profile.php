<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>es'tation: Books, Stationeries, and Board games</title>
    <link rel="icon" href="images/icon.png">
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
    <?php include 'header.php';?>


    <?php
        class MyDB extends SQLite3 {
            function __construct() {
               $this->open('Register.db');
            }
         }
     
         // Open Database 
         $db1 = new MyDB();
         if(!$db1) {
            echo $db1->lastErrorMsg();
         } 

         $sql = "SELECT * from REGISTER WHERE REGISTER.ID = ".$_SESSION['USERS1'];
         $ret = $db1->query($sql);
         $row = $ret->fetchArray(SQLITE3_ASSOC);
        echo "<img id='profilePicture' src='https://cdn.discordapp.com/attachments/847393439704285204/1016577438513373236/funny_whoa_cat.jpg' alt='bruh'>";
        echo "
        <div class='profileMainDiv'>
            <div class='row'>
                <div class='col-md-3'></div>
                <div class='col-md-9' id='profileDetail'>
                    <label for='fname'>FirstName : </label><br>
                    <div class='profileData'>". $row['FNAME'] ."</div><br>
                    <label for='lname'>Last Name : </label><br>
                    <div class='profileData'>". $row['LNAME'] ."</div><br>
                    <label for='address'>Address : </label><br>
                    <div class='profileData'>". $row['ADDRESS'] ."</div><br>
                    <label for='phone'>Phone : </label><br>
                    <div class='profileData'>". $row['PHONE'] ."</div><br>
                    <label for='email'>Email : </label><br>
                    <div class='profileData'>". $row['EMAIL'] ."</div><br>
                </div>
            </div>
            <div class='container' id='purchaseHistory'>
                <label id='purchaseHistoryLabel' for='purchaseHistory'>Purchase History</label><br>
                <div id='historyTable' class='card'>
                    <table class='table table-bordered'>
                        <tr>
                            <th>Name</th>
                            <th>Qtt.</th>
                        </tr>
                        <tr>
                            <td>Used Bricks</td>
                            <td>7 millions</td>
                        </tr>
                        <tr>
                            <td>7 pints of blood</td>
                            <td>85 Swiss Franc</td>
                        </tr>
                        <tr>
                            <td>7 pints of blood</td>
                            <td>85 Swiss Franc</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <br><br>";
        // $_SESSION["count1"] = "2";
    ?>
    <p><a class="btn-auth btn-twitter large" href="login.php?count2=1"> log out </a></p>
    <!-- <button type='submit' class='btn btn-primary' onclick='location.href="login.php"; '>Log out</button> -->
    
</body>

</html>