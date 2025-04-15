<?php
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a054'; // remplacer les SXXX avec le semestre et le numero de votre compte
// exemples nf92p014 ou nf92a078
$dbpass = '9wmb64FKI8gU'; // remplacer votremotdepasse par votre mot de passe
$dbname = 'nf92a054'; // remplacer les SXXX comme indiqué ci-desus
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
('Error connecting to mysql');
//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
date_default_timezone_set('Europe/Paris');
$date = date("Y\-m\-d");

$idseance=$_POST['menuChoixseanceselect'];

$result = mysqli_query($connect,"SELECT eleves.nom,eleves.prenom,inscription.ideleve,inscription.note FROM inscription JOIN eleves ON eleves.ideleve=inscription.ideleve WHERE inscription.idseance=$idseance ");

echo "<link rel='stylesheet' href='styles.css'>";

echo "    <div class='form-container'>";

// ATTENTION il manque les affichages et tests de debugage !!!!
echo "<FORM METHOD='POST' ACTION='noter_eleves.php' >";
echo "<table border =3>";
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{if($row[3]==NULL )
   {
    $erreur=NULL;
   } else{
    $erreur=40-$row[3] ;
   } 
echo
 "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td> <INPUT TYPE='number' placeholder='".$erreur."' NAME ='".$row[2]."' required></td></tr>" ; // 
 echo "<input type='hidden'  name='idseance' value='$idseance' />";

}
echo "</table>";
echo "<BR></BR>";
echo "<BR></BR>";
echo "<INPUT type='submit' value='Noter'>";
echo "</FORM>";
mysqli_close($connect);
?>
