<?php
session_start();
include 'db_connection.php';
 
// Überprüfen, ob der Benutzer Administrator oder Superadmin ist
if ($_SESSION['role'] !== 'Admin' && $_SESSION['role'] !== 'Superadmin') {
    header('Location: login_user.php'); // Umleitung zur Anmeldeseite, wenn der Benutzer nicht berechtigt ist
    exit();
}
 
// Benutzerliste abrufen
$sql = "SELECT user_id, vorname, nachname, role, email, telefonnummer FROM users";
$result = $conn->query($sql);
 
// Benutzer löschen, wenn die ID übergeben wurde
if (isset($_GET['delete_user_id'])) {
    $user_id = $_GET['delete_user_id'];
    $delete_sql = "DELETE FROM users WHERE user_id = ?"; // SQL-Abfrage zum Löschen des Benutzers
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    header('Location: benutzer_bearbeiten.php'); // Umleitung nach dem Löschen
    exit();
}
 
// Benutzerdaten aktualisieren
if (isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $telefonnummer = $_POST['telefonnummer'];
 
    $update_sql = "UPDATE users SET vorname=?, nachname=?, role=?, email=?, telefonnummer=? WHERE user_id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssi", $vorname, $nachname, $role, $email, $telefonnummer, $user_id);
    if ($stmt->execute()) {
        header('Location: benutzer_bearbeiten.php'); // Umleitung nach der Aktualisierung
        exit();
    } else {
        echo "Fehler beim Aktualisieren: " . htmlspecialchars($stmt->error); // Fehlerausgabe, falls die Aktualisierung fehlschlägt
    }
}
?>
 
<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>Benutzerverwaltung</title>
<link rel="stylesheet" href="benutzer_dinste.css"> <!-- CSS-Datei für das Styling -->
</head>
<body>
<h1>Benutzerverwaltung</h1>
 
<table>
<tr>
<th>Vorname</th>
<th>Nachname</th>
<th>Rolle</th>
<th>E-Mail</th>
<th>Telefonnummer</th>
<th>Aktionen</th>
</tr>
<?php while ($user = $result->fetch_assoc()): ?> <!-- Benutzerinformationen aus der Datenbank abrufen -->
<tr>
<form action="" method="POST"> <!-- Formular zum Aktualisieren der Benutzerdaten -->
<td><input type="text" name="vorname" value="<?php echo htmlspecialchars($user['vorname']); ?>" required></td>
<td><input type="text" name="nachname" value="<?php echo htmlspecialchars($user['nachname']); ?>" required></td>
<td><input type="text" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" required></td>
<td><input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required></td>
<td><input type="text" name="telefonnummer" value="<?php echo htmlspecialchars($user['telefonnummer']); ?>" required></td>
<td>
<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['user_id']); ?>"> <!-- Benutzer-ID für das Update -->
<button type="submit" name="update_user">Aktualisieren</button> <!-- Knopf zum Aktualisieren -->
<a href="?delete_user_id=<?php echo htmlspecialchars($user['user_id']); ?>">L&ouml;schen</a> <!-- Link zum Löschen -->
</td>
</form>
</tr>
<?php endwhile; ?>
</table>
 
<a href="admin_dashboard.php">Zur&uuml;ck zum Admin-Dashboard</a> <!-- Link zurück zum Admin-Dashboard -->
</body>
</html>
 
<?php $conn->close(); ?> <!-- Verbindung zur Datenbank schließen -->