<div class="nav-bar">
<div class="container-fluid">
<nav class="navbar navbar-expand-lg bg-dark navbar-dark" id="mainNav">
    <div class="container">
        <a href="#" class="navbar-brand">MENU</a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <a href="#"><img src="assets/img/logo1.png" class="logo" alt=""></a>

            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="blog.php">Blog</a></li>
                <!-- <li class="nav-item" role="presentation"><a class="nav-link" href="contact.php">Contact us</a></li> -->
                <li class="nav-item" role="presentation"><a class="nav-link" href="view-posts.php">View Posts</a></li>
                <?php if (strlen($_SESSION['login']) != 0) {
                    ?>
                    <li class="nav-item dropdown" role="presentation"><a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage Posts
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="add-post.php">Add Post</a>
                            <a class="dropdown-item" href="manage-posts.php">Edit Post</a>
                        </div>
                    </li>
                <?php } else { }?>
                <?php if (strlen($_SESSION['login']) == 0) {
                    ?>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="login.php">Log in</a></li>
                <?php } else {
                    $email = $_SESSION['login'];
                    $sql = "SELECT `fname`,`lname` FROM `users` WHERE `email`=:email";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result2) {
                            ?>
                            <li class="nav-item dropdown" role="presentation">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo htmlentities($result2->fname." ".$result2->lname); ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                                    <a class="dropdown-item" href="update-password.php">Update Password</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Log out</a>
                                </div>
                            </li>
                        <?php }
                    }
                } ?>
                <?php if (strlen($_SESSION['login']) == 0) {
                ?>
                <li class="nav-item" role="presentation"><a class="nav-link" href="register.php">Register</a></li>
                <?php } else { }?>

            </ul>
        </div>
    </div>
</nav>
</div>
</div>