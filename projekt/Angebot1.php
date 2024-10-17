<?php
session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud-Speicher (10 GB)</title>
    <link rel="stylesheet" href="styles_Angebot.css">
    <script>
        function calculatePrice() {
            const packages = parseInt(document.getElementById('packages').value) || 0;
            const users = parseInt(document.getElementById('users').value) || 0;
            const basePrice = 5; // ÇáÓÚÑ ÇáÃÓÇÓí áßá ÍÒãÉ
            let totalPrice = basePrice * packages;

            const additionalUsers = users - packages;
            if (additionalUsers > 0) {
                if (additionalUsers <= 4) {
                    totalPrice += additionalUsers * 2;
                } else if (additionalUsers <= 9) {
                    totalPrice += 4 * 2 + (additionalUsers - 4) * 1.5;
                } else {
                    totalPrice += 4 * 2 + 5 * 1.5 + (additionalUsers - 9) * 1;
                }
            }

            
            document.getElementById('totalPrice').innerText = `Gesamtpreis: ${totalPrice.toFixed(2)} Euro`;

            
            document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);
            document.getElementById('packagesInput').value = packages;
            document.getElementById('usersInput').value = users;
        }
    </script>
</head>
<body>

    <header>
        <h1>Cloud-Speicher (10 GB)</h1>
        <nav>
            <button onclick="window.location.href='Home.php';">Zur&uuml;ck</button>
        </nav>
    </header>

    <section class="cloud-storage-details">
        <h2>Details zu diesem Angebot</h2>
        <p>Kosten: 5 Euro f&uuml;r einen Benutzer pro Paket</p>
       
        <h3>Bestellung aufgeben</h3>
        <label for="packages">Anzahl der Pakete:</label>
        <input type="number" id="packages" value="1" min="1" onchange="calculatePrice()">

        <label for="users">Anzahl der Benutzer:</label>
        <input type="number" id="users" value="1" min="1" onchange="calculatePrice()">

        <h3 id="totalPrice">Gesamtpreis: 5 Euro</h3>

        
        <form action="place_order.php" method="POST">
            
            <input type="hidden" id="totalPriceInput" name="totalPrice" value="5">
            <input type="hidden" id="packagesInput" name="packages" value="1">
            <input type="hidden" id="usersInput" name="users" value="1">

            
            <input type="hidden" name="artikel_name" value="Cloud-Speicher 10GB">
            <input type="hidden" name="grosse" value="10 GB">
            <input type="hidden" name="base_price" value="5"> 

            <button type="submit">Bestellung aufgeben</button>
        </form>
    </section>
<?php
 
if (isset($_SESSION["username"])){
echo "Angemeldet als " . $_SESSION["username"] . ".";
}
?>
</body>
</html>
