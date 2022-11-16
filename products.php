<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php include 'header.php';
    ?>
    <form method="post" name='sort1' style="margin: 20px;">
        <select id="sel_id" name="sel_name" onchange="this.form.submit();">
            <option value="ID" selected>DEFAULT</option>
            <option value="PRODUCT_NAME" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "PRODUCT_NAME") echo "selected"; ?>>A - Z</option>
            <option value="PRODUCT_NAME DESC" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "PRODUCT_NAME DESC") echo "selected"; ?>>Z - A</option>
            <option value="PRICE * ((100 - SALE)/100)" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "PRICE * ((100 - SALE)/100)") echo "selected"; ?>>lowerest to highest</option>
            <option value="PRICE * ((100 - SALE)/100) DESC" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "PRICE * ((100 - SALE)/100) DESC") echo "selected"; ?>>highest to lowerest</option>
        </select>
        <select id="cat_sel" name="cat_name" onchange="this.form.submit();">
            <!-- <option value="ID" selected>ALL</option> -->
            <option value="BOOKS" <?php if (isset($_POST['cat_name']) && $_POST['cat_name'] == "BOOKS") echo "selected"; ?>>BOOKS</option>
            <option value="BOARDGAME" <?php if (isset($_POST['cat_name']) && $_POST['cat_name'] == "BOARDGAME") echo "selected"; ?>>BOARDGAME</option>
            <option value="STATIONARIES" <?php if (isset($_POST['cat_name']) && $_POST['cat_name'] == "STATIONARIES") echo "selected"; ?>>STATIONARIES</option>
        </select>
    </form>
    <br>
    <div class="container">
        <div class="grid-container">
            <?php
            // Connect to Database 
            class MyDB extends SQLite3
            {
                function __construct()
                {
                    $this->open('products.db');
                }
            }

            // Open Database 
            $db = new MyDB();
            if (!$db) {
                echo $db->lastErrorMsg();
            }

            // Query process 
            // $_POST['cat_name'] = null;
            if (isset($_POST['sel_name']) && $_POST['cat_name']) {
                if ($_POST['cat_name'] == 'BOOKS') {
                    $sql = "SELECT * from BOOKS ORDER BY " . $_POST['sel_name'];
                } else if ($_POST['cat_name'] == 'BOARDGAME') {
                    $sql = "SELECT * from BOARD_GAMES ORDER BY " . $_POST['sel_name'];
                } else if ($_POST['cat_name'] == 'STATIONARIES') {
                    $sql = "SELECT * from STATIONERIES ORDER BY " . $_POST['sel_name'];
                } else {
                    $sql = "SELECT * from BOOKS ORDER BY " . $_POST['sel_name'];
                }
                // $sql = "SELECT * from BOOKS ORDER BY " . $_POST['sel_name'];
            } else {
                $_POST['cat_name'] = '';
                if ($_POST['cat_name'] == 'BOOKS') {
                    $sql = "SELECT * from BOOKS ORDER BY ID";
                } else if ($_POST['cat_name'] == 'BOARDGAME') {
                    $sql = "SELECT * from BOARD_GAMES ORDER BY ID";
                } else if ($_POST['cat_name'] == 'STATIONARIES') {
                    $sql = "SELECT * from STATIONERIES ORDER BY ID";
                } else {
                    $sql = "SELECT * from BOOKS ORDER BY ID";
                }
            }

            $ret = $db->query($sql);
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $bookID = $row["ID"];
                $bookName = $row["PRODUCT_NAME"];
                $bookPrice = $row['PRICE'];
                $bookStock = $row['STOCK'];
                $bookDes = $row['DESCRIPTION'];
                $bookIMG = $row['IMAGE'];
                $percent1 = $row["SALE"];

                // $cal1 = $bookPrice * ($percent1/100);
                $fo1 = '<p class="BookPrice" style="text-align:center;font-size:20px;"><del>$%s</del><span style="color:red;"> $%.2f</span> </p>';
                if ($percent1 != 0) {
                    $cal1 = $bookPrice * ((100 - $percent1) / 100);
                    // echo $cal1;
                    if (isset($_POST['cat_name']) && $_POST['cat_name'] == 'BOOKS') {
                        $authorName = $row["AUTHOR"];
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                        echo sprintf($fo1, $bookPrice, $cal1);
                        echo '</div>';
                    } else if (isset($_POST['cat_name']) && $_POST['cat_name'] == 'BOARDGAME') {
                        $manu = $row['MANUFACTURER'];
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><img class="listingBookCover" src="images/boardgames/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="bookAuthor" style="text-align:center;">' . $manu . '</p>';
                        echo sprintf($fo1, $bookPrice, $cal1);
                        echo '</div>';
                    } else if (isset($_POST['cat_name']) && $_POST['cat_name'] == 'STATIONARIES') {
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=STATIONERIES"><img class="listingBookCover" src="images/stationeries/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=STATIONERIES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo sprintf($fo1, $bookPrice, $cal1);
                        echo '</div>';
                    } else {
                        $authorName = $row["AUTHOR"];
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                        echo sprintf($fo1, $bookPrice, $cal1);
                        echo '</div>';
                    }
                } else {
                    $cal1 = $bookPrice;
                    // echo $cal1;
                    if (isset($_POST['cat_name']) && $_POST['cat_name'] == 'BOOKS') {
                        $authorName = $row["AUTHOR"];
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                        echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $cal1 . '</p>';
                        echo '</div>';
                    } else if (isset($_POST['cat_name']) && $_POST['cat_name'] == 'BOARDGAME') {
                        $manu = $row['MANUFACTURER'];
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><img class="listingBookCover" src="images/boardgames/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="bookAuthor" style="text-align:center;">' . $manu . '</p>';
                        echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $cal1 . '</p>';
                        echo '</div>';
                    } else if (isset($_POST['cat_name']) && $_POST['cat_name'] == 'STATIONARIES') {
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=STATIONERIES"><img class="listingBookCover" src="images/stationeries/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=STATIONERIES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $cal1 . '</p>';
                        echo '</div>';
                    } else {
                        $authorName = $row["AUTHOR"];
                        echo '<div class="item">
                        <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                        echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                        echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                        echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $cal1 . '</p>';
                        echo '</div>';
                    }
                }
            }
            $db->close();
            ?>
        </div>
    </div>


    <?php include 'footer.html'; ?>
</body>

</html>