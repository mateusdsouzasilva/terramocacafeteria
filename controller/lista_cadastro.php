<?php
// Conecta no banco de dados
require_once '../util/conexao.php';

try {
    // Roda o select
    $sql = "SELECT * FROM pessoa WHERE PESSOA.STATUS = 'N' LIMIT $recordsPerPage OFFSET $offset";
    $stmt = $pdo->query($sql);

    // Armazena os resultados em uma variável
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Redireciona para o arquivo que você quer visualizar com os dados
    header("Location: ../cadastro/listar_cadastros.php?dados=".urlencode(json_encode($resultados)));
    exit;
} catch (PDOException $e) {
    // Em caso de erro na consulta, exibe uma mensagem de erro
    die("Erro ao executar consulta: " . $e->getMessage());
} finally {
    // Fecha a conexão com o banco de dados
    $pdo = null;
}
?>
