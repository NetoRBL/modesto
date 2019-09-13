<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

include_once("../../controller/VendaDAO.php");
include_once("../../controller/AdminDAO.php");
include_once("../../model/AdminModel.php");
include_once("../../model/ProdutoModel.php");
include_once("../../controller/ProdutoDAO.php");
include_once("../../model/VendaModel.php");
include_once("../../controller/servicoDAO.php");
$servicoDAO = new servicoDAO();
$servicos = $servicoDAO->listar_servicos();
$venda = new Venda();
$produtoModel = new Produto();
$produtoDAO = new produtoDAO();
$lista_produtos = $produtoDAO->listar_produtos();

$vendaDAO = new vendaDAO();
$produto = isset($_POST["produto"])?$_POST["produto"]:"";
$preco = isset($_POST["preco"])?$_POST["preco"]:"";
$imagem = isset($_FILES["imagem"]["name"])?$_FILES["imagem"]["name"]:"";
$qtd = isset($_POST["qtd"])?$_POST["qtd"]:"";
$qtdProd = isset($_POST["qtdProd"])?$_POST["qtdProd"]:"";
$idProd = isset($_POST["idProd"])?$_POST["idProd"]:"";
$data = date("d/m/Y");
$hora = date("H:i");
$num = isset($_POST["num"])?$_POST["num"]:"";
$serv = isset($_POST["serv"])?$_POST["serv"]:"";
if(isset($_POST['deslogar'])){
  if($_POST['deslogar']=="Sim"){
    unset($_SESSION['login']);
    session_destroy();
  }
}

if (isset($_POST["acao"]) and $_POST["acao"]=="Registrar") {
  $info = $vendaDAO->pegar_servico($serv);
  $venda->setProduto($info["nome"]);
  $venda->setValor($info["preco"] * $num);
  $venda->setQtd($num);
  $venda->setData($data);
  $venda->setHora($hora);
  $venda->setTipo(1);
  $vendaDAO->cadastrar_venda($venda);
}

if (isset($_POST["acao"]) and $_POST["acao"]=="Vender") {
  $venda->setProduto($produto);    
  $venda->setData($data);
  $venda->setHora($hora);
  $venda->setValor($preco * $qtd);
  $venda->setQtd($qtd);
  $venda->setTipo(0);
  $produtoModel->setQtd($qtdProd - $qtd);
  $produtoModel->setId($idProd);
  $produtoDAO->remover_produtos($produtoModel);
  $vendaDAO->cadastrar_venda($venda);

}

if(!empty($_SESSION['login'])){
  $log = $_SESSION['login'];

  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Data Tables</title>
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
    
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

   <style type="text/css">
    th {
      text-align: center;
    }

    #btnImpress{
      margin-top: -3%;
      
    }
  </style>
  <script type="text/javascript">
   function trocarCampos(id,imagem,produto,preco,qtd) {
    if (imagem == "") {
      var urlImagem = "../../imagens/icone-produtos.png";
    }else{
      var urlImagem = "../dist/img/img_produtos/" + imagem;
    }
    $("#imgProd").attr("src", urlImagem);
    $("input#produto").val(produto);
    $("input#preco").val(preco);
    $("input#qtdMax").attr("max", qtd);
    $("input#qtdProd").val(qtd);
    $("input#qtdEsto").val(qtd);
    $("input#idProd").val(id);
  }
</script>
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
          <li>
            <a href="relatorio.php">
              <i class="glyphicon glyphicon-print"></i> <span>Serviços</span>
            </a>
          </li>
        </ul>
      </section>

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Realizar uma venda
          <small>marque os produtos</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-money"></i> Realizar Venda</a></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Produtos</h3>
                <div align="right">
                  <button id="btnImpress" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">Serviços</button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Adicionar ao carrinho</th>
                      <th>Imagem</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th>Marca</th>
                      <th>Preço</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    foreach ($lista_produtos as $produtos) {
                      if (empty($produtos["imagem"])) {
                        $urlImg = "../../imagens/icone-produtos.png";
                      }else{
                        $urlImg = "../dist/img/img_produtos/" . $produtos["imagem"];
                      }

                      if ($produtos["qtd"] > 0) {


                        ?>

                        <tr>

                         <td align='center'><button  class='btn btn-success' onclick="trocarCampos('<?=$produtos['id']?>','<?=$produtos['imagem']?>','<?=$produtos['nome']?>','<?=$produtos['preco']?>','<?=$produtos['qtd']?>')" data-toggle="modal" data-target="#modalVender">+</button></td>
                         <td align='center'><img class="img-fluid" style="width: 20%" src="<?=$urlImg?>"> </td>
                         <td align='center'><?=$produtos['nome']?></td>
                         <td align='center'><?=$produtos['descricao']?></td>
                         <td align='center'> <?=$produtos['marca']?> </td>
                         <td align='center'>R$  <?=$produtos['preco']?> </td>

                       </tr>

                       <?php   
                     }
                     else{
                      ?>
                      <tr>
                        <td align='center'><button disabled class='btn btn-danger' style="cursor: pointer;" title="Produto em falta">+</button></td>
                        <td align='center'><img class="img-fluid" style="width: 20%" src="<?=$urlImg?>"> </td>
                        <td align='center'><?=$produtos['nome']?> </td>
                        <td align='center'><?=$produtos['descricao']?></td>
                        <td align='center'> <?=$produtos['marca']?> </td>
                        <td align='center'>R$  <?=$produtos['preco']?> </td>
                      </tr>
                      <?php
                    }

                  }

                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Adicionar ao carrinho</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Marca</th>
                    <th>Preço</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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

  <div class="control-sidebar-bg"></div>
</div>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- data table -->
<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<!-- page script -->
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
        'autoWidth'   : false
      }
    })
  });

</script>


</section>
<!-- /.sidebar -->


<div class="control-sidebar-bg"></div>
</div>


</form>
</div>
</div>

<!-- modal impressão-->
<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " align="center">Quantidade de produtos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>

        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <div align="center">
            <select class="form-control form-control-lg" name="serv">
              <option hidden value="" disabled selected >Selecione um serviço</option>
              <?php
              foreach ($servicos as $servico) {
                ?> 
                <option value="<?=$servico["id"]?>"><?=$servico["nome"]?></option>
              
              <?php
            }
            ?>
            </select>
            <p align="center" style="margin-top: 4px;"><input min="1" class="form-control form-control-lg" type="number" name="num"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input type="submit" class="btn btn-success" name="acao" value="Registrar">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- modal carrinho -->
<div class="modal fade" id="modalVender" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title " align="center">Vender produto</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>

        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">


          <div class="form-group">
            <div class="text-center">
              <img id="imgProd" class="img rounded-circle" src="../../imagens/icone-produtos.png" style="width:15%; cursor:pointer" title="Clique para adicionar uma foto"/>
            </div>
            <div class="form-group">
              <input id="fotoProd" name="teste2" class="form-control" type="file" accept="image/*" style="display:none;">
              <br>
              <label for="produto">Nome</label>
              <input readonly style="cursor: pointer;" type="text" class="form-control" name="produto" id="produto">
              <label for="preco">Preço</label>
              <input readonly style="cursor: pointer;" type="text" class="form-control" name="preco" id="preco">
              <label for="max">Quantidade em estoque</label>
              <input readonly style="cursor: pointer;" type="text" class="form-control" id="qtdEsto">
              <label for="qtdMax">Quantidade a ser vendida</label>
              <input type="number" class="form-control" name="qtd" id="qtdMax" >
              <input type="hidden" name="qtdProd" id="qtdProd">
              <input type="hidden" name="idProd" id="idProd">

            </div>



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input type="submit" class="btn btn-success" name="acao" value="Vender">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
   $(document).ready(function () {
     $('#imgProd').click(function () {
      $('#fotoProd').click();
    });
     $("#fotoProd").on('change', function () {
      if (typeof (FileReader) != "undefined") {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#imgProd').attr('src', e.target.result);
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