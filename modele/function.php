<?php
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
?>