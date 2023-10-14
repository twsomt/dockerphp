<?php

// Обработка запросов от клиента
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'reset') {
        // Сброс игры
        resetGame();
    }
    exit;
}

function resetGame() {
    // Сброс состояния игры
    // Например, сбросите значения ячеек и текущего игрока
}

// Инициализация игры
resetGame();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Крестики-Нолики</title>
    <style>
        .cell {
            width: 50px;
            height: 50px;
            text-align: center;
            vertical-align: middle;
            font-size: 24px;
            border: 1px solid #000;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Игра в крестики-нолики</h1>
    <table>
        <tr>
            <td class="cell" id="cell00" onclick="makeMove(0, 0)"></td>
            <td class="cell" id="cell01" onclick="makeMove(0, 1)"></td>
            <td class="cell" id="cell02" onclick="makeMove(0, 2)"></td>
        </tr>
        <tr>
            <td class="cell" id="cell10" onclick="makeMove(1, 0)"></td>
            <td class="cell" id="cell11" onclick="makeMove(1, 1)"></td>
            <td class="cell" id="cell12" onclick="makeMove(1, 2)"></td>
        </tr>
        <tr>
            <td class="cell" id="cell20" onclick="makeMove(2, 0)"></td>
            <td class="cell" id="cell21" onclick="makeMove(2, 1)"></td>
            <td class="cell" id="cell22" onclick="makeMove(2, 2)"></td>
        </tr>
    </table>
    <p id="message"></p>
    <button onclick="resetGame()">Сбросить игру</button>

    <script>
        let currentPlayer = 'X';
        let gameOver = false;
        const cells = [
            ["", "", ""],
            ["", "", ""],
            ["", "", ""]
        ];

        function makeMove(row, col) {
            const cell = document.getElementById(`cell${row}${col}`);

            if (gameOver || cell.innerHTML !== "") {
                return;
            }

            cell.innerHTML = currentPlayer;
            cells[row][col] = currentPlayer;

            if (checkWinner(currentPlayer, row, col)) {
                document.getElementById("message").innerHTML = `Игрок ${currentPlayer} выиграл!`;
                gameOver = true;
            } else if (checkDraw()) {
                document.getElementById("message").innerHTML = "Ничья!";
                gameOver = true;
            } else {
                currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
            }
        }

        function resetGame() {
            currentPlayer = 'X';
            gameOver = false;
            cells.forEach((row, rowIndex) => {
                row.forEach((_, colIndex) => {
                    cells[rowIndex][colIndex] = "";
                    document.getElementById(`cell${rowIndex}${colIndex}`).innerHTML = "";
                });
            });
            document.getElementById("message").innerHTML = "";
        }

        function checkWinner(player, row, col) {
            return (
                cells[row][0] === player && cells[row][1] === player && cells[row][2] === player ||
                cells[0][col] === player && cells[1][col] === player && cells[2][col] === player ||
                cells[0][0] === player && cells[1][1] === player && cells[2][2] === player ||
                cells[0][2] === player && cells[1][1] === player && cells[2][0] === player
            );
        }

        function checkDraw() {
            return cells.flat().every(cell => cell !== "");
        }
    </script>
</body>
</html>

