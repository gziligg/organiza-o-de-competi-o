<?php

include_once '../conexao/conexao.php';

if (isset($_GET['iniciar'])) {
    $eventoId = $_GET['iniciar'];

    $sql = "SELECT * FROM categorias WHERE evento = '$eventoId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categoria = $row['nome'];
            $inscritos = $row['inscritos'];

            if ($inscritos <= 4) {
                header("location: eventos.php");
                exit();
            }

            $sql = "SELECT nome_evento FROM eventos WHERE id = $eventoId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nomeEvento = $row['nome_evento'];

                $sqlAtletas = "SELECT id, categoria FROM atletas WHERE evento = '$nomeEvento'";
                $resultAtletas = $conn->query($sqlAtletas);

                if ($resultAtletas->num_rows > 0) {
                    $atletasPorCategoria = array();

                    while ($rowAtleta = $resultAtletas->fetch_assoc()) {
                        $atletasPorCategoria[$rowAtleta['categoria']][] = $rowAtleta['id'];
                    }

                    foreach ($atletasPorCategoria as $categoria => $nomesAtletas) {
                        shuffle($nomesAtletas);

                        $numGrupos = ceil(count($nomesAtletas) / 3);

                        for ($i = 1; $i <= $numGrupos; $i++) {
                            $atleta1 = isset($nomesAtletas[($i - 1) * 3]) ? $nomesAtletas[($i - 1) * 3] : '';
                            $atleta2 = isset($nomesAtletas[($i - 1) * 3 + 1]) ? $nomesAtletas[($i - 1) * 3 + 1] : '';
                            $atleta3 = isset($nomesAtletas[($i - 1) * 3 + 2]) ? $nomesAtletas[($i - 1) * 3 + 2] : '';

                            // Verificar se o ID do atleta já existe na tabela "grupos" para o evento atual
                            $sqlVerificarAtleta = "SELECT id FROM grupos WHERE evento = '$nomeEvento' AND (pessoa1 = $atleta1 OR pessoa2 = $atleta1 OR pessoa3 = $atleta1)";
                            $resultVerificarAtleta = $conn->query($sqlVerificarAtleta);

                            if ($resultVerificarAtleta->num_rows === 0) {
                                // Inserir informações na tabela "grupos"
                                $sqlInserirGrupos = "INSERT INTO grupos (evento, categoria, numgp, pessoa1, pessoa2, pessoa3) VALUES ('$nomeEvento', '$categoria', $i, '$atleta1', '$atleta2', '$atleta3')";
                                
                                if ($conn->query($sqlInserirGrupos) !== true) {
                                    echo "Erro ao inserir dados na tabela grupos: " . $conn->error;
                                }
                            }
                        }
                    }

                    // Atualizar o evento como iniciado
                    $sqlAtualizarEvento = "UPDATE eventos SET iniciado = 1 WHERE id = $eventoId";
                    if ($conn->query($sqlAtualizarEvento) !== true) {
                        echo "Erro ao atualizar o evento: " . $conn->error;
                    }
                }
            }
        }  
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" href="../css/principal.css">
    <title>Eventos</title>
</head>
<body>
    <nav>
        <i class="logo">Eventos</i>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="dashboard.php">
                <i class="fas fa-bars"></i>
                <span class="nav-item">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="selected" href="">
                <i class="fas fa-calendar-alt"></i>
                <span class="nav-item">Eventos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="atletas.php">
                <i class="fas fa-user"></i>
                <span class="nav-item">Atletas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="categorias.php">
                <i class="fas fa-table-tennis"></i>
                <span class="nav-item">Categoria</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="grupos.php">
                <i class="fas fa-users"></i>
                <span class="nav-item">Grupos</span>
                </a>
            </li>
            <li class="nav-item ittbtn">
                <a href="#" class="addbtn">
                    <i class="fas fa-plus"></i>
                    <span class="nav-item">Adicionar</span>
                </a>
                <div class="add-dropdown">
                    <div class="dropdown">
                        <a class="add" href="#"><i class="fas fa-calendar-alt"></i>Evento</a>
                        <a class="add" href="#"><i class="fas fa-table-tennis"></i>Categoria</a>
                        <a class="add" href="#"><i class="fas fa-user"></i>Atleta</a>
                    </div>
                </div>
            </li>
        </ul>
        <div class="menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
    <div class="cont-geral">
        <div class="cont-secundario-pricipal">
            <div class="config">
                <div class="configsep1">
                    <h2>Eventos</h2>
                    <h4>Gerenciar eventos</h4>
                </div>
                <div class="configsep2">        
        
                </div>
            </div>
            <hr class="separ">
            <div class="eventosep">
                <div class="conteventos">
                    <div class="subeventos">
                        <?php
                            include_once '../conexao/conexao.php';

                            $sql = "SELECT * FROM eventos";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="sepeventview">';
                                    echo '<div class="eventview" data-evento-id="' . $row['id'] . '">';
                                    echo '<h4>' . $row['nome_evento'] . '</h4>';
                                    echo '</div>';
                                    
                                    if ($row['iniciado'] == 1) {
                                        echo '<a class="play disabled" href="#"><i class="fas fa-play"></i></a>';
                                    } else {
                                        echo '<a class="play" href="eventos.php?iniciar=' . $row["id"] . '"><i class="fas fa-play"></i></a>';
                                    }                                    

                                    echo '</div>';
                                }
                            } else {
                                echo 'Nenhum evento encontrado.';
                            }

                            $conn->close();
                        ?>
                    </div>
                    <div class="difeventos-sep-1">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Eventos</p>
                    </div>
                </div>
                <div class="contcategorias">
                    <div class="subcategorias"></div>
                    <div class="difeventos-sep-1">
                        <i class="fas fa-info"></i>
                        <p>Informações</p>
                    </div>
                </div>
                <div class="contatletas">
                    <div class="subatletas"></div>
                    <div class="difeventos-sep-1">
                        <i class="fas fa-table-tennis"></i>
                        <p>Categorias</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal para Evento -->
    <div id="addEventModal" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="addEventModal">&times;</span>
            <h2>Adicionar Evento</h2>
            <form id="eventForm">
                <div id="modalBodyEvent">
                    <input type="text" placeholder="Nome do Evento" required>
                    <!-- Adicione outros campos necessários para Evento -->
                </div>
                <button type="submit" id="submitEventButton">Salvar</button>
            </form>
        </div>
    </div>

    <!-- Modal para Categoria -->
    <div id="addCategoryModal" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="addCategoryModal">&times;</span>
            <h2>Adicionar Categoria</h2>
            <form id="categoryForm">
                <div id="modalBodyCategory">
                    <input type="text" placeholder="Nome da Categoria" required>
                    <!-- Adicione outros campos necessários para Categoria -->
                </div>
                <button type="submit" id="submitCategoryButton">Salvar</button>
            </form>
        </div>
    </div>

    <!-- Modal para Atleta -->
    <div id="addAthleteModal" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="addAthleteModal">&times;</span>
            <h2>Adicionar Atleta</h2>
            <form id="athleteForm">
                <div id="modalBodyAthlete">
                    <input type="text" placeholder="Nome do Atleta" required>
                    <!-- Adicione outros campos necessários para Atleta -->
                </div>
                <button type="submit" id="submitAthleteButton">Salvar</button>
            </form>
        </div>
    </div>

    <script src="../script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).ready(function() {
        // Abre o modal ao clicar nos links da dropdown
        $('.add-dropdown .add').on('click', function(e) {
            e.preventDefault();
            var action = $(this).text(); // Pega o texto do link

            // Fecha todos os modais antes de abrir um novo
            $('.modal').css('display', 'none');

            if (action === 'Evento') {
                $('#addEventModal').css('display', 'block'); // Mostra o modal de Evento
            } else if (action === 'Categoria') {
                $('#addCategoryModal').css('display', 'block'); // Mostra o modal de Categoria
            } else if (action === 'Atleta') {
                $('#addAthleteModal').css('display', 'block'); // Mostra o modal de Atleta
            }
        });

        // Fecha o modal quando o usuário clicar no 'x'
        $('.close').on('click', function() {
            var modalId = $(this).data('modal');
            $('#' + modalId).css('display', 'none');
        });

        // Fecha o modal quando clicar fora do modal
        $(window).on('click', function(event) {
            $('.modal').each(function() {
                if ($(event.target).is(this)) {
                    $(this).css('display', 'none');
                }
            });
        });

        // Lógica para o envio do formulário do modal
        $('#eventForm').on('submit', function(e) {
            e.preventDefault();
            alert('Evento salvo!'); // Lógica para salvar o evento
            $('#addEventModal').css('display', 'none'); // Fecha o modal
        });

        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();
            alert('Categoria salva!'); // Lógica para salvar a categoria
            $('#addCategoryModal').css('display', 'none'); // Fecha o modal
        });

        $('#athleteForm').on('submit', function(e) {
            e.preventDefault();
            alert('Atleta salvo!'); // Lógica para salvar o atleta
            $('#addAthleteModal').css('display', 'none'); // Fecha o modal
        });
    });

        $('.eventview').on('click', function(e) {
            e.preventDefault();
            var eventoId = $(this).data('evento-id');

            // Fazer uma requisição AJAX para buscar as informações do evento
            $.ajax({
                url: '../get/get_evento.php',
                type: 'GET',
                data: { evento_id: eventoId },
                success: function(response) {
                    var evento = JSON.parse(response);

                    if (evento.error) {
                        $('.subcategorias').html('<p>' + evento.error + '</p>');
                    } else {
                        var eventoHtml = '<h4>' + evento.nome_evento + '</h4>';

                        $('.subcategorias').html(eventoHtml);
                    }
                },
                error: function() {
                    $('.subcategorias').html('<p>Erro ao buscar informações do evento.</p>');
                }
            });

            $.ajax({
                url: '../get/get_categorias_info.php',
                type: 'GET',
                data: { evento_id: eventoId },
                success: function(response) {
                    $('.subatletas').html(response);
                },
                error: function() {
                    $('.subatletas').html('<p>Erro ao buscar categorias para este evento.</p>');
                }
            });
        });
    });

        
    </script>
</body>
</html>
