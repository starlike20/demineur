var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
var x = canvas.width / 2;
var y = canvas.height - 30;
var dx = 3;
var dy = -3;
var ballRadius = 10;
var paddleHeight = 10;
var paddleWidth = 75;
var paddleX = (canvas.width - paddleWidth) / 2;
var rightPressed = false;
var leftPressed = false;

var brickRowCount = 6; 
var brickColumnCount = 9; 
var brickWidth = 75; 
var brickHeight = 20; 
var brickPadding = 7; 
var brickOffsetTop = 30;
var brickOffsetLeft = 30;
var gameOverNotify = document.querySelector('.game-over-notify');
var gameWinNotify = document.querySelector('.game-win-notify');

var score = 0;
var lives = 2;

var gameRunning = true; 

var brickColors = ['#ffff00', '#ffa500', '#ff0000', 'rgb(250, 0, 154)', '#0000ff', '#adff2f'];

var bricksToDrop = Math.floor(brickRowCount * brickColumnCount / 4); 
var dropBrickIndices = [];

while (dropBrickIndices.length < bricksToDrop) {
    var randomIndex = Math.floor(Math.random() * brickRowCount * brickColumnCount);
    if (!dropBrickIndices.includes(randomIndex)) {
        dropBrickIndices.push(randomIndex);
    }
}


var bricks = [];
var brickIndex = 0;

for (var c = 0; c < brickColumnCount; c++) {
    bricks[c] = [];
    for (var r = 0; r < brickRowCount; r++) {
        bricks[c][r] = { 
            x: 0, 
            y: 0, 
            color: getColorForRow(r), 
            status: 1, 
            drop: dropBrickIndices.includes(brickIndex) 
        };
        brickIndex++;
    }
}

function getColorForRow(r) {
    return brickColors[r];
}

var dropItems = []; 

document.addEventListener("mousemove", mouseMoveHandler, false);
document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);
gameOverNotify.addEventListener("click", function () { document.location.reload(); });
gameWinNotify.addEventListener("click", function () { document.location.reload(); });

function mouseMoveHandler(e) {
    var relativeX = e.clientX - canvas.offsetLeft;
    if (relativeX > 0 && relativeX < canvas.width) {
        paddleX = relativeX - paddleWidth / 2;
    }
}

function keyDownHandler(e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = true;
    } else if (e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = true;
    }
}

function keyUpHandler(e) {
    if (e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = false;
    } else if (e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = false;
    }
}

function collisionDetection() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            var b = bricks[c][r];
            if (b.status == 1) {
                if (x > b.x && x < b.x + brickWidth && y > b.y && y < b.y + brickHeight) {
                    dy = -dy;
                    b.status = 0;

                    
                    if (b.drop) {
                        dropItems.push({ x: b.x + brickWidth / 2, y: b.y + brickHeight, dy: 2 });
                    }

                    if (dx < 0) {
                        dx = (dx * -1) + 0.1;
                        dx = (dx * -1);
                    } else {
                        dx = dx + 0.1;
                    }

                    if (dy < 0) {
                        dy = (dy * -1) + 0.1;
                        dy = (dy * -1);
                    } else {
                        dy = dy + 0.1;
                    }

                    score++;
                    if (score == brickRowCount * brickColumnCount) {
                        gameRunning = false;
                        gameWinNotify.style.display = 'flex';
                        return;
                    }
                }
            }
        }
    }
}

function drawScore() {
    ctx.font = "16px Arial";
    ctx.fillStyle = "#000000";
    ctx.fillText("Score: " + score, 8, 20);
}

function drawLives() {
    ctx.font = "16px Arial";
    ctx.fillStyle = "#000000";
    ctx.fillText("Lives: " + lives, canvas.width - 65, 20);
}

function drawSpeed() {
    ctx.font = "16px Arial";
    ctx.fillStyle = "#000000";
    var x;
    var y;
    if (dx < 0) {
        x = (dx * -1);
    } else {
        x = dx;
    }

    x = x.toFixed(1);

    ctx.fillText("Speed: " + x, canvas.width / 2 - 30, 20);
}

function drawBall() {
    ctx.beginPath();
    ctx.arc(x, y, ballRadius, 0, Math.PI * 2);
    ctx.fillStyle = "#000000";
    ctx.fill();
    ctx.closePath();
}

function drawPaddle() {
    ctx.beginPath();
    ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
    ctx.fillStyle = "#800080";
    ctx.fill();
    ctx.closePath();
}

function drawBricks() {
    for (var c = 0; c < brickColumnCount; c++) {
        for (var r = 0; r < brickRowCount; r++) {
            if (bricks[c][r].status == 1) {
                var brickX = (c * (brickWidth + brickPadding)) + brickOffsetLeft;
                var brickY = (r * (brickHeight + brickPadding)) + brickOffsetTop;
                bricks[c][r].x = brickX;
                bricks[c][r].y = brickY;
                ctx.beginPath();
                ctx.rect(brickX, brickY, brickWidth, brickHeight);
                ctx.fillStyle = bricks[c][r].color;
                ctx.fill();
                ctx.closePath();
            }
        }
    }
}

function drawDropItems() {
    dropItems.forEach(function (item) {
        ctx.fillStyle = "#43ac13c4"; 
        ctx.beginPath();
        ctx.arc(item.x, item.y, 7, 0, Math.PI * 2); 
        ctx.fill();
        ctx.closePath();

        ctx.strokeStyle = "#000000"; 
        ctx.beginPath();
        ctx.moveTo(item.x, item.y - 7);
        ctx.lineTo(item.x, item.y - 15);
        ctx.stroke();
        ctx.closePath();
    });
}

function updateDropItems() {
    dropItems.forEach(function (item) {
        item.y += item.dy;

        
        if (item.y + 7 >= canvas.height - paddleHeight &&
            item.x > paddleX && item.x < paddleX + paddleWidth) {
            lives--;
            item.y = canvas.height; 
        }
    });

    dropItems = dropItems.filter(function (item) {
        return item.y + 7 < canvas.height;
    });

   
    if (lives <= 0) {
        gameRunning = false;
        gameOverNotify.style.display = 'flex';
        return;
    }
}

function draw() {
    if (!gameRunning) return; 

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    drawBricks();

    drawBall();

    drawPaddle();

    drawScore();

    drawLives();

    drawSpeed();

    drawDropItems();

    collisionDetection();

    if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {
        dx = -dx;
    }

    if (y + dy < ballRadius) {
        dy = -dy;
    } else if (y + dy > canvas.height - ballRadius) {
        if (x > paddleX && x < paddleX + paddleWidth) {
            dy = -dy;
        } else {
            lives--;

            if (!lives) {
                gameRunning = false;
                gameOverNotify.style.display = 'flex';
                return;
            } else {
                x = canvas.width / 2;
                y = canvas.height - 30;
                dx = dx;
                dy = -dy;
                paddleX = (canvas.width - paddleWidth) / 2;
            }
        }
    }

    if (rightPressed && paddleX < canvas.width - paddleWidth) {
        paddleX += 7;
    } else if (leftPressed && paddleX > 0) {
        paddleX -= 7;
    }

    x += dx;
    y += dy;

    updateDropItems(); 

    requestAnimationFrame(draw);
}

draw();
