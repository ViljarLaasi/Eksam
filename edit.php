<?php
require_once("function.php");

if(isset($_POST["update_plate"])){
		update_data($_POST["id"], $_POST["name"], $_POST["tunnus"], $_POST["pesitsus"]);
	}
if(isset($_GET["edit_id"])){
		$data = getEditData($_GET["edit_id"]);
	}else{
		echo "VIGA";
		header("Location: redigeeri.php");	
	}
?>
</table>
<h2>Muuda Andmeid</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["edit_id"];?>">
	<label for="name" >Linnu Nimi</label><br>
	<input id="name" name="name" type="text" value="<?=$data->name;?>"><br><br>
	<label for="tunnus">Iseloomulikud tunnused</label><br>
	<input id="tunnus" name="tunnus" type="text" value="<?=$data->tunnus;?>"><br><br>
	<label for="pesitsus">Pesitsuspiirkond</label><br>
	<input id="pesitsus" name="pesitsus" type="text" value="<?=$data->pesitsus;?>"><br><br>
	<input type="submit" name="update_plate" value="Salvesta">
</form>