<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <h2>Bem-vindo, <?php echo $_SESSION['user_name']; ?></h2>
        <a class="button" href="register_class.php">Cadastrar Turma</a>

        <h3>Suas Turmas</h3>
        <table>
            <tr>
                <th>Número da Turma</th>
                <th>Nome da Turma</th>
                <th>Ações</th>
            </tr>
            <?php
            include 'config.php';
            $stmt = $pdo->prepare("SELECT * FROM Turma WHERE professor_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $turmas = $stmt->fetchAll();
            
            foreach ($turmas as $turma) {
                echo "<tr>";
                echo "<td>" . $turma['id'] . "</td>";
                echo "<td>" . $turma['nome'] . "</td>";
                echo "<td><a class='button' href='delete_class.php?id=" . $turma['id'] . "'>Excluir</a> | <a class='button' href='view_activities.php?id=" . $turma['id'] . "'>Visualizar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
