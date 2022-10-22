<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <?php include 'includes/header.php';?>
    
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
    $sql = "SELECT * from BOOKS WHERE ID = " . $_GET['id'];

    $ret = $db->query($sql);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        $bookName = $row["BOOK_NAME"];
        $authorName = $row["AUTHOR"];
        $translatorName = $row["TRANSLATOR"];
        $bookPrice = $row['PRICE'];
        $bookStock = $row['STOCK'];
        $bookDes = $row['DESCRIPTION'];
        
    }
    $db->close();
    ?>

    <div class="container"><br><br>
        <div class="row">
            <div class="col-md-3">
                <img src="https://cdn.discordapp.com/attachments/847393439704285204/1033374037180698675/Untitled.png" style="width: 90%; height: 105%; margin: auto;">
            </div>
            <div class="col-md-9">
                <h1 class="bookName"><?php echo $bookName;?></h1>
                <h2 class="bookAuthor"><?php echo $authorName;?></h2>
                <?php
                if ($translatorName != NULL) {
                    echo '<h2 class="bookTranslator">' . $translatorName . '</h2>';
                    }
                ?>
                <h3 class="BookPrice">฿<?php echo $bookPrice;?></h3>
                <?php
                if ($bookStock != 0) {
                    echo '<p class="bookStatus">เหลืออยู่: ' . $bookStock . '</p>';
                    echo '<button class="headerButton btn btn-primary" id="headerPaymentButton" style="height:10%;">Add to cart</button>';
                }
                ?>
                <br><br>
                <p class="bookDescription"><?php echo $bookDes;?></p>
            </div>
        </div><br><br>
    </div>
    
    
    <div id="relatedDiv">
            <div class="categoryText" id="popularCatText">คุณอาจสนใจ</div>
            <div class="categoryCarousel" id="popularCarousel">
                คุณอาจสนใจทำ carousel 
            </div>
    </div>
    <br><br>

    <?php include 'includes/footer.php';?>
</body>

</html>