<?php
include_once '../conexao/conexao.php';

// Verifica se o evento_id foi recebido via GET
if (isset($_GET['categoria_id'])) {
    $categoriaId = $_GET['categoria_id'];

    // Consulta SQL para buscar as categorias associadas ao evento
    $sql = "SELECT * FROM categorias WHERE id = $categoriaId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="catinfo">';
            echo '<h4>' . $row['nome'] . '</h4>';
            echo '<h4>' . $row['inscritos'] . '</h4>';
            echo '</div>';
        }
    } else {
        echo '<p>Nenhuma categoria encontrada para este evento.</p>';
    }

    $conn->close();
} else {
    echo '<p>Não foi fornecido um ID de evento.</p>';
}
?>
