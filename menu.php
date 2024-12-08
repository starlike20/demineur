<?php
include("./modele/function.php");
include("./modele/modele.php");
header('Content-Type: application/json');
session_start();
if (isset($_SESSION['pseudoUser'])) 
{
    if (isset($_POST['jeu'])) {
        $jeu = htmlspecialchars($_POST['jeu']);  
        $t=listeclassement($jeu);
        $response = [
            'tab' => $t,
            'pseudoUser' => $_SESSION['pseudoUser']
        ];
        echo json_encode($response);
        exit;
    }
}
else{
    header("Location: login.php");
}
?>