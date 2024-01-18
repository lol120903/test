<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

$id_Patient = $_POST['id_Patient'];
// Récupération des données du formulaire
$num_sécurité_sociale = $_POST['num_sécurité_sociale'];
$civilité = $_POST['civilité'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$date_naissance = $_POST['date_naissance'];
$lieu_naissance = $_POST['lieu_naissance'];

// Validation des données
// TODO: implémenter la validation des données

// Suppression du patient dans la base de données
$query_delete_patient = "DELETE FROM patient WHERE id_Patient = :id_Patient";
$stmt_delete_patient = $pdo->prepare($query_delete_patient);
$stmt_delete_patient->bindParam(':id_Patient', $id_Patient);
$stmt_delete_patient->execute();

// Suppression des créneaux associés au patient dans la base de données
$query_delete_creneau = "DELETE FROM creneau WHERE id_Patient = :id_Patient";
$stmt_delete_creneau = $pdo->prepare($query_delete_creneau);
$stmt_delete_creneau->bindParam(':id_Patient', $id_Patient);
$stmt_delete_creneau->execute();

// Insertion du patient dans la base de données
$query_insert_patient = "INSERT INTO patient (num_sécurité_sociale, civilité, nom, prenom, adresse, date_naissance, lieu_naissance) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt_insert_patient = $pdo->prepare($query_insert_patient);
$stmt_insert_patient->execute([$num_sécurité_sociale, $civilité, $nom, $prenom, $adresse, $date_naissance, $lieu_naissance]);

;

// Redirection vers la page d'accueil
header('Location: pAffichage0.php');
exit();

/*awdaw??
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

$id_Patient = $_POST['id_Patient'];
// Récupération des données du formulaire
$num_sécurité_sociale = $_POST['num_sécurité_sociale'];
$civilité = $_POST['civilité'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$adresse = $_POST['adresse'];
$date_naissance = $_POST['date_naissance'];
$lieu_naissance = $_POST['lieu_naissance'];

// Validation des données
// TODO: implémenter la validation des données

// Suppression des créneaux associés au patient dans la base de données
$query_delete_creneau = "DELETE FROM creneau WHERE id_Patient = :id_Patient";
$stmt_delete_creneau = $pdo->prepare($query_delete_creneau);
$stmt_delete_creneau->bindParam(':id_Patient', $id_Patient);
$stmt_delete_creneau->execute();

// Mise à jour du patient dans la base de données
$query_update_patient = "UPDATE patient SET num_sécurité_sociale = :num_sécurité_sociale, civilité = :civilité, nom = :nom, prenom = :prenom, adresse = :adresse, date_naissance = :date_naissance, lieu_naissance = :lieu_naissance WHERE id_Patient = :id_Patient";
$stmt_update_patient = $pdo->prepare($query_update_patient);
$stmt_update_patient->execute([
    'num_sécurité_sociale' => $num_sécurité_sociale,
    'civilité' => $civilité,
    'nom' => $nom,
    'prenom' => $prenom,
    'adresse' => $adresse,
    'date_naissance' => $date_naissance,
    'lieu_naissance' => $lieu_naissance,
    'id_Patient' => $id_Patient
]);

// Redirection vers la page d'accueil
header('Location: pAffichage.php');
exit();
?>
*/

?>



