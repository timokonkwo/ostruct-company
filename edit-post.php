<?php
session_set_cookie_params(0);
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location: login.php');
} else {
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $cat = $_POST['selectcat'];
        $grabber = $_POST['grabber'];
        $description = $_POST['description'];
        $id = intval($_GET['id']);

        $sql = "UPDATE `posts` SET title=:title,category=:cat,grabber=:grabber,description=:description WHERE id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':grabber', $grabber, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        echo "<script>alert('Post has updated successfully');document.location = 'view-posts.php';</script>";
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
        <!-- Preloader -->
        <div class="preloader">
            <div>
                <img src="loader.gif" alt="" class="loader">
            </div>
        </div>
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
                <div class="col-md-10 col-lg-8 mt-5 mx-auto">
                    <h2 class="post-title">Edit a post</h2>
                    <br>
                    <?php
                    $id = intval($_GET['id']);
                    $sql = "SELECT posts.*,categories.catname,categories.id AS cid FROM posts JOIN categories ON categories.id=posts.category WHERE posts.id=:id";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':id', $id, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                    foreach ($results

                    as $result) { ?>
                    <form id="contactForm" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <label for="title"><strong>Title</strong></label>
                            <div class="form-group floating-label-form-group controls"><input
                                        class="form-control" type="text" id="title" required="" placeholder="Title"
                                        name="title" value="<?php echo htmlentities($result->title); ?>"><small
                                        class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <label for="select1"><strong>Select Category</strong></label>
                            <div class="form-group floating-label-form-group controls">
                                <select class="form-control" id="select1"
                                        name="selectcat" required>
                                    <option value="<?php echo htmlentities($result->cid); ?>"><?php echo htmlentities($cname = $result->catname); ?></option>
                                    <?php $ret = "SELECT `id`,`catname` FROM `categories`";
                                    $query = $dbh->prepare($ret);
                                    //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                    $query->execute();
                                    $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($resultss as $results) {
                                            if ($results->catname == $cname) {
                                                continue;
                                            } else {
                                                ?>
                                                <option value="<?php echo htmlentities($results->id); ?>">
                                                    <?php echo htmlentities($results->catname); ?>
                                                </option>
                                            <?php }
                                        }
                                    } ?>
                                </select><small class="form-text text-danger help-block"></small>
                            </div>
                        </div>

                        <div class="control-group">
                            <label for="grabber"><strong>Grabber</strong></label>
                            <div class="form-group floating-label-form-group controls"><input
                                        class="form-control" type="text" id="grabber" required="" placeholder="Grabber"
                                        name="grabber" value="<?php echo htmlentities($result->grabber); ?>"><small
                                        class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <label for="image1"><strong>Header Image</strong></label>
                            <div class="form-group floating-label-form-group controls"><img
                                        src="assets/img/postimages/<?php echo htmlentities($result->image1); ?>"
                                        width="300" height="200" style="border:solid 1px #000"><br><br>
                                <a href="changeimage1.php?imgid=<?php echo htmlentities($result->id) ?>">Change
                                                                                                         Header Image</a>
                                <small class="form-text text-danger help-block"></small></div>
                        </div>

                        <div class="control-group">
                            <label for="desc"><strong>Description</strong></label>
                            <div class="form-group floating-label-form-group controls mb-3"><textarea
                                        class="form-control" id="desc"
                                        data-validation-required-message="Description" required=""
                                        placeholder="Description" rows="5"
                                        name="description"><?php echo htmlentities($result->description); ?></textarea><small
                                        class="form-text text-danger help-block"></small></div>
                        </div>
                        <?php }
                        } ?>
                        <div id="success"></div>
                        <div class="form-group">
                            <button class="btn btn-primary" id="sendMessageButton" type="submit" name="submit">Update
                            </button>
                        </div>
                    </form>
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
