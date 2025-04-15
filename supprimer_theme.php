<html>
    <head>
        <meta charset="utf-8" lang="fr">
        <title>Supprimer theme</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="form-container">
            <br>
            <h1>Page de supression d'un thème</h1>
            <?php
            // Connexion à la base de données
            $dbhost = 'tuxa.sme.utc';
            $dbuser = 'nf92a054';
            $dbpass = '9wmb64FKI8gU';
            $dbname = 'nf92a054';

            $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Erreur de connexion à la base de données');
            mysqli_set_charset($connect, 'utf8'); // Les données envoyées vers MySQL sont encodées en UTF-8

            if (isset($_POST['idtheme'])) {
                $idtheme = $_POST['idtheme'];  // Récupérer l'id du thème sélectionné
            
                echo "ID du thème sélectionné à supprimer : " . $idtheme . "<br>";
            
                $query = "UPDATE themes SET supprime = 1 WHERE idtheme = $idtheme";
                //echo "<br> La valeur de query pour suppression : $query";
                $result = mysqli_query($connect, $query);
                if (!$result) {
                    echo "Erreur lors de la suppression du thème : " . mysqli_error($connect);
                } else {
                    echo "Thème supprimé avec succès.";
                }
            } else {
                echo "Erreur : Aucun thème sélectionné.";
            }
            
            mysqli_close($connect);
            ?>
        </div>

    </body>
</html>