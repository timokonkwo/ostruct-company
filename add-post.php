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
        $username = $_POST['name'];

        $email3 = $_SESSION['login'];

        $sql3 = "SELECT `id` FROM `users` WHERE `email`=:email3";
        $query3 = $dbh->prepare($sql3);
        $query3->bindParam(':email3', $email3, PDO::PARAM_STR);
        $query3->execute();
        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
        if ($query3->rowCount() > 0) {
            foreach ($results3 as $result3) {
                $uid = $result3->id;
            }
        }

        $image1 = $_FILES["img1"]["name"];
        $status = 0;

        move_uploaded_file($_FILES["img1"]["tmp_name"], "assets/img/postimages/" . $_FILES["img1"]["name"]);

        $sql = "INSERT INTO posts(title,category,grabber,description,username,image1,userid,status) VALUES(:title,:cat,:grabber,:description,:username,:image1,:uid,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':cat', $cat, PDO::PARAM_STR);
        $query->bindParam(':grabber', $grabber, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':image1', $image1, PDO::PARAM_STR);
        $query->bindParam(':uid', $uid, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);

        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Blog submitted successfully, wait for approval');document.location = 'blog.php';</script>";
        } else {
            echo "<script>alert('Something went wrong')</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Ostruct - Add Post</title>
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


        <script src="assets/js/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea'
            });
        </script>

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


        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mt-5 mx-auto">
                    <h2 class="post-title">Add a post</h2>
                    <form id="contactForm" method="post" enctype="multipart/form-data">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" id="title" required placeholder="Title" name="title">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="select1"><strong>Select Category</strong></label>
                                <select class="form-control" id="select1" name="selectcat" required>
                                    <option value="">-- Select --</option>
                                    <?php $ret = "SELECT `id`,`catname` FROM `categories`";
                                    $query = $dbh->prepare($ret);
                                    //$query->bindParam(':id',$id, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                    ?>
                                            <option value="<?php echo htmlentities($result->id); ?>">
                                                <?php echo htmlentities($result->catname); ?>
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="grabber">Grabber</label>
                                <input class="form-control" type="text" id="grabber" required placeholder="Grabber" name="grabber">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="file1">Add an image</label>
                                <input type="file" class="form-control-file" id="file1" name="img1">
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls">
                                <label for="desc">Description</label>
                                <textarea id="desc" rows="5" name="description"></textarea>
                            </div>
                        </div>
                        <?php
                        $email = $_SESSION['login'];
                        $sql2 = "SELECT fname,lname,id FROM users WHERE email=:email ";
                        $query = $dbh->prepare($sql2);
                        $query->bindParam(':email', $email, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result2) {
                                $name = $result2->fname . " " . $result2->lname;
                        ?>
                                <div class="control-group">
                                    <div class="form-group floating-label-form-group controls">
                                        <label for="name">Username</label>
                                        <input class="form-control" type="text" id="name" required name="name" value="<?php echo htmlentities($name); ?>">
                                    </div>
                                </div>
                        <?php }
                        }
                        ?>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right" id="sendMessageButton" type="submit" name="submit">Post
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