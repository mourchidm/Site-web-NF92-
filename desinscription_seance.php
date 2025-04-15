<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="form-container">
            <br>
            <h1>Désinscription</h1>
            <form action="desinscrire_seance.php" method="post">
                Choisir un élève à désinscrire
                <br>
                <select name="selection" required>
                    <option value="">--Choisir un élève--</option>
                    <?php
                    $dbhost = 'tuxa.sme.utc';
                    $dbuser = 'nf92a054';
                    $dbpass = '9wmb64FKI8gU';
                    $dbname = 'nf92a054';

                    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Erreur de connexion à la base de données');
                    mysqli_set_charset($connect, 'utf8');

                    // Requête pour sélectionner les élèves inscrits à des séances dans le futur
                    $query = "SELECT eleves.ideleve, eleves.nom, eleves.prenom, themes.nom AS theme_nom, seances.DateSeance, seances.idseance
                              FROM eleves
                              JOIN inscription ON eleves.ideleve = inscription.ideleve
                              JOIN seances ON inscription.idseance = seances.idseance
                              JOIN themes ON seances.Idtheme = themes.idtheme
                              WHERE seances.DateSeance > CURDATE()";
                    //echo "<br> la valeur de query : $query <br>";
                    $result = mysqli_query($connect, $query);

                    if (!$result) {
                        echo "Erreur lors de la récupération des données : " . mysqli_error($connect);
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['ideleve'] . "|" . $row['idseance'] . "'>" 
                                 . $row['nom'] . " " 
                                 . $row['prenom'] . " | " 
                                 . $row['theme_nom'] . " : " 
                                 . $row['DateSeance'] . "</option>";
                        }
                    }
                    mysqli_close($connect);
                    ?>
                </select>
                <br><br>
                <input type='submit' value='choisir'>
            </form>
        </div>

    </body>
</html>