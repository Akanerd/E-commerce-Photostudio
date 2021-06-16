<?php
include "lib/koneksi.php";

?>
<!Doctype html>
<html>
<head>
    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Boostrap css -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- CSS Sheet -->
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/font-icons.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/fontawesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/fontawesome.min.css"> -->
    <link rel="shortcut icon" href="./img/logotab.png">
    <!-- font google -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <!--Judul web  -->
    <title>PhotoStudio</title>
</head>

<body>
    <!-- Preloader -->
    <main>
        <?php
        include "inchome/navbarhome.php";
        if (isset($_GET["p"])) {
            $pages = "pageshome/" . $_GET["p"] . ".php";
            if (is_file($pages)) {
                include($pages);
            } else {
                include "pageshome/404.php";
            }
        } else {
            include "pageshome/dashboard.php";
        }
        include "inchome/footer.php";
        ?>
    </main> <!-- end main container -->
</body>

<!-- Boostrap Script -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</html>