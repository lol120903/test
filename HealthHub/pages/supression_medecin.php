<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);


$id_med = $_GET['id_med'];

// Delete creneau table
$queryDeleteCreneau = "DELETE FROM creneau WHERE id_med = :id_med";
$stmtDeleteCreneau = $pdo->prepare($queryDeleteCreneau);
$stmtDeleteCreneau->bindParam(':id_med', $id_med);
$stmtDeleteCreneau->execute();

// delete the medecin
$queryDeleteMedecin = "DELETE FROM medecin WHERE id_med = :id_med";
$stmtDeleteMedecin = $pdo->prepare($queryDeleteMedecin);
$stmtDeleteMedecin->bindParam(':id_med', $id_med);
$stmtDeleteMedecin->execute();

// Redirection vers la page d'accueil
header('Location: pAffichage2.php?tab=medecin');
exit;