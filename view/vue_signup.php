<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Kaushan+Script&display=swap" rel="stylesheet">
    <title>Inscription</title>
    <link rel="stylesheet" href="../public/css/styles.css">
    <script src="../public/javascript/inscription.js" defer ></script>

</head>
<body>
<div class="form-container inscription">
    <form action="../signup.php" method="post" id="log" enctype="multipart/form-data">
        <div class="image-container">
            <img src="../public/img/images.jpg" alt="Avatar">
        </div>
        <span id="erroglobale" class="error">rien</span>
        <h2>Inscription</h2>
        <input type="text" id="pseudoUser" name="pseudoUser" placeholder="Pseudo" required>
        <span id="erropseudo" class="error">rien</span>

        <input type="password"  id="password" name="password" placeholder="Mot de passe" required>
        <span id="erropassword" class="error">rien</span>

        <input type="password" id="conpassword" name="confirm_password" placeholder="Confirmation mot de passe" required>
        <span id="erroconpassword" class="error">rien</span>

        <input type="date" id="birthdate" name="birthdate" placeholder="Date de naissance" required>
        <span id="errobirthdate" class="error">rien</span>

        <select name="sexe"  id="sexe">
            <option value="H">Homme</option>
            <option value="F">Femme</option>
            <option value="S">Autre</option>
        </select>
        <span id="errosexe" class="error">rien</span>
        
        <div class="selectProfile">
		    <label for="picture" class="form-label"> Profile-picture: </label>
		    <input type="file" class="form-control"
		   id="picture" name="picture" >
		</div> 
        <span id="erropicture" class="error">rien</span>

        <button id="login" type="submit" name="submit">S'inscrire</button>
        
		<a href="../login.php"> Connexion  </a>
    </form>
</div>
</body>
</html>
