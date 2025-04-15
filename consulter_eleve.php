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

$ideleve=$_POST['menuChoixeleveselect'] ;

$result = mysqli_query($connect,"SELECT * FROM eleves WHERE ideleve='$ideleve'");


echo "<link rel='stylesheet' href='styles.css'>";

echo "    <div class='form-container'>";

// ATTENTION il manque les affichages et tests de debugage !!!!

echo "<table border =3>";
echo
 "<tr><td>ideleve</td><td>Nom</td><td>Prenom</td><td>Date de Naissance</td><td>Date d'inscription</td></tr>" ;
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
echo
 "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td></tr>" ; // 


}
echo "</table>";

mysqli_close($connect);
?>