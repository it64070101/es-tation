<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" href="images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        <?php include "script.js" ?>
    </script>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    
</head>

<body style="height: 100%;background-size:cover;background-image: url('./images/background.jpg');">
    <?php include 'header.php'; ?>
    <?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('Register.db');
        }
    }
    ?>

    <main style="height: 100%;">
        <!-- <div> -->
        <div id="mainRegDiv">
            <p style="font-size: 40px; margin-top: 15px; text-align: center;">Register</p>
            <form method="post" id="loginForm" class="form-group mt-5 mx-5 p-3">
                <div class="row">
                    <div class="col-5">
                        <label for="Fname" id="FnameLabel">Firstname</label><br>
                        <input type="text" placeholder="3-50 Characters" id="FnameInput" class="form-control" name='fname' value=<?php echo isset($_POST['fname']) ? $_POST['fname'] : ""; ?>><br>
                    </div>
                    <div class="col-5">
                        <label for="Lname" id="LnameLabel">Lastname</label><br>
                        <input type="text" placeholder="3-50 Characters" id="LnameInput" class="form-control" name='lname' value=<?php echo isset($_POST['lname']) ? $_POST['lname'] : ""; ?>><br>
                    </div>
                    <div class="col-10">
                        <label for="phone" id="phoneLabel">Phone-Number</label><br>
                        <input type="text" placeholder="xxxxxxxxxx" id="phoneInput" class="form-control" name='phone1' value=<?php echo isset($_POST['phone1']) ? $_POST['phone1'] : ""; ?>><br>
                    </div>
                    <div class="col-10">
                        <label for="email" id="EmailLabel">Email</label><br>
                        <input type="text" placeholder="example@mymail.com" id="emailInput" class="form-control" name='email1' value=<?php echo isset($_POST['email1']) ? $_POST['email1'] : ""; ?>><br>
                    </div>
                    <div class="col-10">
                        <label for="pass" id="passLabel">Password</label><br>
                        <input type="password" placeholder="more than 10 Characters" id="passInput" class="form-control" name='pass1'><br>
                    </div>
                    <div class="col-10">
                        <label for="addr" id="addrLabel">Address</label><br>
                        <textarea placeholder="30-200 Characters" id="addInput" class="form-control" name='add1'><?php echo isset($_POST['add1']) ? $_POST['add1'] : ""; ?></textarea><br>
                    </div>
                </div>
                <button id='signbut2' class="btn btn-success mainButton" name="sign1" type="submit" onclick="Checkreg();" value="1">Sign up</button>
            </form>
            <!-- <button id='signbut2' class="btn btn-success mainButton" name="sign1" type="submit" onclick="Checkreg();" value="1">Sign up</button> -->
            <!-- <div">
                <button type="submit" class="btn btn-success" name='sign1' onclick="ale();">Sign up</button>
            </div> -->
        </div>
    </main>



    <?php
    // Connect to Database 




    // Open Database 
    $db1 = new MyDB();
    if (!$db1) {
        echo $db1->lastErrorMsg();
    }




    // Query process 
    if (isset($_POST['sign1']) && $_POST['sign1'] == '1') {
        $fname2 = $_POST['fname'];
        $lname2 = $_POST['lname'];
        $phone2 = $_POST['phone1'];
        $email2 = $_POST['email1'];
        $pass2 = $_POST['pass1'];
        $add2 = $_POST['add1'];

        $sql = "SELECT EMAIL FROM REGISTER WHERE EMAIL = '$email2'";
        $ret = $db1->query($sql);
        $str = "";
        while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
            $str = $str . $row['EMAIL'];
        }
        echo "<input type='text' id='sameEmail' value='$str'>";
        echo "<script>
        if (document.getElementById('sameEmail').value != ''){
            alert('?????????????????????????????????????????????????????????????????????????????????');
            location.href='register.php';
        }
        }</script>";

        $sql1 = <<<EOF
   INSERT INTO REGISTER (FNAME, LNAME, PHONE, EMAIL, PASSLOG, ADDRESS, POINTS)
      VALUES ('$fname2', '$lname2', '$phone2', '$email2', '$pass2', '$add2', 0);

  EOF;
        $db1->exec($sql1);

        echo "<script> location.href='regsuc.php'; </script>";
    }
    $db1->close();
    ?>

</body>

</html>