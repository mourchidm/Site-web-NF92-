<html>
<body>
<?php

date_default_timezone_set('Europe/Paris');
$date = date("Y\-m\-d");

if (empty($_POST['prenom']) or empty($_POST['nom'])  or empty($_POST['datedenaissance']) and mb_strlen($_POST['prenom'])>30 and mb_strlen($_POST['nom'])>30) {
        echo 'remplir tous les champs ';

}else {

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a054';
// remplacer les SXXX avec le semestre et le numero de votre compte
// exemples nf92p014 ou nf92a078
$dbpass = '9wmb64FKI8gU';
// remplacer  votremotdepasse par votre mot de passe
$dbname = 'nf92a054';
// remplacer les XXX comme indiqué ci-dessus
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

echo "<link rel='stylesheet' href='styles.css'>";

$nom = mysqli_real_escape_string ($connect,$_POST['nom']); // a condition que 'nom' soit le bon 'name'! expliquez.
$prenom=mysqli_real_escape_string ($connect,$_POST['prenom']);
$dateNaiss=mysqli_real_escape_string ($connect,$_POST['datedenaissance']);

$verification="SELECT * FROM eleves WHERE nom= '$nom' AND prenom='$prenom' AND dateNaiss='$dateNaiss'";
$result1 = mysqli_query($connect, $verification);
if (!$result1)
{
echo "<br>problème dans la requête   ".mysqli_error($connect);
exit ;
}
if (mysqli_num_rows($result1) > 0){ // il y a déjà, un élève
    echo "<p>Il existe déja un éleve similaire voulez-vous vraiment l'ajouter ?</p>";
    echo "<form method='POST'ACTION='valider_eleve.php'>";
    echo "Oui <input type='radio' name='reponse' value='oui'checked>";
    echo "Non <input type='radio' name='reponse' value='non'>";
    echo "<input type='hidden' name='nom' value='$nom'>";
    echo "<input type='hidden' name='prenom' value='$prenom'>";
    echo "<input type='hidden' name='dateNaiss' value='$dateNaiss'>";
    echo "<input type='submit' value='Valider'>";
    echo "</form>";
    exit;
  }

echo "<br> le nom saisie est : $nom";
$query = "insert into eleves values (NULL,'$nom','$prenom','$dateNaiss','$date')";
// Est-ce que cela fonctionne ? Pourquoi ?
// ci-dessous autre requete prete a etre testee ensuite voir sujet de TP
// $query = "insert into eleves values (NULL, 'Blanche', 'Neige', '1800-01-01', "."'$date'".")";
//echo "<br>$query<br>";
echo "<br>Eleve inscrit avec succès<br>";
// important echo a faire systematiquement, c'est impose !

$result = mysqli_query($connect, $query);
// $query utilise comme parametre de mysqli_query
// le test ci-dessous est desormais impose pour chaque appel de :
// mysqli_query($connect, $query);
if (!$result)
{
echo "<br>pas bon  ".mysqli_error($connect);
}
mysqli_close($connect);


}
?>


</body>
</html>