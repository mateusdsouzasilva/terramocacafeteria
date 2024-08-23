<?php
//valida a secao e atribui a mensagem de erro
// session_start();
$errors = '';

//verifica se o metodo e envio eh o post se naum for ele nem entra que resolve a questao do f5
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../util/conexao.php';

    //recebe os atributos passados no formulario
    $nome_pessoa = strtoupper($_POST['nome_pessoa']);
    $data_nascimento = $_POST['data_nascimento'];
    $telefone_pessoa = $_POST['telefone_pessoa'];
    $checkbox_termo = $_POST['aceite_termo'];
    $cpf_pessoa = $_POST['cpf_pessoa'];

    //faz um select buscando os dados da tabela usurario para saber se eh cadastro ou pesquisa
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :email");
    $sql->bindValue(':email', $nome_pessoa);
    $sql->execute();

    //verifica se jah existe email cadastrado
    if ($sql->rowCount() > 0) {
        // Email já existe, redireciona para cadastros.php
        session_start();
        $_SESSION['nome_pessoa'] = $nome_pessoa;

        header('Location: ../cadastro/listar_cadastros.php');
        exit;
    }

    //validacao da lei lgpd se marcar cadastra, se nao da a mensagem de erro pedindo para marcar
    if(isset($_POST['aceite_lgpd'])){
        $checkbox_lgpd = 'S';

        //valida se marcou o termo de aceite 
        if (isset($checkbox_termo)) {
            $checkbox_termo = 'S';
        } else {
            $checkbox_termo = 'N';
        }

        //validando telefone duplicado
        $sql = $pdo->prepare("SELECT * FROM pessoa WHERE pessoa.telefone_pessoa = :telefone_pessoa");
        $sql->bindValue(':telefone_pessoa', $telefone_pessoa);
        $sql->execute();

        //validando cpf duplicado
        $sqlcpf = $pdo->prepare("SELECT * FROM pessoa WHERE pessoa.cpf_pessoa = :cpf_pessoa");
        $sqlcpf->bindValue(':cpf_pessoa', $cpf_pessoa);
        $sqlcpf->execute();

        if ($sqlcpf->rowCount() === 0) {
            //se naum existir telefone duplicado ele faz o cadastro
            if($sql->rowCount() === 0){
                if(isset($nome_pessoa)){
                    $sql = $pdo->prepare("INSERT INTO pessoa VALUES (null,?,?,?,?,?,?,'N')");
                    $cadastro = $sql->execute(array($nome_pessoa, $data_nascimento, $telefone_pessoa, $checkbox_lgpd, $checkbox_termo, $cpf_pessoa));
                    
                    //verifica se o cadstro deu certo
                    if ($cadastro) {
                        $_SESSION['form_data'] = $_POST;
                        header('Location: agradecimento.php');
                        exit;
                    }
                }
            }else{
                //erro do telefone duplicado
                $errors = '<div class="alert text-center alert-warning">
                <strong>Olá '.$nome_pessoa.'</strong>
                <p>O número de telefone digitado já foi cadastrado!</p></div>';
            }
        }else {
            //erro do cpf jah cadastrado
            $errors = '<div class="alert text-center alert-warning">
            <strong>Olá '.$nome_pessoa.'</strong>
            <p>Este número de CPF já foi cadastrado!</p></div>';
        }
    }else{
        //erro do lgpd desmarcado
        $errors = '<div class="alert text-center alert-warning">
        <strong>Olá '.$nome_pessoa.'</strong>
        <p>Para validar o seu benefício preciso que marque a opção Lei Geral de Proteção de Dados.</p></div>';
    }            
}        
?>