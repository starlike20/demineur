<?php

//------------------------------------connexion à la base de donnée----------------------------------------- 

function connexion()
{

    $bdd = mysqli_connect('localhost', 'root','','source_db') ;
    if(mysqli_connect_errno())
    {


    echo "Une erreur c'est produite lors de la coonection a la base de donnee";
    exit();


    }

    mysqli_set_charset($bdd,'utf8');//pour ne pas avoir de probleme de caractére exemple accent

    return $bdd;
}
//-----------------------------------------------------------------------------------------------------------------



//----------------------------------pour verifier si il ya pas deux pseudo dans la base--------------------------------
function InscriptionVerif($pseudoUser)
{
    $bdd = connexion();
    
    $check = "SELECT * FROM utilisateur WHERE pseudo = ?";

    $stmt = mysqli_prepare($bdd, $check);

    mysqli_stmt_bind_param($stmt, "s", $pseudoUser);

    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);
    
    if (!$res) 
    {
        die('Erreur dans la requête : ' . mysqli_error($bdd));
    }
    
    return $res;
}
//--------------------------------------------------------------------------------------------------------




//-----------------------------------------------------------insertion------------------------------------
function InscriptionInsertion($pseudoUser, $password, $sexe, $date_of_birth) 
{
    $bdd = connexion();

    $rep= "INSERT INTO utilisateur (pseudo, mdp, genre, ddn, avatar) VALUES (?, ?, ?, ?, '')";

    $stmt = mysqli_prepare($bdd,$rep);
    ////je prépare l'instruction sql pour insere dans la base de donnees 

    mysqli_stmt_bind_param($stmt, "ssss", $pseudoUser, $password, $sexe, $date_of_birth);//Lie des variables à une requête MySQL
    //. Le deuxième argument "ssss" indique que chaque paramètre est une chaîne de caractères (s)

    mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);
}
//---------------------------------------------------------------------------------------------------------




//------------------------------------------------------Login----------------------------------------------
function login( $pseudoUser)
{
    $bdd=connexion();

    $check="SELECT mdp FROM utilisateur WHERE pseudo='$pseudoUser'";



    $res = mysqli_query($bdd,$check); //execute la requete

    if (!$res) 
    {
       die('Erreur dans la requête : ' . mysqli_error($bdd));
    }

    return mysqli_fetch_all($res,MYSQLI_ASSOC);
    //retourne un tableau associatif contenant toutes les lignes de résultats de la requête SQL

    

}

//------------------------------------------------------------------------------------------------------------------

function verif($x)
{

    if(preg_match('/^[[:print:]]+$/', $x))
    {
        if(strlen($x) >= 8 && strlen($x) <= 15)  // est une fonction PHP qui permet de vérifier si tous les caractères d'une chaîne de caractères sont imprimables
        {

            return 3;
        }
        else
        {
           return 2; 
        }

        

        //La variable $em est généralement utilisée pour stocker un message d'erreur à afficher à l'utilisateur en cas de problème avec le formulaire ou de violation des règles de 
    }
    else 
    {
        return 1;
    }

}

//-------------------------------------------- Recuperation pseudo et avatar -------------------------------

function recuperation ($pseudoUser)
{
    $bdd = connexion();
    
    $check = "SELECT * FROM utilisateur WHERE pseudo='$pseudoUser'";

    $stmt = mysqli_prepare($bdd, $check);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);//pour obtenir l'objet de résultat 

    if (!$result) 
    {
        die('Erreur dans la requête : ' . mysqli_error($bdd));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);

}
//-------------------------------------------- insertion  message-------------------------------




function insertion($message, $pseudoUser)
{
    $bdd = connexion();
    
    $sql = "INSERT INTO chatMessage (message, emetteur) VALUES (?, ?)";
    
    $stmt = mysqli_prepare($bdd, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $message, $pseudoUser);

    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);

    mysqli_close($bdd);
}
//-------------------------------------------- recuper  message-------------------------------
function recuper($page, $limit) 
{
    $bdd = connexion();

    $offset = ($page - 1) * $limit;

    $query = "SELECT cm.id, cm.message, cm.temps, cm.emetteur, u.genre FROM chatMessage cm JOIN utilisateur u ON cm.emetteur = u.pseudo ORDER BY id DESC LIMIT ?, ?";

    $stmt = mysqli_prepare($bdd, $query);

    mysqli_stmt_bind_param($stmt, "ii", $offset, $limit);

    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) 
    {
        die('Erreur dans la requête : ' . mysqli_error($bdd));
    }

    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($bdd);

    return $messages;
}

function recupererationmess()
{
    $bdd = connexion();

    

    $query = "SELECT count(*)FROM chatMessage ";

    $stmt = mysqli_prepare($bdd, $query);

   

    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) 
    {
        die('Erreur dans la requête : ' . mysqli_error($bdd));
    }

    $nombre = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    mysqli_close($bdd);

    return $nombre;



}

function suppression ($id)
{
    $bdd = connexion();
    
    $requet="DELETE FROM `chatmessage` WHERE `id`=$id";

    $res = mysqli_query($bdd,$requet); //execute la requete
}


/**------------------------------------------------- */

