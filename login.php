<!DOCTYPE html>
<html>
<head>
    <title>Order App</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background: #f4f5f6;">
    <div class="container">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
            <h3 class="text-center" style="margin-top: 50px;">Login</h3>
            <hr>
            <?php if (isset($_GET['error']) == 1): ?>
                <div class="alert alert-danger">Invalid credentials</div>
            <?php endif; ?>

            <form action="loginCheck.php" method="post">
                <input type="text" name="username" class="form-control" placeholder="Username = demo">
                <input type="password" name="password" class="form-control" placeholder="Password = pass">
                <br>
                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
