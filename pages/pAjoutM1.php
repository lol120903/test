<?php

    //Verifier si des données ont été envoyées via POST
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if (isset($_POST["civilite"], $_POST["nom"], $_POST["prenom"])) {
            //Recupérer les données du formulaire
            $civilite = $_POST["civilite"];
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            
    
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

            //Requete de l'ajout + Preparation
            $searchQuery = "SELECT COUNT(*) FROM medecin WHERE nom = ? ";

            // Préparation de la requête
            $searchStmt = $link->prepare($searchQuery);
            $searchStmt->bind_param("s", $nom);

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
            $searchStmt->bind_result($count);
            $searchStmt->fetch();

            // Fermeture de la requête de recherche
            $searchStmt->close();

            // Vérification du résultat
            if ($count > 0) {
                echo "Ce médecin existe déja.";
            }else {
                //Préparer la requete d'insertion
                $insertQuery="INSERT INTO medecin (civilite, nom, prenom) VALUES (?, ?, ?)";
                $insertStmt = $link->prepare($insertQuery);

                /*
                //Tester si la preparation de la requete a bien été faite
                if ($insertStmt == false){
                    die("Erreur de préparation de la requete:" .$stmt->error);
                }
                else{
                    echo "Preparation réussi.<br>";
                }
                */
                
                //Liser les paramètres et exécuter la requete
                $insertStmt->bind_param("sss",$civilite, $nom, $prenom);
                
                
                //Tester si l'esxecution de la requète est bien réalisée
                if($insertStmt->execute()){
                    header("Location: pAjoutM2.php");
                }else{
                    echo "Erreur";
                }
                

                //Fermer la requete d'insertion
                $insertStmt->close();

                //Fermer la requete de connexion
                $link->close();
            }
        }
    }


        ?>