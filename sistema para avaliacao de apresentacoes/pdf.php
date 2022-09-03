<?php 
ob_start(); // Ativa o buffer de saida do PHP

function CriaCodigo(){ //Gera numero aleatorio
    for ($i = 0; $i < 40; $i++) {
            $tempid = strtoupper(uniqid(rand(), true));
            $finalid = substr($tempid, -12);
            return $finalid;
    }
}?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;"/>
        <meta name="author" content="Claudio Souza Jr. <claudio@uerr.edu.br>"/>
        <meta name="created" content="18/12/2015"/>
        <meta name="version" content="1.0"/>
        <meta name="changed" content="20/12/2015"/>
        <title>Teste mPDF</title>
        <link rel='icon' type='image/png' href='favicon.png'>
        <!-- Nao defina atributos para a folha de estilos -->
        <link rel='stylesheet' href='style.css' type='text/css'>
    </head>
    <form action="gerador.php" target="_blank">
        <input type="submit" value="Salvar em PDF">
    </form>
    <body>
        <h3>
            Doc: <?=CriaCodigo()?>
        </h3>
        <p>O padre Manuel Bernardes pregava, numa das suas Silvas:</p>
        <p> "Bem pode haver ira, sem haver pecado: Irascimini, et nolite peccare. E às vezes poderá haver pecado, se não houver ira: porquanto a paciência, e silêncio, fomenta a negligência dos maus, e tenta a perseverança dos bons. Qui cum causa non irascitur, peccat (diz um padre) patientia enim irrationabilis vitia seminat, negligentiam nutrit, et non solum malos, sed etiam bonos invitat ad malum. Nem o irar-se nestes termos é contra a mansidão: porque esta virtude compreende dous atos: um é reprimir a ira, quando é desordenada: outro excitá-la, quando convém. A ira se compara ao cão, que ao ladrão ladra, ao senhor festeja, ao hóspede nem festeja, nem ladra: e sempre faz o seu ofício. E assim quem se agasta nas ocasiões, e contra as pessoas, que convém agastar-se, bem pode, com tudo isso, ser verdadeiramente manso. Qui igitur (disse o Filósofo) ad quae oportet, et quibus oportet, irascitur, laudatur, esse que is mansuetus potest".</p>
        <blockquote>
            Trecho de "Oração aos moços" de Rui Barbosa.
        </blockquote>
    </body>
</html>
<?php

require_once('conn/conn.php');
include("mpdf60/mpdf.php");

if($_POST['id_aluno']){$id = $_POST['id_aluno'];}else{$id = "0";}
$result=pg_query($conn, "SELECT * FROM pontos WHERE \"id_nome\"='$id';");
$cont=1;

$html = "
<table border='1'><tr> - <td></td><td>N1</td><td>N2</td><td>N3</td><td>N4</td><td>N5</td><td>N6</td><td>N7</td><td>N8</td><td>N9</td><td>N10</td><td>N11</td><td>N12</td><td>N13</td><td>N14</td><td>N15</td><td>N16</td><td>N17</td><td>N18</td><td>MÉDIA</td></tr>";
while($row=pg_fetch_array($result)){

	$html .="<tr>
	<td>NOTA ".$cont."</td><td>".$row["nota1"]."</td><td>".$row["nota2"]."</td><td>".$row["nota3"]."</td><td>".$row["nota4"]."</td><td>".$row["nota5"]."</td><td>".$row["nota6"]."</td><td>".$row["nota7"]."</td><td>".$row["nota8"]."</td><td>".$row["nota9"]."</td><td>".$row["nota10"]."</td><td>".$row["nota11"]."</td><td>".$row["nota12"]."</td><td>".$row["nota13"]."</td><td>".$row["nota14"]."</td><td>".$row["nota15"]."</td><td>".$row["nota16"]."</td><td>".$row["nota17"]."</td><td>".$row["nota18"]."</td><td>".$row["pontos"]."</td>
	</tr>";
	$cont++;
} 

$html .="</table>

<p>LEGENDA:</p>
N1 : CONTEXTUALIZAÇÃO DO ASSUNTO DA AULA;<br>
N2 : INFORMAÇÃO DO OBJETIVO DA AULA;<br>
N3 : REALIZAÇÃO DE INCENTIVAÇÃO INICIAL;<br>
N4 : RITMO DE FALA PERMITE QUE OS ALUNOS ACOMPANHEM AS EXPLICAÇÕES;<br>
N5 : VARIAÇÃO DA INTENSIDADE DA VOZ;<br>
N6 : MOVIMENTOU-SE NA SALA DUTRANTE SUA AULA;<br>
N7 : MANTEVE CONTATO VISUAL COM TODA A TURMA DURANTE AS EXPLICAÇÕES;<br>
N8 : ADEQUAÇÃO DA POSTURA;<br>
N9 : USO DE LINGUAGEM ISENTA DE ERROS OU VÍCIOS;<br>
N10 : ARTICULAÇÃO DAS PALAVRAS;<br>
N11 : SEGURANÇA NAS EXPLICAÇÕES DO CONTEÚDO;<br>
N12 : USO DE TÉCNICAS PARA A FACILITAÇÃO DA APRENDIZAGEM;<br>
N13 : VERIFICAÇÃO DA APRENDIZAGEM;<br>
N14 : INCENTIVA E ESTIMULA A PARTICIPAÇÃO DOS ALUNOS;<br>
N15 : CONDUÇÃO DA AULA DE MODO A TORNÁ-LA DINÂMICA;<br>
N16 : DESENVOLTURA PARA REAGIR A SITUAÇÕES ADVERSAS;<br>
N17 : UTILIZAÇÃO DOS 'RI' DE FORMA DIDÁTICA (SEM PRENDER-SE À LEITURA);<br>
N18 : CRIATIVIDADE E INOVAÇÃO DOS 'RI'.<br>
";

  

 $mpdf=new mPDF(); 
 $mpdf->SetDisplayMode('fullpage');
 $css = file_get_contents("css/responsivo.css");
 $mpdf->WriteHTML($css,1);
 $mpdf->WriteHTML($html);
 $mpdf->Output('Arquivo.pdf',D);

 exit;
 ?>