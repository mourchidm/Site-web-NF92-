<html>
<body>
<?php

date_default_timezone_set('Europe/Paris');
$date = date("Y\-m\-d");

if (empty($_POST['DateSeance']) or empty($_POST['menuChoixTheme'])  or empty($_POST['EffMax'])) {
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


$Idtheme=$_POST['menuChoixTheme'];
$EffMax=$_POST['EffMax'];
$DateSeance=mysqli_real_escape_string ($connect,$_POST['DateSeance']);

if ($DateSeance < $date){
    echo 'Impossible de créer la Séance car la date est déja passée ';
    exit ;
}

$verification="SELECT * FROM seances WHERE Idtheme= '$Idtheme' AND DateSeance='$DateSeance'";
$result1 = mysqli_query($connect, $verification);
if (!$result1)
{
echo "<br>problème dans la requête   ".mysqli_error($connect);
exit ;
}
if (mysqli_num_rows($result1) > 0){ // il y a déjà, une séance avec ce thème ce jour là
    echo "<p>Il existe déjà une séance pour ce thème à cette date, vous ne pouvez pas en créer une autre.</p>";
    exit;
  }

if ($EffMax <=0){
    echo "l'effectif doit être plus grand que 0";
    exit;
}






$query = "insert into seances values (NULL,'$DateSeance','$EffMax','$Idtheme')";
// Est-ce que cela fonctionne ? Pourquoi ?
// ci-dessous autre requete prete a etre testee ensuite voir sujet de TP


//echo "<br>$query<br>";
echo "<br>Eleve ajouté avec succès</br>";
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