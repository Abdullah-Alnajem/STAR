
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles_Anmelden.css">
</head>
<body>

    <header>
        <h1>Cloud Services Login</h1>
    </header>

    <section class="login-section">
        <div class="login-container">
            <h2>Login</h2>
            <form action="login_user.php" method="POST">
                <label for="benutzername_email">Benutzername / E-Mail:</label>
                <input type="text" id="benutzername_email" name="benutzername_email" required><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>
                <button type="submit">Login</button>
            </form>
            <p class="register-link">noch nicht Registriert? Registrieren als <a href="Privat.php">Privat</a> oder <a href="Firma.php">Firma</a></p>
        </div>
    </section>

</body>
</html>
