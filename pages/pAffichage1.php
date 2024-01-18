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

        <h1 class = 'text'> La table des creneaux : </h1>

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

                
                //Requete de l'affichage + Preparation
                    $displayQuery = "SELECT * FROM creneau";

                   /* if(isset($_POST['filtre_medecin'])) {

                        $nom = $_POST['filtre_medecin'];

                        $displayQuery = $displayQuery." WHERE nom = ?";
                        $displayQuery = $link -> prepare($displayStmt);
                        $displayStmt -> bind_param("s", $nom);

                    }else{
                        $displayStmt = $link -> prepare($displayQuery);
                    }*/

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
                                    <th>id_med</th>
                                    <th>nom</th>
                                    <th>DateJour</th>
                                    <th>heureDEB</th>
                                    <th>Duree</th>
                                    <th>id_Patient</th>
                                    <th>Traiter</th>
                                </tr>";
                            
                            while ($row = $result->fetch_assoc()) {
                                $id_Patient=$row['id_Patient'];
                                $id_med=$row['id_med'];
                                $heureDEB=$row['heureDEB'];
                                echo "<tr>";
                                echo "<td>" . $row['id_med'] . "</td>";
                                echo "<td>" . $row['nom'] . "</td>";
                                echo "<td>" . $row['DateJour'] . "</td>";
                                echo "<td>" . $row['heureDEB'] . "</td>";
                                echo "<td>" . $row['Duree'] . "</td>";
                                echo "<td>" . $row['id_Patient'] . "</td>";
                                echo "<td><a href='supression_creneau.php?id_Patient=$id_Patient&id_med=$id_med&heureDEB=$heureDEB' style='text-decoration:none';color='blue'>Supprimer</br></a>
                                        <a href='posmodif_creneau.php?id_Patient=$id_Patient&id_med=$id_med&heureDEB=$heureDEB' style='text-decoration:none;color:blue'>Modifier</a></td>";
                            }
        
                            /*;id_med=$id_med;heureDEB=$heureDEB*/
        
                            echo "</table>";
                        

                    }else{
                        echo "Erreur d'execution";
                    }

                //Fermer la requete d'affichage
                    $displayStmt->close();

                //Fermer la requete de connexion
                    $link->close();
                
            }else{
                header("Location: pIndex.php");
            }

        ?>

        <form method="POST">
            <label for="filtre_medecin">Filtrer par medecin:</label>
            <select name="filtre_medecin" id="filtre_medecin">
                <option value="">Tous</option>
            </select>

            <input type="submit" value="Filtrer">
        </form>

    </body>

</html>