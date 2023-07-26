<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type=text] {
            width: 50%;
            height: 200px;
            margin-bottom: 20px;
        }
        button {
            width: 100px;
            height: 30px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Escreva sua mensagem:</h1>
    <form action="process.php" method="POST">
        <input type="text" name="message" id="message" placeholder="Escreva...">
        <button type="submit">Enviar</button>
    </form>
    <h2>Hello World</h2>
</body>
</html>