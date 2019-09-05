<?php
session_start();

include_once("../../controller/AdminDAO.php");
include_once("../../model/AdminModel.php");
include_once("../../model/ProdutoModel.php");
include_once("../../controller/ProdutoDAO.php");

$produto = new Produto();
$produtoDAO = new produtoDAO();
$lista_produtos = $produtoDAO->listar_produtos();

$nome = isset($_POST["nome"])?$_POST["nome"]:"";
$preco = isset($_POST["preco"])?$_POST["preco"]:"";
$descricao = isset($_POST["descricao"])?$_POST["descricao"]:"";
$marca = isset($_POST["marca"])?$_POST["marca"]:"";
$imagem = isset($_POST["imagem"])?$_POST["imagem"]:"";
$qtd = isset($_POST["qtd"])?$_POST["qtd"]:"";

$nNome = isset($_POST["nNome"])?$_POST["nNome"]:"";
$nPreco = isset($_POST["nPreco"])?$_POST["nPreco"]:"";
$nDescricao = isset($_POST["nDescricao"])?$_POST["nDescricao"]:"";
$nMarca = isset($_POST["nMarca"])?$_POST["nMarca"]:"";
$nImagem = isset($_POST["nImagem"])?$_POST["nImagem"]:"";
$nQtd = isset($_POST["nQtd"])?$_POST["nQtd"]:"";

if(isset($_POST['deslogar'])){
  if($_POST['deslogar']=="Sim"){
    unset($_SESSION['login']);
    session_destroy();
  }
}
if (isset($_POST["acao"]) and $_POST["acao"]=="Delete" and isset($_POST["dId"])) {
 $produto->setId($_POST["dId"]);
 $produtoDAO->apagar_produto($produto);
}

if (isset($_POST["acao"]) and $_POST["acao"]=="Cadastrar") {
  $produto->setNome($nome);    
  $produto->setDescricao($descricao);
  $produto->setMarca($marca);
  $produto->setPreco($preco);
  $produto->setQtd($qtd);
  $produto->setImagem($imagem);
  $produtoDAO->cadastrar_produto($produto);

}

if (isset($_POST["acao"]) and $_POST["acao"]=="Editar" and isset($_POST["eId"])) {
  $produto->setNome($nNome);    
  $produto->setDescricao($nDescricao);
  $produto->setMarca($nMarca);
  $produto->setPreco($nPreco);
  $produto->setQtd($nQtd);
  $produto->setImagem($nImagem);
  $produto->setId($_POST["eId"]);
  $produtoDAO->editar_produto($produto);

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
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
    <script type="text/javascript">
      function trocarCampos(imagem,nome,descricao,marca,preco,qtd,id) {
        $("input#nome").val(nome);
        $("input#marca").val(marca);
        $("input#descricao").val(descricao);
        $("input#preco").val(preco);
        $("input#eQtd").val(qtd);
        $("input#eId").val(id);
      }
      function trocarCamposDelete(id) {
        $("input#dId").val(id);
      }
    </script>
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
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <style type="text/css">
     #divi{

      margin-top: 0px;
    }
  </style>
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
        <li>
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
        <li class="active treeview">
          <a href="produtos.php">
            <i class="glyphicon glyphicon-pencil"></i> <span>Produtos</span>
          </a>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
      </ul>


      <!-- /.sidebar -->

    </aside>

  </section>

  <div>

    <div class="content-wrapper">

      <div>
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
<li>
  <a href="vendas.php">
    <i class="glyphicon glyphicon-shopping-cart"></i> <span>Vendas</span>
</a>
</li>
<li class="active treeview">
  <a href="produtos.php">
    <i class="glyphicon glyphicon-pencil"></i> <span>Produtos</span>
</a>
</li>
</ul>


<!-- /.sidebar -->

</aside>

</section>

<div>

  <div class="content-wrapper">

    <div>


        <h1 id="divi">
          Produtos
        </h1>
        <button class='btn btn-primary' data-toggle="modal" data-target="#modalCadastrar" style="margin-left: 92%; margin-bottom: 0.5%;">Cadastrar produto</button>
      </div>
      <table id="myTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
          <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Marca</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Apagar</th>
            <th>Editar</th>          
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($lista_produtos as $produtos) {
            ?>
            <tr>
              <td align='center'><?=$produtos['imagem']?> </td>
              <td align='center'><?=$produtos['nome']?> </td>
              <td align='center'><?=$produtos['descricao']?></td>
              <td align='center'> <?=$produtos['marca']?> </td>
              <td align='center'>R$  <?=$produtos['preco']?> </td>
              <td align='center'><?=$produtos['qtd']?> </td>
              <td align='center'><button class='btn btn-danger' data-toggle="modal" data-target="#modalDelete" onclick="trocarCamposDelete('<?=$produtos['id']?>')">+</button></td>

              <td><button id="btnImpress" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar" onclick="trocarCampos('<?=$produtos['imagem']?>','<?=$produtos['nome']?>','<?=$produtos['descricao']?>','<?=$produtos['marca']?>','<?=$produtos['preco']?>','<?=$produtos['qtd']?>','<?=$produtos['id']?>')">+</button></td>
            </tr>

            <?php   
          }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Marca</th>
            <th>Preço</th>
          </tr>
        </tfoot>
      </table>

    </div>
  </div>  
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
          <script type="text/javascript">

            $('#example').DataTable();

          </script>
          <script>
            $('#meuModal').on('shown.bs.modal', function () {
              $('#meuInput').trigger('focus')
            });
            $(document).ready(function(){
              $('#myTable').dataTable({
                "language": {
                  "lengthMenu": "Mostrando _MENU_ produtos por página",
                  "zeroRecords": "Nenhum produto encontrado",
                  "info": "Mostrando _PAGE_ de _PAGES_ páginas",
                  "infoEmpty": "Nenhum registro disponível",
                  "infoFiltered": "(filtrado de _MAX_ registros no total)",
                  'paging'      : true,
                  'lengthChange': false,
                  'searching'   : true,
                  'ordering'    : true,
                  'info'        : true,
                  'autoWidth'   : false
                }

              });


            });

          </script>
          <script type="text/javascript" src="../DataTables/datatables.min.js"></script>
          <!--Modal editar -->

          <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title " align="center">Editar produto</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>

                  </button>
                </div>
                <div class="modal-body">
                  <form method="post">


                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="text" class="form-control" name="nNome" id="nome" >
                      <label for="preco">Preço</label>
                      <input type="text" class="form-control" name="nPreco" id="preco" >
                      <label for="descricao">Descrição</label>
                      <input type="text" class="form-control" name="nDescricao" id="descricao" >
                      <label for="marca">Marca</label>
                      <input type="text" class="form-control" name="nMarca" id="marca" >
                      <label for="marca">Quantidade</label>
                      <input type="number" class="form-control" name="nQtd" id="eQtd" >
                      <input type="hidden" name="eId" id="eId">
                    </div>



                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <input type="submit" name="acao" value="Editar">
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--Modal editar-->
          <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title " align="center">Apagar produto</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>

                  </button>
                </div>
                <div class="modal-body">
                  <form method="post">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: 50%;">Fechar</button>                    
                    <input type="hidden" class="form-control" name="dId" id="dId">
                    <input type="submit" class="btn btn-secondary" name="acao" value="Delete">
                  </form>
                </div>


              </div>
            </div>
          </div>

          <div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title " align="center">Cadastrar produto</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>

                  </button>
                </div>
                <div class="modal-body">
                  <form method="post">


                    <div class="form-group">
                      <div class="text-center">
                        <img id="teste" class="img rounded-circle" src="../../imagens/default-avatar.png" style="width: 90px; height: 90px; cursor:pointer" title="Clique para adicionar uma foto"/>
                      </div>
                      <div class="form-group">
                        <input id="teste2" name="teste2" class="form-control" type="file" accept="image/*" style="display:none;">
                        <br>
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" name="nome">
                        <label for="preco">Preço</label>
                        <input type="text" class="form-control" name="preco" >
                        <label for="descricao">Descrição</label>
                        <input type="text" class="form-control" name="descricao">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control" name="marca" >
                        <label for="marca">Quantidade</label>
                        <input type="number" class="form-control" name="qtd">

                      </div>



                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                      <input type="submit" name="acao" value="Cadastrar">
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
             $(document).ready(function () {
               $('#teste').click(function () {
                $('#teste2').click();
              });
               $("#teste2").on('change', function () {
                if (typeof (FileReader) != "undefined") {
                  var reader = new FileReader();
                  reader.onload = function (e) {
                    $('#teste').attr('src', e.target.result);
                  }
                  var file = $(this)[0].files[0];
                  if (typeof (file) != "undefined")
                    reader.readAsDataURL($(this)[0].files[0]);
                } else {
                  alert("Este navegador nao suporta FileReader.");
                }
              });
             });
           </script>
         </body>
         </html>
         <?php } else{ header("location:../index.php"); } ?>