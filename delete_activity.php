<?php
session_start();
include 'config.php';

if (!isset($_GET['id']) || !isset($_GET['turma_id'])) {
    header("Location: dashboard.php");
    exit();
}

$atividade_id = $_GET['id'];
$turma_id = $_GET['turma_id'];

$stmt = $pdo->prepare("DELETE FROM Atividade WHERE id = ?");
$stmt->execute([$atividade_id]);

header("Location: view_activities.php?id=" . $turma_id);
exit();
?>
