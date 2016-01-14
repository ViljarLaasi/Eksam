<?php

echo"Tere tulemast redigeeri lehele";

if(isset($msqly)){
	die('Püüad mind häkkida');
}
	if(!isset($_SESSION["id"])){
		header("id");
	}
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
	}
?>
<p>
<a href="?logout=1"> Logi välja <a> 
</p>
 <?php
 require_once("function.php");
	if(isset($_GET["delete"])){
		echo "Kustutame id ".$_GET["delete"];
		delete_entry($_GET["delete"]);
	}
	if(isset($_POST["save"])){
		update_entry($_POST["id"], $input['name'], $input['tunnus'], $input['pesitsus']);
	}
$keyword = "";
	if(isset($_GET["keyword"])){
		$keyword = $_GET["keyword"];
		$data_array = get_Data($keyword);
	}else{
		$data_array = get_Data();
	}
?>
<h2>Tabel</h2>

<form action="redigeeri.php" method="get" >
	<input type="search" name="keyword" value="<?=$keyword;?>" >
	<input type="submit">
</form>
<h2>Tabel</h2>
<table border=1 >
	<tr>
		<th>id</th>
		<th>Linnu nimi</th>
		<th>Iseloomulikud tunnused</th>
		<th>Pesitsuspiirkond</th>
		<th>Kustuta</th>
		<th>Muuda</th>
	</tr>
	<?php
		for($i = 0; $i < count($data_array); $i++){
			if(isset($_GET["edit"]) && $data_array[$i]->id == $_GET["edit"]){
				echo "<tr>";
				echo "<form action='redigeeri.php' method='post'>";
				echo "<input type='hidden' name='id' value='".$data_array[$i]->id."'>";
				echo "<td><input name='name' value='".$data_array[$i]->name."'></td>";
				echo "<td><input name='tunnus' value='".$data_array[$i]->tunnus."'></td>";
				echo "<td><input name='pesitsus' value='".$data_array[$i]->pesitsus."'></td>";
				echo "<td><a href='redigeeri.php'>cancel</a></td>";
				echo "<td><input type='submit' name='save'></td>";
				echo "</form>";
				echo "</tr>";
			}else{
				echo "<tr>";
				echo "<td>".$data_array[$i]->id."</td>";
				echo "<td>".$data_array[$i]->name."</td>";
				echo "<td>".$data_array[$i]->tunnus."</td>";
				echo "<td>".$data_array[$i]->pesitsus."</td>";
				echo "<td><a href='?delete=".$data_array[$i]->id."'>Kustuta</a></td>";
				echo "<td><a href='edit.php?edit_id=".$data_array[$i]->id."'>Muuda</a></td>";
				echo "</tr>";
				
			}
			
		}
	
	
	?>




