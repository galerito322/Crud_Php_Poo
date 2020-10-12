<link href="css/style.css" rel="stylesheet">

<?php
//SETS

use App\Model\Produto;
use App\Model\ProdutoDao;

require_once 'vendor/autoload.php';

$produtoDao = new ProdutoDao();
//$produtoDao->delete(8);

$produtoDao->read();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

	<?php

	$produto = new Produto();

	if (isset($_POST['cadastrar'])){
			
		$nome  = $_POST['nome'];
		$descricao = $_POST['descricao'];

		if (!empty($nome) and !empty($descricao) ) {
			$produto->setNome($nome);
			$produto->setDescricao($descricao);

			$produtoDao->create($produto);
			header("Location: index.php");
		}
		else {
			echo "<script>alert('Preencha todos os campo ".$id." aa ');</script>";
			header("Refresh: 0");
		}

	}
	
	?>

	<?php

	if (isset($_POST['atualizar'])) {

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
	
		if (!empty($nome) and !empty($descricao) ) {
			$produto->setNome($nome);
			$produto->setDescricao($descricao);

			$produto->setId($id);
			$produtoDao->update($produto);
			header("Location: index.php");
		}

		else {
			echo "<script>alert('Preencha todos os campos');</script>";
			header("Refresh: 0");
		}

	}

	?>

	<?php
	if (isset($_GET['acao']) && $_GET['acao'] == 'deletar') :

		$id = (int)$_GET['id'];
		$produtoDao->delete($id);

	endif;
	?>

	<?php
	if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
		$id = (int)$_GET['id'];
		$resultado = $produtoDao->find($id);
	?>

		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome" value="<?php echo $resultado['nome']; ?>" placeholder="Nome:" />
				<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados" style="color:blue" onclick="alert('Dados atualizados !')"> 
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="descricao" value="<?php echo $resultado['descricao']; ?>" placeholder="Descrição:" />
			</div>
			<input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">
		</form>

	<?php } else { ?>

		<form method="post" action="index.php">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome" placeholder="Nome:" />
				<b>
				<input type="submit" name="cadastrar" class="btn btn-primary" value="Inserir" style="color:green" onclick="alert('Dados inseridos !')" >
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="descricao" placeholder="Descrição:" />
			</div>
			
		</form>
		
	<?php } ?>
</body>

<?php

echo "<h4 class='tablehead'> CRUD, Using Php, Poo and Pdo </h4>";

//tabela da gambiarra!
foreach ($produtoDao->read() as $produto) :

	echo "<table class ='tablecss'>";
	echo "<tr>";
	echo "<th class='id'>Id:</th>";
	echo "<th>Nome:</th>";
	echo "<th>Descrição:</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class='id'>" . $produto["id"] . "</td>";
	echo "<td>" . $produto["nome"] . "</td>";
	echo "<td>" . $produto["descricao"] . "</td>";
	echo "<td>";
	echo "<a href=index.php?acao=deletar&id=" . $produto['id'] . " ' onclick='return confirm(\"Deseja realmente deletar o item: ".$produto['nome']." ? \")'>Deletar</a>";
	echo "</td>";
	echo "<td>";
	echo "<a href='index.php?acao=editar&id=" . $produto['id'] . "'>Editar</a>";
	echo "</td>";
	echo "</tr>";
	echo "</table>";

endforeach;

//tabela mais simples 
/* foreach ($produtoDao->read() as $produto) :
	echo "<a href='index.php?acao=deletar&id=" . $produto['id'] . "'>Deletar</a> &ensp;";
	echo "<a href='index.php?acao=editar&id=" . $produto['id'] . "'>Editar</a><br>";
	echo $produto['nome'] . "<br>" . $produto['descricao'] . "<br> id:" . $produto['id'] . "<hr>";
endforeach; */

?>



</html>