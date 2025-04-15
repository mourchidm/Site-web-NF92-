<?php
date_default_timezone_set('Europe/Paris');
$date = date("Y\-m\-d");
$dbhost = 'tuxa.sme.utc';
$dbuser = 'nf92a054'; // remplacer les SXXX avec le semestre et le numero de votre compte
// exemples nf92p014 ou nf92a078
$dbpass = '9wmb64FKI8gU'; // remplacer votremotdepasse par votre mot de passe
$dbname = 'nf92a054'; // remplacer les SXXX comme indiqué ci-desus
$connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die
('Error connecting to mysql');
//la ligne suivante permet d'éviter les problèmes d'accent entre la page ouèbe et le serveur mysql
mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8
$result = mysqli_query($connect,"SELECT * FROM themes WHERE supprime=0");

echo "<link rel='stylesheet' href='styles.css'>";
echo "    <div class='form-container'>";

echo "<a>Theme : </a>";

// ATTENTION il manque les affichages et tests de debugage !!!!
echo "<FORM METHOD='POST' ACTION='ajouter_seance.php' >";
echo "<select name='menuChoixTheme' >";
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
echo
 "<option value=".$row[0].">".$row[1]."</option>" ;

}
echo "</select>";
echo "<BR></BR>";
echo "Date de séance :<INPUT TYPE='date' NAME ='DateSeance' required min=$date>";
echo "<BR></BR>";
echo "<BR></BR>";
echo "Entrez l'effectif maximum :<INPUT TYPE='number' NAME ='EffMax' required >";
echo "<BR></BR>";
echo "<BR></BR>";
echo "<INPUT type='submit' value='Enregistrer séance'>";
echo "</FORM>";
echo "</div>";
mysqli_close($connect);
?>