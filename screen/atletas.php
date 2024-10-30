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
                <a href="eventos.php">
                <i class="fas fa-calendar-alt"></i>
                <span class="nav-item">Eventos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="selected" href="">
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
                        <a class="add" href="#" id="add-evento"><i class="fas fa-calendar-alt"></i>Evento</a>
                        <a class="add" href="#" id="add-categoria"><i class="fas fa-table-tennis"></i>Categoria</a>
                        <a class="add" href="#" id="add-atleta"><i class="fas fa-user"></i>Atleta</a>
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
                    <h2>Atletas</h2>
                    <h4>Gerenciar atletas</h4>
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

                            $sql = "SELECT * FROM atletas";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<a href="#" class="atletasview" data-empresa-id="' . $row['id'] . '">';
                                    echo '<h4>' . $row['nome'] . '</h4>';
                                    echo '<h4>' . $row['sobrenome'] . '</h4>';
                                    echo '</a>';
                                }
                            } else {
                                echo 'Nenhum atleta encontrado.';
                            }

                            $conn->close();
                        ?>
                    </div>
                    <div class="difeventos-sep-1">
                        <i class="fas fa-users"></i>
                        <p>Atletas</p>
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
                        <i class="fas fa-pen"></i>
                        <p>Editar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modais -->
    <div id="modal-evento" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="modal-evento">&times;</span>
            <h2>Criar Evento</h2>
            <!-- Adicione seu formulário ou conteúdo aqui -->
            <p>Conteúdo para criar evento.</p>
        </div>
    </div>

    <div id="modal-categoria" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="modal-categoria">&times;</span>
            <h2>Criar Categoria</h2>
            <!-- Adicione seu formulário ou conteúdo aqui -->
            <p>Conteúdo para criar categoria.</p>
        </div>
    </div>

    <div id="modal-atleta" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="modal-atleta">&times;</span>
            <h2>Criar Atleta</h2>
            <!-- Adicione seu formulário ou conteúdo aqui -->
            <p>Conteúdo para criar atleta.</p>
        </div>
    </div>

    <script src="../script/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Abrindo os modais
            $('#add-evento').on('click', function(e) {
                e.preventDefault();
                $('#modal-evento').show();
            });

            $('#add-categoria').on('click', function(e) {
                e.preventDefault();
                $('#modal-categoria').show();
            });

            $('#add-atleta').on('click', function(e) {
                e.preventDefault();
                $('#modal-atleta').show();
            });

            // Fechando os modais
            $('.close').on('click', function() {
                var modalId = $(this).data('modal');
                $('#' + modalId).hide();
            });

            // Fechando o modal ao clicar fora dele
            $(window).on('click', function(event) {
                $('.modal').each(function() {
                    if (event.target === this) {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>
</html>
