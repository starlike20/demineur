<?php
 session_start();

if (isset($_SESSION['pseudoUser'])) 
{
    //header("Location: recup.php");
    header("Location: pageDacceuil.php");
}

 include("../modele.php");

 $errors = array();


    if(isset($_POST['pseudoUser']) ||
        isset($_POST['password']))
    {
        $_SESSION['succes'] = NULL;

        #Obtenir le formulaire de données après la demande et les stocker dans Variable 
        $pseudoUser= htmlspecialchars( $_POST['pseudoUser']);// permet a utilisateur entre du code html 
        $password= htmlspecialchars( $_POST['password']);
        $ver="";

   

        #Création du format de données d’URL
        $data = 'pseudoUser='.$pseudoUser.'&password='.$password;
        
        if(empty($pseudoUser))
        {
            $errors['pseudoUser'] = "*Le pseudo doit être complété";
        }


        

        if(empty($password))
        {
            $errors['password'] = "*Le mot de passe doit être complété";
        }


        if(empty($errors))
        {
            $res=login($pseudoUser); 
             
            if(empty($res) )
            {
                $errors['login'] = "*Pseudo incorrect";
            } 

            else 
            {

                
                $hash = $res[0]['mdp'];


                if (password_verify($password, $hash)) 
                {
                    $_SESSION['pseudoUser']=$pseudoUser;


                    header("Location: recup.php");

                    
                } 
                else
                {
                    $errors['login'] = "*Mot de passe incorrect";

                    $_SESSION['errors'] = $errors;

                    include("../vue_index.php");
                }
            }
        }
        else
        {
            $_SESSION['errors'] = $errors;

            include("../vue_index.php");
        }
	}

    else
    {
        $_SESSION['errors'] = NULL;
        include("../vue_index.php");
        exit;
    }



    
?>