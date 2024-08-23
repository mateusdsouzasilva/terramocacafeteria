<?php
    include '../cadastro/head.php';
    session_start();
    if (!isset($_SESSION['nome_pessoa'])) {
        // Se não estiver autenticado, redirecione para a página de login
        header("Location: ../cadastro/index.php");
        exit();
    }
?>
<body>
    <nav class="navbar">
        <div class="container">
            <img src="../imagens/logo.jpeg" alt="" class="rounded mx-auto d-block logo-imagem">
        </div>
    </nav>
    <div class="container">
        <h3 class="text-center titulo-tabela">Consultar Individual</h3>
        <div class="row">
            <div class="col-md-12">
                <button class="btn" onclick="voltar()">Voltar</button>
            </div>
        </div>
        <br>
        <form method="post" onsubmit="return consultar(event)" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome_pessoa" id="nome_pessoa">
            </div>
            <div class="col-md-6">
                <label for="nascimento" class="form-label">Data Nascimento</label>
                <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
            </div>
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="number" pattern="[0-9]*" class="form-control" name="telefone_pessoa" id="telefone_pessoa">
            </div>
            <div class="col-md-6">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" name="cpf_pessoa" id="cpf_pessoa">
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn">Consultar</button>
            </div>
        </form>

        <!-- Área para exibir os resultados da consulta -->
    <div id="resultadoConsulta" class="mt-4 table-responsive">
        <!-- Os resultados da consulta serão inseridos aqui via AJAX -->
    </div>
    </div>

    <script>
        const voltar = () => {
            window.location.href = '../cadastro/listar_cadastros.php';
        };

        // Definição da função consultar
        const consultar = (event) => {
    event.preventDefault(); // Impede o envio padrão do formulário

    // Obter os valores dos campos do formulário
    const nome_pessoa = document.getElementById('nome_pessoa').value;
    const data_nascimento = document.getElementById('data_nascimento').value;
    const telefone_pessoa = document.getElementById('telefone_pessoa').value;
    const cpf_pessoa = document.getElementById('cpf_pessoa').value;

    // Enviar os dados via AJAX para o PHP processar a consulta
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../controller/processa_consulta.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            // Exibir os resultados na área designada
            document.getElementById('resultadoConsulta').innerHTML = xhr.responseText;
        } else {
            console.error('Erro ao processar a requisição.');
        }
    };
    xhr.onerror = function() {
        console.error('Erro de rede.');
    };
    xhr.send(`nome_pessoa=${nome_pessoa}&data_nascimento=${data_nascimento}&telefone_pessoa=${telefone_pessoa}&cpf_pessoa=${cpf_pessoa}`);
};

    </script>
</body>
</html>