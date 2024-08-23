<?php
    include 'head.php';
    session_start();
    if (!isset($_SESSION['nome_pessoa'])) {
        // Se não estiver autenticado, redirecione para a página de login
        header("Location: index.php");
        exit();
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
       $(document).ready(function() {
        var currentPage = 1; // Página inicial
        var recordsPerPage = 5; // Número de registros por página

        // Função para carregar os dados da página específica via AJAX
        function loadPage(page) {
            console.log("Carregando página:", page);
            $.ajax({
                url: '../controller/processa_dados.php', // Verifique o caminho correto para o arquivo PHP
                type: 'GET',
                data: {
                    page: page,
                    recordsPerPage: recordsPerPage
                },
                success: function(response) {
                    // Atualiza a tabela com os dados recebidos
                    $('tbody').html(response); // Use $('tbody') para selecionar a área da tabela corretamente
                }
            });
        }

        // Carregar a primeira página ao carregar a página HTML
        loadPage(currentPage);

        // Evento de clique no botão "Próximo"
        $('#nextBtn').click(function() {
            console.log("Botão 'Próximo' clicado");
            currentPage++;
            loadPage(currentPage);
        });

        // Evento de clique no botão "Anterior"
        $('#prevBtn').click(function() {
            console.log("Botão 'Anterior' clicado");
            if (currentPage > 1) {
                currentPage--;
                loadPage(currentPage);
            }
        });
    });

    $(document).ready(function() {
        // Função para atualizar o banco de dados com os IDs selecionados
        function updateCheckedItems(ids) {
            $.ajax({
                url: '../controller/atualiza_dados.php', // Arquivo PHP para processar a atualização
                type: 'POST',
                data: { ids: ids },
                success: function(response) {
                    alert('Dados atualizados com sucesso!');
                    // Recarregar a página para exibir as atualizações
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('Erro ao atualizar dados: ' + error);
                }
            });
        }

        // Evento de clique no botão "Atualizar"
        $('#updateBtn').click(function() {
            var checkedIds = [];
            $('.check-item:checked').each(function() {
                checkedIds.push($(this).data('id'));
            });

            if (checkedIds.length > 0) {
                updateCheckedItems(checkedIds);
            } else {
                alert('Selecione pelo menos um item para atualizar.');
            }
        });
    });

    $(document).ready(function() {
        $('#consultar').click(function() {
            // Redirecionar para a página de consulta individual
            window.location.href = '../consulta/consulta_individual.php';
        });
    });

    </script>

<body>
    <nav class="navbar">
    <div class="container">
        <img src="../imagens/logo.jpeg" alt="" class="rounded mx-auto d-block logo-imagem">
    </div>
    </nav>
    <div class="container">
        <div class="row">
            <h3 class="text-center titulo-tabela">Cadastros Realizados</h3>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn" id="consultar">Consultar Individual</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Data Nascimento</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Atualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php require_once '../controller/processa_dados.php'; ?>   
                    </tbody>
                </table>   
            </div>      
            <!-- Após a tabela -->
            <p>Total de cadastros: <?php echo $totalRecords; ?></p>      
   
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <button class="btn" id="prevBtn">Anterior</button>
                <button class="btn" id="nextBtn">Próximo</button>
                <button class="btn" id="updateBtn">Atualizar Selecionados</button> <!-- Botão para atualizar -->
            </div>
        </div>
        <br>
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>