<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

$heureDEB = $_GET['heureDEB'];
$id_med = $_GET['id_med'];
$DateJour = $_GET['DateJour'];

// Delete creneau table
$queryDeleteCreneau = "DELETE FROM creneau WHERE id_med = :id_med AND DateJour = :DateJour AND heureDEB = :heureDEB";
$stmtDeleteCreneau = $pdo->prepare($queryDeleteCreneau);
$stmtDeleteCreneau->bindParam(':id_med', $id_med);
$stmtDeleteCreneau->bindParam(':DateJour', $DateJour);
$stmtDeleteCreneau->bindParam(':heureDEB', $heureDEB);
$stmtDeleteCreneau->execute();


// Redirection vers la page d'accueil
header('Location: pAffichage1.php?tab=creneau');
exit;