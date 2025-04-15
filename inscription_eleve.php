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


$result = mysqli_query($connect,"SELECT * FROM eleves ");
$result1 = mysqli_query($connect,"SELECT seances.idseance,themes.nom, seances.DateSeance  FROM seances JOIN themes ON themes.idtheme=seances.Idtheme WHERE seances.DateSeance >= '$date' ");

echo "<link rel='stylesheet' href='styles.css'>";

echo "    <div class='form-container'>";
echo "<a> Eleve : </a>";
// ATTENTION il manque les affichages et tests de debugage !!!!
echo "<FORM METHOD='POST' ACTION='inscrire_eleve.php' >";
echo "<select name='menuChoixeleve' required>";
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
echo
 "<option value=".$row[0].">".$row[1]."</option>" ;

}
echo "</select>";
echo "<BR></BR>";
echo "<BR></BR>";
echo "<a> Seance :</a>";
echo "<select name='menuChoixseance' required >"; // permet de créer la liste déroulante
while ($row = mysqli_fetch_array($result1, MYSQLI_NUM))
{
echo
 "<option value=".$row[0].">".$row[1].$row[2]."</option>" ;

}
echo "</select>";


echo "<BR></BR>";
echo "<BR></BR>";
echo "<INPUT type='submit' value='Inscrire'>";
echo "</FORM>";
echo "</div>";
mysqli_close($connect);
?>