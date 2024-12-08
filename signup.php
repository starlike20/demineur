<?php
include("./modele/modele.php");

session_start();

if (isset($_SESSION['pseudoUser'])) 
{
    header("Location: acceuille.php");
}
else{
    if(isset($_POST['pseudoUser']) ||  
        isset($_POST['password']) ||  
        isset($_POST['confirm_password']) ||
        isset($_POST['sexe']) ||  
        isset($_POST['birthdate']) ||
        (isset($_FILES['picture']['name'])))
    {
        $pseudo= htmlspecialchars( $_POST['pseudoUser']);// permet a utilisateur entre du code html 
        $mdp= htmlspecialchars( $_POST['password']);
        $sexe = htmlspecialchars($_POST['sexe']);
        $ddn=htmlspecialchars($_POST['birthdate']);
        $ava=htmlspecialchars($_FILES['picture']['name']);

        $avatar_dir = "./public/img/";
        $avatar_file = $avatar_dir.basename($_FILES['picture']['name']);
        move_uploaded_file($_FILES['picture']['tmp_name'], $avatar_file);
        $mdp=password_hash($mdp, PASSWORD_DEFAULT);
        
        ajoutuser($pseudo,$mdp,$sexe,$ddn,$ava);
        header("Location: acceuille.php");
    }
    else{
        header("Location: ./view/vue_signup.php");
    }


}


 /*$errors = array();

    if(isset($_POST['pseudoUser']) ||  
        isset($_POST['password']) ||  
        isset($_POST['confirm_password']) ||
        isset($_POST['sexe']) ||  
        isset($_POST['birthdate']) ||
        (isset($_FILES['picture'])))
    {

        #Obtenir le formulaire de données après la demande et les stocker dans Variable 
        $pseudoUser= htmlspecialchars( $_POST['pseudoUser']);// permet a utilisateur entre du code html 

        $password= htmlspecialchars( $_POST['password']);

        $confirm_password=htmlspecialchars($_POST['confirm_password']);

        $sexe = htmlspecialchars($_POST['sexe']);

        $birthdate=htmlspecialchars($_POST['birthdate']);
        
        if(empty($pseudoUser))
        {
            $errors['pseudoUser']="*le pseudo doit etre complete";

        }

        else
        {
            $veri=verif($pseudoUser);
            if($veri==2)
            {
                $errors['pseudoUser'] = "*le Pseudo doit avoir entre 8 et 15 caractères";

            }
            else if($veri==1)
            {
                $errors['pseudoUser'] = "*le Pseudo doit etre des caractères imprmable";


            }
            

        }
        

        if(empty($password))
        {
            $errors['password']="*le mot de passe doit etre complete";

        }
        else 
        {
            $veri=verif($password);
            if($veri==1)
            {
                $errors['password'] = "*le password doit avoir entre 8 et 15 caractères";

            }
            else if($veri==2)
            {
                $errors['password'] = "*le password doit etre des caractères imprmable";


            }

        }

        if(empty($confirm_password))
        {
            $errors['confirm_password']="*confirme votre mot de passe";

        }

        if ($password !== $confirm_password) 
        {
            $errors['confirm_password']="*le mot de passe et la confirmation de mot de passe ne correspondent pas";

        }

        
        if(empty($sexe))
        {
            $errors['sexe']="*le sexe  doit etre complete";

        }
        
        if(empty($birthdate))
        {
            $errors['birthdate']="*la date   doit etre complete";

        }
        else if(strtotime($birthdate) > time())
        # pas besoin de verifier si la date est sous format jour/mois/annee
        # Vérifier si la date de naissance est antérieure à la date d'inscription
        {
            $errors['birthdate'] = "*La date de naissance doit être antérieure à la date d'inscription.";

        }
        # Calculer l'âge de l'utilisateur en années
        $age = floor((time() - strtotime($birthdate)) / 31536000); # 31536000 = nombre de secondes dans une année
        if ($age < 14) 
        {
            $errors['birthdate'] = "*Vous devez avoir au moins 14 ans pour utiliser notre chat.";

        }

        if (!empty($_FILES['picture']['name']) ) 
        {


          $allowed_types = array(IMAGETYPE_JPEG, IMAGETYPE_PNG);

          $detected_type = exif_imagetype($_FILES['picture']['tmp_name']);
          if (in_array($detected_type, $allowed_types)) 
          {
            list($width, $height) = getimagesize($_FILES['picture']['tmp_name']);
            if ($width <= 400 && $height <= 400) 
            {
              $avatar_dir = "../avatar/";
              $avatar_file = $avatar_dir . $_POST['pseudoUser'];
              move_uploaded_file($_FILES['picture']['tmp_name'], $avatar_file);
            } 
            else 
            {
                $errors['picture'] = "*L'image doit être inférieure ou égale à 400 x 400 pixels.";

            
            }
          } 
          else 
          {
            $errors['picture'] = "*L'image doit être au format JPEG ou PNG.";

          }
        } 
        else 
        {
            $errors['picture'] = "*Veuillez sélectionner une image pour votre avatar.";

        }


        if(empty($errors))
        {

            $pseudoUser=htmlentities($_POST['pseudoUser'],ENT_QUOTES,"UTF-8");//htmlentities avec ENT_QUOTES permet de sécuriser la requête pour éviter les injections SQL, UTF-8 pour dire de convertir en ce format

            $password= password_hash($password, PASSWORD_DEFAULT);

            if(mysqli_num_rows($res=InscriptionVerif($pseudoUser))!=0)//si mysqli_num_rows retourne pas 0
            {

      
                // echo "Ce pseudo est déjà utilisé par un autre membre, veuillez en choisir un autre svp.";

                $errors['pseudoUser']= "*Ce pseudo <<$pseudoUser>> est déjà utilisé par un autre membre,!! veuillez en choisir un autre svp!!.";

                $_SESSION['errors'] = $errors;

                include("../vue_signup.php");

            }

            else
            {

                InscriptionInsertion ($pseudoUser,$password,$sexe,$birthdate);


                // redirection 

                $succes['pseudoUser']= "!!  Inscription Reussir Connectez vous  !!";

                $_SESSION['succes'] = $succes;

                $_SESSION['errors'] = NULL;

                include("../vue_index.php");
                
            }

        }
        else
        {
            $_SESSION['errors'] = $errors;

            include("../vue_signup.php");
        }           
    }

    else
    {
        $_SESSION['errors'] = NULL;
        include("../vue_signup.php");
        exit;
    }



   */

?>
