<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

// Récupération de la licence du joueur à modfier
$id_med = $_POST['id_med'];

// Récupération des données du formulaire
// Récupération des données du formulaire
$civilite = $_POST['civilite'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$id_Patient = $_POST['id_Patient'];

// Validation des données
// TODO: implémenter la validation des données

// Insertion du joueur dans la base de données
$query = "DELETE FROM medecin WHERE id_Patient = :id_Patient";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_Patient', $id_Patient);

$stmt->execute();
$query = "INSERT INTO medecin (civilite, nom, prenom, id_Patient) VALUES (:civilite, :nom, :prenom, :id_Patient)";
//$query = "UPDATE matchs SET date = :date, heure = :heure, equipe_adverse = :equipe_adverse, lieu = :lieu where id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([
    'civilite' => $civilite,
    'nom' => $nom,
    'prenom' => $prenom,
    'id_Patient' => $id_Patient
]);

// Redirection vers la page d'accueil
header('Location: pAffichage2.php');
exit();
?>
