<html>

    <meta charset="UTF-8">
    <head>
        <title> Affichage </title>
        <link rel="stylesheet" href= "Navigation.css">
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
                <li><a href="pLandingPatients.php">Patient</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="dureeConsMed.php">Statistiques</a></li>
            </ul>
        </nav>

        <br><br>

        <h1 class = 'text'> La table des patients : </h1>

        <!--Script PHP-->
        <?php

            session_start();

            if ($_SESSION['acce_autorise']){
                
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

                $displayQuery = "SELECT * FROM patient";
                
                $displayStmt = $link -> prepare($displayQuery);

                /*
                //Tester si la preparation de la requete a bien été faite
                if ($displayStmt == false){
                    die("Erreur de préparation de la requete:" .$stmt->error);
                }
                else{
                    echo "Preparation réussi.<br>";
                }
                */

            
                //Executiion + Vérification
                if($displayStmt->execute()){

                    $result = $displayStmt->get_result();

                    
                    echo "<table border='2'>";
                    echo "<tr>
                            <th>id_Patient</th>
                            <th>num_sécurité_sociale</th>
                            <th>Civilité</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>date_naissance</th>
                            <th>lieu_naissance</th>
                            <th>Traiter</th>
                        </tr>";
                    
                    while ($row = $result->fetch_assoc()) {
                        $id_Patient=$row['id_Patient'];
                        echo "<tr>";
                        echo "<td>" . $row['id_Patient'] . "</td>";
                        echo "<td>" . $row['num_sécurité_sociale'] . "</td>";
                        echo "<td>" . $row['civilité'] . "</td>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['adresse'] . "</td>";
                        echo "<td>" . $row['date_naissance'] . "</td>";
                        echo "<td>" . $row['lieu_naissance'] . "</td>";
                        echo "<td><a href='supression_patient.php?id_Patient=$id_Patient' style='text-decoration:none';color='blue'>Supprimer</br></a>
                                <a href='posmodif_patient.php?id_Patient=$id_Patient' style='text-decoration:none;color:blue'>Modifier</a></td>";
                
                        echo "</tr>";
                    
                    }
                        echo "</table>";
                    
                }

                //Fermer la requete d'affichage
                $displayStmt->close();

                //Fermer la requete de connexion
                $link->close();
            } 

        ?>


    </body>

</html>