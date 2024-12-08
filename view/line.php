<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>tchat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Kaushan+Script&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="demineur.css"> 
</head> 
<body >
<canvas id='my-canvas' width="600" height="1000"></canvas>
</body>
<script>
    const canvasElement = document.getElementById('my-canvas');
    const ctx = canvasElement.getContext('2d');

    const rect = {
        x: 0,
        y: 0,
        width: 50,
        height: 50,
        color: 'red',
        text:2,
        colortxt:'#FFFFFF',
    };

    function draw() {
        ctx.clearRect(0, 0, canvasElement.width, canvasElement.height);
        ctx.fillStyle = rect.color;
        
        ctx.fillRect(rect.x, rect.y, rect.width, rect.height);
        ctx.font = '20px Arial';
        ctx.fillStyle = rect.colortxt; 
        ctx.fillText(rect.text, rect.x+20, rect.y+32);
        console.log(ctx)
    }
    function update() {
    if (rect.x >= canvasElement.width) {
        rect.y = Math.floor(Math.random() * canvasElement.height - rect.height);
        rect.x = 0;
    } else {
        rect.y=rect.y+1;
    }
}

draw();

function animate() {
    if(rect.y<550){
        update();
        draw();
        requestAnimationFrame(animate);
    }
}

requestAnimationFrame(animate);

window.addEventListener('keyup', (evt) => {
    if (evt.key === 'ArrowRight') {
        if(rect.x<500){
            rect.x += 100;
        }
    } else if (evt.key === 'ArrowLeft') {
        if(rect.x>0){
            rect.x -= 100;
        }
    }
    console.log(evt);
});
</script>
</html>