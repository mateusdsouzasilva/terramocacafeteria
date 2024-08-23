<?php
    include 'head.php';
?>
<body>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCff3ULWmRHmvuwvpVnOhE_z2qU-Lqre3A&callback=console.debug&libraries=maps,marker&v=beta"></script>
<script>
        function abrirlocalizacao() {
            // Latitude e longitude do local

            var latitude = -20.2850023; // Exemplo: substitua pela latitude do seu local
            var longitude = -50.2531559; // Exemplo: substitua pela longitude do seu local

            // URL do Google Maps com a localização
            var googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;

            // Abrir o link no navegador (se estiver em um dispositivo móvel, abrirá no aplicativo do Google Maps)
            window.open(googleMapsUrl);
        }
</script>
<iframe style="display:none;" name="pessoa"></iframe>
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
                <strong>Obrigado pelo Cadastro!</strong>
                <p>Venha conhecer nosso espaço.</p>                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <gmp-map style="width: 100%; height: 400px;" center="-20.28492546081543,-50.253211975097656" zoom="14" map-id="DEMO_MAP_ID">
                <gmp-advanced-marker position="-20.28492546081543,-50.253211975097656" title="My location"></gmp-advanced-marker>
            </gmp-map>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br>
            <p class="text-center">
                <input type="button" onclick="abrirlocalizacao()" class="btn" value="Vamos lá">
            </p>
        </div>
    </div>
    <br>
</div>
<?php
        include 'footer.php';
    ?>
</body>
</html>