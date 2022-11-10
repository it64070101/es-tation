<!-- Main page, portal to anything else -->
<?php session_start(); ?>
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

<body>
    <?php include 'keepsession.php';?>
    <?php if(isset($_SESSION['count2'])){
        if ($_SESSION['count2'] == '1'){
            $_SESSION['count1'] = '1';
        }
        if ($_SESSION['count2'] == '2'){
            $_SESSION['count1'] = '2';
        }
    } ?>
    <?php include 'header.php';?>

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

            $sql = "SELECT * from BOOKS where ID = 3";
            $ret = $db->query($sql);
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $id = $row["ID"];
                $bookName = $row["PRODUCT_NAME"];
                $bookDes = $row['DESCRIPTION'];
            }
            $db->close();
            ?>
            <div class="text-end" id="mainButtonDiv">
                <button class="mainButton btn btn-primary" id="mainNewButton">new arrival</button>
                <button class="mainButton btn btn-primary" id="mainPromoButton">promotion</button>
                <a href="products.php"><button class="mainButton btn btn-primary" id="mainAllButton">all product</button></a>
            </div>
            <div id="recommendedBookCover">
                <a href="details.php?id=<?php echo $id;?>&cat=BOOKS" class="invisiLink"><img src="images/books/<?php echo $id;?>.jpg" alt="comedy book" id="bookCover"><a>
            </div>
            <div id="recommendedWhite">
                <div id="recommendTexts">
                    <a href="details.php?id=<?php echo $id;?>&cat=BOOKS" class="invisiLink"><p id="recommendedTitle"><?php echo $bookName;?></p></a>
                    <p id="recomendedParagraph">
                        <?php echo $bookDes;?>
                    </p>
                </div>
            </div>  
        </div>
        <br><br>
        <div id="mainPopularDiv">
            <div class="categoryText" id="popularCatText">popular</div>
            <div class="categoryCarousel" id="popularCarousel">
                why are we making this a carousel lmao
            </div>
        </div>
        <br>
        <div id="mainNewArrivalDiv">
            <div class="categoryText" id="newArrivalCatText">new arrivals</div>
            <div class="categoryCarousel" id="newArrivalCarousel">
                why are we making this a carousel lmao
            </div>
        </div>
        <br>
        <div id="mainPromotionDiv">
            <div class="categoryText" id="promotionCatText">promotions</div>
            <div class="categoryCarousel" id="promotionCarousel">
                why are we making this a carousel lmao
            </div>
        </div>
        <br>
        <div id="mainBooksDiv">
            <div class="categoryText" id="booksCatText">books</div>
            <div class="categoryCarousel" id="booksCarousel">
                why are we making this a carousel lmao
            </div>
        </div>
        <br>
        <div id="mainStationeriesDiv">
            <div class="categoryText" id="stationeriesCatText">stationeries</div>
            <div class="categoryCarousel" id="stationeriesCarousel">
                why are we making this a carousel lmao
            </div>
        </div>
        <br>
        <div id="mainBoardGamesDiv">
            <div class="categoryText" id="boardGamesCatText">board games</div>
            <div class="categoryCarousel" id="boardGamesCarousel">
                why are we making this a carousel lmao
            </div>
        </div>
        <br>
    </main>

    <?php include 'boiler/footer.html';?>
</body>

</html>