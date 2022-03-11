<?php

    $funcionario_logado  = $_COOKIE["id"];
    $nome  = $_COOKIE["name"];
    $foto  = $_COOKIE["foto"];
    $email = $_COOKIE["email"];
    include('work2/xcrud.php');
    $produto_saldo = Xcrud::get_instance();
    $produto_saldo->table_name('Saldo e Estoque Mínimo/Máximo');;
    $produto_saldo->query('SELECT p.codigo, p.nome, 
    (SELECT d.name FROM storages d WHERE d.id = s.storages_id) AS deposito,
    (SELECT nome_categoria FROM product_categories WHERE id = p.product_category_id) AS categoria,
    s.quantity as saldo, p.min_quantity AS qtd_min, p.max_quantity AS qtd_max
    FROM products p, product_stock s
    WHERE s.product_id = p.id
    AND p.min_quantity != "" order by p.codigo, p.nome asc'  );


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gerenciador</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<?Php include("sobre.php"); ?>

<div class="wrapper">

  <?php include("titulo.php"); ?>

  <aside class="main-sidebar">
    <section class="sidebar">
      
      <?Php include("perfil.php"); ?>
      <?php require("menu.php"); ?>

    </section>
  </aside>
<!------ Conteudo da pagina aqui - INICIO --------->
  <div class="content-wrapper">


    <section class="content">

      <div class="box">
    
        <div class="box-body">
          
            <?php echo $produto_saldo->render(); ?>
      
        </div>
        <div class="box-footer">
          GPSOFT.com.br - Sistemas
        </div>
      </div>

    </section>
  </div>

<!------ Conteudo da pagina aqui - FIM --------->

<?php include("rodape.php"); ?>
  
<div class="control-sidebar-bg"></div>

</div>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>

</body>
</html>


