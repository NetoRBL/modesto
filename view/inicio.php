<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

include_once("../controller/AdminDAO.php");
include_once("../model/AdminModel.php");
include_once("../controller/VendaDAO.php");
include_once("../model/VendaModel.php");
include_once("../controller/CaixaDAO.php");
include_once("../model/CaixaModel.php");
$caixaDAO = new caixaDAO();
$caixaModel = new CaixaModel();
$vendaDAO = new vendaDAO();
$vendaModel = new Venda();

$ultimo_status_caixa = $caixaDAO->listar_ultimo_status();

$venda_ano = $vendaDAO->listar_ganho_ano();
$contador = 0;
foreach ($venda_ano as $venda_mes) {
  $valores[] = $venda_mes["total_valor"];
  if ($valores[$contador] == null) {
    $valores[$contador] = 0;
  }
  $contador++;
}
$data = date("d/m/Y");
$caixa = $caixaDAO->valor_caixa($data);
$caixaInicial = $caixaDAO->check($data);
$ganho = $vendaDAO->listar_ganho();
$ganho_passado = $vendaDAO->listar_ganho_passado();
$ganho_impressoes = $vendaDAO->listar_ganho_impressoes();

$statusCaixa = isset($_POST['statusCaixa'])?$_POST['statusCaixa']:"";

if ($statusCaixa == "fechado") {
  if ($ultimo_status_caixa["status"] != "Fechado") {
    $caixaModel->setStatus("Fechado");
    $caixaModel->setValor(0);
    $caixaModel->setData(date('d/m/Y'));
    $caixaModel->setHora(date('H:i'));
    $caixaDAO->resgistrar_caixa($caixaModel);
  }else{
    
  }
}

if (isset($_POST["acao"]) and $_POST["acao"]=="Retirar" and isset($_POST["vlsaque"])) {
  $data = date("d/m/Y");
  $hora = date("H:i");
  $caixaModel->setStatus("Retirada");
  $caixaModel->setValor($_POST["vlsaque"]);
  $caixaModel->setData($data);
  $caixaModel->setHora($hora);
  $caixaDAO->resgistrar_caixa($caixaModel);
}

if (isset($_POST["acao"]) and $_POST["acao"] = "Abrir Caixa") {
  $caixaModel->setStatus("Aberto");
  $caixaModel->setValor(0);
  $caixaModel->setData(date('d/m/Y'));
  $caixaModel->setHora(date('H:i'));
  $caixaDAO->resgistrar_caixa($caixaModel);
}

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
    <script type="text/javascript">
      function valorMax(max){
        $("input#saque").attr("max", max);        
      }
      function verificar(val){
        if (val == 0 || val == false) {
          $("#abrCaixa").attr("disabled", false); 
        }
        else{
          $("#abrCaixa").attr("disabled", true);
          alert("Valor inicial do caixa já confirmado"); 
        }
      }
    </script>
    <style type="text/css">
      #mdcaixa{
        width: 330px;
      }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
   <!-- Morris chart -->
   <link rel="stylesheet" href="bower_components/morris.js/morris.css">
   <!-- jvectormap -->
   <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style type="text/css">
  i.ion {
    font-size: 0.8em;
  }
  i.fa-trophy{
    font-size: 0.8em;
  }
  i.fa-dollar{
    font-size: 0.8em;
  }
  i.fa-newspaper-o{
    font-size: 0.8em;
  }
  i.fa-pie-chart{
    font-size: 0.8em;
  }
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
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
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Fulano de Tal</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVEGAÇÃO</li>
          <li class="active treeview">
            <a href="inicio.php">
              <i class="fa fa-home"></i>
              <span>Inicio</span>
            </a>
          </li>
          <li <?php 
            if ($ultimo_status_caixa["status"] == "Fechado") {
              echo "style='pointer-events:none;opacity:0.6;'";
            }else{
              echo "style='pointer-events:auto;opacity:1;'";
            }
          ?>>
            <a href="pages/realizarVenda.php">
              <i class="fa fa-money"></i>
              <span>Realizar Venda</span>
            </a>
          </li>
          <li <?php 
            if ($ultimo_status_caixa["status"] == "Fechado") {
              echo "style='pointer-events:none;opacity:0.6;'";
            }else{
              echo "style='pointer-events:auto;opacity:1;'";
            }
          ?>>
            <a href="pages/vendas.php">
              <i class="glyphicon glyphicon-shopping-cart"></i> <span>Vendas</span>
            </a>
          </li>
          <li <?php 
            if ($ultimo_status_caixa["status"] == "Fechado") {
              echo "style='pointer-events:none;opacity:0.6;'";
            }else{
              echo "style='pointer-events:auto;opacity:1;'";
            }
          ?>>
            <a href="pages/produtos.php">
              <i class="glyphicon glyphicon-pencil"></i> <span>Produtos</span>
            </a>
          </li>
          <li <?php 
            if ($ultimo_status_caixa["status"] == "Fechado") {
              echo "style='pointer-events:none;opacity:0.6;'";
            }else{
              echo "style='pointer-events:auto;opacity:1;'";
            }
          ?>>
            <a href="pages/relatorio.php">
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
          Inicio
          <small>Painel de Controle</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="inicio.php"><i class="fa fa-home"></i> Inicio</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3>R$ <?=number_format($ganho["total_valor"], 2, '.', '')?></h3>

                <p><h4>Ganho do mês</h4></p>
              </div>
              <div class="icon">
                <i class="fa fa-dollar"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6" style="cursor: pointer;" data-toggle="modal" data-target="#modalCaixa">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">

                <h3>R$ <?=number_format($caixa["valor_caixa"], 2, '.', '')?></h3>
                <p><h4>Caixa</h4></p>

              </div>
              <div class="icon">
                <i class="fa fa-trophy"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>R$ <?=number_format($ganho_impressoes["valor_total_impressão"], 2, '.', '')?></h3>
                <p><h4>Impressões do dia</h4></p>
              </div>
              <div class="icon">
                <i class="fa fa-newspaper-o"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>R$ <?=number_format($ganho_passado["total_valor_passado"], 2, '.', '')?></h3>

                <p><h4>Ganho do ultimo mês</h4></p>
              </div>
              <div class="icon">
                <i class="fa fa-pie-chart"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Gráfico do ganho deste ano</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
 <script src="bower_components/jquery/dist/jquery.min.js"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="bower_components/chart.js/Chart.js"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      datasets: [
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?=$valores[0]?>,
                                  <?=$valores[1]?>,
                                  <?=$valores[2]?>,
                                  <?=$valores[3]?>,
                                  <?=$valores[4]?>,
                                  <?=$valores[5]?>,
                                  <?=$valores[6]?>,
                                  <?=$valores[7]?>,
                                  <?=$valores[8]?>,
                                  <?=$valores[9]?>,
                                  <?=$valores[10]?>,
                                  <?=$valores[11]?>,]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

  })
</script>

<div class="modal fade" id="modalCaixa" tabindex="-1" role="dialog">
  <div id="mdcaixa" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " align="center">Caixa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>

        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <p>Escolha uma operação</p>
          <button id="abrCaixa" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#modalAbrirCaixa" onclick="verificar('<?=$caixaInicial['valor']?>')" <?php
            if ($ultimo_status_caixa["data"] and $ultimo_status_caixa["status"] == "Fechado") {
              echo "title='O caixa já foi fechado, amanhã poderá abrir novamente.' disabled";
            }
          ?>>Abrir caixa</button>
          <button class="btn btn-danger" style="margin-left: 10px; margin-right: 10px;">Fechar caixa</button>
          <input type="hidden" name="statusCaixa" value="fechado">
          <button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#modalRetirada" onclick="valorMax('<?=$caixa['caixa']?>')">Retirada</button>
        </div>
      </form>
    </div>
  </div>
</div>



<div class="modal fade" id="modalRetirada" tabindex="-1" role="dialog">
  <div id="mdcaixa" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " align="center">Retirada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>

        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <p>Digite um valor a ser retirado</p>
          <input type="number" class="form-control" id="saque" name="vlsaque">
          <div align="right">
            <button class="btn btn-success"data-dismiss="modal" data-toggle="modal" data-target="#modalCaixa">Voltar</button>
            <input type="submit" name="acao" class="btn btn-primary" value="Retirar">
          </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="modalAbrirCaixa" tabindex="-1" role="dialog">
  <div id="mdcaixa" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " align="center">Abrir caixa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>

        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <p>Digite um valor inicial do caixa</p>
          <input type="number" class="form-control" id="saque" name="vlsaque">
          <div align="right">
            <button class="btn btn-success"data-dismiss="modal" data-toggle="modal" data-target="#modalCaixa">Voltar</button>
            <input type="submit" name="acao" class="btn btn-primary" value="Abrir Caixa">
          </div>
      </form>
    </div>
  </div>
</div>
</div>

</body>
</html>

<?php } else{ header("location:index.php"); } ?>