<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_SESSION['login'];

        $sql1 = "UPDATE `users` SET `fname`=:fname,`lname`=:lname,`email`=:email,`phone`=:phone WHERE `email`=:email";
        $query = $dbh->prepare($sql1);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);

        $query->execute();
        echo "<script>alert('User UPDATED');document.location = 'index.php';</script>";
    }
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Ostruct - Edit Post</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Ostruct Structural engineers" name="keywords">
        <meta content="Ostruct Construction Company" name="description">

        <!-- Favicon -->
        <link href="assets/img/favicon/favicon.ico" rel="icon">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
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

    </head>
    <body>
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <!-- <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-lg-8 mx-auto">
                        <div class="site-heading">
                            <h1>Kabir's Blog</h1><span class="subheading">An Informative Blog</span></div>
                    </div>
                </div>
            </div>
        </header> -->
        <!-- Header -->

        <div class="container">

            <div class="row">
                <div class="col-md-9 col-lg-6">
                    <div class="clearfix">
                        <h4>Update Profile</h4>
                        <br>
                        <?php
                        $email = $_SESSION['login'];
                        $sql2 = "SELECT * FROM `users` WHERE `email`=:email";
                        $query = $dbh->prepare($sql2);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                        foreach ($results

                        as $result) { ?>
                        <form method="post">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                       value="<?php echo htmlentities($result->fname); ?>">
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                       value="<?php echo htmlentities($result->lname); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email1">Email address</label>
                                <input type="email" class="form-control" id="email1" name="email"
                                       value="<?php echo htmlentities($result->email); ?>" disabled>
                                <small id="emailHelp" class="form-text text-muted">To change email address contact
                                                                                   admin</small>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" autocomplete="off"
                                       value="<?php echo htmlentities($result->phone); ?>">
                            </div>
                            <?php }
                            } ?>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger float-right" name="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/clean-blog.js"></script>
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
<?php } ?>