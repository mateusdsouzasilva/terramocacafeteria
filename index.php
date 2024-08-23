<?php
include './cadastro/head.php';
?>

<body>
    <nav class="navbar">
        <div class="container">
            <img src="./imagens/logo.jpeg" alt="" class="rounded mx-auto d-block logo-imagem">
        </div>
    </nav>
    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-4">Bem-vindo à Terra Moça Cafeteria!</h1>
                <p class="lead">Explore nossas opções de cardápio e aproveite nossas promoções.</p>
                <div class="d-grid gap-2 mt-4">
                    <a href="https://terramocacafeteria.pedirweb.com.br/cardapiomesa.php" target=""
                        class="btn btn-lg">Cardápio</a>
                    <a href="https://terramocacafeteria.pedirweb.com.br/cardapiodelivery.php"
                        class="btn btn-lg">Faça seu Pedido Delivery</a>
                    <a href="./cadastro/index.php" class="btn btn-lg">Cadastro/Promoção</a>
                    <a href="#" class="btn btn-lg">Deixe sua opinião</a>
                </div>
            </div>
        </div>
        <br>
    </div>
    <?php
    include './cadastro/footer.php';
    ?>
</body>

</html>