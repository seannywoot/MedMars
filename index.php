<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GC-MedMaRS</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>  
<div class="container" id="container">
<div class="form-container log-in">
    <form action="login.php" method="post">
        <h1>Login</h1>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php }?>

        <label>Name</label>
        <input type="text" name="uname" placeholder="Name">

        <label>Password</label>
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Login</button>
    </form>
    </div>
    <div class="toggle-container">
    <div class="toggle">
    <div class="toggle-panel toggle-right">
        <div class="logo">
        <img src="assets/logo.png" alt="logo">
        <img src="assets/CCS logo.jpg" alt="ccs-logo">
        </div>
        <h1>Welcome Admin!</h1>
        <p>Enter your Admin account to use the site features</p>
    </div>
    </div>
    </div>
</div>
<div class="wrapper">
    <div class="box">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
</body>
</html>
<?php 

?>