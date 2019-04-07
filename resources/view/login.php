<?php

require_once __DIR__ . '/../../config/config.php';

use App\Http\Controller\Login;

$app = new Login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app->postProcess($_REQUEST);
} else {
    $app->run();
}

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>Log In</title>
</head>
<body>
<div class="container">
    <h1 class="display-4 border border-top-0 border-right-0 border-left-0 border-secondary pb-3 mb-3">Log In</h1>
    <?php if ($app->getErrors('login')): ?>
        <p class="alert alert-danger"><?= $app->getErrors('login') ?></p>
    <?php endif; ?>
        <form method="post" action="" id="login">
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <p>
                    <input type="text" name="email" placeholder="enter email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </p>
                <label for="exampleInputPassword1">Password</label>
                <p>
                    <input type="password" name="password" placeholder="enter password" class="form-control" id="exampleInputPassword1">
                </p>
             </div>
             <button type="button" class="btn btn-primary" onclick="document.getElementById('login').submit();">Log In</button>
             <p><a href="/signup.php" class="px-2">Sign Up</a></p>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
        </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>

