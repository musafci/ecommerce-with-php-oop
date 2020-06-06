<?php
include '../class/Adminlogin.php';
?>

<?php
$obj = new Adminlogin;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $adminUser = $_POST['adminUser'];
    $adminPass = md5($_POST['adminPass']);
    
    $loginCheck = $obj->adminLogin($adminUser, $adminPass);
}
?>




<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
    <div class="container">
        <section id="content">
            <form action="login.php" method="post">
                <h1>Admin Login</h1>
                <span style="color: red;font-size: 18px;text-align: center;">
                    <?php
                    if (isset($loginCheck)) {
                        echo $loginCheck;
                    }
                    ?>
                </span>
                <div>
                    <input type="text" name="adminUser" placeholder="Username"/>
                </div>
                <div>
                    <input type="password" name="adminPass" placeholder="Password"/>
                </div>
                <div>
                    <input type="submit" name="btn" value="Log in" />
                </div>
            </form><!-- form -->
            <div class="button">
                <a href="#">Training with live project</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>