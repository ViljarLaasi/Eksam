<?php
if(isset($msqly)){
	die('Püüad mind häkkida');
}	
$errors = array();
$input = array();
$show_form = True;
if($_SERVER["REQUEST_METHOD"] == "POST") {
	foreach(array('username', 'password') as $field){
			if ( empty($_POST[$field]) ) { 
				$errors[$field] = "See väli on kohustuslik";
			}else{
				$input[$field] = cleanInput($_POST[$field]);
			}
		}
		if(empty($errors)){
				$hash = hash("sha512", $input['password']);
					
				$stmt = $mysqli->prepare('SELECT id, email FROM user WHERE email =? AND password=?');
				if(!$stmt){
					die("juhtus viga".$mysqli->error);
				}
				$stmt->bind_param("ss", $input['username'], $hash);
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				if($stmt->fetch()){
					echo "Email ja parool õiged, kasutaja id=".$id_from_db;
					header('Location: index.php');
					$show_form = False ;
					$_SESSION['username'] = $email_from_db ;
					$_SESSION['id'] = $id_from_db ;
				}else{
					$errors['username'] = 'Ei leidnud sellist kasutajat';
				}
				$stmt->close();	
		}
	} 
if($show_form){
	?>
	<html>
<head>
<meta charset="UTF-8">
  <title>Log In</title>
</head>
<body>
	<h2>Log In</h2>
	<?php if(isset($_SESSION['Register sooritatud'])){
		echo '<span style="color:green"> Registreerimine õnnestus. Logi sisse </span> ';
		unset($_SESSION['Register sooritatud']);
	}	
	?>
  <form action="index.php?action=login" method="post" >
  	<input name="username" type="email" placeholder="E-post" value="<?php if(isset($input['username'])){echo $input['username'];} ?>">
	<span style="color:red" ><?php if(isset($errors['username'])){echo $errors['username'];} ?> </span><br><br>
  	<input name="password" type="password" placeholder="Parool"> 
	<span style="color:red" ><?php if(isset($errors['password'])){echo $errors['password'];} ?> </span> <br><br>
  	<input type="submit" value="Log In">
	<br>
	<a href="index.php?action=registreeri">Siin saad registreerida end kasutajaks</a>
  </form>
<body>
<html>
	
	<?php
}