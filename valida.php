<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gerenciador</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="componentes/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="componentes/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="componentes/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="componentes/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
        <center>
          <font face="calibri"><b>
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b>Gerenciador</b></a>
      </div>
      <div class="login-box-body">

<p class="login-box-msg">
            <?php
                error_reporting(0);
                include 'config.php';
                    $login  = $_POST["login"];
                    $senha  = $_POST["senha"];
                if ($senha=="") {
                        echo"<br>Senha em branco<br><br><a href='index.php'><i class='fa fa-backward'></i> Voltar</a>";
                        }
                else {

                $visao = mysqli_query($conn, "select id, name, email, login, password, foto from system_user where login = '$login'") or die(
                  mysqli_error($conn) //caso haja um erro na consulta
                );

                while (($registros = mysqli_fetch_array($visao))) {
                    $id       = $registros[0];
                    $nome     = $registros[1];
                    $email    = $registros[2];
                    $login    = $registros[3];
                    $senha1   = $registros[4];
                    $foto     = $registros[5];
                }

                $visao1 = mysqli_query($conn, "select id, name, email, login, password, foto from system_user where password = '$senha' and id = '$id'") or die(
                  mysqli_error($conn) //caso haja um erro na consulta
                );

                while (($registros1 = mysqli_fetch_array($visao1))) {
                $id1 = $registros1[0];
                }
                    setcookie("id", $id);
                    setcookie("name", $nome);
                    setcookie("email", $email);
                    setcookie("login", $login);
                    setcookie("foto", $foto);
                if ($id == "") {
                        echo "<center>Usuário ou Senha incorreta!<br><br><a href='index.php'><i class='fa fa-backward'></i> Voltar</a></center>";
                    } 
                    
                    elseif ($id == "55") {
                      header("Location: despesas_full.php");
                  }                    
                    else {
                      header("Location: principal.php");
                    }
                }
            ?>
    </p>


      </div>
    </div>
    <script src="componentes/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="componentes/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="componentes/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>

  </b></font>
        </center>
  </body>
</html>
