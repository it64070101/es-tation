<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header class="header">
        <div class="container d-flex" style="height: 10%;" id="headerContainerDiv">
            <div class="col-lg-2 col-md-3 col-sm-3 col-3" id="webNameDiv">
                <a href="index.php">
                    <h1 class="estation" style="margin-top: 5%;">es'tation</h1>
                </a>
            </div>
            <div class="col-md-4" id="searchInputDiv">
                <form action="search.php" method="POST">
                    <input type="text" name="search" id="searchInput" class="mainButton">
                    <button class="mainButton"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 text-end" style="margin-top: 20px; margin-left:auto;" id="headerButtonDiv">
                <a href="cart.php"><button class="headerButton" id="headerCartButton" style="<?php echo !empty($_SESSION['cart']) ? "background-color: rgb(0, 255, 21);" : ""; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button></a>
                <a href="<?php if ($_SESSION['count1'] == '' || $_SESSION['count1'] == '1') {
                                echo $_SESSION["link1"];
                            } else if ($_SESSION['count1'] == '2') {
                                echo $_SESSION['link2'];
                            } ?>"><button class="headerButton" style="<?php echo $_SESSION['count1'] == '2' ? "background-color: rgb(0, 255, 21);" : ""; ?>" id="headerProfileButton"><i class="fa fa-user" aria-hidden="true"></i></button></a>
            </div>
        </div>
    </header>
</body>

</html>