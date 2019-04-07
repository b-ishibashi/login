<?php

require_once __DIR__ . '/../../config/config.php';

use App\Http\Controller\SignUp;

$app = new SignUp();

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

    <title>Sign Up</title>
</head>
<body>
<div class="container">
    <h1 class="display-4 border border-top-0 border-right-0 border-left-0 border-secondary pb-3 mb-3">Sign Up</h1>
    <?php if ($app->getErrors('email')): ?>
        <p class="alert alert-danger"><?= $app->getErrors('email') ?></p>
    <?php elseif ($app->getErrors('password')): ?>
        <p class="alert alert-danger"><?= $app->getErrors('password') ?></p>
    <?php endif; ?>
    <form method="post" action="" id="signup">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <p>
                <input type="text" name="email" placeholder="enter email" class="form-control" value="<?= isset($app->getValues()->email) ? h($app->getValues()->email) : '' ?>">
            </p>
            <label for="exampleInputPassword1">Password</label>
            <p>
                <input type="password" name="password" placeholder="enter password" class="form-control">
            </p>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="agree">
            Agree <a href="/policy.php"><label class="form-check-label" for="exampleCheck1">this policy</label></a>
        </div>
        <button id="submitbtn" type="button" class="btn btn-primary" disabled onclick="document.getElementById('signup').submit();">Sign Up</button>
        <p><a href="/login.php" class="px-3">Log In</a></p>
        <input type="hidden" name="token" value="<?= h($_SESSION['token']) ?>">
    </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
    $(function () {
        $('#agree').on('change', function() {
            if ($(this).is(':checked')) {
                // チェックが入ったらボタンを押せる
                $('#submitbtn').prop('disabled', false);
            } else {
                $('#submitbtn').prop('disabled', true);
            }
        });
    });
</script>
</body>
</html>

