<?php
include_once '../conexao/conexao.php';

if (isset($_GET['categoria_id'])) {
    $categoria_Id = $_GET['categoria_id'];
    
    // Atualizada a consulta para incluir o status do grupo
    $sql = "
        SELECT g.numgp, 
               g.id AS grupo_id, 
               g.pessoa1 AS id1,
               g.pessoa2 AS id2,
               g.pessoa3 AS id3,
               g.pessoa4 AS id4,
               g.status, -- Incluindo status
               CONCAT(a1.nome, ' ', a1.sobrenome) AS pessoa1, 
               CONCAT(a2.nome, ' ', a2.sobrenome) AS pessoa2, 
               CONCAT(a3.nome, ' ', a3.sobrenome) AS pessoa3,
               CONCAT(a4.nome, ' ', a4.sobrenome) AS pessoa4,
               a1.evento AS evento_id1,
               a2.evento AS evento_id2,
               a3.evento AS evento_id3,
               a4.evento AS evento_id4
        FROM grupos g
        LEFT JOIN atletas a1 ON g.pessoa1 = a1.id
        LEFT JOIN atletas a2 ON g.pessoa2 = a2.id
        LEFT JOIN atletas a3 ON g.pessoa3 = a3.id
        LEFT JOIN atletas a4 ON g.pessoa4 = a4.id
        WHERE g.categoria = $categoria_Id
    ";

    $result = $conn->query($sql);

    echo '<div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <div id="modal-body"></div>
            </div>
          </div>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Determinando o ID do evento a partir do primeiro atleta
            $eventoId = $row['evento_id1'] ? $row['evento_id1'] : ($row['evento_id2'] ? $row['evento_id2'] : ($row['evento_id3'] ? $row['evento_id3'] : $row['evento_id4']));

            // Verificando o status
            $isDisabled = $row['status'] == 1 ? 'disabled' : '';

            // Alterando o estilo com base no status
            echo '<div class="catinfo ' . $isDisabled . '" style="cursor: ' . ($isDisabled ? 'not-allowed' : 'pointer') . '" data-group="' . htmlspecialchars($row['numgp']) . '" data-grupo-id="' . htmlspecialchars($row['grupo_id']) . '" data-athletes=\'' . htmlspecialchars(json_encode([$row['id1'], $row['id2'], $row['id3'], $row['id4']])) . '\' data-names=\'' . htmlspecialchars(json_encode([$row['pessoa1'], $row['pessoa2'], $row['pessoa3'], $row['pessoa4']])) . '\' data-categoria="' . $categoria_Id . '" data-evento="' . htmlspecialchars($eventoId) . '">';
            
            echo '<h4>Grupo ' . $row['numgp'] . '</h4>';
            echo '<h4>' . ($row['pessoa1'] ? $row['pessoa1'] : 'N/A') . '</h4>';
            echo '<h4>' . ($row['pessoa2'] ? $row['pessoa2'] : 'N/A') . '</h4>';
            echo '<h4>' . ($row['pessoa3'] ? $row['pessoa3'] : 'N/A') . '</h4>';
            echo '<h4>' . ($row['pessoa4'] ? $row['pessoa4'] : 'N/A') . '</h4>';
            echo '</div>';
        }
    } else {
        echo '<p>Nenhuma categoria encontrada para este evento.</p>';
    }

    $conn->close();

    echo '<script>
            document.querySelectorAll(".catinfo").forEach(function(element) {
                element.addEventListener("click", function() {
                    // Verifique se o grupo está desabilitado
                    if (this.classList.contains("disabled")) {
                        return; // Não faz nada se o grupo estiver desabilitado
                    }

                    const groupName = this.getAttribute("data-group");
                    const grupoId = this.getAttribute("data-grupo-id"); // Obtendo o ID do grupo
                    const athletes = JSON.parse(this.getAttribute("data-athletes"));
                    const athleteNames = JSON.parse(this.getAttribute("data-names"));
                    const categoria = this.getAttribute("data-categoria");
                    const evento = this.getAttribute("data-evento");

                    let checklist = "<h2>Grupo " + groupName + "</h2>";
                    checklist += "<form>";

                    athletes.forEach(function(athleteId, index) {
                        if (athleteId) {
                            checklist += `<label><input type=\\"checkbox\\" class=\\"athlete-checkbox\\" data-index=\\"${index}\\" /> ${athleteNames[index]} <span class=\\"number-label\\" id=\\"number-${index}\\" style=\\"display: none;\\"></span></label><br />`;
                        }
                    });

                    checklist += \'<button type="button" id="submit-button" disabled>Enviar</button>\'; // Inicia como desabilitado
                    checklist += "</form>";
                    document.getElementById("modal-body").innerHTML = checklist;

                    // Restrições de seleção
                    const checkboxes = document.querySelectorAll(".athlete-checkbox");
                    let selectedCount = 0;

                    // Verifica quantos atletas estão disponíveis
                    const availableAthletes = athletes.filter(id => id).length;

                    checkboxes.forEach((checkbox, index) => {
                        checkbox.addEventListener("change", function() {
                            if (this.checked) {
                                if (selectedCount < 2) {
                                    selectedCount++;
                                    document.getElementById("number-" + this.getAttribute("data-index")).innerText = selectedCount;
                                    document.getElementById("number-" + this.getAttribute("data-index")).style.display = "inline";
                                } else {
                                    this.checked = false; // Reverte a seleção se já houver 2 selecionados
                                }
                            } else {
                                selectedCount--;
                                updateNumbers();
                            }
                            toggleSubmitButton(); // Atualiza o estado do botão ao mudar a seleção
                        });
                    });

                    function updateNumbers() {
                        let currentNum = 1;
                        checkboxes.forEach(chk => {
                            if (chk.checked) {
                                document.getElementById("number-" + chk.getAttribute("data-index")).innerText = currentNum++;
                                document.getElementById("number-" + chk.getAttribute("data-index")).style.display = "inline";
                            } else {
                                document.getElementById("number-" + chk.getAttribute("data-index")).style.display = "none";
                            }
                        });
                    }

                    function toggleSubmitButton() {
                        const submitButton = document.getElementById("submit-button");
                        // Se há apenas 1 atleta disponível, habilite se estiver selecionado
                        if (availableAthletes === 1) {
                            submitButton.disabled = selectedCount !== 1; // Habilita se 1 jogador estiver selecionado
                        } else {
                            submitButton.disabled = selectedCount !== 2; // Habilita se 2 jogadores estiverem selecionados
                        }
                    }

                    // Ação do botão "Enviar"
                    document.getElementById("submit-button").addEventListener("click", function() {
                        const selectedAthletes = [];
                        const athleteIds = [];

                        checkboxes.forEach((checkbox, index) => {
                            if (checkbox.checked) {
                                selectedAthletes.push(checkbox.nextSibling.textContent.trim());
                                athleteIds.push(athletes[index]);
                            }
                        });

                        if (athleteIds.length > 0) {
                            $.ajax({
                                url: \'../get/insert_eliminatorias.php\',
                                type: \'POST\',
                                data: {
                                    athletes: athleteIds,
                                    group: groupName,
                                    categoria: categoria,
                                    evento: evento,
                                    grupoId: grupoId // Passando o ID do grupo
                                },
                                success: function(response) {
                                    // Atualizando o status do grupo
                                    $.ajax({
                                        url: \'../get/update_status.php\',
                                        type: \'POST\',
                                        data: {
                                            grupoId: grupoId // Passando o ID do grupo para atualizar o status
                                        },
                                        success: function(updateResponse) {
                                            window.location.reload(); // Atualiza a página
                                        },
                                        error: function() {
                                            console.error("Erro ao atualizar o status do grupo.");
                                        }
                                    });
                                },
                                error: function() {
                                    console.error("Erro ao enviar dados para o servidor.");
                                }
                            });
                        } else {
                            console.error("Nenhum atleta selecionado.");
                        }
                    });

                    document.getElementById("myModal").style.display = "block";
                });
            });

            document.querySelector(".close").addEventListener("click", function() {
                document.getElementById("myModal").style.display = "none";
            });

            window.onclick = function(event) {
                const modal = document.getElementById("myModal");
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
          </script>';
} else {
    echo '<p>Não foi fornecido um ID de evento.</p>';
}
?>
