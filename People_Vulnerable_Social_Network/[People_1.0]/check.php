<?php
	session_start();
	include("db_functions.php");
	include("people_functions.php");
	if(isset($_POST['reg'])){
		if(isset($_POST['reguser']) && isset($_POST['regpass']) && isset($_POST['regmail']) && isset($_POST['regname']) && isset($_POST['regsurname']) && isset($_POST['sex']) && isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']) && isset($_POST['secretquestion']) && isset($_POST['secretanswer'])){
			if((strlen($_POST['reguser']) > 30) || (strlen($_POST['regpass']) < 6) || (strlen($_POST['regname']) > 30) || (strlen($_POST['regsurname']) > 30) || (strlen($_POST['regmail']) > 50)){
				$_SESSION['Message'] = "Riempire Correttamente Tutti I Campi Di Registrazione";
				header("location: index.php");
			}
			else{
				if(check_valid_mail($_POST['regmail'])){
					$_SESSION['Message'] = "E-mail Inserita Non Valida";
					header("location: index.php");
				}
				else{
					if($_POST['sex']=='m' || $_POST['sex']=='f'){
						switch($_POST['secretquestion']){
							case "q1":
								$question = "Nome Del Tuo Animale Domestico";
							break;
							case "q2":
								$question = "Nome Del Tuo Libro Preferito";
							break;
							case "q3":
								$question = "Data Dell'Evento Pi&ugrave Importante Della Tua Vita";
							break;
							case "q4":
								$question = "Nome Della Tua Canzone Preferita";
							break;
							case "q5":
								$question = "Un Codice PIN Alfanumerico Segreto";
							break;
							case "q6":
								$question= "Nome Del Tuo Film Preferito";
							break;
						}
						if($_POST['year'] > 2014){
							$_SESSION['Message'] = $_POST['year'] . "??? WoW Sei Veramente Precoce Nell'Uso Del Computer! :D ";
						}
						else{
							if($_POST['year'] < 1920){
								$_SESSION['Message'] = $_POST['year']. "??? Altro Che Elisir Di Lunga Vita! Sicuramente Sei Un Vampiro! D: ";
							}
							else{
								$_SESSION['Message'] = "Ciao \"".$_POST['regname']."\" Ti Diamo Il Benvenuto In People!";
							}
						}	
						if(!search_name($_POST['reguser'])){
							if(!search_mail($_POST['regmail'])){
								$password = password_hash($_POST['regpass'], PASSWORD_DEFAULT);
								$date = strval($_POST['year']) . "-" . strval($_POST['month']) . "-" . strval($_POST['day']);
								new_user($_POST['reguser'],$password,$_POST['regmail'],$date,$_POST['regname'],$_POST['regsurname'],$_POST['sex'],$question,$_POST['secretanswer']);
								$_SESSION['username'] = $_POST['reguser'];
								$cookie = strval(rand(5000,100000)) . $_SESSION['username'] . strval(rand(5000,100000));
								setcookie("cookie", $cookie ,time()+3600);
								make_user_dir($_SESSION['username']);
								header("location: userpage.php");
							}
							else{
								$_SESSION['Message'] = "Questa Email Esiste Gi&aacute";
								header("location: index.php");
							}
						}
						else{
							$_SESSION['Message'] = "Questo Nome Utente Esiste Gi&aacute";
							header("location: index.php");
						}
					}
					else{
						$_SESSION['Message'] = "Campo Sesso Inserito Non valido";
						header("location: index.php");
					}
				}
			}
		}
		else{
			$_SESSION['Message'] = "Inserire Tutti I Campi Di Registrazione";
			header("location: index.php");
		}
	}
	else{
		if(isset($_POST['log'])){
			if(isset($_POST['username']) && isset($_POST['password'])){
				if((strlen($_POST['username']) < 3) || (strlen($_POST['password']) < 6)){
					$_SESSION['Message'] = "Riempire Correttamente Tutti I Campi Di LogIn";
					header("location: index.php");
				}
				else{
					if(check_password($_POST['password'],$_POST['username'])){
						$_SESSION['username'] = $_POST['username'];
						$cookie = strval(rand(5000,100000)) . $_SESSION['username'] . strval(rand(5000,100000));
						setcookie("cookie", $cookie ,3600);
						log_time($_SESSION['username']);
						header("location: userpage.php");
					}
					else{
						$_SESSION['Message'] = "Nome Utente / Password Non Validi";
						header("location: index.php");
					}
				}
			}
			else{
				$_SESSION['Message'] = "Inserire Tutti I Campi Di LogIn";
				header("location: index.php");
			}
		}
		else{
			header("location: index.php");
		}
	}
?>