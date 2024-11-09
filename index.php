<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Register Form -->
        <div class="form-container" id="register-container">
            <h1>Register</h1>
            <form action="register.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Register</button>
                <p id="registerMessage">
                    <?php
                    if (isset($_GET['register_message'])) {
                        echo $_GET['register_message'];
                    }
                    ?>
                </p>
            </form>
        </div>

        <!-- Login Form -->
        <div class="form-container" id="login-container">
            <h1>Login</h1>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p id="loginMessage">
                    <?php
                    if (isset($_GET['login_message'])) {
                        echo $_GET['login_message'];
                    }
                    ?>
                </p>
            </form>
        </div>
    </div>
</body>
</html>
