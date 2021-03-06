<?php
session_start();

include_once("../../controller/AdminDAO.php");
include_once("../../model/AdminModel.php");
include_once("../../model/VendaModel.php");
include_once("../../controller/VendaDAO.php");

$venda = new vendaDAO();
$venda_produtos = $venda->listar_vendas_produtos();
$venda_impressoes = $venda->listar_vendas_impressoes();

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
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">

     <!-- Logo -->
     <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>I</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Modesto</b> Idiomas</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
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
  
  <aside class="main-sidebar">
    <section class="sidebar">

      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Fulano de Tal</p>
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
        <li>
          <a href="realizarVenda.php">
            <i class="fa fa-money"></i>
            <span>Realizar Venda</span>
          </a>
        </li>
        <li class="active treeview">
          <a href="vendas.php">
            <i class="glyphicon glyphicon-shopping-cart"></i> <span>Vendas</span>
          </a>
        </li>
        <li>
          <a href="produtos.php">
            <i class="glyphicon glyphicon-pencil"></i> <span>Produtos</span>
          </a>
        </li>
        <li>
          <a href="relatorio.php">
            <i class="glyphicon glyphicon-print"></i> <span>Serviços</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendas
        <small>listagem de vendas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="vendas.php"><i class="glyphicon glyphicon-shopping-cart"></i> Vendas</a></li>
      </ol>
      <div align="right">
        <button id="btnImpress" class="btn btn-primary" data-toggle="modal" data-target="#modalRelatorio">Relatorio</button>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->

      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
          <!-- /.box-header -->
          <h3>Tabela de produtos vendidos</h3>
          <div class="box-body">
            <table id="tabelaProdutos" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Produto</th>
                  <th>Valor Unit.</th>
                  <th>Valor Tot.</th>
                  <th>Quantidade</th>
                  <th>Data</th>
                  <th>Hora</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($venda_produtos as $venda) {
                  echo "<tr>";
                  echo "<td>" . $venda["produto"] . "</td>";
                  echo "<td>R$ " . number_format($venda["valor"]/$venda["qtd"], 2, '.', '') . "</td>";
                  echo "<td>R$ " . number_format($venda["valor"], 2, '.', '') . "</td>";
                  echo "<td>" . $venda["qtd"] . "</td>";
                  echo "<td>" . $venda["data"] . "</td>";
                  echo "<td>" . $venda["hora"] . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Produto</th>
                  <th>Valor Unit.</th>
                  <th>Valor Tot.</th>
                  <th>Quantidade</th>
                  <th>Data</th>
                  <th>Hora</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </section>

        <!-- right col -->
        <section class="col-lg-6 connectedSortable">
          <!-- /.box-header -->
          <h3>Tabela de serviços</h3>
          <div class="box-body">
            <table id="tabelaImpressoes" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Produto</th>
                  <th>Valor</th>
                  <th>Quantidade</th>
                  <th>Data</th>
                  <th>Hora</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($venda_impressoes as $venda) {
                  echo "<tr>";
                  echo "<td>" . $venda["produto"] . "</td>";
                  echo "<td>R$ " . number_format($venda["valor"], 2, '.', '') . "</td>";
                  echo "<td>" . $venda["qtd"] . "</td>";
                  echo "<td>" . $venda["data"] . "</td>";
                  echo "<td>" . $venda["hora"] . "</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>Produto</th>
                  <th>Valor</th>
                  <th>Quantidade</th>
                  <th>Data</th>
                  <th>Hora</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </section>
      </div>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.13
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- jQuery 3 -->
 <script src="../bower_components/jquery/dist/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../bower_components/raphael/raphael.min.js"></script>
<script src="../bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- data table -->
<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script>
  $(document).ready(function(){
    $('#tabelaProdutos').dataTable({
      "language": {
        "lengthMenu": "Mostrando _MENU_ vendas por página",
        "zeroRecords": "Nenhuma venda encontrada",
        "info": "Mostrando _PAGE_ de _PAGES_ páginas",
        "infoEmpty": "Nenhum registro disponível",
        "infoFiltered": "(filtrado de _MAX_ registros no total)",
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
      }
    });
    $('#tabelaImpressoes').dataTable({
      "language": {
        "lengthMenu": "Mostrando _MENU_ vendas por página",
        "zeroRecords": "Nenhuma venda encontrada",
        "info": "Mostrando _PAGE_ de _PAGES_ páginas",
        "infoEmpty": "Nenhum registro disponível",
        "infoFiltered": "(filtrado de _MAX_ registros no total)",
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'autoWidth'   : false
      }
    })
  });

</script>
<div class="modal fade" id="modalRelatorio" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title " align="center">Relatorio</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>

        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="relatorioView.php" target="_blank">
          <div align="center">
            <p>Selecione o mês e o ano desejado</p>
            <select name="mes">
              <option value="1">Janeiro</option>
              <option value="2">Fevereiro</option>
              <option value="3">Março</option>
              <option value="4">Abril</option>
              <option value="5">Maio</option>
              <option value="6">Junho</option>
              <option value="7">Julho</option>
              <option value="8">Agosto</option>
              <option value="9">Setembro</option>
              <option value="10">Outubro</option>
              <option value="11">Novembro</option>
              <option value="12">Dezembro</option>
            </select>
            <select name="ano">
              <?php

              for ($i = date("Y"); $i >= 2019 ; $i--) { 
                echo "<option value='" . $i . "'>" . $i . "</option>";
              }
              ?>
            </select>
            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 50%;">Fechar</button>                    
            <input type="hidden" class="form-control" name="dId" id="dId">
            <input type="submit" class="btn btn-danger" name="acao" value="Comfirma">
          </div>
        </form>
      </div>


    </div>
  </div>
</div>
</body>
</html>
<?php } else{ header("location:../index.php"); } ?>