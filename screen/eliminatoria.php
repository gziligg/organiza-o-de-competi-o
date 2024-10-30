<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
    <link rel="stylesheet" href="../css/principal.css";>
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
                <a href="eventos.php">
                <i class="fas fa-calendar-alt"></i>
                <span class="nav-item">Eventos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="se lected" href="">
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
                    <h2>Eliminatórias</h2>
                    <h4>Gerenciar Eliminatórias</h4>
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

                            $search = isset($_GET['search']) ? $_GET['search'] : '';

                            $sql = "SELECT * FROM eventos";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<a href="#" class="atletasview" data-evento-id="' . $row['id'] . '">';
                                    echo '<h4>' . $row['nome_evento'] . '</h4>';
                                    echo '</a>';
                                }
                            } else {
                                echo 'Nenhum atleta encontrado.';
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
                    <div class="subcategoriasgp"></div>
                    <div class="difeventos-sep-1">
                        <i class="fas fa-table-tennis"></i>
                        <p>Categorias</p>
                    </div>
                </div>
                <div class="contatletas">
                    <div class="subgrupos"></div>
                    <div class="difeventos-sep-1">
                        <i class="fas fa-users"></i>
                        <p>Grupos</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.atletasview').on('click', function(e) {
                e.preventDefault();
                var eventoId = $(this).data('evento-id');   

                $.ajax({
                    url: '../get/get_categorias_gp.php',
                    type: 'GET',
                    data: { evento_id: eventoId },
                    success: function(response) {
                        $('.subcategoriasgp').html(response);
                    },
                    error: function() {
                        $('.subcategoriasgp').html('<p>Erro ao buscar categorias para este evento.</p>');
                    }
                });
            });

            // Adicionando o evento de clique para as categorias
            $(document).on('click', '.evecategorias', function(e) {
                e.preventDefault();
                var categoriaId = $(this).data('categoria-id');

                $.ajax({
                    url: '../get/get_grupos.php',
                    type: 'GET',
                    data: { categoria_id: categoriaId },
                    success: function(response) {
                        $('.subgrupos').html(response);
                    },
                    error: function() {
                        $('.subgrupos').html('<p>Erro ao buscar grupos para esta categoria.</p>');
                    }
                });
            });
        });
    </script>
</body>
</html>
