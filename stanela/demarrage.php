<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix du Nombre de Mines</title>
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <h1>demineur</h1>
    <div id="config">
        <h2>Choisissez le nombre de mines</h1>
        <form id="mineForm" action="controller.php"  method="post">
            <label for="mineCount">Nombre de mines:</label>
            <input type="number" id="mineCount" name="mineCount" min="1" max="100" value="10">
            <button type="submit">Démarrer le jeu</button>
        </form>
    
        <button id="Menu">Retour au menu</button>
    </div>
    <div id="nochargement">
        <img src="./img/abstract-1449.gif">
        <p>chargement du jeu...</p>
    </div> 

    <script src="./scripts/demarrage.js"></script>
</body>
</html>
