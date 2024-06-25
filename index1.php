<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fale Conosco</title>
</head>
<body>
    <h2>Enviar Mensagem</h2>

    <form action="enviar.php" method="POST">
        <div>
            <input type="email" name="email" placeholder="E-mail" required>
        </div>
        <div>
            <input type="text" name="nome" placeholder="Nome" required>
        </div>
        <div>
            <textarea name="msg" placeholder="Mensagem" required></textarea>
        </div>
        <input type="submit" name="enviar">
    </form>
</body>
</html>