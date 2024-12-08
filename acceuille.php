<?php
include("./modele/modele.php");

session_start();

$t[0]=listeclassement('line');
$t[1]=listeclassement('line');
$t[2]=listeclassement('line');
if (isset($_SESSION['pseudoUser'])) 
{
    //header("Location: recup.php");
    $i=(isset($_GET['i']))?$_GET['i']:0;
    if($i==2){
        session_destroy();
        header("Location: ./connexion.php");
    }
    include("./view/menu.php");
}
else{
    header("Location: ./connexion.php");
}
 
?>