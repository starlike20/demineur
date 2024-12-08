<?php
    require_once('connexionbd.php');

    function ispseudo($u){
        global $connexion;
        $b = 0;
        $requete = "SELECT * FROM `utilisateur` WHERE `pseudo`=?";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("s", $u);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($a = $result->fetch_array(MYSQLI_ASSOC)) {
            $b++;
        }

        $stmt->close();
        return $b;
    }
    function motdepasse($i){
        global $connexion;
        $b=0;
        $requet="SELECT `mdp` FROM `utilisateur` WHERE `pseudo`=?";
        $stmt = $connexion->prepare($requet);
        $stmt->bind_param("s", $i);
        $stmt->execute();
        $result = $stmt->get_result();
        while($a=$result->fetch_array(MYSQLI_ASSOC)){
            $b=$a['mdp'];
        }
        $stmt->close();
        return $b;
    }
    function listeclassement($i){
        global $connexion;
        $b=0;
        $requet="SELECT `emetteur`,`score` FROM `meilleurscore` WHERE `jeu`=? ORDER by score LIMIT 5; ";
        $stmt = $connexion->prepare($requet);
        $stmt->bind_param("s", $i);
        $stmt->execute();
        $result = $stmt->get_result();
        while($a=$result->fetch_array(MYSQLI_ASSOC)){
            $t[$b]=$a;
            $b++;
        }
        $stmt->close();
        return $t;
    }
    function ajoutescore($score,$emeteur,$jeu){

        global $connexion;
        $requet = "SELECT `score` FROM `meilleurscore` WHERE `emetteur`=? and `jeu`=?";

        $stmt = $connexion->prepare($requet);
        $stmt->bind_param("ss", $emeteur, $jeu);
        $stmt->execute();
        $result = $stmt->get_result();
        if($a=$result->fetch_array(MYSQLI_ASSOC)){
            $t=$a;
        }
        if($score>$t["score"]){
            $requet = "UPDATE `meilleurscore` SET `score`=?,`temps`=NOW() WHERE `emetteur`=? and `jeu`=?; ";
        
            $stmt = $connexion->prepare($requet);
            $stmt->bind_param("iss", $score, $emeteur, $jeu);
            $stmt->execute();
        }
            
        $stmt->close();
        
    }
    function meilleurscore($emeteur,$jeu){
        global $connexion;
        $b=0;    
        // Préparer la requête SQL
        $requet = "SELECT `score` FROM `meilleurscore` WHERE `emetteur`=? and `jeu`=?";
        
        $stmt = $connexion->prepare($requet);
        $stmt->bind_param("ss", $emeteur, $jeu);
        $stmt->execute();
        $result = $stmt->get_result();
        while($a=$result->fetch_array(MYSQLI_ASSOC)){
            $t[$b]=$a;
            $b++;
        }
        return $t;
    }
    function getavar($nom){
       
        global $connexion;
        
        $requet = " SELECT `avatar` FROM `utilisateur` WHERE `pseudo`=?";
        
        $stmt = $connexion->prepare($requet);
        $stmt->bind_param("s", $nom);
        $stmt->execute();
        $result = $stmt->get_result();
        while($a=$result->fetch_array(MYSQLI_ASSOC)){
            $b=$a['avatar'];
        }
          
        $stmt->close();
    }
    function ajoutuser($speudo,$mdp,$sexe,$date,$ava){
        global $connexion;
        
        // Préparer la requête SQL
        $requet = " INSERT INTO `utilisateur`(`pseudo`, `mdp`, `genre`, `ddn`, `avatar`) VALUES (?,?,?,?,?);";
        
        $stmt = $connexion->prepare($requet);
        $stmt->bind_param("sssss",$speudo,$mdp,$sexe,$date,$ava);
        $stmt->execute();
            
        $stmt->close();
        
    }
    ajoutescore(8006,"pierre","stanela");
   // var_dump(getavar("cedric"));
   
?>