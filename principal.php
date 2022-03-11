<?php
    $funcionario_logado  = $_COOKIE["id"];
    $nome  = $_COOKIE["name"];
    $foto  = $_COOKIE["foto"];
    $email = $_COOKIE["email"];

    include('work/xcrud.php');

    $despesas = Xcrud::get_instance();
    $despesas->table('cabecalho');
    $despesas->where("fk_funcionario = '$funcionario_logado' ");
    
    // mostra apenas pedidos de vendas efetuados para clientes 
    $despesas->table_name('Cadastre suas Despesas');
    
    $despesas->validation_required('dt_ini');    
    $despesas->validation_required('dt_fim');
    $despesas->validation_required('fk_funcionario');
    $despesas->validation_required('trecho');

    $despesas->columns('id,dt_ini,dt_fim,fk_funcionario,trecho');  
    $despesas->label('dt_ini','Data Inicial');
    $despesas->label('dt_fim','Data Final');
    $despesas->validation_required('dt_fim');
    $despesas->label('fk_funcionario','Funcionário');
    $despesas->label('trecho','Trecho');
    $despesas->label('observacao','Observações');
    $despesas->relation('fk_funcionario','system_user','id','name',"system_user.id = '$funcionario_logado'");    
    $despesas->unset_csv();
    $despesas->unset_print();
    
    $despesas->button('relatorio_despesas.php?id={id}','Imprimir','fa fa-print','',array('target'=>'_blank'));
    
    $itens = $despesas->nested_table('Itens','id','itens','despesa');     
    $itens->default_tab('despesa');
    $itens->table_name('Despesas');
    
    $itens->validation_required('despesa');
    $itens->validation_required('dt_lancamento');
    $itens->validation_required('documento');
    $itens->validation_required('descricao');
    $itens->validation_required('tipo');
    $itens->validation_required('doc');
    $itens->validation_required('valor');

    $itens->columns('dt_lancamento,documento,descricao,tipo,doc,valor');       
    $itens->disabled('despesa');       
    $itens->label('dt_lancamento','Data');
    $itens->label('documento','Cod. DOC');
    $itens->label('descricao','Descrição');
    $itens->label('valor','Valor');
    $itens->label('doc','Doc.');
    //$itens->subselect('valor','SELECT format(valor,2,"de_DE") valor FROM itens i, cabecalho c WHERE i.despesa = c.id and c.id = {id}');
    $itens->sum('valor');
    //$itens->sum('valor','Total: {value}');
    //format(valor,2,'de_DE')
    //echo number_format($numero, 2, ',', '.');
    $itens->change_type('valor', 'price', '', array('prefix'=>'R$ '));    
    $itens->change_type('comprovante', 'file', '', array('not_rename'=>true));
        
    $itens->unset_csv();
    $itens->unset_print();
    
    $adianta = $despesas->nested_table('Adiantamento','id','adiantamento','fk_despesa');     
    $adianta->default_tab('adiantamento');
    $adianta->table_name('Adiantamento');      
    $adianta->disabled('fk_despesa');   
    $adianta->validation_required('valor');
    $adianta->label('fk_despesa','Despesa');
    $adianta->change_type('valor', 'price', '', array('prefix'=>'R$ '));   
    $adianta->unset_csv();
    $adianta->unset_print();
    
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
          
            <?php echo $despesas->render(); ?>
      
        </div>
        <div class="box-footer">
        FAE - Suas Despesas para Reembolso.
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


