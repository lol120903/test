<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Navigation.css">
    <style>
			.text{
                text-align : center;
            }
	</style>
</head>

<body>
	<nav>
            <img id="logo" src="HealHub.png">
            <ul>
                <li><a href="pLandingPatients.php">Medecin</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="dureeConsMed.php">Statistiques</a></li>
            </ul>
  </nav>

	<br><br>
    <h2 class='text'>Creneau total des medecins</h2><br>

	<table>
		<tr>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Duree Creneau total</th>

    <?php

    // Connexion à la base de données
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'gestion_patient';
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password);

    // Récupération de la liste des joueurs
    $query = "SELECT medecin.nom, medecin.prenom, SEC_TO_TIME(SUM(TIME_TO_SEC(creneau.Duree))) AS DureeTotalCreneau FROM creneau, medecin WHERE medecin.id_med = creneau.id_med GROUP BY creneau.id_med;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $id_med = $stmt->fetchAll();

    // Affichage des joueurs

    foreach ($id_med as $id_med) {
      $nom = $id_med['nom'];
      $prenom = $id_med['prenom'];
      $DureeTotalCreneau = $id_med['DureeTotalCreneau'];

    echo "<tr>";
      echo "<td>$nom</td>";
      echo "<td>$prenom</td>";
      echo "<td>$DureeTotalCreneau</td>";

      
    echo "</tr>";
    }
    echo "</table>";

    ?>

<br><br>
<h2 class = 'text'>Répartition des usagers selon leur sexe et leur âge</h2><br>

<?php


    session_start();

    if (!$_SESSION['acce_autorise']){
        header("Location: pIndex.php");
    }else{
         //Etablir une connection à MySQLi
        $server="localhost";
        $login="root";
        $password="";
        $db="gestion_patient";

        $link=new mysqli($server, $login, $password, $db);

        /*
        //Tester si la connexion est établie ou non
            if ($link->connect_error){
                die('Erreur:' .$link->connect_error);
                echo "connexion non etablie";
            }
            else{
                echo 'Connexion réussie.<br>';
            }
        */
        
        //Requete pour récupérer le nombre d'hommes moins de 25 ans
        $searchQuery = "SELECT COUNT(*) \n"
            . "FROM `patient`\n"
            . "WHERE DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 < 25 AND civilité = 'Mr';";
        
        // Préparation de la requête
        $searchStmt = $link->prepare($searchQuery);

        /*
        //Tester si la preparation de la requete a bien été faite
            if ($searchStmt == false){
                die("Erreur de préparation de la requete:" .$searchStmt->error);
            }
            else{
                echo "Preparation réussi.<br>";
            }
        */

        // Exécution de la requête
        $searchStmt->execute();

        /*
        //Tester si l'execution de la requète est bien réalisée
            if($searchStmt->execute()){
                echo "L'execution est faite.<br>";
            }else{
                echo "Erreur";
            }
        */

        // Récupération du résultat
            $searchStmt->bind_result($patientM_fresh);
            $searchStmt->fetch();

        // Fermeture de la requête de recherche
            $searchStmt->close();



        //Requete pour récupérer le nombre d'hommes entre 25 ans et 50
        $searchQuery = "SELECT COUNT(*) \n"
            . "FROM `patient`\n"
            . "WHERE DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 >= 25 AND DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 <= 50 AND civilité = 'Mr';";
        
        // Préparation de la requête
        $searchStmt = $link->prepare($searchQuery);

        /*
        //Tester si la preparation de la requete a bien été faite
            if ($searchStmt == false){
                die("Erreur de préparation de la requete:" .$searchStmt->error);
            }
            else{
                echo "Preparation réussi.<br>";
            }
        */

        // Exécution de la requête
        $searchStmt->execute();

        /*
        //Tester si l'execution de la requète est bien réalisée
            if($searchStmt->execute()){
                echo "L'execution est faite.<br>";
            }else{
                echo "Erreur";
            }
        */

        // Récupération du résultat
            $searchStmt->bind_result($patientM_junior);
            $searchStmt->fetch();

        // Fermeture de la requête de recherche
            $searchStmt->close();
        
        
            
        //Requete pour récupérer le nombre d'hommes entre 25 ans et 50
        $searchQuery = "SELECT COUNT(*) \n"
            . "FROM `patient`\n"
            . "WHERE DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 > 50 AND civilité = 'Mr';";
        
        // Préparation de la requête
        $searchStmt = $link->prepare($searchQuery);

        /*
        //Tester si la preparation de la requete a bien été faite
            if ($searchStmt == false){
                die("Erreur de préparation de la requete:" .$searchStmt->error);
            }
            else{
                echo "Preparation réussi.<br>";
            }
        */

        // Exécution de la requête
        $searchStmt->execute();

        /*
        //Tester si l'execution de la requète est bien réalisée
            if($searchStmt->execute()){
                echo "L'execution est faite.<br>";
            }else{
                echo "Erreur";
            }
        */

        // Récupération du résultat
            $searchStmt->bind_result($patientM_senior);
            $searchStmt->fetch();

        // Fermeture de la requête de recherche
            $searchStmt->close();


        //Requete pour récupérer le nombre d'hommes moins de 25 ans
        $searchQuery = "SELECT COUNT(*) \n"
            . "FROM `patient`\n"
            . "WHERE (DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524) < 25 AND (civilité = 'Mme' OR civilité = 'Mlle')";
        
        // Préparation de la requête
        $searchStmt = $link->prepare($searchQuery);

        /*
        //Tester si la preparation de la requete a bien été faite
            if ($searchStmt == false){
                die("Erreur de préparation de la requete:" .$searchStmt->error);
            }
            else{
                echo "Preparation réussi.<br>";
            }
        */

        // Exécution de la requête
        $searchStmt->execute();

        /*
        //Tester si l'execution de la requète est bien réalisée
            if($searchStmt->execute()){
                echo "L'execution est faite.<br>";
            }else{
                echo "Erreur";
            }
        */

        // Récupération du résultat
            $searchStmt->bind_result($patientF_fresh);
            $searchStmt->fetch();

        // Fermeture de la requête de recherche
            $searchStmt->close();


        //Requete pour récupérer le nombre d'hommes entre 25 ans et 50
        $searchQuery = "SELECT COUNT(*) \n"
            . "FROM `patient`\n"
            . "WHERE DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 >= 25 AND DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 <= 50 AND (civilité = 'Mme' OR civilité = 'Mlle');";
        
        // Préparation de la requête
        $searchStmt = $link->prepare($searchQuery);

        /*
        //Tester si la preparation de la requete a bien été faite
            if ($searchStmt == false){
                die("Erreur de préparation de la requete:" .$searchStmt->error);
            }
            else{
                echo "Preparation réussi.<br>";
            }
        */

        // Exécution de la requête
        $searchStmt->execute();

        /*
        //Tester si l'execution de la requète est bien réalisée
            if($searchStmt->execute()){
                echo "L'execution est faite.<br>";
            }else{
                echo "Erreur";
            }
        */

        // Récupération du résultat
            $searchStmt->bind_result($patientF_junior);
            $searchStmt->fetch();

        // Fermeture de la requête de recherche
            $searchStmt->close();

        //Requete pour récupérer le nombre d'hommes entre 25 ans et 50
        $searchQuery = "SELECT COUNT(*) \n"
            . "FROM `patient`\n"
            . "WHERE DATEDIFF(CURRENT_DATE, date_naissance) / 365.2524 > 50 AND (civilité = 'Mme' OR civilité = 'Mlle');";
        
        // Préparation de la requête
        $searchStmt = $link->prepare($searchQuery);

        /*
        //Tester si la preparation de la requete a bien été faite
            if ($searchStmt == false){
                die("Erreur de préparation de la requete:" .$searchStmt->error);
            }
            else{
                echo "Preparation réussi.<br>";
            }
        */

        // Exécution de la requête
        $searchStmt->execute();

        /*
        //Tester si l'execution de la requète est bien réalisée
            if($searchStmt->execute()){
                echo "L'execution est faite.<br>";
            }else{
                echo "Erreur";
            }
        */

        // Récupération du résultat
            $searchStmt->bind_result($patientF_senior);
            $searchStmt->fetch();

        // Fermeture de la requête de recherche
            $searchStmt->close();

        echo "<table>";
        echo "<tr>
            <th> Tranches d'ages </th>
            <th> Nb Hommes </th>
            <th> Nb Femmes </th>
        </tr>";

        echo "<tr>
            <td> Moins de 25 ans </td>
            <td> $patientM_fresh </td>
            <td> $patientF_fresh</td>
            </tr>";

        echo "<td> Entre 25 et 50 ans </td>
            <td> $patientM_junior </td>
            <td> $patientF_junior</td>
            </tr>";

        echo "<td> Plus de 50 ans </td>
            <td> $patientM_senior </td>
            <td> $patientF_senior</td>
            </tr>";
    }

?>

</body>
