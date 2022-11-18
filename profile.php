<?php session_start(); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="icon" href="images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>
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

    <div id="logoutDiv"><a class="btn-auth btn-twitter large invisilink" href="login.php?count2=1"> log out </a></div>

    <?php

    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('Register.db');
        }
    }

    // Open Database 
    $db1 = new MyDB();
    if (!$db1) {
        echo $db1->lastErrorMsg();
    }

    $sql = "SELECT * from REGISTER WHERE REGISTER.ID = " . $_SESSION['USERS1'];
    $ret = $db1->query($sql);
    $row = $ret->fetchArray(SQLITE3_ASSOC);
    $email = $row['EMAIL'];
    ?>
    <img id='profilePicture' src='images/profile.png' alt='bruh'>
    <div class='profileMainDiv'>
        <div class='row'>
            <div class='col-md-3'></div>
            <div class='col-md-9' id='profileDetail'>
                <form action='profile.php' method='POST'>

                    <p>
                        <label for='fname'>First Name : </label><br>
                        <input name='fname' id='fname' type='text' class='profileData' value=<?php echo $row['FNAME']; ?> disabled="disabled"><br>
                    </p>

                    <p>
                        <label for='lname'>Last Name : </label><br>
                        <input name='lname' id='lname' type='text' class='profileData' value=<?php echo $row['LNAME']; ?> disabled><br>
                    </p>

                    <p>
                        <label for='address'>Address : </label><br>
                        <textarea name='address' id='address' type='text' class='profileData' col="30" row="10" style="height:auto;" disabled><?php echo $row['ADDRESS']; ?></textarea><br>
                    </p>

                    <p>
                        <label for='phone'>Phone : </label><br>
                        <input name='phone' id='phone' type='text' class='profileData' value=<?php echo $row['PHONE']; ?> disabled><br>
                    </p>

                    <p>
                        <label for='email'>Email : </label><br>
                        <input name='email' id='email' type='text' class='profileData' value=<?php echo $row['EMAIL']; ?> disabled><br>
                    </p>

                    <!-- <button id='editButton' class='mainButton btn btn-primary' type='button' onclick='this.form.submit();'>Edit Profile</button> -->
                </form>
                <h1>Your Points : <?php echo $row['POINTS']; ?></h1>
            </div>

        </div>
        <div class='container' id='purchaseHistory'>
            <label id='purchaseHistoryLabel' for='purchaseHistory'>Purchase History</label><br>
            <div id='historyTable' class='card'>
                <table class='table table-bordered'>
                    <tr>
                        <th>Date</th>
                        <th>Purchase ID</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>List</th>
                        <th>Points</th>
                    </tr>
                    <?php
                    class MyDB2 extends SQLite3
                    {
                        function __construct()
                        {
                            $this->open('purchases.db');
                        }
                    }

                    // Open Database 
                    $db1 = new MyDB2();
                    if (!$db1) {
                        echo $db1->lastErrorMsg();
                    }

                    $sql = "SELECT * from PURCHASES WHERE EMAIL = '$email'";
                    $ret = $db1->query($sql);
                    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['DATE'] . "</td>";
                        echo "<td>" . $row['ID'] . "</td>";
                        echo "<td>" . $row['TOTAL'] . "</td>";
                        echo "<td>" . $row['PAYMENT'] . "</td>";
                        echo "<td class='text-start'>" . $row['LIST'] . "</td>";
                        echo "<td>" . $row['POINTS'] . "</td>";
                        echo "</tr>";
                    }

                    ?>

                </table>
            </div>
        </div>

    </div>
    <br><br>
    <script type="text/javascript">
        editable = false

        function editProfile() {
            fname = document.getElementById("fname");
            lname = document.getElementById("lname");
            address = document.getElementById("address");
            phone = document.getElementById("phone");
            email = document.getElementById("email");
            editButton = document.getElementById("editButton");

            if (editable) {
                fname.disabled = true;
                lname.disabled = true;
                address.disabled = true;
                phone.disabled = true;
                email.disabled = true;

                editButton.innerText = "Edit Profile";
                editButton.classList.remove('btn-danger');
                editButton.classList.add('btn-primary');
                editable = false;
                this.form.submit();
            } else {
                fname.disabled = false;
                lname.disabled = false;
                address.disabled = false;
                phone.disabled = false;
                email.disabled = false;

                editButton.innerText = "Save Profile";
                editButton.classList.remove('btn-primary');
                editButton.classList.add('btn-danger');
                editable = true;
            }


        }
    </script>


</body>

</html>