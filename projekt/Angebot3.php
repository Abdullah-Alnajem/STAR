<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud-Speicher (1 TB)</title>
    <link rel="stylesheet" href="styles_Angebot.css">
    <script>
        function calculatePrice() {
            const packages = parseInt(document.getElementById('packages').value) || 0;
            const users = parseInt(document.getElementById('users').value) || 0;
            const basePrice = 225;
            let totalPrice = basePrice * packages;

            const includedUsers = packages * 5;
            const additionalUsers = users - includedUsers;

            if (additionalUsers > 0) {
                if (additionalUsers <= 15) {
                    totalPrice += additionalUsers * 40;
                } else if (additionalUsers <= 40) {
                    totalPrice += 15 * 40 + (additionalUsers - 15) * 30;
                } else {
                    totalPrice += 15 * 40 + 25 * 30 + (additionalUsers - 40) * 20;
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
        <h1>Cloud-Speicher (1 TB)</h1>
        <nav>
            <button onclick="window.location.href='Home.php';">Zur&uuml;ck</button>
        </nav>
    </header>

    <section class="cloud-storage-details">
        <h2>Details zu diesem Angebot</h2>
        <p>Kosten: 225 Euro pro Paket (5 Benutzer enthalten)</p>
       
        <h3>Bestellung aufgeben</h3>
        <label for="packages">Anzahl der Pakete:</label>
        <input type="number" id="packages" value="1" min="1" onchange="calculatePrice()">

        <label for="users">Anzahl der Benutzer:</label>
        <input type="number" id="users" value="5" min="5" onchange="calculatePrice()">

        <h3 id="totalPrice">Gesamtpreis: 225 Euro</h3>

        <form action="place_order.php" method="POST">
            <input type="hidden" id="totalPriceInput" name="totalPrice" value="225">
            <input type="hidden" id="packagesInput" name="packages" value="1">
            <input type="hidden" id="usersInput" name="users" value="5">
            
            <input type="hidden" name="artikel_name" value="Cloud-Speicher 1TB">
            <input type="hidden" name="grosse" value="1 GB">
            <input type="hidden" name="base_price" value="225"> 
            
            <button type="submit">Bestellung aufgeben</button>
        </form>
    </section>

</body>
</html>
