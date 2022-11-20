<?php
session_start();
// $_SESSION["link3"] = 'complete.php';
// $_SESSION["link4"] = 'checkout.php';
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="icon" href="images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <style>
        <?php include "style.css" ?>
    </style>
    <script>
        <?php include "script.js" ?>
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="cart_calcu.js"></script>
</head>

<body style="background-size:cover;background-image: url('./images/background.jpg');">
    <main>

        <?php include 'header.php'; ?>
        <?php
        // foreach ($_SESSION['cat'] as $key => $value) {
        //     echo $value['cat'];
        // }
        class MyDB extends SQLite3
        {
            function __construct()
            {
                $this->open('products.db');
            }
        }
        $db = new MyDB();
        if (!$db) {
            echo $db->lastErrorMsg();
        }
        $sql = 'SELECT* from BOOKS';
        $ret = $db->query($sql);
        $total = 0;
        ?>
        <div class="container mt-5">

            <div class="row" style="background-color:white;">
                <div style="border:1px solid #0004; padding:2%;" class="">
                    <h5>รายการสินค้า</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="50%">Name</th>
                                <th style="text-align: center;" width="10%">Price</th>
                                <th style="text-align: center;" width="10%">Quantity</th>
                            </tr>
                        </thead>
                        <?php
                        // echo print_r($_SESSION['cart']);
                        // $_SESSION['cart'][0]['quantity'] -= 2;
                        // $index = 0;
                        $list = '';
                        foreach ($_SESSION['cart'] as $key => $value) {
                            if ($value['catagory'] == "BOOKS") {
                                $sql = 'SELECT* from BOOKS';
                                $imgcat = 'books';
                            } elseif ($value['catagory'] == "BOARD_GAMES") {
                                $sql = 'SELECT* from BOARD_GAMES';
                                $imgcat = 'boardgames';
                            } elseif ($value['catagory'] == "STATIONERIES") {
                                $sql = 'SELECT* from STATIONERIES';
                                $imgcat = 'stationeries';
                            }

                            $ret = $db->query($sql);
                            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                                if ($row['ID'] == $value['product_id']) {
                                    if ($row['SALE'] == NULL) {
                                        $price = $row['PRICE'];
                                    } else {
                                        $price = (($row['PRICE']) / 100) * (100 - $row['SALE']);
                                    }
                                    $img = $row['ID'];
                                    $name = $row['PRODUCT_NAME'];
                                    $stock = $row['STOCK'];
                                    if (isset($_POST['Quantity-product-' . $img])) {
                                        // $key = array_search('green', $array);
                                        $_SESSION['cart'][$key]['quantity'] = $_POST['Quantity-product-' . $img];
                                        $value['quantity'] = $_POST['Quantity-product-' . $img];
                                    } else {
                                        $_POST['Quantity-product-' . $img] = 1;
                                    }

                                    $list = $list . $name . ' (' . $_SESSION['cart'][$key]['quantity'] . ')<br>';
                                    $total = $total + ($price * $_SESSION['cart'][$key]['quantity']);
                                    echo '
                                    <tbody>
                                        <tr>
                                            <td style="margin-top:50%;">
                                            <p style="margin-top:22.5px;">' . $name . '</p></td>
                                            <td style="text-align: center;">
                                                <p style="margin-top:22.5px;">' . number_format($price, 2) . '</p></td>
                                            <td style="text-align: center;">
                                            
                                            <p style="margin-top:22.5px;">' .  $value['quantity']  . '</p>
                                            </td>
                                            
                                        </tr>
                                    </tbody>';
                                }
                            }
                        }
                        ?>
                    </table>

                    <?php
                    echo '<form action="cart.php">
                            <div>
                                <button type="submit" class="mainButton btn btn-primary" style="display:flex; margin-left:auto; margin-right:0;">จัดการรถเข็น</button>
                            </div>
                        </form>';
                    ?>
                </div>
                <div class="" style="border:1px solid #0005; border-radius:0.5em;padding:2%;">
                    <h5>สรุปราการสั่งซื้อ</h5>
                    <div class="row">
                        <p class="col-8">ราคาสินค้าทั้งหมด</p>
                        <p style="text-align: right;" class="col-4"><?php echo "$" . number_format($total, 2) ?></p>
                    </div>
                    <div class="row">
                        <p class="col-8">Vat(7%)</p>
                        <p style="text-align: right;" class="col-4"><?php $vax = $total * 0.07;
                                                                    echo "$" . number_format($vax, 2) ?></p>
                    </div>
                    <div class="row">
                        <p class="col-8">ราคาสุทธิ</p>
                        <p style="text-align: right;" class="col-4"><?php echo "$" . number_format($total + $vax, 2) ?></p>
                    </div>
                    <?php
                    class MyDB2 extends SQLite3
                    {
                        function __construct()
                        {
                            $this->open('Register.db');
                        }
                    }
                    $db1 = new MyDB2();
                    if (!$db1) {
                        echo $db1->lastErrorMsg();
                    }

                    if ($_SESSION['count1'] == '2') {
                        $sql = "SELECT * from REGISTER WHERE REGISTER.ID = " . $_SESSION['USERS1'];
                    } else {
                        $sql = "SELECT * from REGISTER WHERE REGISTER.ID = 3";
                    }
                    // $sql = "SELECT * from REGISTER WHERE REGISTER.ID = 3";
                    $ret = $db1->query($sql);
                    $row = $ret->fetchArray(SQLITE3_ASSOC);
                    if ($_SESSION['count1'] != '2') {
                        echo "คุณยังไม่ได้ล็อกอิน หากคุณเป็นสมาชิกอยู่แล้ว <a href='login.php'>คลิ๊กเพื่อล็อกอิน</a> หากต้องการสมัครสมาชิก <a href='register.php'>คลิ๊กเพื่อสมัครสมาชิก</a>";
                    }
                    // echo $_SESSION['count1'] == '2' ? $row['FNAME']:"";
                    ?>
                    <div class='row'>
                        <div class=''></div>
                        <div class='' id='profileDetail'>
                            <form action='#' method='POST' id="dateForm">
                                <p>
                                    <label for='fname'>First Name * : </label><br>
                                    <input name='fname' id='fname2' type='text' placeholder="3-50 Characters" style="width: 100%;" value=<?php echo $_SESSION['count1'] == '2' ? $row['FNAME'] : ""; ?>><br>
                                </p>

                                <p>
                                    <label for='lname'>Last Name * : </label><br>
                                    <input name='lname' id='lname2' type='text' placeholder="3-50 Characters" style="width: 100%;" value=<?php echo $_SESSION['count1'] == '2' ? $row['LNAME'] : ""; ?>><br>
                                </p>

                                <p>
                                    <label for='address'>Address * : </label><br>
                                    <textarea name='address' id='address2' type='text' placeholder="30-200 Characters" col="30" row="10" style="width:100%;height:auto;"><?php echo $_SESSION['count1'] == '2' ? $row['ADDRESS'] : ""; ?></textarea><br>
                                </p>

                                <p>
                                    <label for='phone'>Phone * : </label><br>
                                    <input name='phone' id='phone2' type='text' placeholder="xxxxxxxxxx" style="width: 100%;" value=<?php echo $_SESSION['count1'] == '2' ? $row['PHONE'] : ""; ?>><br>
                                </p>

                                <p>
                                    <label for='email'>Email * : </label><br>
                                    <input name='email' id='email2' type='text' style="width: 100%;" placeholder="10-1000 characters" value=<?php echo $_SESSION['count1'] == '2' ? $row['EMAIL'] : "";
                                                                                                                                            echo $_SESSION['count1'] == '2' ? " readonly" : ""; ?>><br>
                                </p>
                                <p>
                                    <textarea name='list' hidden><?php echo $list; ?></textarea>
                                </p>
                                <p>
                                    <input name='total' type="text" value="<?php echo $total; ?>" hidden>
                                </p>
                                เลือกวิธีการชำระเงิน * :
                                <div>
                                    <!-- <input type="radio" name="payment" value="000" style="display: none;" checked> -->
                                    <input type="radio" class='rad1' name="payment" value="Credit card">
                                    <label for="card">Credit card</label><br>
                                    <input type="radio" class='rad1' name="payment" value="True wallet">
                                    <label for="wallet">True Wallet</label><br>
                                    <input type="radio" class='rad1' name="payment" value="Bank">
                                    <label for="bank">Bank</label><br>
                                    <input type="radio" class='rad1' name="payment" value="QR Payment">
                                    <label for="qrpayment">QR Payment</label>
                                </div>
                                <button type="submit" id="checkout1" name='checkout2' onclick="Check222();" class="mainButton btn btn-primary" style="display:flex; margin-left:auto; margin-right:auto;" value='1'>ยืนยันการชำระเงิน</button>
                                <!-- <button id='editButton' class='mainButton btn btn-primary' type='button' onclick='this.form.submit();'>Edit Profile</button> -->
                                <?php
                                if (isset($_POST['checkout2']) && $_POST['checkout2'] == '1') {
                                    echo "<script> location.href='checkout.php'; </script>";
                                    // $_POST['checkout2'] = '2';
                                }
                                // else{
                                //     echo "<script> location.href='checkout.php'; </script>";
                                //     $_POST['checkout2'] = '1';
                                // }
                                ?>
                            </form>
                        </div>
                    </div>


                    <!-- <form method="post">
                            <div>
                            <button type="submit" id="checkout1" name='checkout2' onclick="Check222();" class="mainButton btn btn-primary" style="display:flex; margin-left:auto; margin-right:auto;" value='1'>ยืนยันการชำระเงิน</button>
                            </div>
                    </form> -->

                    <?php
                    // if (isset($_POST['checkout2']) && $_POST['checkout2'] == '1') {
                    //     echo "<script> location.href='complete.php'; </script>";
                    //     // $_POST['checkout2'] = '2';
                    // }
                    // else{
                    //     echo "<script> location.href='checkout.php'; </script>";
                    //     $_POST['checkout2'] = '1';
                    // }
                    ?>

                </div>
            </div>
        </div>

    </main>
</body>