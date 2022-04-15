<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ostruct Associates</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Ostruct Structural engineers" name="keywords">
    <meta content="Ostruct Construction Company" name="description">

    <!-- Favicon -->
    <link href="img/favicon/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- CSS Stylesheet Linking -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800"> -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic"> -->
    <!-- <link rel="stylesheet" href="assets/fonts/font-awesome.min.css"> -->

</head>

<body>

        <div class="preloader">
            <div>
                <img src="loader.gif" alt="" class="loader">
            </div>
        </div>

    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Header -->

    <!-- Page Header Start -->
    <div class="page-header mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>About Us</h2>
                        </div>
                        <div class="col-12">
                            <a href="">Home</a>
                            <a href="">Single Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

    <?php
    $ptype = 'aboutus';
    $sql = "SELECT pages.pagename, pages.description FROM pages WHERE pages.pagetype=:ptype";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ptype', $ptype, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results

                 as $result) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <h2 class="post-title"><?php echo htmlentities($result->pagename); ?></h2>
                        <p><?php echo htmlentities($result->description); ?></p>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
    <hr>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/clean-blog.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>