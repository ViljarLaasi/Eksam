<?php
require_once("../config.php");
function delete_entry($id){
		
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 
			$stmt = $mysqli->prepare("UPDATE linnud SET del=NOW() WHERE id=?");
			if(!$stmt){
					die("juhtus viga delete_entry".$mysqli->error);
			}
			$stmt->bind_param("i", $id);
			if($stmt->execute()){	
			header("Location: redigeeri.php");
		}
			$stmt->close();
		$mysqli->close();
}
		
function update_entry($id, $name, $tunnus, $pesitsus){
	
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 
		
		$stmt = $mysqli->prepare("UPDATE linnud SET name=?, tunnus=?, pesitsuspiirkond=? WHERE id=?");
		if(!$stmt){
			die("juhtus viga update_entry".$mysqli->error);
		}
		$stmt->bind_param("sss", $input['name'], $input['tunnus'], $input['pesitsus']);
		if($stmt->execute()){
			header("Location: redigeeri.php");
		}
			$stmt->close();
		$mysqli->close();
}
		
function get_Data($keyword=""){
		$search = "%%";
	
			$search = "%".$keyword."%";
		
		
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ; 				
		$stmt = $mysqli->prepare("SELECT id, name, tunnus, pesitsuspiirkond from linnud WHERE del IS NULL AND name LIKE ? ");
		if(!$stmt){
			die("juhtus viga get_Data".$mysqli->error);
		}
		$stmt->bind_param("s", $search );
		$stmt->bind_result($id, $name, $tunnus, $pesitsus);
		$stmt->execute();
		$data_array = array();
		
		while($stmt->fetch()){
			$data = new StdClass();
			$data->id = $id;
			$data->name = $name;
			$data->tunnus = $tunnus;
			$data->pesitsus= $pesitsus;
			array_push($data_array, $data);
		}
		return $data_array;
			$stmt->close();
			$mysqli->close();
}
function getEditData($id){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ;
		$stmt = $mysqli->prepare("SELECT name, tunnus, pesitsuspiirkond from linnud WHERE id=? AND del IS NULL");
		$stmt->bind_param("i",$id);
		$stmt->bind_result($name, $tunnus, $pesitsus);
		$stmt->execute();
		$data = new StdClass();
		
		if($stmt->fetch()){
			$data->name = $name;
			$data->tunnus = $tunnus;
			$data->pesitsus = $pesitsus;
		}else{
			header("Location: redigeeri.php");
		}
		return $data;
		
		
		$stmt->close();
		$mysqli->close();
		
	}
function update_data($id, $name, $tunnus, $pesitsus){
		
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME) ;
		$stmt = $mysqli->prepare("UPDATE linnud SET name=?, tunnus=?, pesitsuspiirkond=? WHERE id=?");
		$stmt->bind_param("sssi", $name, $tunnus, $pesitsus, $id);
		if($stmt->execute()){
			header("Location: redigeeri.php");
		}
		$stmt->close();
		$mysqli->close();
	}
?>