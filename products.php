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
    <style><?php include "style.css" ?></style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>

<body>
    <?php include 'includes/header.html';

    ?>
    <form method="post" name='sort1' style="margin: 20px;">
        <select id="sel_id" name="sel_name" onchange="this.form.submit();">
            <option value="ID" selected>DEFAULT</option>
            <option value="BOOK_NAME" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "BOOK_NAME") echo "selected"; ?>>A - Z</option>
            <option value="BOOK_NAME DESC" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "BOOK_NAME DESC") echo "selected"; ?>>Z - A</option>
            <option value="PRICE" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "PRICE") echo "selected"; ?>>lowerest to highest</option>
            <option value="PRICE DESC" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "PRICE DESC") echo "selected"; ?>>highest to lowerest</option>
            <option value="AUTHOR" <?php if (isset($_POST['sel_name']) && $_POST['sel_name'] == "AUTHOR") echo "selected"; ?>>AUTHOR</option>
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
            if (isset($_POST['sel_name'])) {
                $sql = "SELECT * from BOOKS ORDER BY " . $_POST['sel_name'];
            } else {
                $sql = "SELECT * from BOOKS ORDER BY ID";
            }

            $ret = $db->query($sql);
            while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
                $bookID = $row["ID"];
                $bookName = $row["PRODUCT_NAME"];
                $authorName = $row["AUTHOR"];
                $translatorName = $row["TRANSLATOR"];
                $bookPrice = $row['PRICE'];
                $bookStock = $row['STOCK'];
                $bookDes = $row['DESCRIPTION'];
                $bookIMG = $row['IMAGE'];

                echo '<div>
                <a href="details.php?id=' . $bookID . '"><img class="listingBookCover" src="https://cdn.discordapp.com/attachments/847393439704285204/1033374037180698675/Untitled.png"></a>';
                echo '<a class="invisiLink" href="details.php?id=' . $bookID . '"><br><br><p class="listingBookName">' . $bookName . '</p></a>';
                echo '<p class="bookAuthor" style="text-align:center;">' . $authorName . '</p>';
                echo '<p class="BookPrice" style="text-align:center;font-size:20px;">฿' . $bookPrice . '</p>';
                echo '</div>';
            }
            $db->close();
            ?> 
        </div>
    </div>
    

    <?php include 'includes/footer.html'; ?>
</body>

</html>