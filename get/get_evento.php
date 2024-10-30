<?php
include_once '../conexao/conexao.php';

if (isset($_GET['evento_id'])) {
    $evento_id = $_GET['evento_id'];

    $sql = "SELECT * FROM eventos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $evento_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $evento = $result->fetch_assoc();

    echo json_encode($evento);
} else {
    echo json_encode(array('error' => 'Evento ID não fornecido'));
}

$conn->close();
?>
