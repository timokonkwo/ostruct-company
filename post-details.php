<?php
session_set_cookie_params(0);
session_start();
include('includes/config.php');
error_reporting(0);
$_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];

if (isset($_POST['submit'])) {
    $name2 = $_POST['name'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $postid = intval($_GET['id']);
    $st1 = '0';
    $sql = "INSERT INTO comments(`postid`,`name`,`email`,`comment`,`status`) VALUES(:postid,:name2,:email,:comment,:st1)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':postid', $postid, PDO::PARAM_STR);
    $query->bindParam(':name2', $name2, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':comment', $comment, PDO::PARAM_STR);
    $query->bindParam(':st1', $st1, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Comment submitted, wait for approval');</script>";
    } else {
        echo "<script>alert('Something went wrong');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Add Post</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Ostruct Structural engineers" name="keywords">
        <meta content="Ostruct Construction Company" name="description">

        <!-- Favicon -->
        <link href="assets/img/favicon/favicon.ico" rel="icon">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/site.webmanifest">

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



        <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">

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

    <?php
    $id = intval($_GET['id']);
    $s = 1;
    $sql1 = "SELECT posts.*,categories.catname,categories.id AS cid FROM posts JOIN categories ON categories.id=posts.category WHERE posts.id=:id AND posts.status=:s";
    $query = $dbh->prepare($sql1);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':s', $s, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results

            as $result) {
    ?>
            <?php if (htmlentities($result->image1) == null) { ?>
                <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
                <?php } else { ?>
                    <header class="masthead"
                style="background-image:url('assets/img/postimages/<?php echo htmlentities($result->image1); ?>');"> -->
                <?php } ?>
                <div class="overlay"></div>
                
                <!-- Header -->

                <article>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-lg-8 mx-auto">

                                <div class="post-preview">
                                    <h2 class="post-title" style="color: #fff;"><?php echo htmlentities($result->title); ?></h2>
                                    <p class="post-meta" style="color: #fff;">Category: <?php echo htmlentities($result->catname); ?><br>
                                        Posted
                                        by&nbsp;<b><?php echo htmlentities($result->username); ?></b>
                                        on <?php echo htmlentities($result->creationdate); ?>
                                    </p>
                                    <p style="font-weight: bold; color: #fff"><?php echo htmlentities($result->grabber); ?></p>
                                    <?php if (htmlentities($result->image1) == null) {
                                    } else { ?>
                                        <p><img class="img-fluid" src="assets/img/postimages/<?php echo htmlentities($result->image1); ?>" width="auto" height="auto" style="border:solid 1px #000"></p>
                                    <?php } ?>
                                    <p style="text-align: justify; color: #fff;"><?php echo htmlentities($result->description); ?></p>
                                    <p class="post-meta" style="color: #fff";>Posted by&nbsp;<?php echo htmlentities($result->username); ?>
                                        on <?php echo htmlentities($result->creationdate); ?>
                                    </p>
                                </div>
                        <?php }
                } ?>

                            </div>

                            <!--Display Comments-->
                            <div class="col-md-10 col-lg-8 mx-auto">
                                <?php
                                $pid = intval($_GET['id']);
                                $sts = 1;
                                $sql3 = "SELECT `name`,`comment`,`postingdate` FROM comments WHERE postid=:pid AND status=:sts";
                                $query = $dbh->prepare($sql3);
                                $query->bindParam(':pid', $pid, PDO::PARAM_STR);
                                $query->bindParam(':sts', $sts, PDO::PARAM_STR);
                                $query->execute();
                                $results3 = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($results3

                                        as $result3) {
                                ?>
                                        <div class="card my-4">
                                            <h5 class="card-header">Comments</h5>
                                            <div class="card-body">
                                                <div class="media-body">
                                                    <h6><?php echo htmlentities($result3->name); ?> <br />
                                                        <span style="font-size:11px;"><b>commented at</b> <?php echo htmlentities($result3->postingdate); ?></span>
                                                    </h6>
                                                    <div style="font-size: 18px;">
                                                        Comment: <?php echo htmlentities($result3->comment); ?></div>
                                                </div>

                                            </div>
                                        </div>
                                <?php
                                        $cnt++;
                                    }
                                } ?>
                            </div>
                            <!--Display Comments-->

                            <!--Post comment-->
                            <div class="col-md-10 col-lg-8 mx-auto">
                                <div class="card my-4">
                                    <h5 class="card-header">Leave a Comment:</h5>
                                    <div class="card-body">
                                        <form name="Comment" method="post">
                                            <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                                            <div class="form-group">
                                                <?php if ($_SESSION['login']) {
                                                    $email = $_SESSION['login'];
                                                    $sql2 = "SELECT fname,lname FROM users WHERE email=:email";
                                                    $query = $dbh->prepare($sql2);
                                                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $result2) {
                                                            $name = $result2->fname . " " . $result2->lname;
                                                ?>
                                                            <input type="text" name="name" value="<?php echo htmlentities($name); ?>" class="form-control" required>
                                                    <?php }
                                                    }
                                                } else { ?>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter your fullname" autocomplete="off" required>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <?php if ($_SESSION['login']) {
                                                ?>
                                                    <input type="email" name="email" value="<?php echo $_SESSION['login']; ?>" class="form-control" placeholder="Enter your Valid email" autocomplete="off" required>
                                                <?php } else { ?>
                                                    <input type="email" name="email" value="" class="form-control" placeholder="Enter your Valid email" autocomplete="off" required>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
                                            </div>
                                            <?php if ($_SESSION['login']) {
                                            ?>
                                                <button type="submit" class="btn btn-primary float-right" name="submit">Submit
                                                </button>
                                            <?php } else { ?>
                                                <a href="login.php" class="btn btn-primary float-right">Log in & Comment</a>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-8 mx-auto">
                                <br>
                            </div>
                            <!--Post comment-->

                        </div>
                </article>
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