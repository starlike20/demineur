<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Kaushan+Script&display=swap" rel="stylesheet">
    <title>Connexion</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <script src="../public/javascript/connexion.js" defer ></script>
</head>
<body>
    <div class="form-container">
        <form id="log" action="../login.php" method="post">
            <div class="image-container">
                <img src="../public/img/images.jpg" alt="Avatar">
            </div>
            <h2>Connexion</h2>     
            <input id="login1" type="text" name="pseudoUser" placeholder="   Pseudo" required class="input-with-icon">
            <span id="erropseudo" class="error">rien</span>
            <input id="login2" type="password" name="password" placeholder="   Mot de passe" required class="input-with-icon">
            <span id="erromdp" class="error">rien</span>
            <button id="login" type="submit" name="submit">Se connecter</button>
            
		    <a href="../signup.php"> Inscription  </a>
        </form>
    </div>
    <div id="noload">
        <img src="../public/img/bouncy-hourglass-and-loading-icon.gif" alt="Chargement...">
        <img src="../public/img/wait.gif" alt="Chargement..." id="patient">
    </div>


</body>
</html>
