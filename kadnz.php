<?php
$result = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'] ?? '';
    $num2 = $_POST['num2'] ?? '';
    $op = $_POST['operation'] ?? '';

    if ($num1 === '' || $num2 === '' || !is_numeric($num1) || !is_numeric($num2)) {
        $error = "Error: Please enter valid integers!";
    } else {
        $n1 = (int)$num1;
        $n2 = (int)$num2;

        switch ($op) {
            case '+':
                $result = $n1 + $n2;
                break;
            case '-':   
                $result = $n1 - $n2;
                break;
            case '*':
                $result = $n1 * $n2;
                break;
            case '/':
                if ($n2 === 0) {
                    $error = "Error: Cannot divide by zero!";
                } else {
                    $result = $n1 / $n2;
                }
                break;
            default:
                $error = "Erorr: Please choose an operation!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calc is short for calculator for the people new to the stream</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(https://cbeditz.com/public/cbeditz/preview/light-wood-background-hd-images-free-photos-5glbsvmdp1.webp);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .calculator {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);  
            width: 300px;
            text-align: center;
            border: 2px solid #0c0c0cff;        
        }

        .field {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 5px 0;
        }

        .field label {
            width: 170px;
            text-align: left;
            font-size: 14px;
        }

        input[type="number"], input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .operation-bt {
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        .clear {
            margin-top: 5px;
        }

        .clear-bt {
            width: 100%;
        }

        button {
            flex: 1;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 4px;
            background-color: #B68e65;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #9f8660;
        }

        .error {
            color: red;
            font-size: 14px;
        }

    </style>
</head>
<body>
    <div class="calculator">
        <h2>Calculator</h2>

        <form id="calc-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="field   ">
                <label for="num1">Input 1st Integer</label>
                <input type="number" id="num1" name="num1" required>
            </div>
            <div class="field">
                <label for="num2">Input 2nd Integer</label>
                <input type="number" id="num2" name="num2" required>
            </div>
            
            <div class="field">
                <label for="result">Result</label>
                <input type="text" id="result" name="result" value="<?php echo $result; ?>" readonly>
            </div>
            <div class="operation-bt">
                <button type="submit" name="operation" value="+">Add</button>
                <button type="submit" name="operation" value="-">Subtract</button>
                <button type="submit" name="operation" value="*">Multiply</button>
                <button type="submit" name="operation" value="/">Divide</button>
            </div>
            <div class="clear">
                <button type="button" class="clear-bt" id="clear-btn">Clear</button>
            </div>
        </form>

        <?php if ($error): ?>
            <p class="error" id="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>

    <script>
        const form = document.getElementById('calc-form');
        const clearBtn = document.getElementById('clear-btn');
        const num1 = document.getElementById('num1');
        const num2 = document.getElementById('num2');
        const result = document.getElementById('result');

        clearBtn.addEventListener('click', () => {
            form.reset();
            num1.value = '';
            num2.value = '';
            result.value = '';

            const errorMsg = document.getElementById('error-msg');
            if (errorMsg) {
                errorMsg.textContent = '';
            }
        });
    </script>
</body>
</html>