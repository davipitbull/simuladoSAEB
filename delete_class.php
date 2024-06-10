<?php
session_start();
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$turma_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM Atividade WHERE turma_id = ?");
$stmt->execute([$turma_id]);
$atividades = $stmt->fetchColumn();

if ($atividades > 0) {
    echo "Você não pode excluir uma turma com atividades cadastradas";
    echo "<br><a href='dashboard.php'>Voltar</a>";
} else {
    $stmt = $pdo->prepare("DELETE FROM Turma WHERE id = ?");
    $stmt->execute([$turma_id]);
    header("Location: dashboard.php");
}
?>
