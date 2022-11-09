<!DOCTYPE html>
<?php
// $_SESSION["link1"] = 'login.php';
// $_SESSION["link2"] = 'profile.php';
// $_SESSION["count1"] = '1';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class="bg-primary">
        <div class="container d-flex" style="height: 10%;" id="headerContainerDiv">
            <div class="col-lg-2 col-md-3 col-sm-3 col-3" id="webNameDiv">
                <a href="index.php">
                    <h1 class="text-white" style="margin-top: 5%;">es'tation</h1>
                </a>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-3 col-3" id="searchInputDiv">
                <input type="text" name="search"  id="searchInput" style="height: 40%; border-radius: 0.2rem; border: 1px;">
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6  text-end" style="margin-top: 20px;" id="headerButtonDiv">
                <a href="payment.php"><button class="headerButton bg-primary"
                        id="headerPaymentButton">payment</button></a>
                <a href="shipping.php"><button class="headerButton bg-primary"
                        id="headerShippingButton">shipping</button></a>
                <a href="cart.php"><button class="headerButton bg-primary" id="headerCartButton"><i
                            class="fa fa-shopping-cart" aria-hidden="true"></i></button></a>
                <a href="<?php if($_SESSION['count1']=='' || $_SESSION['count1']=='1') {echo $_SESSION["link1"];} else if($_SESSION['count1']=='2') {echo $_SESSION['link2'];} ?>"><button class="headerButton bg-primary" id="headerProfileButton"><i
                            class="fa fa-user" aria-hidden="true"></i></button></a>
            </div>
        </div>
    </header>
</body>
</html>