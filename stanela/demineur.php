<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>tchat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/demineur.css"> 
    <script type="module" src="./scripts/script.js">
    </script>
</head> 
<body >
    <div id="nochargement">
        <img id="load" src="./img/abstract-1449.gif">
        <p>chargement du jeu...</p>
    </div> 
    <div id="panel">
        <div id="listequiz">
            
            <?php
            $i=0;
            while($i<84):?>
                <?php $i++;
                ?>
                <div class="carte">
                </div>
                    
            <?php endwhile?>
        </div>
        <div id="nogagner">
            <img src="./img/picmix.com_552963.gif" id="feu">
            <!-- <img src="./img/active-avatars-of-happy-young-people.gif" id="happy"> -->
            <!-- <img src="./img/3d-hands-fun-and-wild-clapping-white-skin-hands-2.png" id="hand">-->
            <img src="./img/lettering-lettering-congratulations-gradient-with-stars-text.png" id="hand"> 
             <!--  <img src="./img/abstract-1449.gif" id="fire"> -->
            <img src="./img/business-3d-black-businesswoman.png" id="woman">
            <img src="./img/business-3d-close-up-of-businessman.png" id="men">
        </div>
        <div id="noperdu">
            <img src="./img/perdu.gif">
        </div>
    </div>
    <footer>
        <div id="profil">
            <img src="<?php echo"../public/img/".$img?>">
            <span><?php echo $nom?><span>
        </div>
        <!-- <img id="imoji" src="./img/3d-plastilina-yellow-party-popper.png">> -->
        <div id="foot">
            <div>
                <span>score:</span>
                <span id="score">00</span>
            </div>
            <div id="imo">
                <img id="imoji" src="./img/twemoji_slightly-smiling-face.png">
            
            </div>
           
            <div>
                <span>nombre de mine:</span>
                <span id="mine"><?php echo $mine?></span>
            </div>
            <div id="controls">
                <button id="menuBtn">Retour au menu</button>
                <button id="restartBtn">Recommencer</button>
                <button id="pauseBtn">Pause</button>
            </div>
        </div>
    </footer>
</body>
</html>