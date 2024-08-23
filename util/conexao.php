<?php
    //utilizado para conectar do banco da hospedagem
    // $pdo = new PDO('mysql:host=terramoca.mysql.dbaas.com.br;dbname=terramoca;charset=utf8','terramoca','Mateus425371@');

    //utilizado para conectar do banco local
    $pdo = new PDO('mysql:host=localhost;dbname=terramoca;charset=utf8','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>