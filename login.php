<?php
include("../modele.php");

session_start();

if (isset($_SESSION['pseudoUser'])) 
{
    //header("Location: recup.php");
    header("Location: ./acceuille.php");
}
else{
    if(isset($_POST['pseudoUser']) || isset($_POST['password'])){
        $pseudoUser= htmlspecialchars( $_POST['pseudoUser']);// permet a utilisateur entre du code html 
        $_SESSION['pseudoUser']=$pseudoUser;
        header("Location: ./acceuille.php");
    }
    else{
        header("Location: ./view/vue_index.php");
    }
}
 
?>