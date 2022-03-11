<header class="main-header">
    <a href="index2.html" class="logo">
      <span class="logo-mini"><b>FAE</b></span>
      <span class="logo-lg"><b>SISPC</b> FAE</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">!</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Posição de Estoque - SALT</li>
              <li>
                <ul class="menu">      
                  <p>          
                    <a href="produtos.php">
                      <i class="fa fa-bell-o text-aqua"></i> 
                      <b>CLIQUE AQUI</b>
                    </a>
                  </p>
                </ul>
              </li>
            </ul>
          </li>

          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-gears" title="Tema"></i>
              <span class="label label-danger"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Alterar Tema</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">
                     
                        <div class="box box-solid" style="max-width: 300px;">
                        <div class="box-body no-padding">
                            <table id="layout-skins-list" class="table table-striped bring-up nth-2-center">
                            <thead>
                                <tr>
                                <th style="width: 210px;">Tema</th>
                                <th>Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td><code>Azul</code></td>
                                <td><a href="#" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Azul-light</code></td>
                                <td><a href="#" data-skin="skin-blue-light" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Amarelo</code></td>
                                <td><a href="#" data-skin="skin-yellow" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Amarelo-light</code></td>
                                <td><a href="#" data-skin="skin-yellow-light" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Verde</code></td>
                                <td><a href="#" data-skin="skin-green" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Verde-light</code></td>
                                <td><a href="#" data-skin="skin-green-light" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Púrpura</code></td>
                                <td><a href="#" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Púrpura-light</code></td>
                                <td><a href="#" data-skin="skin-purple-light" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Vermelho</code></td>
                                <td><a href="#" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Vermelho-light</code></td>
                                <td><a href="#" data-skin="skin-red-light" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Escuro</code></td>
                                <td><a href="#" data-skin="skin-black" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                <td><code>Escuro-light</code></td>
                                <td><a href="#" data-skin="skin-black-light" class="btn bg-black btn-xs"><i class="fa fa-eye"></i></a></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>

            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?Php print "<img src='work/uploads/$foto' class='user-image'>"; ?>
                    <span class="hidden-xs"><?Php echo utf8_encode($nome); ?></span>
                </a>

                <ul class="dropdown-menu">
                <li class="user-header">
                    <?Php print "<img src='work/uploads/$foto' class='user-image'>"; ?>
                    <p><?Php echo "$nome"; ?></p>
                </li>
                <li class="user-body">
                <div class="col-xs-20 text-center">
                    <a href="mailto:<?Php echo "$email"; ?> ">Enviar e-mail</a>
                </div>
                </li>
                <li class="user-footer">
                <div class="pull-left">

                </div>
                <div class="pull-right">
                    <a href="index.php" class="btn btn-default btn-flat">Fechar</a>
                </div>
                </li>
                </ul>

                </li>
          
        </ul>
      </div>
    </nav>
  </header>