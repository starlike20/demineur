<?php
include("../modele/modele.php");
function answer($a,$b,$c=200){
    http_response_code($c);
    $response = [
        'status' => $a,
        'message' => $b
    ];
    echo json_encode($response);
    exit;
}

session_start();

if (isset($_SESSION['pseudoUser'])) 
{
    $nom=$_SESSION['pseudoUser'];
    if(isset($_POST['mineCount'])){
        
        $img=getavar($nom);
        if($img==NULL){
            $img="Anonyme.png";
        }
        $mine=$_POST['mineCount'];
        include("demineur.php");
    }
    else{
        if(isset($_POST['score'])){
            ajoutescore($_POST['score'],$nom,"stanela");
            answer("success","ajout reussi");
        }
        else{
            header("Location: ./demarrage.php");
        }
    }
    
}
?>