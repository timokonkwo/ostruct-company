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
    <link href="assets/img/favicon/favicon.ico" rel="icon">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="assets/lib/flaticon/font/flaticon.css" rel="stylesheet">
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="assets/lib/slick/slick.css" rel="stylesheet">
    <link href="assets/lib/slick/slick-theme.css" rel="stylesheet">

    <!-- CSS Stylesheet Linking -->
    <link rel="stylesheet" href="assets/css/style.css">
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
    <div class="page-header">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>Blog Page</h2>
                        </div>
                        <div class="col-12">
                            <a href="index.html">Home</a>
                            <a href="#">Blog</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

    <div class="container">
        <div class="row">
            <?php
            $s = 1;
            $sql = "SELECT posts.*,categories.catname FROM posts JOIN categories ON categories.id=posts.category WHERE posts.status=:s ORDER BY posts.id DESC LIMIT 7";
            $query = $dbh->prepare($sql);
            $query->bindParam(':s', $s, PDO::PARAM_STR);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if ($query->rowCount() > 0) {
                foreach ($results as $result) {
            ?>
                    <div class="col-md-10 col-lg-12">
                        <div class="post-preview">
                            <a href="post-details.php?id=<?php echo htmlentities($result->id); ?>">
                                <h2 class="post-title"><?php echo htmlentities($result->title); ?>,
                                    <i><?php echo htmlentities($result->catname); ?></i>
                                </h2>
                                <h3 class="post-subtitle"><?php echo htmlentities($result->grabber); ?></h3>
                            </a>
                            <p class="post-meta">Posted by&nbsp;<?php echo htmlentities($result->username); ?>
                                on <?php echo htmlentities($result->creationdate); ?>
                            </p>
                        </div>
                        <hr>


                    </div>
            <?php }
            } ?>

        </div>

        <div class="row">
            <div class="col-md-10 col-lg-12">
                <div class="clearfix">
                    <a href="view-posts.php">
                        <button class="btn btn-primary float-right" type="button">Older Posts&nbsp;???</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/lib/easing/easing.min.js"></script>
    <script src="assets/lib/wow/wow.min.js"></script>
    <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/lib/lightbox/js/lightbox.min.js"></script>
    <script src="assets/lib/waypoints/waypoints.min.js"></script>
    <script src="assets/lib/counterup/counterup.min.js"></script>
    <script src="assets/lib/slick/slick.min.js"></script>

    <!-- JavaScript Libraries -->
    <script src="assets/js/main.js"></script>

</body>

</html>