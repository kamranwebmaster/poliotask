<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm" style="width: 24rem;">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Login</h4>

            <!-- Error Message -->
 
            <?php if (session()->get('login_error')): ?>
                <div class="alert alert-danger">
                    <?= session()->get('login_error') ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/do_login">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="user_email" id="user_email" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
