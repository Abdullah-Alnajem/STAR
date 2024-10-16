<?php
session_start();
include 'db_connection.php';

// Überprüfen, ob der Benutzer Admin oder Superadmin ist
if ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Superadmin') {
    header('Location: login_user.php');
    exit();
}

// Artikelliste abrufen
$sql = "SELECT Artikel_ID, Artikelname, Benutzeranzahl, Grosse, Zusatzanzahl, Zusatzpreis FROM Artikel";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Dienste verwalten</title>
    <link rel="stylesheet" href="benutzer_dinste.css">
</head>
<body>
    <h1>Dienste verwalten</h1>

    <table border="1">
        <tr>
            <th>Artikel ID</th>
            <th>Artikelname</th>
            <th>Benutzeranzahl</th>
            <th>Gr&ouml;sse (GB)</th>
            <th>Zusatzanzahl</th>
            <th>Zusatzpreis (Euro)</th>
            <th>Aktionen</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['Artikel_ID']; ?></td>
                <td><?php echo $row['Artikelname']; ?></td>
                <td><?php echo $row['Benutzeranzahl']; ?></td>
                <td><?php echo $row['Grosse']; ?></td>
                <td><?php echo $row['Zusatzanzahl']; ?></td>
                <td><?php echo $row['Zusatzpreis']; ?></td>
                <td>
                    <a href="dienst_bearbeiten.php?Artikel_ID=<?php echo $row['Artikel_ID']; ?>">Bearbeiten</a> 
                   
            </tr>
        <?php } ?>
    </table>

    <a href="admin_dashboard.php">Zur&uuml;ck zum Dashboard</a>
</body>
</html>

<?php $conn->close(); ?>
