<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['ator'])&& is_numeric($_GET['ator'])) {
		$idFilme = $_GET['ator'];
		$con=new mysqli("localhost","root", "","projeto-filmes");

		if ($con->connect_errno!=0) {
			echo "<h1>Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error."</h1>";
			exit();
		}
		$sql="Select * from autores where id_filme=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idAutor);
			$stm->execute();
			$res=$stm->get_result();
			$ator=$res->fetch_assoc();
			$stm->close();
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>Editar Atores</title>
<h1>Editar Atores</h1>
			<form action="atores_update.php" method="POST">
		<label>Nome</label><input type="text" name="nome" required value="<?php echo $ator['nome']; ?>"><br>
		<label>Data Nascimento</label><input type="text" name="data_nascimento" value="<?php echo $ator['data_nascimento'];?>"><br>
		<label>Nacionalidade</label><input type="text" name="nacionalidade" value="<?php echo $ator['nacionalidade'];?>"><br>
        <input type="submit" name="enviar">
	</form>
	</body>
		
			<?php
			}
			else{
				echo "<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos irá ser rencaminhado!</h1>";
				header ("refresh:5; url=index.php");
				
			}
		
		?>
		</html>
	<?php
}
?>