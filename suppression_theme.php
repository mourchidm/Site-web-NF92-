<html>
	<head>
		<meta charset = "utf-8">
    <link rel="stylesheet" href="styles.css">
	</head>
		<body>
      <div class="form-container">
			<br>
          <h1>Page suppression de thèmes</h1>
          <form action = "supprimer_theme.php" method = "post">
              Choisir un thème à supprimer :
                <br>
                <select name="idtheme" required>
                  <option value="">--Choisir un thème--</option>
                  <?php
                    $dbhost = 'tuxa.sme.utc';
                    $dbuser = 'nf92a054';
                    $dbpass = '9wmb64FKI8gU';
                    $dbname = 'nf92a054';

                    $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die('Erreur de connexion à la base de données');
                    mysqli_set_charset($connect, 'utf8');

                    $query = "SELECT * FROM themes WHERE supprime = 0";
                    //echo "<br> la valeur de query : $query <br>";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='" . $row['idtheme'] . "'>" . $row['nom'] . "</option>";
                    }
                    mysqli_close($connect);
                  ?>
                </select>
              <br><br>
              <input type='submit' value='supprimer'>
          </form>
        </div>

		</body>
</html>