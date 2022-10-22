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
        echo '<h1 class="name">' . $row["BOOK_NAME"] . '</h1>';
        echo '<h2 class="author">' . $row["AUTHOR"] . '</h2>';
        if ($row['TRANSLATOR'] != NULL) {
            echo '<h2 class="translator">' . $row["TRANSLATOR"] . '</h2>';
        }
        echo '<h3 class="price">฿' . $row['PRICE'] . '</h3>';
        if ($row['STOCK'] != 0) {
            echo '<p class="status">เหลืออยู่: ' . $row['STOCK'] . '</p>';
            echo '<button class="addToCart">เพิ่มลงรถเข็น</button>';
        }
        echo '<p class="description">' . $row['DESCRIPTION'] . '</p>';
    }
    // Close database
    $db->close();

    ?>
</body>

</html>