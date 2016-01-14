<?php
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


$errors = array();
$input = array();
$show_form = False ; 
if($_SERVER["REQUEST_METHOD"] == "POST") {
	foreach(array('name', 'tunnus', 'pesitsus') as $field){
			//if ( empty($_POST['$name'])) { 
				//$errors[$field] = "See väli on kohustuslik";	
			//}else{
				$input[$field] = cleanInput($_POST[$field]);
			//}
		}
		if(empty($errors)){
					$stmt = $mysqli->prepare("INSERT INTO linnud (name, tunnus, pesitsuspiirkond) VALUES (?,?,?)");
					if(!$stmt){
					die("juhtus viga".$mysqli->error);
					}
					$stmt->bind_param("sss", $input['name'], $input['tunnus'], $input['pesitsus']);
					$stmt->execute();
					$stmt->close();
				$_SESSION['lisa']=True;
				$show_form = True ;
		}
	}
	?>
	
	<html>
<head>
<meta charset="UTF-8">
  <title>Lisa märgatud lindude andmed</title>
</head>
<body>
	<?php if($show_form){
		echo '<span style="color:green"> Andmed on edastatud edukalt </span> ';
	}	
?>

	<h2> Lisa linnud andmebaasi</h2>
  <form action="index.php?action=registreeri" method="post" >
	<input name="name" type="text" placeholder="Linnu nimi" value="<?php if(isset($input['name'])){echo $input['name'];} ?>">
	<br><br>
  	<input name="tunnus" type="text" placeholder="Iseloomulikud tunnused" value="<?php if(isset($input['tunnus'])){echo $input['tunnus'];} ?>">
	<br><br>
	<input name="pesitsus" type="text" placeholder="Pesitsuspiirkond"value="<?php if(isset($input['pesitsus'])){echo $input['pesitsus'];} ?>"> 
	<br><br>
	<input type="submit" name="create" value="Lae Andmed">
	<a href="redigeeri.php">Siin saad redigeerida</a>
  </form>
<body>
<html>


	
	




