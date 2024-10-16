<?php
session_start();
include 'db_connection.php';

// Überprüfen, ob der Benutzer Admin oder Superadmin ist
if ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Superadmin') {
    header('Location: login_user.php');
    exit();
}

// Benutzerliste abrufen
$sql = "SELECT user_id, vorname, nachname, role, strasse, hausnummer, plz_id, email, firma, telefonnummer, geschlecht, benutzername, payment_method FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Benutzerverwaltung</title>
    <link rel="stylesheet" href="benutzer_dinste.css">
   
</head>
<body>
    <h1>Benutzerverwaltung</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Rolle</th>
            <th>Strasse</th>
            <th>Hausnummer</th>
            <th>PLZ</th>
            <th>Email</th>
            <th>Firma</th>
            <th>Telefonnummer</th>
            <th>Geschlecht</th>
            <th>Benutzername</th>
            <th>Zahlungsmethode</th>
            <th>Aktionen</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['vorname']; ?></td>
                <td><?php echo $row['nachname']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td><?php echo $row['strasse']; ?></td>
                <td><?php echo $row['hausnummer']; ?></td>
                <td><?php echo $row['plz_id']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['firma']; ?></td>
                <td><?php echo $row['telefonnummer']; ?></td>
                <td><?php echo $row['geschlecht']; ?></td>
                <td><?php echo $row['benutzername']; ?></td>
                <td><?php echo $row['payment_method']; ?></td>
                <td>
                    <a href="benutzer_bearbeiten.php?user_id=<?php echo $row['user_id']; ?>">Bearbeiten</a> 
                    
                </td>
            </tr>
        <?php } ?>
    </table>
    <button onclick="window.location.href='admin_dashboard.php';">Zur&uuml;ck zum Dashboard</button>
    
</body>
</html>

<?php $conn->close(); ?>
