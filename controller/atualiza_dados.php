<?php
require_once '../util/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['ids']; // IDs dos registros a serem atualizados

    try {
        // Exemplo: Atualizar algum campo no banco para os IDs selecionados
        $sql = "UPDATE pessoa SET status = 'S' WHERE id_pessoa IN (" . implode(',', $ids) . ")";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        echo 'Atualização realizada com sucesso!';
    } catch (PDOException $e) {
        echo 'Erro ao atualizar dados: ' . $e->getMessage();
    } finally {
        $pdo = null;
    }
}
?>
