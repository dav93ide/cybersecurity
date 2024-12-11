<?php

	function make_user_dir($name){
		if(!file_exists('data/'.$name)){
			mkdir('data/'.$name);
		}
	}
	
	function check_valid_mail($email){
		$mail = explode("@",$email)[1];
		$mail = explode(".",$mail)[0];
		$validMail = Array("gmail","libero","yahoo","hotmail");
		if(!in_array($mail, $validMail)){
			return True;
		}
		else{
			return False;
		}
	}
?>