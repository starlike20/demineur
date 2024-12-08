<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>tchat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Kaushan+Script&display=swap" rel="stylesheet">
    <script src="./public/javascript/menu.js" defer ></script>

    <link rel="stylesheet" href="./public/css/acceuille.css">
</head> 
<body >
    <header>
        <nav>
            <a id="acc"> accueil </a>
            <a id="clas" > classement</a>
            <a id="dec"> deconnection</a>
        </nav>
    </header>
    <article id="classement">
        <?php include("classement.php");?>
    </article>
    <article id="acceuille">
        <?php include("acceuille.php"); ?>
    </article>
</body>
</script>
</html>