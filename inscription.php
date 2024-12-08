<?php
include("./modele/function.php");
include("./modele/modele.php");
header('Content-Type: application/json');
function answer($a,$b,$c=200){
    http_response_code($c);
    $response = [
        'status' => $a,
        'message' => $b
    ];
    echo json_encode($response);
    exit;
}
if (isset($_POST['user']) ) {
    $user = htmlspecialchars($_POST['user']);  
    if(ispseudo($user)){
        answer("error","utilisateur existe dans la bd");
    }
    answer("success","l'utilisateur n'existe pas dans la bd");
}
?>