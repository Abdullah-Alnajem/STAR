<?php
// Daten für das Impressum
$company_name = "Mustermann GmbH";
$address = "Musterstraße 1";
$postal_code = "12345";
$city = "Musterstadt";
$country = "Deutschland";
$phone = "+49 123 456789";
$email = "info@mustermann.de";
$website = "www.mustermann.de";
$representative = "Max Mustermann";
$register_court = "Amtsgericht Musterstadt";
$register_number = "HRB 12345";
$vat_id = "DE123456789";
$liability = "Für den Inhalt externer Links übernehmen wir keine Haftung.";
$copyright = "Alle Inhalte sind urheberrechtlich geschützt.";
?> 



<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impressum</title>
    <link rel="stylesheet" href="styles_impressum.css">
    
</head>

<body>

<header>
        <h1>Impressum</h1>
        <nav>
            <button onclick="window.location.href='Home.php';">Home</button>

            
        </nav>
    </header>



    <div class="container">
        <h1>Impressum</h1>



        <h2>Angaben gemäß § 5 TMG:</h2>

        <p>
            <?php echo $company_name; ?><br>
            <?php echo $address; ?><br>
            <?php echo $postal_code . ", " . $city; ?><br>
            <?php echo $country; ?>
        </p>

        <p>
            <h2>Kontakt:</h2>
            Telefon: <?php echo $phone; ?><br>
            E-Mail: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a><br>
            Website: <a href="http://<?php echo $website; ?>"><?php echo $website; ?></a>
        </p>

        <p>
            <h2>Vertreten durch:</h2>
            <?php echo $representative; ?>
        </p>

        <p>
            <h2>Registereintrag:</h2>
            Eingetragen im <?php echo $register_court; ?> unter der Registernummer <?php echo $register_number; ?>.
        </p>

        <p>
            <h2>Umsatzsteuer-ID:</h2>
            <?php echo $vat_id; ?>
        </p>

        <p>
            <h2>Haftungsausschluss:</h2>
            <?php echo $liability; ?>
        </p>

        <p>
            <h2>Urheberrecht:</h2>
            <?php echo $copyright; ?>
        </p>


    </div>

</body>
</html>