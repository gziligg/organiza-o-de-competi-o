<?php
include_once '../conexao/conexao.php';

if (isset($_POST['athletes']) && isset($_POST['group']) && isset($_POST['categoria']) && isset($_POST['evento'])) {
    $athletes = $_POST['athletes'];
    $group = $_POST['group'];
    $categoria = $_POST['categoria']; // Obtendo a categoria
    $evento = $_POST['evento']; // Obtendo o evento

    // Prepare a instrução para evitar SQL Injection
    $stmt = $conn->prepare("INSERT INTO eliminatorias (idjogador, lugarg, numgp, categoria, evento) VALUES (?, ?, ?, ?, ?)");

    // Percorre todos os atletas e insere na tabela
    foreach ($athletes as $index => $athleteId) {
        // O número do lugar será baseado no índice do atleta, você pode ajustar isso se necessário
        $lugar = $index + 1; // 1 para o primeiro lugar, 2 para o segundo, etc.

        // Bind dos parâmetros
        $stmt->bind_param("iiiss", $athleteId, $lugar, $group, $categoria, $evento);
        $stmt->execute();
    }

    // Fecha a instrução e a conexão
    $stmt->close();
    $conn->close();

    // Retorna uma resposta JSON
    echo json_encode(['status' => 'success', 'message' => 'Atletas inseridos com sucesso!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Dados não foram fornecidos corretamente.']);
}
?>
