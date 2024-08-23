<?php
    include 'head.php';
    include '../controller/processa_cadastro.php';
    include 'lgpd.php';
    include 'termo.php';
?>
<body>
<nav class="navbar">
  <div class="container">
      <img src="../imagens/logo.jpeg" alt="" class="rounded mx-auto d-block logo-imagem">
  </div>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="alert text-center alert-warning">
                    <strong>Bem Vindo(a)!</strong>
                    <p>Faça seu cadastro para ganhar 1 Café da Terrinha no dia do seu aniversário. Para validar nos siga no <strong><a href="https://www.instagram.com/terramocacafeteria">Instagram</a></strong></p>
                </div>
            </div>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome</label>
                <input tabindex=1 type="text" class="form-control" name="nome_pessoa" value="<?php echo isset($_POST['nome_pessoa']) ? htmlspecialchars($_POST['nome_pessoa']) : ''; ?>" id="nome_pessoa" required>
            </div>
            <div class="col-md-6">
                <label for="nascimento" class="form-label">Data Nascimento</label>
                <input tabindex=2 type="date" class="form-control" inputmode="numeric" name="data_nascimento" value="<?php echo isset($_POST['data_nascimento']) ? htmlspecialchars($_POST['data_nascimento']) : ''; ?>" id="data_nascimento" required>
            </div>
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input tabindex=3 type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" name="telefone_pessoa" value="<?php echo isset($_POST['telefone_pessoa']) ? htmlspecialchars($_POST['telefone_pessoa']) : ''; ?>" id="telefone_pessoa" required>
            </div>
            <div class="col-md-6">
                <label for="cpf_pessoa" class="form-label">CPF</label>
                <input tabindex=4 type="number" pattern="[0-9]*" inputmode="numeric" class="form-control" name="cpf_pessoa" value="<?php echo isset($_POST['cpf_pessoa']) ? htmlspecialchars($_POST['cpf_pessoa']) : ''; ?>" id="cpf_pessoa" required>
            </div>
            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="aceite_lgpd" tabindex=4 id="aceite_lgpd">
                <label class="form-check-label" for="aceite_lgpd">
                    Lei Geral de Proteção de Dados
                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Leia-me
                    </button>
                </label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="aceite_termo" tabindex=5 id="aceite_termo" required>
                <label class="form-check-label" for="aceite_termo">
                    Aceito o regulamento
                    <button type="button" data-bs-toggle="modal" data-bs-target="#regulamento">
                        Leia-me
                    </button>
                </label>
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" name="cadastrar" class="btn">Cadastrar</button>
            </div>
        </form>

        <br>

        <?php
            echo $errors;
        ?>
        
    </div>
    <?php
        include 'footer.php';
    ?>
</body>
</html>
