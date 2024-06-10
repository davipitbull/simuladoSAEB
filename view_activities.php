<?php
session_start();
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$turma_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM Turma WHERE id = ?");
$stmt->execute([$turma_id]);
$turma = $stmt->fetch();

if (!$turma) {
    header("Location: dashboard.php");
    exit();
}

echo "<h2>Atividades da Turma: " . $turma['nome'] . "</h2>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atividades da Turma</title>
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
        <h2>Atividades da Turma: <?php echo $turma['nome']; ?></h2>
        <a class="button" href="register_activity.php?turma_id=<?php echo $turma['id']; ?>">Cadastrar Atividade</a>

        <h3>Atividades</h3>
        <table>
            <tr>
                <th>Número da Atividade</th>
                <th>Descrição da Atividade</th>
            </tr>
            <?php
            $stmt = $pdo->prepare("SELECT * FROM Atividade WHERE turma_id = ?");
            $stmt->execute([$turma_id]);
            $atividades = $stmt->fetchAll();
            
            foreach ($atividades as $atividade) {
                echo "<tr>";
                echo "<td>" . $atividade['id'] . "</td>";
                echo "<td>" . $atividade['descricao'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a class="button" href="dashboard.php">Voltar</a>
    </div>
</body>
</html>
