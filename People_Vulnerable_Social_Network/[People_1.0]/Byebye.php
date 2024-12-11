<?php
	session_start();
	if(isset($_COOKIE['cookie']) OR isset($_SESSION['username'])){
		setcookie("cookie","",time()-3600);
		session_destroy();
		header('location: index.php');
	}
	else{
		header("location: 404.html");
	}
?>