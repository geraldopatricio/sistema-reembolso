<?php

$funcionario_logado  = $_COOKIE["id"];
    $nome  = $_COOKIE["name"];
    $foto  = $_COOKIE["foto"];
    $email = $_COOKIE["email"];
    include('work/xcrud.php');
    $funcionario = Xcrud::get_instance();
    $funcionario->table('system_user');
    $funcionario->where("id = '$funcionario_logado' ");
    $funcionario->table_name('Cadastro de Funcionário');

    $funcionario->unset_add();
    $funcionario->unset_remove();
    $funcionario->unset_print();
    $funcionario->unset_csv();

    $funcionario->columns('name,setor,email'); 
    $funcionario->relation('setor','centro_custos','descricao','descricao'); 
    $funcionario->change_type('senha', 'password', '', 15);
    $funcionario->change_type('cpf', 'password', '', 20);
    $funcionario->change_type('banco', 'password', '', 50);
    $funcionario->change_type('agencia', 'password', '', 30);
    $funcionario->change_type('conta', 'password', '', 30);  
    $funcionario->disabled('id');   
    $funcionario->change_type('password', 'password', '', 15);
    $funcionario->label('name','Funcionário');
    $funcionario->label('password','Senha');
    
    $funcionario->fields('frontpage_id', true, 'edit');
    $funcionario->fields('system_unit_id', true, 'edit');
    $funcionario->fields('active', true, 'edit');

    $funcionario->change_type('foto', 'image', false, array(
            'width' => 250,
            'path' => '/uploads',
            'thumbs' => array(array(
                    'height' => 120,
                    'width' => 120,
                    'crop' => true,
                    'marker' => '_th'))));

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
          
            <?php echo $funcionario->render(); ?>
      
        </div>
        <div class="box-footer">
          FAE - Seu Cadastro para alterações.
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


