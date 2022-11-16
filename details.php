<html lang="en">
<?php session_start();

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if (!in_array($_POST['product_id'], $item_array_id)) {
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id'],
                'catagory' => $_POST['cat']
            );
            $_SESSION['cart'][$count] = $item_array;
        } else {
            echo "<script>alert('คุณมีสินค้านี้อยู่ในตะกร้าแล้ว')</script>";
            echo "<script>window.location ='details.php'</script>";
        }
    } else {

        $item_array = array(
            'product_id' => $_POST['product_id'],
            'catagory' => $_POST['cat']
        );
        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="images/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <style>
        <?php include "style.css" ?>
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

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
    switch ($_GET['cat']) {
        case 'BOOKS':
            $cat = "books";
            break;
        case 'BOARD_GAMES':
            $cat = "boardgames";
            break;
        case 'STATIONERIES':
            $cat = "stationeries";
            break;
        default:
            # code...
            break;
    }
    // Query process 
    $sql = "SELECT * from " . $_GET['cat'] . " WHERE ID = " . $_GET['id'];

    $ret = $db->query($sql);
    while ($row = $ret->fetchArray(SQLITE3_ASSOC)) {
        $id = $row["ID"];
        $bookName = $row["PRODUCT_NAME"];
        if ($_GET['cat'] == "BOOKS") {
            $authorName = $row["AUTHOR"];
        } else if ($_GET['cat'] == "BOARD_GAMES") {
            $authorName = $row["MANUFACTURER"];
        } else if ($_GET['cat'] == "STATIONERIES") {
            $authorName = "";
        }

        // $translatorName = $row["TRANSLATOR"];
        $bookPrice = $row['PRICE'];
        $bookStock = $row['STOCK'];
        $bookDes = $row['DESCRIPTION'];
    }
    $db->close();

    ?>

    <div class="container"><br><br>
        <form action="details.php?action=add&id=<?php echo $id ?>" method="post">
            <div class="row">
                <div class="col-md-3">
                    <img class="bookCover" src="images/<?php echo $cat; ?>/<?php echo $id . '.jpg'; ?>">
                </div>
                <div class="col-md-9">
                    <h1 class="bookName"><?php echo $bookName; ?></h1>
                    <h2 class="bookAuthor"><?php echo $authorName; ?></h2>
                    <p><?php echo $_GET['cat']; ?></p>
                    <?php
                    // if ($translatorName != NULL) {
                    //     echo '<h2 class="bookTranslator">' . $translatorName . '</h2>';
                    //     }
                    ?>
                    <h3 class="BookPrice">$<?php echo $bookPrice; ?></h3>
                    <?php
                    if ($bookStock != 0) {
                        echo '<p class="bookStatus">เหลืออยู่: ' . $bookStock . '</p>';
                        echo '<input type="submit" class="headerButton btn btn-primary" id="headerPaymentButton" name="add" style="height:10%;"value="Add to cart">';
                    }
                    ?>
                    <br><br>
                    <p class="bookDescription"><?php echo $bookDes; ?></p>
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $id ?>">
                    <input type="hidden" id="cat" name="cat" value="<?php echo $_GET['cat'] ?>">
                </div>
            </div><br><br>
        </form>
    </div>


    <div id="relatedDiv">
        <div class="categoryText" id="popularCatText">คุณอาจสนใจ</div>
        <div class="categoryCarousel" id="popularCarousel">
            คุณอาจสนใจทำ carousel
        </div>
    </div>
    <br><br>

    <?php include 'footer.html'; ?>
</body>

</html>