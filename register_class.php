<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_turma = $_POST['nome_turma'];
    $professor_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO Turma (nome, professor_id) VALUES (?, ?)");
    $stmt->execute([$nome_turma, $professor_id]);

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Turma</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistema de Gestão Escolar</h1>
            <nav>
                <a href="logout.php">Sair</a>
            </nav>
        </header>
        <h2>Cadastro de Turma</h2>
        <form action="register_class.php" method="post">
            <label for="nome_turma">Nome da Turma:</label>
            <input type="text" id="nome_turma" name="nome_turma" required><br><br>
            <button type="submit">Cadastrar</button>
        </form>
        <a class="button" href="dashboard.php">Voltar</a>
    </div>
</body>
</html>
