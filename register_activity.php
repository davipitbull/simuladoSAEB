<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $turma_id = $_POST['turma_id'];

    $stmt = $pdo->prepare("INSERT INTO Atividade (descricao, turma_id) VALUES (?, ?)");
    $stmt->execute([$descricao, $turma_id]);

    header("Location: view_activities.php?id=" . $turma_id);
}

$turma_id = $_GET['turma_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Atividade</title>
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
        <h2>Cadastrar Atividade</h2>
        <form action="register_activity.php" method="post">
            <input type="hidden" name="turma_id" value="<?php echo $turma_id; ?>">
            <label for="descricao">Descrição da Atividade:</label>
            <textarea id="descricao" name="descricao" required></textarea><br><br>
            <button type="submit">Cadastrar</button>
        </form>
        <a class="button" href="view_activities.php?id=<?php echo $turma_id; ?>">Voltar</a>
    </div>
</body>
</html>
