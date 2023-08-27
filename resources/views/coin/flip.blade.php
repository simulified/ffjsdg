<!DOCTYPE html>
<html lang="en">
<title>Kapish Coinflip</title>
<meta name="description" content="Live by the coin, Die by the coin." />
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Rubik", sans-serif;
        }

        body {
            height: 100%;
            background-image: url("https://preview.redd.it/keep-gambling-v0-am35c5v0a2u91.png?width=640&crop=smart&auto=webp&s=65488184cc00899c815fb98fb8edb6632e43fcd2");
        }

        .container {
            background-color: #ffffff;
            width: 400px;
            padding: 35px;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            box-shadow: 15px 30px 35px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            -webkit-perspective: 300px;
            perspective: 300px;
        }

        .stats {
            display: flex;
            color: #101020;
            font-weight: 500;
            padding: 20px;
            margin-bottom: 40px;
            margin-top: 55px;
            box-shadow: 0 0 20px rgba(0, 139, 253, 0.25);

        }

        .stats p:nth-last-child(1) {
            margin-left: 50%;
        }

        .coin {
            height: 150px;
            width: 150px;
            position: relative;
            margin: 32px auto;
            -webkit-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }

        .coin img {
            width: 145px;
        }

        .heads,
        .tails {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .tails {
            transform: rotateX(180deg);
        }

        @keyframes spin-tails {
            0% {
                transform: rotateX(0);
            }

            100% {
                transform: rotateX(1980deg);
            }
        }

        @keyframes spin-heads {
            0% {
                transform: rotateX(0);
            }

            100% {
                transform: rotateX(2160deg);
            }
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        button {
            width: 150px;
            padding: 15px 0;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        #flip-button {
            background-color: #053469;
            color: #ffffff;
        }

        #flip-button:disabled {
            background-color: #e1e0ee;
            border-color: #e1e0ee;
            color: #101020;
        }

        #reset-button {
            background-color: #674706;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <p id="abc"> Nothing yet..</p>
        <div class="coin" id="coin">
            <div class="heads">
                <img
                    src="https://w7.pngwing.com/pngs/377/27/png-transparent-silver-coin-silver-gilt-mint-tech-postcard-head-gold-material.png">
            </div>
            <div class="tails">
                <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTKPXdeMWZbX3Vk9Qc3tgGtERTCZNe5z1OyzXN8ZejoIrXgA95Wi4mfTV3BgGr0lGHO5I4&usqp=CAU">
            </div>
        </div>
        <div class="stats">
            <label for="fname">Amount to gamble:</label>
            <input type="text" id="heads-count">

        </div>
        <div class="buttons">
            <button id="flip-button">
                Flip Coin
            </button>
            <button id="reset-button">
                Heads
            </button>

        </div>
    </div>
    <!--Script-->
    <script type="text/javascript">
        document.querySelector("#reset-button").textContent = "Heads";
        let heads = 0;
        let tails = 0;
        let coin = document.querySelector(".coin");
        let flipBtn = document.querySelector("#flip-button");
        let resetBtn = document.querySelector("#reset-button");

        flipBtn.addEventListener("click", () => {
            let option = document.querySelector("#reset-button").textContent;
            let moneyGambled = document.querySelector("#heads-count").value;

            fetch("https://kapish.fun/coinflip/api?flip=" + option + "&moneyGambled=" + moneyGambled)
                .then(response => response.text())
                .then(result => {
                    if (result.includes("You won")) {
                        coin.style.animation = "none";
                        if (option === "Heads") {
                            setTimeout(function () {
                                coin.style.animation = "spin-heads 3s forwards";
				document.querySelector("#abc").textContent = "You won!"
                            }, 100);
                            heads++;
                        } else {
                            setTimeout(function () {
                                coin.style.animation = "spin-tails 3s forwards";
				document.querySelector("#abc").textContent = "You won!"
                            }, 100);
                            tails++;
                        }
                        setTimeout(updateStats, 3000);
                        disableButton();
                    }
                    if (result.includes("You lost")) {
                        if (option === "Heads") {
                            option = "Tails";
                        } else {
                            option = "Heads";
                        }
                        coin.style.animation = "none";
                        if (option === "Heads") {
                            setTimeout(function () {
                                coin.style.animation = "spin-heads 3s forwards";
                                document.querySelector("#abc").textContent = "You lost."
                            }, 100);
                            heads++;
                        } else {
                            setTimeout(function () {
                                coin.style.animation = "spin-tails 3s forwards";
                                document.querySelector("#abc").textContent = "You lost."
                            }, 100);
                            tails++;
                        }
                        setTimeout(updateStats, 3000);
                        disableButton();
                    }
                    if (result.includes("You do not have enough money.")) {
                        document.querySelector("#abc").textContent = "You do not have enough money."
                    }
		if (result.includes("backed off")) {
		    document.querySelector("#abc").textContent = "Kapish Casino INC has decided your play is too strong and has backed you off from our games for a small amount of time."
		}
		})
                .catch(error => {
                    document.querySelector("#abc").textContent = "API is down, please wait"
                });
        });

        function disableButton() {
            flipBtn.disabled = true;
            setTimeout(function () {
                flipBtn.disabled = false;
            }, 3000);
        }

        resetBtn.addEventListener("click", () => {
            if (document.querySelector("#reset-button").textContent === "Heads") {
                document.querySelector("#reset-button").textContent = "Tails";
            } else {
                document.querySelector("#reset-button").textContent = "Heads";
            }
        });

        function updateStats() {
            // Update the statistics display here
        }

    </script>
</body>

</html>
</div>