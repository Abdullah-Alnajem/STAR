<?php
session_start();
include 'db_connection.php';

if ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Superadmin') {
    header('Location: login_user.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Admin-Dashboard</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
<header>
    <h1>Admin-Dashboard</h1>
</header>

<section>
    <h2 style="text-align: center;">Verwaltung</h2>
    <div class="button-container">
        <a href="benutzer_liste.php" class="button big-button">
            <img src="user.png" alt="Benutzer" class="button-icon"> 
            Benutzer anzeigen und verwalten
        </a>
        <a href="dienste_verwalten.php" class="button big-button">
            <img src="dinste.png" alt="Dienste" class="button-icon"> 
            Dienste anzeigen und bearbeiten
        </a>
    </div>

    <div class="button-container">
        <a href="logout.php" class="button">Abmelden</a>
        <a href="home.php" class="button">Zur&uuml;ck zur Startseite</a>
    </div>
</section>
</body>
</html>
