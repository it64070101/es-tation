<!-- Main page, portal to anything else -->
<?php session_start();
// session_destroy();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>es'tation: Books, Stationeries, and Board games</title>
    <link rel="icon" href="images/icon.png">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css” />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <style>
        <?php include "style.css" ?>
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Charm:wght@700&family=Mitr&family=Noto+Serif+Thai&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <?php include 'keepsession.php'; ?>
    <?php if (isset($_SESSION['count2'])) {
        if ($_SESSION['count2'] == '1') {
            $_SESSION['count1'] = '1';
        }
        if ($_SESSION['count2'] == '2') {
            $_SESSION['count1'] = '2';
        }
    } ?>
    <?php include 'header.php'; ?>

    <main>
        <div id="mainRecommendedDiv">
            <?php
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

            $sql = "SELECT * from BOOKS where TAG = 'RECOMMENDED'";
            $ret = $db->query($sql);
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $id = $row["ID"];
                $bookName = $row["PRODUCT_NAME"];
                $bookDes = $row['DESCRIPTION'];
            }
            $db->close();
            ?>
            <div class="text-end" id="mainButtonDiv" style="margin-right: 7%;">
                <a href="newari.php"><button class="mainButton" id="mainAllButton">new arrivals</button></a>
                <a href="promotion.php"><button class="mainButton" id="mainAllButton">sales</button></a>
                <a href="products.php"><button class="mainButton" id="mainAllButton">all products</button></a>
            </div>
            <div id="recommendedBookCover">
                <a href="details.php?id=<?php echo $id; ?>&cat=BOOKS" class="invisiLink"><img src="images/books/<?php echo $id; ?>.jpg" alt="comedy book" id="bookCover"><a>
            </div>
            <div id="recommendedWhite">
                <div id="recommendTexts">
                    <a href="details.php?id=<?php echo $id; ?>&cat=BOOKS" class="invisiLink">
                        <p id="recommendedTitle"><?php echo $bookName; ?></p>
                    </a>
                    <p id="recomendedParagraph">
                        <?php echo $bookDes; ?>
                    </p>
                </div>
            </div>
        </div>
        <br><br>
        <div id="mainPopularDiv">
            <div class="categoryText" id="popularCatText">popular</div>
            <div class="categoryCarousel" id="popularCarousel">
                <?php

                // Open Database 
                $db = new MyDB();
                if (!$db) {
                    echo $db->lastErrorMsg();
                }

                $sql = "SELECT * from BOOKS WHERE TAG = 'POPULAR' AND SALE == 0";
                $ret = $db->query($sql);

                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $bookStock = $row['STOCK'];
                    $bookDes = $row['DESCRIPTION'];
                    $bookIMG = $row['IMAGE'];

                    $authorName = $row["AUTHOR"];
                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                    echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $bookPrice . '</p>';
                    echo '</div>';
                }
                $db->close();
                ?>
            </div>
        </div>
        <br>
        <div id="mainNewArrivalDiv">
            <div class="categoryText" id="newArrivalCatText">new arrivals</div>
            <div class="categoryCarousel" id="newArrivalCarousel">
                <?php

                // Open Database 
                $db = new MyDB();
                if (!$db) {
                    echo $db->lastErrorMsg();
                }

                $sql = "SELECT * from BOOKS WHERE ID > 10 AND SALE == 0 LIMIT 7";
                $ret = $db->query($sql);

                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $bookStock = $row['STOCK'];
                    $bookDes = $row['DESCRIPTION'];
                    $bookIMG = $row['IMAGE'];

                    $authorName = $row["AUTHOR"];
                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                    echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $bookPrice . '</p>';
                    echo '</div>';
                }
                $db->close();
                ?>
            </div>
        </div>
        <br>
        <div id="mainPromotionDiv">
            <div class="categoryText" id="promotionCatText">sales</div>
            <div class="categoryCarousel" id="promotionCarousel">
                <?php

                // Open Database 
                $db = new MyDB();
                if (!$db) {
                    echo $db->lastErrorMsg();
                }

                $sql = "SELECT ID, PRODUCT_NAME, PRICE, SALE, AUTHOR, NULL as MANUFACTURER
                FROM BOOKS
                WHERE SALE > 0.0";
                $sql1 = "SELECT ID, PRODUCT_NAME, PRICE, SALE, NULL, MANUFACTURER
                FROM BOARD_GAMES
                WHERE SALE > 0.0";
                $sql2 = "SELECT ID, PRODUCT_NAME, PRICE, SALE, NULL, NULL
                FROM STATIONERIES
                WHERE SALE > 0.0";

                $ret = $db->query($sql);
                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $authorName = $row["AUTHOR"];
                    $percent1 = $row["SALE"];
                    $cal1 = $bookPrice * ((100 - $percent1) / 100);
                    $fo1 = '<p class="BookPrice" style="text-align:center;font-size:20px;"><del>$%s</del><span style="color:red;"> $%.2f</span> </p>';
                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                    echo sprintf($fo1, $bookPrice, $cal1);
                    echo '</div>';
                }
                $ret = $db->query($sql1);
                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $manu = $row['MANUFACTURER'];
                    $percent1 = $row["SALE"];
                    $cal1 = $bookPrice * ((100 - $percent1) / 100);
                    $fo1 = '<p class="BookPrice" style="text-align:center;font-size:20px;"><del>$%s</del><span style="color:red;"> $%.2f</span> </p>';
                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><img class="listingBookCover" src="images/boardgames/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="bookAuthor" style="text-align:center;">' . $manu . '</p>';
                    echo sprintf($fo1, $bookPrice, $cal1);
                    echo '</div>';
                }
                $ret = $db->query($sql2);
                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $percent1 = $row["SALE"];
                    $cal1 = $bookPrice * ((100 - $percent1) / 100);
                    $fo1 = '<p class="BookPrice" style="text-align:center;font-size:20px;"><del>$%s</del>  <span style="color:red;"> $%.2f</span> </p>';
                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=STATIONERIES"><img class="listingBookCover" src="images/stationeries/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=STATIONERIES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo sprintf($fo1, $bookPrice, $cal1);
                    echo '</div>';
                }
                $db->close();
                ?>
            </div>
        </div>
        <br>
        <div id="mainBooksDiv">
            <div class="categoryText" id="booksCatText">books</div>
            <div class="categoryCarousel" id="booksCarousel">
                <?php

                // Open Database 
                $db = new MyDB();
                if (!$db) {
                    echo $db->lastErrorMsg();
                }

                $sql = "SELECT * from BOOKS WHERE SALE == 0 LIMIT 7";
                $ret = $db->query($sql);

                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $bookStock = $row['STOCK'];
                    $bookDes = $row['DESCRIPTION'];
                    $bookIMG = $row['IMAGE'];

                    $authorName = $row["AUTHOR"];
                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=BOOKS"><img class="listingBookCover" src="images/books/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOOKS"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                    echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $bookPrice . '</p>';
                    echo '</div>';
                }
                $db->close();
                ?>
            </div>
        </div>
        <br>
        <div id="mainStationeriesDiv">
            <div class="categoryText" id="stationeriesCatText">stationeries</div>
            <div class="categoryCarousel" id="stationeriesCarousel">
                <?php

                // Open Database 
                $db = new MyDB();
                if (!$db) {
                    echo $db->lastErrorMsg();
                }

                $sql = "SELECT * from STATIONERIES WHERE SALE == 0 LIMIT 7";
                $ret = $db->query($sql);

                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $bookStock = $row['STOCK'];
                    $bookDes = $row['DESCRIPTION'];
                    $bookIMG = $row['IMAGE'];

                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=STATIONERIES"><img class="listingBookCover" src="images/stationeries/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=STATIONERIES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $bookPrice . '</p>';
                    echo '</div>';
                }
                $db->close();
                ?>
            </div>
        </div>
        <br>
        <div id="mainBoardGamesDiv">
            <div class="categoryText" id="boardGamesCatText">board games</div>
            <div class="categoryCarousel" id="boardGamesCarousel">
                <?php

                // Open Database 
                $db = new MyDB();
                if (!$db) {
                    echo $db->lastErrorMsg();
                }

                $sql = "SELECT * from BOARD_GAMES WHERE SALE == 0 LIMIT 7";
                $ret = $db->query($sql);

                while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                    $bookID = $row["ID"];
                    $bookName = $row["PRODUCT_NAME"];
                    $bookPrice = $row['PRICE'];
                    $bookStock = $row['STOCK'];
                    $bookDes = $row['DESCRIPTION'];
                    $bookIMG = $row['IMAGE'];

                    echo '<div class="item">
                    <a href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><img class="listingBookCover" src="images/boardgames/' . $bookID . '.jpg' . '"></a>';
                    echo '<a class="invisiLink" href="details.php?id=' . $bookID . '&cat=BOARD_GAMES"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                    echo '<p class="BookPrice" style="text-align:center;font-size:20px;">$' . $bookPrice . '</p>';
                    echo '</div>';
                }
                $db->close();
                ?>
            </div>
        </div>
        <br>
    </main>

    <?php include 'footer.html'; ?>
</body>

</html>