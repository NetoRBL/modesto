<?php
  session_start();

  include_once("../../controller/AdminDAO.php");
  include_once("../../model/AdminModel.php");
  
  if(isset($_POST['deslogar'])){
    if($_POST['deslogar']=="Sim"){
      unset($_SESSION['login']);
      session_destroy();
    }
  }
  if(!empty($_SESSION['login'])){
    $log = $_SESSION['login'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">

  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">


</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

      <a href="../index.html" class="logo">

        <span class="logo-mini"><b>M</b>I</span>

        <span class="logo-lg"><b>Modesto</b> Idiomas</span>
      </a>



      <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
      </nav>
    </header>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-power-off"></i>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  Tem certeza que deseja deslogar?
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <form method="post">
                    <input type="submit" name="deslogar" value="Sim" class="btn btn-primary">
                  </form>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-danger">Não</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user9 160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Tonin Tornado</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGAÇÃO</li>
        <li >
          <a href="../inicio.php">
            <i class="fa fa-home"></i> <span>Inicio</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="realizarVenda.php">
            <i class="fa fa-money"></i>
            <span>Realizar Venda</span>
          </a>
        </li>
        <li>
          <a href="vendas.php">
            <i class="glyphicon glyphicon-shopping-cart"></i> <span>Vendas</span>
          </a>
        </li>
        <li>
          <a href="produtos.php">
            <i class="glyphicon glyphicon-pencil"></i> <span>Produtos</span>
          </a>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.html"><i class="fa fa-home"></i> Inicio</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class=" col-md-7">
      <select class="form-control form-control-sm ">
      <option>Large select</option> 

    </select>
    </div>

    
    <aside class="main-sidebar">

      <section class="sidebar">

        <div class="user-panel">
          <div class="pull-left image">
            <img src="../dist/img/user9 160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Tonin Tornado</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVEGAÇÃO</li>
          <li >
            <a href="../inicio.php">
              <i class="fa fa-home"></i> <span>Inicio</span>
            </a>
          </li>
          <li class="active treeview">
            <a href="realizarVenda.php">
              <i class="fa fa-money"></i>
              <span>Realizar Venda</span>
            </a>
          </li>
          <li>
            <a href="vendas.php">
              <i class="glyphicon glyphicon-shopping-cart"></i> <span>Vendas</span>
            </a>
          </li>
          <li>
            <a href="produtos.php">
              <i class="glyphicon glyphicon-pencil"></i> <span>Produtos</span>
            </a>
          </li>
          <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        </ul>
      </section>

    </aside>
    
    <div class="content-wrapper">

      <section class="content-header">
        <h1>
          Realizar venda
          <small>Preencha os campos</small>
        </h1>
        
      </section>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>


  </section>
</div>

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.4.13
  </div>
  <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
  reserved.
</footer>


<div class="control-sidebar-bg"></div>
</div>


</form>
</div>
</div>
<
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/demo.js"></script>

</body>
</html>
<?php } else{ header("location:../index.php"); } ?>