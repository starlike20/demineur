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

if (isset($_POST['user']) && isset($_POST['password']) ) {
    $user = htmlspecialchars($_POST['user']); 
    $password=htmlspecialchars($_POST['password']);
    if(ispseudo($user)){
        if(password_verify($password,motdepasse($user))){
            answer("success","utilisateur existe dans la bd");
        }
        answer("error","le mot de passe est erroner");
    }
    answer("error","l'utilisateur n'existe pas dans la bd");
}
else{
    if (isset($_POST['user']) ) {
        $user = htmlspecialchars($_POST['user']);  
        if(ispseudo($user)){
            answer("success","utilisateur existe dans la bd");
        }
        answer("error","l'utilisateur n'existe pas dans la bd");
    }
    else{
        header("Location: ./view/vue_index.php");
    }
    //answer("error","Le paramètre 'user' est requis",401);
}
?>