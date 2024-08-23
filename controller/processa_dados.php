<?php
// Conecta no banco de dados
require_once '../util/conexao.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$recordsPerPage = isset($_GET['recordsPerPage']) ? $_GET['recordsPerPage'] : 5;

try {
    // Calcula o OFFSET baseado na página atual
    $offset = ($page - 1) * $recordsPerPage;

    // Roda o select com LIMIT e OFFSET
    $sql = "SELECT * FROM pessoa WHERE pessoa.status = 'N' LIMIT $recordsPerPage OFFSET $offset";
    $stmt = $pdo->query($sql);

    // Armazena os resultados em uma variável
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Gera a tabela HTML com os resultados
    if (empty($resultados)) {
        echo '<tr><td colspan="5">Nenhum dado encontrado.</td></tr>';
    } else {
        foreach ($resultados as $row) {
            echo '<tr>';
            echo '<th scope="row">' . htmlspecialchars($row['id_pessoa']) . '</th>';
            echo '<td>' . htmlspecialchars($row['nome_pessoa']) . '</td>';
            echo '<td>' . htmlspecialchars($row['telefone_pessoa']) . '</td>';
            // Formatar a data de nascimento para o formato DD/MM/YYYY
            $dataNascimento = date('d/m/Y', strtotime($row['data_nascimento']));
            echo '<td>' . htmlspecialchars($dataNascimento) . '</td>';
            echo '<td>' . htmlspecialchars($row['cpf_pessoa']) . '</td>';
            // echo '<td><input type="checkbox" class="check-item" data-id="' . htmlspecialchars($row['id_pessoa']) . '"></td>';
            echo '<td>
                    <div class="form-check form-switch">
                        <input type="checkbox" class="form-check-input check-item" id="flexSwitchCheckChecked" data-id="' . htmlspecialchars($row['id_pessoa']) . '">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Consumiu</label>
                    </div>

                </td>';
            echo '</tr>';
        }
    }

    // Consulta para contar o número total de registros na tabela
    $countSql = "SELECT COUNT(*) as total FROM pessoa WHERE pessoa.status = 'N'";
    $countStmt = $pdo->query($countSql);
    $totalRecords = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

} catch (PDOException $e) {
    die("Erro ao executar consulta: " . $e->getMessage());
} finally {
    $pdo = null;
}
?>
