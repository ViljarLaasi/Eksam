<?php
	

echo"Tere tulemast db_tav.php";

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
<a href="index.php?action=login">Logi sisse</a>
 <?php
 require_once("function.php");
 
$keyword = "";

	if(isset($_GET["keyword"])){
	
		$keyword = $_GET["keyword"];
		$data_array = get_Data($keyword);
	}else{
		$data_array = get_Data();
	}
	
?>
<h2>Otsing, nime või tunnuse järgi</h2>

<form action="db_tav.php" method="get" >
	<input type="search" name="keyword" value="<?=$keyword;?>" >
	<input type="submit">
</form>
<h2>Tabel</h2>
<table border=1 >
	<tr>
		<th>id</th>
		<th>Linnu Nimi</th>
		<th>Iseloomulikud tunnused</th>
		<th>Pesitsuspiirkond</th>
		
	</tr>
	<?php
		for($i = 0; $i < count($data_array); $i++){
				echo "<tr>";
				echo "<td>".$data_array[$i]->id."</td>";
				echo "<td>".$data_array[$i]->name."</td>";
				echo "<td>".$data_array[$i]->tunnus."</td>";
				echo "<td>".$data_array[$i]->pesitsus."</td>";
				echo "</tr>";
				
			
			
		}
	
	
	?>







