<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firmenregistrierung</title>
    <link rel="stylesheet" href="styles_Firma.css">
</head>
<body>

    <header>
        <h1>Firmenregistrierung</h1>
    </header>

    <section class="register-section">
        <h2>Registrieren f&uuml;r Unternehmen</h2>
        <form action="insert_user_u.php" method="POST">
            
            <div class="form-group">
                <label for="firma">Firmenname:</label>
                <input type="text" id="firma" name="firma" required>
            </div>

            <div class="form-group">
                <label for="contact_name">Ansprechpartner:</label>
                <br/>
                <label for="vorname">Vorname:</label>
                <input type="text" id="vorname" name="vorname" required>
                <label for="nachname">Nachname:</label>
                <input type="text" id="nachname" name="nachname" required>
            </div>

            <div class="form-group">
                <label for="geschlecht">Geschlecht:</label>
                <select id="geschlecht" name="geschlecht" required>
                    <option value="m&auml;nnlich">M&auml;nnlich</option>
                    <option value="weiblich">Weiblich</option>
                    <option value="divers">Divers</option>
                    <option value="fahrstuhl">Fahrstuhl</option>
                    
                </select>
            </div>
            
            <div class="form-group">
                <label for="username">Benutzername:</label>
                <input type="text" id="username" name="benutzername" required>
            </div>
            
            <div class="form-group">
                <label for="email">Firmen-E-Mail:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm_password">Passwort wiederholen:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>

            <div class="form-group">
                <label for="strasse">Stra&szlig;e:</label>
                <input type="text" id="strasse" name="strasse" required>
            </div>

            <div class="form-group">
                <label for="hausnummer">Hausnummer:</label>
                <input type="text" id="hausnummer" name="hausnummer" required>
            </div>

            <div class="form-group">
                <label for="plz_id">Postleitzahl:</label>
                <input type="text" id="plz_id" name="plz_id" required>
            </div>

            <div class="form-group">
                <label for="payment_method">Zahlungsmethode:</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="iban">IBAN</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <div class="form-group">
                <label for="telefonnummer">Firmentelefonnummer:</label>
                <input type="tel" id="telefonnummer" name="telefonnummer" required>
            </div>

            <button type="submit" class="submit-btn">Registrieren</button>
        </form>
    </section>

</body>
</html>
