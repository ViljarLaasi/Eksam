<?php
if(isset($msqly)){
	die('Püüad mind häkkida');
}
$errors = array();
$input = array();
$show_form = True;
if($_SERVER["REQUEST_METHOD"] == "POST") {

	foreach(array('username', 'password','firstname','lastname','phone') as $field){
	
			if ( empty($_POST[$field]) ) { 
				$errors[$field] = "See väli on kohustuslik";
			}else{
			
				$input[$field] = cleanInput($_POST[$field]);
			}
		}
		if(empty($errors)){
			
				$hash = hash("sha512", $input['password']);
					
					
					$stmt = $mysqli->prepare("INSERT INTO user (email, password, first, last, phone) VALUES (?,?,?,?,?)");
					
					
					
					$stmt->bind_param("sssss", $input['username'], $hash,$input['firstname'],$input['lastname'],$input['phone']);
					$stmt->execute();
					$stmt->close();
				header('Location: index.php'); 
				$_SESSION['Register sooritatud']=True;
				$show_form = False ;
			
			
		}
		
	}


	
if($show_form){
	?>
	<html>
<head>
<meta charset="UTF-8">
  <title>Register</title>
</head>
<body>
	<h2>Create user</h2>
  <form action="index.php?action=registreeri" method="post" >
  	<input name="username" type="email" placeholder="E-post" value="<?php if(isset($input['username'])){echo $input['username'];} ?>">
	<span style="color:red" ><?php if(isset($errors['username'])){echo $errors['username'];} ?> </span><br><br>
	<input name="password" type="password" placeholder="Parool"> <?php if(isset($errors['password'])){echo $errors['password'];} ?> <br><br>
	
	<input name="firstname" type="name" placeholder="Eesnimi" value="<?php if(isset($input['firstname'])){echo $input['firstname'];} ?>">
	<span style="color:red" ><?php if(isset($errors['firstname'])){echo $errors['firstname'];} ?> </span><br><br>
	
	<input name="lastname" type="text" placeholder="Perenimi" value="<?php if(isset($input['lastname'])){echo $input['lastname'];} ?>">
	<span style="color:red" ><?php if(isset($errors['lastname'])){echo $errors['lastname'];} ?> </span><br><br>
	
	<input name="phone" type="text" placeholder="Telefon" value="<?php if(isset($input['phone'])){echo $input['phone'];} ?>">
	<span style="color:red" ><?php if(isset($errors['phone'])){echo $errors['phone'];} ?> </span><br><br>
	
	<input type="submit" name="create" value="Create user">
  	
  </form>
<body>
<html>
	
	<?php
}