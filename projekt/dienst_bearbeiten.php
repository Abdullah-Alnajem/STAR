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

// Löschen eines Artikels, wenn die ID übergeben wurde
if (isset($_GET['delete_artikel_id'])) {
    $Artikel_ID = $_GET['delete_artikel_id'];
    
    // rechnung_details
    $delete_rechnung_sql = "DELETE FROM rechnung_details WHERE Artikel_ID = ?";
    $stmt = $conn->prepare($delete_rechnung_sql);
    $stmt->bind_param("i", $Artikel_ID);
    $stmt->execute();
    
    $delete_sql = "DELETE FROM Artikel WHERE Artikel_ID = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $Artikel_ID);
    $stmt->execute();
    
    header('Location: dienst_bearbeiten.php'); // zurück zur Artikelverwaltung
    exit();
}

// Artikeldaten aktualisieren
if (isset($_POST['update_artikel'])) {
    $Artikel_ID = $_POST['Artikel_ID'];
    $Artikelname = $_POST['Artikelname'];
    $Benutzeranzahl = $_POST['Benutzeranzahl'];
    $Grosse = $_POST['Grosse'];
    $Zusatzanzahl = $_POST['Zusatzanzahl'];
    $Zusatzpreis = $_POST['Zusatzpreis'];

    $update_sql = "UPDATE Artikel SET Artikelname=?, Benutzeranzahl=?, Grosse=?, Zusatzanzahl=?, Zusatzpreis=? WHERE Artikel_ID=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("siidii", $Artikelname, $Benutzeranzahl, $Grosse, $Zusatzanzahl, $Zusatzpreis, $Artikel_ID);
    if ($stmt->execute()) {
        header('Location: dienst_bearbeiten.php');
        exit();
    } else {
        echo "Fehler beim Aktualisieren: " . $conn->error;
    }
}
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
        <th>Gr&ouml;&szlig;e (GB)</th>
        <th>Zusatzanzahl</th>
        <th>Zusatzpreis (Euro)</th>
        <th>Aktionen</th>
    </tr>
    <?php while ($artikel = $result->fetch_assoc()): ?>
    <tr>
        <form action="" method="POST">
            <td><?php echo $artikel['Artikel_ID']; ?></td>
            <td><input type="text" name="Artikelname" value="<?php echo $artikel['Artikelname']; ?>" required></td>
            <td><input type="number" name="Benutzeranzahl" value="<?php echo $artikel['Benutzeranzahl']; ?>" required></td>
            <td><input type="number" name="Grosse" value="<?php echo $artikel['Grosse']; ?>" required></td>
            <td><input type="number" name="Zusatzanzahl" value="<?php echo $artikel['Zusatzanzahl']; ?>" required></td>
            <td><input type="number" name="Zusatzpreis" value="<?php echo $artikel['Zusatzpreis']; ?>" step="0.01" required></td>
            <td>
                <input type="hidden" name="Artikel_ID" value="<?php echo $artikel['Artikel_ID']; ?>">
                <button type="submit" name="update_artikel">Aktualisieren</button>
                <a href="?delete_artikel_id=<?php echo $artikel['Artikel_ID']; ?>">L&ouml;schen</a>
            </td>
        </form>
    </tr>
    <?php endwhile; ?>
</table>

<a href="admin_dashboard.php">Zur&uuml;ck zum Admin-Dashboard</a>
</body>
</html>

<?php $conn->close(); ?>
