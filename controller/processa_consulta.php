<?php
// Verifica se os dados do formulário foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados enviados do formulário
    $nome_pessoa = '%'.strtoupper($_POST['nome_pessoa']).'%';
    $data_nascimento = $_POST['data_nascimento'];
    $telefone_pessoa = '%'.$_POST['telefone_pessoa'].'%';
    $cpf_pessoa = '%'.$_POST['cpf_pessoa'].'%';

    // Estabeleça a conexão com o banco de dados (substitua com suas credenciais)
    require_once '../util/conexao.php';

    // Construa a consulta SQL dinamicamente com base nos parâmetros fornecidos
    $sql = "SELECT * FROM pessoa WHERE 1=1";

    if (!empty($nome_pessoa)) {
        $sql .= " AND nome_pessoa LIKE :nome_pessoa";
    }
    if (!empty($data_nascimento)) {
        $sql .= " AND data_nascimento = :data_nascimento";
    }
    if (!empty($telefone_pessoa)) {
        $sql .= " AND telefone_pessoa LIKE :telefone_pessoa";
    }
    if (!empty($cpf_pessoa)) {
        $sql .= " AND cpf_pessoa LIKE :cpf_pessoa";
    }

    // Prepara e executa a consulta SQL
    $stmt = $pdo->prepare($sql);

    // Associa os parâmetros aos placeholders da consulta
    if (!empty($nome_pessoa)) {
        $stmt->bindValue(':nome_pessoa', $nome_pessoa);
    }
    if (!empty($data_nascimento)) {
        $stmt->bindValue(':data_nascimento', $data_nascimento);
    }
    if (!empty($telefone_pessoa)) {
        $stmt->bindValue(':telefone_pessoa', $telefone_pessoa);
    }
    if (!empty($cpf_pessoa)) {
        $stmt->bindValue(':cpf_pessoa', $cpf_pessoa);
    }

    // Executa a consulta preparada
    $stmt->execute();

    // Obtém os resultados da consulta como um array associativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se há resultados para exibição
    if ($resultados) {
    
        // Monta a tabela com os resultados da consulta
        echo '<table class="table">';
        echo '<thead><tr><th>Nome</th><th>Data Nascimento</th><th>Telefone</th><th>CPF</th><th>Status</th></tr></thead>';
        echo '<tbody>';
        foreach ($resultados as $resultado) {

            if ($resultado['status'] === 'S') {
                $status = 'Consumiu';
            }else{
                $status = 'Não Consumiu';
            }
            
            echo '<tr>';
            echo '<td>' . $resultado['nome_pessoa'] . '</td>';
            echo '<td>' . date('d/m/Y', strtotime($resultado['data_nascimento'])) . '</td>';
            echo '<td>' . $resultado['telefone_pessoa'] . '</td>';
            echo '<td>' . $resultado['cpf_pessoa'] . '</td>';
            echo '<td>' . $status . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>Nenhum resultado encontrado.</p>';
    }
} else {
    // Se não for uma requisição POST, retorne uma mensagem de erro
    echo 'Erro: Requisição inválida.';
}
?>
