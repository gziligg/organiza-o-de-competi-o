<?php
include_once '../conexao/conexao.php';

if (isset($_POST['grupoId'])) {
    $grupoId = $_POST['grupoId'];

    $sql = "UPDATE grupos SET status = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $grupoId);

    if ($stmt->execute()) {
        echo json_encode(['message' => 'Status atualizado com sucesso.']);
    } else {
        echo json_encode(['message' => 'Erro ao atualizar status.']);
    }

    $stmt->close();
} else {
    echo json_encode(['message' => 'ID do grupo não fornecido.']);
}

$conn->close();
?>
