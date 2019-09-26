<?php	

	include_once("../../model/VendaModel.php");
	include_once("../../controller/VendaDAO.php");

	$mes = isset($_POST['mes'])?$_POST['mes']:date('m');
	$ano = isset($_POST['ano'])?$_POST['ano']:date('Y');

	if ($mes < 10) {
		$data = '%/0' . $mes . '/' . $ano;
	}else{
		$data = '%/' . $mes . '/' . $ano;
	}
	

	require_once("../../config/conexao.php");
	$sql ="SELECT * FROM venda WHERE  data LIKE :data";
	$pdo = new PDO('mysql:host=localhost;dbname=modesto;charset=utf8', 'root', '');
	$listar = $pdo->prepare($sql);
	$listar->bindValue(':data', $data);
	$listar->execute();
	$lista = $listar->fetchAll(PDO::FETCH_ASSOC);

	$relatorio = "";

	foreach ($lista as $venda) {
		$relatorio .= "<tr>";
		$relatorio .= "<td>" . $venda["produto"] . "</td>";
		$relatorio .= "<td>R$ " . number_format($venda["valor"]/$venda["qtd"], 2, '.', '') . "</td>";
		$relatorio .= "<td>R$ " . number_format($venda["valor"], 2, '.', '') . "</td>";
		$relatorio .= "<td>" . $venda["qtd"] . "</td>";
		$relatorio .= "<td>" . $venda["data"] . "</td>";
		$relatorio .= "<td>" . $venda["hora"] . "</td>";
		$relatorio .= "</tr>";
	}

	//referenciar o DomPDF com namespace
		use Dompdf\Dompdf;

		// include autoloader
		require_once("../dompdf/autoload.inc.php");


		$ano = $_POST['ano'];
		$mes = $_POST['mes'];

		if ($mes == 1) {
			$nome_mes = "janeiro";
		}else if ($mes == 2) {
			$nome_mes = "fevereiro";
		}else if ($mes == 3) {
			$nome_mes = "março";
		}else if ($mes == 4) {
			$nome_mes = "abril";
		}else if ($mes == 5) {
			$nome_mes = "maio";
		}else if ($mes == 6) {
			$nome_mes = "junho";
		}else if ($mes == 7) {
			$nome_mes = "julho";
		}else if ($mes == 8) {
			$nome_mes = "agosto";
		}else if ($mes == 9) {
			$nome_mes = "setembro";
		}else if ($mes == 10) {
			$nome_mes = "outubro";
		}else if ($mes == 11) {
			$nome_mes = "novembro";
		}else if ($mes == 12) {
			$nome_mes = "dezembro";
		}

		if ($mes < 10) {
			$dMes = "0" . $mes;
		}

		//Criando a Instancia
		$dompdf = new DOMPDF();

		// Carrega seu HTML
		$dompdf->load_html('
				<p>Relatorio referente ao mes de ' . $nome_mes . ' do ano '.$ano.'</p>
				<p>Ganho do mes: R$200</p>
				<p>Impressões: R$</p>
				<table border="0.5px" style="border-color: black;" >
					<tbody>
						<tr>
							<th colspan="6">Tabela de vendar referente ao mês de ' . $nome_mes . ' do ano ' . $ano . '</th>
						</tr>
						<tr>
							<td>Produto</td>
							<td>Valor Unitário</td>
							<td>Valor Total</td>
							<td>Quantidade</td>
							<td>Data</td>
							<td>Hora</td>
						</tr>
						' . $relatorio . '
					</tbody>
				</table>
			');

		//Renderizar o html
		$dompdf->render();

		//Exibibir a página
		$dompdf->stream(
			"vendas_" . $dMes . "_" . $ano . ".pdf", 
			array(
				"Attachment" => false //Para realizar o download somente alterar para true
			)
		);
	
?>