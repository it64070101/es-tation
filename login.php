<!-- if user pressed on the icon of a funny looking guy but hasn't logged in lead here -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>es'tation: Books, Stationeries, and Board games</title>
    <link rel="icon" href="images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <style><?php include "style.css" ?></style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body style="height: 100%;">
    <?php include 'includes/header.html';?>

    <main style="height: 70%;">
        <div id="mainLoginDiv">
            <p style="font-size: 40px; margin-top: 15px; text-align: center;">es'tation</p>
            <form action="<!-- php to do things -->" method="post" id="loginForm" class="form-group">
                <label for="username" id="usernameLabel">Username</label><br>
                <input type="text" placeholder="Username" id="usernameInput" class="form-control"><br>
                <label for="password" id="passwordLabel">Password</label><br>
                <input type="password" placeholder="Password" id="passwordInput" class="form-control"><br>
            </form>
            <div style="text-align:center;">
                <a href="profile.php"><button type="submit" class="btn btn-primary">Log in</button></a><br>
                <p style="text-align: center;">or</p>
                <button type="button" class="btn btn-success">Sign up</button>
            </div>
        </div>
    </main>

</body>

</html>