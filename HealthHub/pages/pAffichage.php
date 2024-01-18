<html>

    <meta charset="UTF-8">
    <head>
        <title> Affichage </title>
        <link rel="stylesheet" href= "Navigation.css">
		<style>
			
		
		</style>
    </head>

    <body>

        <nav>
            <ul>
                <li><a href="pLandingPatients.php">Patients</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="">Statistiques</a></li>
            </ul>
        </nav>

        <!--Script PHP-->
        <?php

            session_start();

            if ($_SESSION['acce_autorise']){

                if ($_SERVER["REQUEST_METHOD"]=="POST"){

                    //Vérifier si les données ont été transmis via la methode GET.
                        if($_POST["affichage"]=="Affichage des patients"){
                            echo "Vous avez choisit d'afficher la table Patients.<br><br>";
                        }else if ($_POST["affichage"]=="Affichage des consultations"){
                            echo "Vous avez choisit d'afficher la table Créneaux.<br><br>";
                        }else if (($_POST["affichage"])=="Affichage des médecins"){
                            echo "Vous avez choisit d'afficher la table Medecins.<br><br>";
                        }
    
                    
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
                        if ($_GET['tab']=="patient"){
                            $displayQuery = "SELECT * FROM patient";
                        }else if ($_GET['tab']=="creneau"){
                            $displayQuery = "SELECT * FROM creneau";
                        }else if ($_GET['tab']=="medecin"){
                            $displayQuery = "SELECT * FROM medecin";
                        }
    
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
    
                            if ($_GET['tab']=="patient"){
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
                            }else if ($_GET['tab']=="creneau") {
                                echo "<table border='2'>";
                                echo "<tr>
                                        <th>id_med</th>
                                        <th>DateJour</th>
                                        <th>heureDEB</th>
                                        <th>Duree</th>
                                        <th>id_Patient</th>
                                    </tr>";
                                
                                while ($row = $result->fetch_assoc()) {
								$id_Patient=$row['id_Patient'];
								$id_med=$row['id_med'];
								$heureDEB=$row['heureDEB'];
                                echo "<tr>";
                                echo "<td>" . $row['id_med'] . "</td>";
                                echo "<td>" . $row['DateJour'] . "</td>";
                                echo "<td>" . $row['heureDEB'] . "</td>";
                                echo "<td>" . $row['Duree'] . "</td>";
                                echo "<td>" . $row['id_Patient'] . "</td>";
								echo "<td><a href='supression_creneau.php?DateJour=$DateJour;id_med=$id_med;heureDEB=$heureDEB' style='text-decoration:none';color='blue'>Supprimer</br></a>
										<a href='posmodif_creneau.php?DateJour=$DateJour;id_med=$id_med;heureDEB=$heureDEB' style='text-decoration:none;color:blue'>Modifier</a></td>";
                                }
			
								/*;id_med=$id_med;heureDEB=$heureDEB*/
			
                                echo "</table>";
                            }else if ($_GET['tab']=="medecin") {
                                echo "<table border='2'>";
                                echo "<tr>
                                        <th>id_Med</th>
                                        <th>Civilite</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>id_Patient</th>
										<th>Traiter</th>
                                    </tr>";
                                
                                while ($row = $result->fetch_assoc()) {
								$id_med=$row['id_med'];
                                echo "<tr>";
                                echo "<td>" . $row['id_med'] . "</td>";
                                echo "<td>" . $row['civilite'] . "</td>";
                                echo "<td>" . $row['nom'] . "</td>";
                                echo "<td>" . $row['prenom'] . "</td>";
                                echo "<td>" . $row['id_Patient'] . "</td>";
								echo "<td><a href='supression_medecin.php?id_med=$id_med' style='text-decoration:none';color='blue'>Supprimer</br></a>
										<a href='posmodif_med.php?id_med=$id_med' style='text-decoration:none';color='blue'>Modifier</a></td>";
                                echo "</tr>";
                                }
    
                                echo "</table>";
                            }
    
                        }else{
                            echo "Erreur d'execution";
                        }
    
                    //Fermer la requete d'affichage
                        $displayStmt->close();
    
                    //Fermer la requete de connexion
                        $link->close();
                    
                }else{
                    echo" methode post non invoqué";
                }
            }else{
                header("Location: pIndex.php");
            }

        ?>

    </body>

</html>