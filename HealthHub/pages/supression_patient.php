<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

$id_Patient = $_GET['id_Patient'];

// Delete associated records in the creneau table
$queryDeleteCreneau = "DELETE FROM creneau WHERE id_Patient = :id_Patient";
$stmtDeleteCreneau = $pdo->prepare($queryDeleteCreneau);
$stmtDeleteCreneau->bindParam(':id_Patient', $id_Patient);
$stmtDeleteCreneau->execute();

// Then delete the patient
$queryDeletePatient = "DELETE FROM patient WHERE id_Patient = :id_Patient";
$stmtDeletePatient = $pdo->prepare($queryDeletePatient);
$stmtDeletePatient->bindParam(':id_Patient', $id_Patient);
$stmtDeletePatient->execute();

$_POST["affichage"]=="Affichage des patients";
// Redirection vers la page d'accueil
header("Location: pAffichage0.php?tab=patient"); // Assuming index.php is your home page
exit;
?>