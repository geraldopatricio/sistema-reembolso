<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$document = new Dompdf();
$html = '';
$page = file_get_contents("despesa.html");
$connect = mysqli_connect("localhost", "root", "", "intranet");

$cod=$_GET['id'];

// cabeçalho
$query = "SELECT c.id cod_despesa
			, DATE_FORMAT(c.dt_ini, '%d/%m/%Y') dt_ini
			, DATE_FORMAT(c.dt_fim, '%d/%m/%Y') dt_fim
			, (SELECT f.name FROM system_user f WHERE f.id = c.fk_funcionario) nome
			, (SELECT f.setor FROM system_user f WHERE f.id = c.fk_funcionario) cc
			, c.trecho trecho
			, c.observacao
			FROM cabecalho c
			WHERE c.id = '$cod'";
$result = mysqli_query($connect, $query);

// soma totais por tipo
$query2 = "SELECT distinct
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Hotel') AS hotel,			  
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Taxi') AS taxi,		  
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Uber') AS uber,		  
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Pedagio') AS pedagio,		  
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Refeicoes') AS refeicoes,		  
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Passagem') AS passagem,		  
			(SELECT SUM(i.valor) 
				FROM cabecalho c, itens i
				WHERE c.id = i.despesa
				AND c.id = '$cod'
				AND i.tipo = 'Outros') AS outros
			FROM cabecalho c, itens i
			WHERE c.id = i.despesa
			AND c.id = '$cod'";
$result2 = mysqli_query($connect, $query2);

// despesas
$query3 = "SELECT date_format(i.dt_lancamento, '%d/%m/%Y') AS dt
				, i.documento AS doc
				, i.descricao AS despesa
				, i.tipo AS tp
				, i.valor AS valor
			FROM cabecalho p, itens i
			WHERE p.id = i.despesa
			AND p.id = '$cod'";
$result3 = mysqli_query($connect, $query3);

// total
$query4 = "SELECT sum(i.valor) AS total
			FROM cabecalho p, itens i
			WHERE p.id = i.despesa
			AND p.id = '$cod'";
$result4 = mysqli_query($connect, $query4);

// adiantamento
$query5 = "SELECT SUM(a.valor) AS adianta
			FROM cabecalho p, adiantamento a
			WHERE p.id = a.fk_despesa
			AND p.id = '$cod'";
$result5 = mysqli_query($connect, $query5);

// resto
$query6 = "SELECT (sum(i.valor) - (select SUM(a.valor) FROM adiantamento a WHERE a.fk_despesa = p.id )) AS resto
			FROM cabecalho p, itens i
			WHERE p.id = i.despesa
			AND p.id = '$cod'";
$result6 = mysqli_query($connect, $query6);

// rodape
$query7 = "SELECT f.banco, f.agencia, f.conta, f.cpf, f.name as nome, p.observacao
			FROM cabecalho p, system_user f
			WHERE p.fk_funcionario = f.id
			AND p.id = '$cod'";
$result7 = mysqli_query($connect, $query7);

$data = date("d/m/Y");

$output = "
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			font-size: 10px;
		}

		td, th {
			border: 1px solid #028cab;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			background-color: #dddddd;
		}
		footer {
		page-break-after: always;
		}
	</style>
<table>
	
";

while($row = mysqli_fetch_array($result))
{
	$output .= '
		<tr>
            <td width="15%"><img src="img/logo.png" width="100" height="46"></td>
            <td width="60%" colspan="5" align="center"><center><font size="5"><b>RELAT&Oacute;RIO DE DESPESAS</b></font></center></td>
            <td width="25%"><b>N&Uacute;MERO:</b><br> <font size="4"><b>'.$row["cod_despesa"].'<\b></font></td>
        </tr>
        <tr>
            <td><b>NOME:</b></td>
            <td colspan="4">'.utf8_encode($row["nome"]).'</td>
            <td colspan="2"><b>EMISS&Atilde;O:</b> '.$data.'</td>
        </tr>
        <tr>
            <td><b>TRECHO:</b></td>
            <td colspan="6">'.utf8_encode($row["trecho"]).'</td>
        </tr>
		<tr>
			<td><b>OBSERVA&Ccedil;&Otilde;ES</b></td>
			<td colspan="6">'.utf8_encode($row["observacao"]).'</td>
		</tr>
        <tr>
            <td><b>&Aacute;REA:</b></td>
            <td colspan="3">'.utf8_encode($row["cc"]).'</td>
            <td colspan="3"><b>PER&Iacute;ODO:</b> '.$row["dt_ini"].' a '.$row["dt_fim"].'</td>
        </tr>
	';
}


while($row = mysqli_fetch_array($result2))
{
	$output .= '
	<tr>
		<td colspan="7" bgcolor="#eaeaea" align="center"><center><font size="3"><b>RESUMO TOTAL DAS DESPESAS</b></font></center></td>
	</tr>
	<tr>
		<td align="center"><b>HOTEL</b></td>
		<td align="center"><b>T&Aacute;XI</b></td>
		<td align="center"><b>UBER</b></td>
		<td align="center"><b>PED&Aacute;GIO</b></td>
		<td align="center"><b>REFEI&Ccedil;&Otilde;ES</b></td>
		<td align="center"><b>PASSAGEM</b></td>
		<td align="center"><b>OUTROS</b></td>
	</tr>
	<tr>
		<td>R$ '.number_format($row["hotel"], 2, ',', '.').'</td>
		<td>R$ '.number_format($row["taxi"], 2, ',', '.').'</td>
		<td>R$ '.number_format($row["uber"], 2, ',', '.').'</td>
		<td>R$ '.number_format($row["pedagio"], 2, ',', '.').'</td>
		<td>R$ '.number_format($row["refeicoes"], 2, ',', '.').'</td>
		<td>R$ '.number_format($row["passagem"], 2, ',', '.').'</td>
		<td>R$ '.number_format($row["outros"], 2, ',', '.').'</td>
	</tr>
	<tr>
		<td colspan="7" bgcolor="#eaeaea" align="center"><center><font size="3"><b>DEMOSTRANTIVO DE TODAS AS DESPESAS</b></font></center></td>
	</tr>
	<tr>
		<td><b>DATA</b></td>
		<td><b>NUM DOC</b></td>
		<td colspan="4"><b>DESCRI&Ccedil;&Atilde;O</b></td>
		<td><b>VALOR</b></td>
	</tr>
	';
}

while($row = mysqli_fetch_array($result3))
{
	$output .= '	
	<tr>
		<td>'.$row["dt"].'</td>
		<td>'.$row["doc"].'</td>
		<td colspan="4">'.utf8_encode($row["despesa"]).'</td>
		<td>R$ '.number_format($row["valor"], 2, ',', '.').'</td>
	</tr>
	';
}

while($row = mysqli_fetch_array($result4))
{
	$output .= '	
	<tr>
		<td colspan="5" rowspan="3">
			<center><img src="img/assinatura.png" width="400" height="74"></center>
		</td>
		<td><b>TOTAL</b></td>
		<td>R$ '.number_format($row["total"], 2, ',', '.').'</td>
	</tr>
	';
}

while($row = mysqli_fetch_array($result5))
{
	$output .= '
	<tr>
		<td><b>ADIANTAMENTO</b></td>
		<td>R$ '.number_format($row["adianta"], 2, ',', '.').'</td>
	</tr>
	';
}


while($row = mysqli_fetch_array($result6))
{
	$output .= '
	<tr>
		<td><b>RECEBER/DEVOLVER</b></td>
		<td>R$ '.number_format($row["resto"], 2, ',', '.').'</td>
	</tr>
	';
}


while($row = mysqli_fetch_array($result7))
{
	$output .= '
	<tr>
		<td colspan="7" bgcolor="#eaeaea" align="center"><center><font size="3"><b>DADOS BANC&Aacute;RIOS PARA REEMBOLSO</b></font></center></td>
	</tr>
	<tr>
		<td><b>BANCO</b></td>
		<td colspan="6">'.$row["banco"].'</td>
	</tr>
	<tr>
		<td><b>AG&Ecirc;NCIA</b></td>
		<td>'.$row["agencia"].'</td>
		<td><b>CONTA</b></td>
		<td colspan="4">'.$row["conta"].'</td>
	</tr>
	<tr>
		<td><b>CPF</b></td>
		<td>'.$row["cpf"].'</td>
		<td><b>FAVORECIDO</b></td>
		<td colspan="4">'.$row["nome"].'</td>
	</tr>
	<tr>
		<td colspan="7">
			<center>
				<b><font size="-2">FAE - SISTEMAS DE MEDI&Ccedil;&Atilde;O S.A.</font></b><br>
				Rod. BR 116 - KM 13, N. 2363 - Messejana - Fortaleza - CE - CEP: 60842-395<br>
				www.fae.com.br - vendas@fae.com.br - Whatsapp: (85) 9 9434-4191
			</center>
		</td>
	</tr>
	';
}

$output .= '</table>';
$document->loadHtml($output);
//$document->setPaper('A4', 'landscape');

$document->setPaper('A4', 'portrait');
$document->render();
$document->stream("Webslesson", array("Attachment"=>0));

?>