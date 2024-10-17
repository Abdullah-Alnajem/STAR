<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud-Dienste</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Willkommen bei unseren Cloud-Diensten</h1>
        <nav>
            <button onclick="window.location.href='Anmelden.php';">Anmelden / Registrieren</button>
            <button onclick="window.location.href='AGB.php';">AGB</button>
            <button onclick="window.location.href='FAQ.php';">FAQs</button>
            <?php
            // ?berpr?fen, ob der Benutzer eingeloggt ist und die Rolle Admin hat
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                echo '<button onclick="window.location.href=\'admin_dashboard.php\';">Admin Dashboard</button>';
            }
            ?>
        </nav>
    </header>

    <section class="cloud-services">
        <h2>Unsere Cloud-Dienste</h2>
        <div class="services-container">
            <div class="service" onclick="window.location.href='Angebot1.php';">
                <h3>Speicher 10 GB</h3>
                <ul>
                    <li><b>Kosten: 5 Euro 1 Benutzer</b></li>
                    
                    <ul class="benutzer">
                        <li><b>Zus&auml;tzliche Benutzer:</b></li> 
                        <li>2 Euro    (1. Benutzer)</li>
                        <li>1,50 Euro (5. Benutzer)</li>
                        <li>1 Euro    (10. Benutzer)</li>
                    </ul>
                </ul>
                <img src="images.png" alt="Cloud-Speicher 10 GB" class="service-image">
            </div>
            <div class="service" onclick="window.location.href='Angebot2.php';">
                <h3>Speicher 200 GB</h3>
                <ul>
                    <li>Kosten: 75 Euro 3 Benutzer</li>
               
                    <ul class="benutzer">
                        <li><b>Zus&auml;tzliche Benutzer:</b></li>
                        <li>20 Euro (1. Benutzer)</li>
                        <li>15 Euro (10. Benutzer)</li>
                        <li>10 Euro (25. Benutzer)</li>
                    </ul>
                </ul>
                <img src="images1.png" alt="Cloud-Speicher 200 GB" class="service-image">
            </div>
            <div class="service" onclick="window.location.href='Angebot3.php';">
                <h3>Speicher 1 TB</h3>
                <ul>
                    <li>Kosten: 225 Euro 5 Benutzer</li>
                    
                    <ul class="benutzer">
                        <li><b>Zus&auml;tzliche Benutzer:</b></li>
                        <li>40 Euro (1. Benutzer)</li>
                        <li>30 Euro (15. Benutzer)</li>
                        <li>20 Euro (40. Benutzer)</li>
                    </ul>
                </ul>
                <img src="images3.png" alt="Cloud-Speicher 1 TB" class="service-image">
            </div>
            <div class="service" onclick="window.location.href='Angebot4.php';">
                <h3>Speicher 5 TB</h3>
                <ul>
                    <li>Kosten: 450 Euro 10 Benutzer</li>
                    
                    <ul class="benutzer">
                        <li><b>Zus&auml;tzliche Benutzer:</b></li>
                        <li>45 Euro (1. Benutzer)</li>
                        <li>32 Euro (25. Benutzer)</li>
                        <li>18 Euro (50. Benutzer)</li>
                    </ul>
                </ul>
                <img src="images2.png" alt="Cloud-Speicher 5 TB" class="service-image">
            </div>
        </div>
    </section>

</body>
</html>
<?php
 
if (isset($_SESSION["username"])){
echo "Angemeldet als " . $_SESSION["username"] . ".";
}
?>