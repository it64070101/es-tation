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
    <style>
    </style>
</head>

<body>
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
                <a href="cart.php?action=del&add">Emty</a>
                <div class="row" style="background-color:white;;">
                    <div style="border:1px solid #0004;" class="col-8 m-2">
                        <h5>รายการสินค้า</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Product</th>
                                    <th style="text-align: center;" width="50%">Name</th>
                                    <th style="text-align: center;" width="10%">Price</th>
                                    <th style="text-align: center;" width="10%">Quntity</th>
                                    <th style="text-align: center;" width="10%"></th>
                                </tr>
                            </thead>
                        <?php
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
                                        $price = (($row['PRICE'])/100) * (100-$row['SALE']);
                                    }
                                    $img = $row['ID'];
                                    $name = $row['PRODUCT_NAME'];

                                    $total = $total + $price;
                                    echo '
                                    <tbody>
                                        <tr>
                                            <td><img style="width:100px;" src="images/' . $imgcat . '/' . $img . '.jpg" alt=""></td>
                                            <td style="text-align: center; margin-top:50%;">
                                                <p style="margin-top:22.5px;">' . $name . '</p></td>
                                            <td style="text-align: center;">
                                                <p style="margin-top:22.5px;">' . $price . '</p></td>
                                            <td style="text-align: center;"><input type="number" name="Quantity-product" style="width: 100%; text-align:center; margin-top:20px; border:0px;" value="1" min="1"></td>
                                            <td style="text-align: center;"><a href="cart.php?action=delete&id=' . $img . '"<i class="fa fa-trash" style="margin-top:25px;"></i></a></td>
                                        </tr>
                                    </tbody> ';
                                }
                            }
                        }
                    } else {
                        echo '<div class="container mt-5">
                            <a href="">Empty</a>
                            <div class="row" style="background-color:white;;">
                                <div style="border:1px solid #0004;" class="col-8 m-2 text-center">
                                <img src="imgcart.png" style="width:150px;">
                                <p>ยังไม่มีสินค้าในตะกร้าของคุณ</p>
                                <a href="index.php">กลับไปยังหน้าหลัก</a>';
                    }
                        ?>
                        </table>
                    </div>
                    <div class="col"></div>
                    <div class="col-3 m-2" style="border:1px solid #0005; border-radius:0.5em;">
                        <h5>สรุปราการสั่งซื้อ</h5>
                        <div class="row">
                            <p class="col-8">ราคาสินค้าทั้งหมด</p>
                            <p style="text-align: right;" class="col-4"><?php echo $total ?></p>
                        </div>
                        <div class="row">
                            <p class="col-8">Vat(7%)</p>
                            <p style="text-align: right;" class="col-4"><?php $vax = $total * 0.07;
                                                                        echo $vax ?></p>
                        </div>
                        <div class="row">
                            <p class="col-8">ราคาสุทธิ</p>
                            <p style="text-align: right;" class="col-4"><?php echo $total + $vax ?></p>
                        </div>
                        <input type="submit" value="ทำการสั่งซื้อ">
                    </div>
                </div>
            </div>

    </main>
</body>

</html>