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



$idseance=$_POST['idseance'];
$result = mysqli_query($connect,"SELECT ideleve,note FROM inscription WHERE idseance=$idseance");
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
    if (!isset($_POST["$row[0]"])) {
        echo "<br> Vérifiez de bien écrire toutes les notes ";
        mysqli_close($connect);
        exit();
        }
    if ($_POST["$row[0]"]==0) {
        $query = "UPDATE inscription SET note = 40 WHERE ideleve = $row[0]   AND idseance = $idseance";
        $result1 = mysqli_query($connect, $query);
        echo "Tout est ok";
    }  
    if (is_numeric($_POST["$row[0]"]) and $_POST["$row[0]"]<=40) {
        $note=$_POST["$row[0]"] ;
        $query = "UPDATE inscription SET note = 40-$note WHERE ideleve = $row[0]   AND idseance = $idseance";
        $result1 = mysqli_query($connect, $query);
        echo "Tout est ok";
    }  
} 
mysqli_close($connect);
?>