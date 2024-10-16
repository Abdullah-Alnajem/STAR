<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud-Speicher (5 TB)</title>
    <link rel="stylesheet" href="styles_Angebot.css">
    <script>
        function calculatePrice() {
            const packages = parseInt(document.getElementById('packages').value) || 0;
            const users = parseInt(document.getElementById('users').value) || 0;
            const basePrice = 450;
            let totalPrice = basePrice * packages;

            const includedUsers = packages * 10;
            const additionalUsers = users - includedUsers;

            if (additionalUsers > 0) {
                if (additionalUsers <= 25) {
                    totalPrice += additionalUsers * 45;
                } else if (additionalUsers <= 50) {
                    totalPrice += 25 * 45 + (additionalUsers - 25) * 32;
                } else {
                    totalPrice += 25 * 45 + 25 * 32 + (additionalUsers - 50) * 18;
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
        <h1>Cloud-Speicher (5 TB)</h1>
        <nav>
            <button onclick="window.location.href='Home.php';">Zur&uuml;ck</button>
        </nav>
    </header>

    <section class="cloud-storage-details">
        <h2>Details zu diesem Angebot</h2>
        <p>Kosten: 450 Euro pro Paket (10 Benutzer enthalten)</p>
       
        <h3>Bestellung aufgeben</h3>
        <label for="packages">Anzahl der Pakete:</label>
        <input type="number" id="packages" value="1" min="1" onchange="calculatePrice()">

        <label for="users">Anzahl der Benutzer:</label>
        <input type="number" id="users" value="10" min="10" onchange="calculatePrice()">

        <h3 id="totalPrice">Gesamtpreis: 450 Euro</h3>

        <form action="place_order.php" method="POST">
            <input type="hidden" id="totalPriceInput" name="totalPrice" value="450">
            <input type="hidden" id="packagesInput" name="packages" value="1">
            <input type="hidden" id="usersInput" name="users" value="10">
            
            <input type="hidden" name="artikel_name" value="Cloud-Speicher 5GB">
            <input type="hidden" name="grosse" value="5GB">
            <input type="hidden" name="base_price" value="450"> 
            
            <button type="submit">Bestellung aufgeben</button>
        </form>
    </section>

</body>
</html>
