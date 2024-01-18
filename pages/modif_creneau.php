<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

// Récupération de l'ID du créneau à modifier
$id_med = $_POST['id_med'];
// Récupération des données du formulaire
$DateJour = $_POST['DateJour'];
$heureDEB = $_POST['heureDEB'];
$Duree = $_POST['Duree'];
$id_Patient = $_POST['id_Patient'];

// Validation des données
// TODO: implémenter la validation des données

// Suppression du créneau existant
$queryDelete = "DELETE FROM creneau WHERE id_med = :id_med";
$stmtDelete = $pdo->prepare($queryDelete);
$stmtDelete->bindParam(':id_med', $id_med);
$stmtDelete->execute();

// Insertion du nouveau créneau dans la base de données
$queryInsert = "INSERT INTO creneau (id_med, DateJour, heureDEB, Duree, id_Patient) VALUES (:id_med, :DateJour, :heureDEB, :Duree, :id_Patient)";
$stmtInsert = $pdo->prepare($queryInsert);
$stmtInsert->execute([
    'id_med' => $id_med,
    'DateJour' => $DateJour,
    'heureDEB' => $heureDEB,
    'Duree' => $Duree,
    'id_Patient' => $id_Patient
]);

// Redirection vers la page d'accueil
header('Location: pAffichage1.php');
exit();
?>