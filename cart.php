<!-- shipping cart -->

<html lang="en">
<?php
session_start();
if (isset($_GET['action'])) {
    if ($_GET['action'] == "delete") {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['product_id'] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo '<script>alert("ลบสินค้าออกจากตะกร้าแล้ว")</script>';
                echo '<script>window.location="cart.php"</script>';
            }
        }
    } else {
        unset($_SESSION['cart']);
        echo '<script>alert("ลบสินค้าออกจากตะกร้าแล้ว")</script>';
        echo '<script>window.location="cart.php"</script>';
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
        if (!empty($_SESSION['cart'])) {
        ?>
            <div class="container mt-5">
                <div>
                    <a href="cart.php?action=del&add" class="invisilink"><button class="clearbutton" style="padding: 0.3em 1.5em 0.3em 1.5em;">Clear</button></a>
                    <a href="products.php" class="invisilink"><button class="gotoshopbutton">กลับไปเลือกสินค้า</button></a>
                </div>
                <div class="row cartcover">
                    <div class="col-8 m-2 cart">
                        <h5>รายการสินค้า</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Product</th>
                                    <th style="text-align: center;" width="50%">Name</th>
                                    <th style="text-align: center;" width="10%">Price</th>
                                    <th style="text-align: center;" width="10%">Quantity</th>
                                    <th style="text-align: center;" width="10%"></th>
                                </tr>
                            </thead>
                        <?php
                        // echo print_r($_SESSION['cart']);
                        // $_SESSION['cart'][0]['quantity'] -= 2;
                        // $index = 0;
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
                            echo '<form action="cart.php" method="POST">';
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
                                        if ($_POST['Quantity-product-' . $img] > $stock) {
                                            $_POST['Quantity-product-' . $img] = $stock;
                                        }
                                        $_SESSION['cart'][$key]['quantity'] = $_POST['Quantity-product-' . $img];
                                        $value['quantity'] = $_POST['Quantity-product-' . $img];
                                    } else {
                                        $_POST['Quantity-product-' . $img] = 1;
                                    }


                                    $total = $total + ($price * $_SESSION['cart'][$key]['quantity']);
                                    echo '
                                    <tbody>
                                        <tr>
                                            <td><a href="details.php?id=' . $img . '&cat=' . $value['catagory'] . '" class="invisilink"><img style="width:100px;" src="images/' . $imgcat . '/' . $img . '.jpg" alt=""></a></td>
                                            <td style="text-align: center; margin-top:50%;">
                                            <a href="details.php?id=' . $img . '&cat=' . $value['catagory'] . '" class="invisilink"><p style="margin-top:22.5px;">' . $name . '</p></a></td>
                                            <td style="text-align: center;">
                                                <p style="margin-top:22.5px;">' . number_format($price, 2) . '</p></td>
                                            <td style="text-align: center;">
                                            
                                            <input type="number" name="Quantity-product-' . $img . '" style="width: 80%; text-align:center; margin-top:20px; " value="' . $value['quantity'] . '" min="1" max="' . $stock . '" onchange="this.form.submit()">
                                            </td>
                                            <td style="text-align: center;"><a href="cart.php?action=delete&id=' . $img . '"<i class="fa fa-trash" style="margin-top:25px;"></i></a></td>
                                        </tr>
                                    </tbody>';
                                }
                            }
                            echo "</form>";
                        }
                    } else {
                        echo '<div class="container mt-5">
                            <div class="row cartcover">
                                <div style="border:1px solid #0004;" class="col-8 m-2 text-center">
                                <img src="imgcart.png" style="width:150px;">
                                <p>ยังไม่มีสินค้าในตะกร้าของคุณ</p>
                                <a href="products.php"><button class="mainButton btn btn-primary ">เลือกซื้อสินค้าเลย!</button></a>';
                    }
                        ?>
                        </table>
                    </div>
                    <div class="col"></div>
                    <div class="col-md-3 col-sm-12 m-2" style="border:1px solid #0005; border-radius:0.2em;padding:1%;">
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
                        if (!empty($_SESSION['cart'])) {
                            echo '<form action="checkout.php">
                            <div>
                                <button type="submit" class="mainButton btn btn-primary" style="padding:2% 25% 2% 25%; display:flex; margin-left:auto; margin-right:auto;">สั่งซื้อ</button>
                            </div>
                        </form>';
                        }
                        ?>

                    </div>
                </div>
            </div>

    </main>
</body>

</html>