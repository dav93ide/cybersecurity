<?php
	session_start();
	include("db_functions.php");
	if(!isset($_SESSION['username']) && !isset($_COOKIE['cookie'])){
		header("location: 404.html");
	}
	else{
?>

<!DOCTYPE html>
	<html>
		<head>
			<title> 
				Pagina Utente
			</title>
			<link href="MoreStyle.css" rel="stylesheet" type="text/css">
		</head>
		<body style="background-color:black" onload="javascript:hideAll(666,1);hide_img_container();hide_mex_container();hide_post_textarea();hide_posts();">
			<div style="position:absolute;top:18%;left:5%;right:45%;background-color:#22F;border-radius:5px;">
				<!-- BACHECA -->
					<center>
						<font style="color:#0F0;border:2px solid black;font-size:25px;background-color:black;" > Bacheca Utente </font>
					</center>
				<form style="position:absolute;top:25px;left:15px;" action="options.php" method="POST">
					<input id="optionsSubmitButton" type="SUBMIT" name="addpost" value="Aggiungi Post" onmouseover="show_post_textarea()"/> <br/>
					<textarea maxlength=1000 id="PostTextArea" style="width:250px;height:100px;border-radius:5px;" name="posttext" onmouseleave="hide_post_textarea()"></textarea>		
				</form>
				<?php
					$arrPosts = get_posts($_SESSION['username']);
					if($arrPosts){
						$arrgroups = array();
						$maxposts = 0;
						$n=0;
						for($i=0;$i<count($arrPosts[2]);$i++){
							if(!in_array($arrPosts[2][$i],$arrgroups)){
								$first = false;
								$n++;
								if($maxposts == ($n-1)){
									$maxposts++;
								}
				?>
								<br/><br/>
								<div id="postgroup<?php echo $maxposts; ?>D" style="border:1px solid black;width:100%;background-color:black;border:1px solid white;" >
									<span style="color:white"> [-- <?php echo $n; ?> --]<br/>
										<span style="color:yellow">	User:	</span> 	<?php echo $arrPosts[1][$i]; ?> <br/>
										<span style="color:yellow">	Data Invio:	</span>	<?php echo $arrPosts[3][$i]; ?><br/><br/>
										<?php echo $arrPosts[0][$i]; ?><br/>
									</span>
									<form action="options.php" method="POST">
										<input type="hidden" value="<?php echo $arrPosts[2][$i]; ?>" name="postgroup" /><br/>
										<textarea maxlength=1000 style="width:80%;height:100px;border-radius:5px;" name="posttext" ></textarea>
										<input id="optionsSubmitButton" style="position:absolute;right:1%;border:1px solid #0F0;"  type="SUBMIT" name="answerpost" value="Rispondi" /> <br/>
									</form>
								</div>
				<?php
								array_push($arrgroups,$arrPosts[2][$i]);
							}
							else{
				?>	
								<button style="position:relative;left:88%;bottom:25px;background-color:#0F0;" onclick="show_post(<?php echo $maxposts; ?>)"> More </button><br/>
								<div id="postgroup<?php echo $maxposts; ?>" style="position:absolute;left:0%;top:0%;border:2px solid red;width:100%;background-color:black; z-index:1;" onmouseleave="hide_posts()" >
				<?php
								if(!$first){
				?>
									<span style="color:white"> [-- <?php echo $n; ?> --]<br/>
										<span style="color:yellow">	User:	</span> 	<?php echo $arrPosts[1][(($i==0) ? 0 : $i - 1)]; ?> <br/>
										<span style="color:yellow">	Data Invio:	</span>	<?php echo $arrPosts[3][(($i==0) ? 0 : $i - 1)]; ?><br/><br/>
										<?php echo $arrPosts[0][(($i==0) ? 0 : $i - 1)]; ?><br/>
									</span>
				<?php
									$first = true;
								}
								$v = $i;
								do{
									if($arrPosts[2][$i] == $arrPosts[2][$v]){
				?>
											<span style="color:white"><br/><br/>
												<span style="color:yellow">	User:	</span> 	<?php echo $arrPosts[1][$v]; ?> <br/>
												<span style="color:yellow">	Data Invio:	</span>	<?php echo $arrPosts[3][$v]; ?><br/><br/>
												<?php echo $arrPosts[0][$v]; ?> <br/>
											</span>
											
					<?php
										$v++;
									}
									else{
										break;
									}
								} while($v < count($arrPosts[2]));
								$i = (($v==0) ? 0 : $v - 1);
				?>
										<br/><br/>
										<form action="options.php" method="POST">									
											<textarea maxlength=1000 style="width:80%;height:100px;border-radius:5px;" name="posttext" ></textarea>
											<input id="optionsSubmitButton" style="position:absolute;right:1%;border:1px solid #0F0;"  type="SUBMIT" name="answerpost" value="Rispondi" /> <br/>
										</form>
									</div>
								<?php
								$maxposts++;
							}						
						}
					}
					else{
						echo "<br/><br/>Nessun Post Da Visualizzare <br/><br/><br/><br/><br/>";
					}
				?>
			</div>
			<div style="position:absolute;top:1%;left:3%;right:3%;bottom:85%;background-color:#F30;border-radius:25px;" >
				<?php
					if(isset($_SESSION['Message'])){
				?>
					<span style="position:absolute;top:65px;left:5%;color:white;"> <?php echo $_SESSION['Message']; ?> </span>
				<?php
						unset($_SESSION['Message']);
					}
				?>
				<img src="<?php echo get_user_profile_picture($_SESSION['username']); ?>" style="position:absolute;left:85%;width:150px;height:150px;border-radius:25px;z-index:1;border:1px solid white;" />
				<p style="position:absolute;right:18%;top:3%;color:#22F;"> <?php echo $_SESSION['username']; ?> </p>
				<form action="ByeBye.php" method="get" >
					<input style="position:absolute;right:18%;top:50%;background-color:black;border-radius:5px;color:yellow;border:2px solid yellow;width:75px;height:30px;" type="SUBMIT" value="Logout" />
				</form>
				<button style="position:absolute;left:5%;top:10%;background:none;border:none;color:#22F;" onmouseover="buildMenu(0)"> Config </button>
				<div id="menu0" style="z-index:1;border-radius:25px;position:absolute;left:5%;top:10%;width:100px;height:300px;background-color:#000" onmouseleave="noMenu(0)"> 
					<center> <br/> <br/>
					<button id="menuButton" onclick="buildOption(1)"> Cambia Password </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(2)"> Carica/Cambia Immagine </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(3)"> Cambia Email </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(4)"> Cambia Domanda Segreta </button> <br/> <br/>
					</center>
				</div>
				<div class="dropdownmenu1" id="dropdownmenu1" style="position:relative;"> </div>
				<button style="position:absolute;left:15%;top:10%;background:none;border:none;color:#22F;" onmouseover="buildMenu(1)" > Followers </button>
				<div id="menu1" style="z-index:1;border-radius:25px;position:absolute;left:15%;top:10%;width:100px;height:300px;background-color:#000" onmouseleave="noMenu(1)"> 
					<center> <br/> <br/>
					<button id="menuButton" onclick="buildOption(5)"> Cerca Utente </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(6)"> Aggiungi Utente </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(7)"> Elimina Follower </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(10)"> S/Blocca Utente	</button> <br/> <br/>
					</center>
				</div>
				<div class="dropdownmenu1" id="dropdownmenu1" style="position:relative;"> </div>
				<button style="position:absolute;left:25%;top:10%;background:none;border:none;color:#22F;" onmouseover="buildMenu(2)" > Messaggi </button>
				<div id="menu2" style="z-index:1;border-radius:25px;position:absolute;left:25%;top:10%;width:100px;height:300px;background-color:#000" onmouseleave="noMenu(2)"> 
					<center> <br/> <br/>
					<button id="menuButton" onclick="buildOption(8)"> Invia Nuovo Messaggio </button> <br/> <br/>
					<button id="menuButton"	onclick="buildOption(9)" > Leggi Messaggi </button> <br/> <br/>
					<button id="menuButton" onclick="buildOption(9)"> Elimina Messaggi </button> <br/> <br/>
					</center>
				</div>
				<div class="dropdownmenu1" id="dropdownmenu1" style="position:relative;"> </div>
				<button style="position:absolute;left:35%;top:10%;background:none;border:none;color:#22F;" onmouseover="buildMenu(3)" > Profilo </button>
				<div id="menu3" style="z-index:1;border-radius:25px;position:absolute;left:35%;top:10%;width:100px;height:300px;background-color:#000" onmouseleave="noMenu(3)">
					<center> <br/> <br/>
					<button id="menuButton" onclick="buildOption(11)"> Info Profilo </button> <br/> <br/>
					<button id="menuButton"	onclick="buildOption(12)" > Album Immagini </button> <br/> <br/>
					<button id="menuButton"	onclick="buildOption(13)" > Tuoi Followers </button> <br/> <br/>
					</center>
				</div>
			</div>
			<div style="border-radius:15px;position:absolute;top:18%;left:60%;width:30%;;height:76%;background-color:#925;">
				<!-- Cambia Password -->
				<div class="divOptions" id="opt1" >
					<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Cambia Password </p>
					<form style="position:absolute;left:3%;" action="options.php" method="POST">
						Vecchia Password: <input type="password" name="oldpass" required /><br/> <br/>
						Nuova Password: <input type="password" name="newpass" required /> <br/>  <br/>
						Repeat Password: <input type="password" name="passconfirm" required /> <br/> <br/>
						<input id="optionsSubmitButton" type="SUBMIT" value="INVIA" name="changepass" />
					</form>
					</center>
				</div>
				<!-- Cambia Immagine -->
				<div class="divOptions" id="opt2" >
					<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;"> Cambia Immagine </span>
					<br/> <br/>
					<form style="position:absolute; left:5%;" enctype="multipart/form-data" action ="options.php" method="POST">
						<span style="color:#FFF"> Foto Profilo? </span>
						<input type="radio" name="profile" value="y" required> yes
						<input type="radio" name="profile" value="n" required> no <br/> <br/>
						<span style="color:#FFF"> Nome Immagine: </span>
						<input type="text" name="imgname" placeholder="Nome Dell'Immagine" /> <br/> <br/>
						<span style="color:#FFF"> Messaggio Nell'Immagine: </span>
						<span style="color:#000;" onclick="show_img_textarea()"> Click Here </span> <br/> <br/> 
						<input style="border:none;background-color:black;color:white;" type="file" name="image" required/> <br/> <br/>
						<input id="optionsSubmitButton" type="submit" value="UPLOAD" name="changepicture"/> <br/> <br/>
						<textarea maxlength=500 id="textAreaImgMex" style="width:250px;height:100px" name="imgtext" onmouseleave="hide_img_textarea()">Testo Messaggio Immagine</textarea>
					</form>
					</center>
				</div>
				<!-- Cambia Email -->
				<div class="divOptions" id="opt3" >
					<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Cambia E-Mail </p>
					<form action="options.php" method="POST">
						Vecchia Email: <input type="MAIL" name="oldmail" required /> <br/> <br/>
						Nuova Email: <input type="MAIL" name="newmail" required /> <br/> <br/>
						<input id="optionsSubmitButton" type="SUBMIT" value="INVIA" name="changemail" />
					</form>
					</center>
				</div>
				<!-- Cambia Domanda Segreta -->
				<div class="divOptions" id="opt4" >
					<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;"> Cambia Domanda Segreta </span> <br/><br/>
					<form action="options.php" method="POST">
						Password: <input type="password" name="passquestion" placeholder="Inserisci Password" /> <br/><br/>
						Seleziona Una Domanda:
						<SELECT NAME="secret_question" required>
							<option VALUE="q1"> Nome Del Tuo Animale Domestico </option>
							<option VALUE="q2"> Nome Del Tuo Libro Preferito </option>
							<option VALUE="q3"> Data Dell'Evento Pi&ugrave Importante Della Tua Vita </option>
							<option VALUE="q4"> Nome Della Tua Canzone Preferita </option>
							<option VALUE="q5"> Un Codice PIN Alfanumerico Segreto </option>
							<option VALUE="q6"> Nome Del Tuo Film Preferito </option>
						</SELECT> <br/> <br/>
						Risposta: <input type="text" name="secretanswer" maxlength=50 required /> <br/> <br/>
						<input id="optionsSubmitButton" type="SUBMIT" value="INVIA" name="changequestion" />
					</form>
					</center>
				</div>
				<!-- Cerca Utente -->
				<div class="divOptions" id="opt5" >
					<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Cerca Un Utente </p>
					<form action="search.php" method="POST">
						Pattern Di Ricerca: 
						<input type="text" name="srcuser" required/> <br/> <br/>
						<input id="optionsSubmitButton" type="SUBMIT" value="CERCA" name="searchuser" />
					</form>
					</center>
				</div>
				<!-- Aggiungi Utente -->
				<div class="divOptions" id="opt6" >
					<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Be A Follower! </p>
					<form action="options.php" method="POST">
						Nome Utente: 
						<input type="text" name="fllwuser" required /> <br/> <br/>
						<input id="optionsSubmitButton" type="SUBMIT" value="INVIA" name="followuser" /> 
					</form>
					</center>
				</div>
				<!-- Elimina Follower -->
				<div class="divOptions" id="opt7" >
					<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Stop Follow... </p>
					<form action="options.php" method="POST">
						Seleziona Utente: 	
						<SELECT ID="fllwrList" NAME="fllwrList" placeholder="Persone Che Segui">
							<option value=""> ////////// </option>
							<?php
								$arr = get_followers($_SESSION['username']);
								foreach($arr as $v){
									echo "<option value=\"$v\">$v</option>";
								}
							?>
						</SELECT> <br/> <br/>
						<input id="optionsSubmitButton" type="SUBMIT" name="delFllw" value="Elimina Follower" />
					</form>
					</center>
				</div>
				<!-- Invia Messaggio -->
				<div class="divOptions" id="opt8" >
					<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;">Invia Nuovo Messaggio</span> <br/><br/>
					<form action="options.php" method="POST">
						Nome Utente: 
						<input type="text" name="usersendmex" /><br/><br/>
						<TEXTAREA NAME="messagetext" style="width:250px;height:100px;"></TEXTAREA><br/><br/>
						<input type="SUBMIT" id="optionsSubmitButton" name="sendnewmex" value="INVIA" />
					</form>
					</center>
				</div>
				<!-- Leggi Messaggi --> <!-- Elimina Messaggi -->
				<div style="border-radius:15px;position:absolute;top:5%;left:5%;right:5%;background-color:#48A;" id="opt9" >
					<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;">Lista Messaggi Ricevuti</p>
					<form action="options.php" method="POST">
						Lista Messaggi:
						<SELECT ID="mexslist" name="mexslists" >
						<option value="null"></option>>
							<?php
								$arrMex = get_mex($_SESSION['username']);
								$parsed = Array();
								$n = 0;
								for($i=0;$i<count($arrMex[1]);$i++){
									if(!in_array($arrMex[1][$i],$parsed)){
										$n++;
										array_push($parsed,$arrMex[1][$i]);
										// IDMexGroup = $arrMex[1][$i];
										echo "<option value=\"".$arrMex[1][$i]."\">IDMex:".$n." | ".(($arrMex[3][$i]==$_SESSION['username']) ? "Tu " : $arrMex[3][$i])." -> ".(($arrMex[2][$i]==$_SESSION['username']) ? "Tu " : $arrMex[2][$i])."</option>";
									}
									else{
										continue;
									}
								}
							?>
						</SELECT> <br/> <br/>
						Testo Messaggio Di Risposta<br/>
						<TEXTAREA NAME="messagetext" style="width:250px;height:100px;"></TEXTAREA><br/><br/>
						<input type="SUBMIT" id="optionsSubmitButton" name="delmex" value="ELIMINA GRUPPO MESSAGGI" />
						<input type="SUBMIT" id="optionsSubmitButton" name="sendanswermex" value="RISPONDI" />
					</form>
					<button id="viewMex" style="border:none;background-color:black;color:white;border-radius: 15px;" value="VISUALIZZA" onclick="view_mex()" > VISUALIZZA </button> <br/> <br/>
					</center>
				</div>
				<!-- Blocca/Sblocca Utenti -->
				<div class="divOptions" id="opt10" >
				<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Blocca/Sblocca Utente </p>
					<form action="options.php" method="POST">
						Utenti Bloccati:	
						<SELECT ID="blckdlist" NAME="blockedlist" placeholder="Utenti Bloccati">
							<option value=""> ////////// </option>
							<?php
								$arr = get_lockeds($_SESSION['username']);
								foreach($arr as $v){
									echo "<option value=\"$v\">$v</option>";
								}
							?>
						</SELECT> <br/> <br/>
						Blocca Utente: 
						<input type="text" name="lockuser" placeholder="Nome Utente" /> <br/> <br/> <br/>
						<input type="SUBMIT" id="optionsSubmitButton" name="lock" value="BLOCCA" />
						<input type="SUBMIT" id="optionsSubmitButton" name="block" value="SBLOCCA" />
					</form>
				</center>
				</div>
				<!-- Mostra Info Profilo -->
				<div class="divOptions" id="opt11" >
				<center> <br/> <p style="color:#FFF;font-family:Arial;font-size:20px;"> Info Profilo </p>
					<?php
						$arr = get_info_user($_SESSION['username']);
					?>
						<span style="color:#FFF">
					<?php
						echo "Username:    " . $arr['username'] . "<br/>";
						echo "Email:    " . $arr['email'] . "<br/>";
						echo "Nome:    " . $arr['first_name'] . "<br/>";
						echo "Cognome:    " . $arr['last_name'] . "<br/>";
						echo "Data Di Nascita:    " . $arr['birth_date'] . "<br/>";
						echo "Sesso:    " . $arr['sex'] . "<br/>";
						echo "Data Registrazione:    " . $arr['registrazione'] . "<br/>";
						echo "Ultimo Accesso:    " . $arr['lastlog'] . "<br/>";
					?>
						</span>
				</center>
				</div>
				<!-- Mostra Immagini -->
				<div class="divOptions" id="opt12" >
				<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;"> Album Immagini </span>
						<select id="selectimg" name="select_img" onchange="view_img()" >
						<option value="null"></option>
						<?php
							$arrImg = get_user_imgs($_SESSION['username']);
							for($i=0;$i<count($arrImg[1]);$i++){
									echo "<option value=\"$i\">".$arrImg[1][$i]."</option>";
								}
						?>
						</select>
				</center>
				</div>
				<!-- Mostra User Followers -->
				<div class="divOptions" id="opt13" >
				<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;"> I Tuoi Followers </span>
					<br/><br/><br/>
						<SELECT ID="fllwrList" NAME="fllwrList" placeholder="Persone Che Segui">
							<option value=""> ////////// </option>
							<?php
								$arr = get_user_followers($_SESSION['username']);
								foreach($arr as $v){
									echo "<option value=\"$v\">$v</option>";
								}
							?>
						</SELECT>
				</center>
				</div>
			</div>
			<span style="color:white;">
			<div id="imgcontainer" style="border:3px solid white;border-radius:5px;position:absolute;top:15%;left:5%;bottom:5%;width:50%;background-color:#000;height:100%;" onmouseleave="hide_img_container()">				
			</div>
			</span>
			<span style="color:white;">
			<div id="mexcontainer" style="border-radius:5px;position:absolute;top:15%;left:5%;width:52%;background-color:#000;height:500%;" onmouseleave="hide_mex_container()">				
			</div>
			</span>
		</body>
	</html>
	<?php
	}
?>

<script type="text/javascript">
	
	function view_img(){
		var img_links = [<?php for($n=0;$n<count($arrImg[0]);$n++){ echo (($n!=(count($arrImg[0])-1)) ? "\"".$arrImg[0][$n]."\"," : "\"".$arrImg[0][$n]."\"");}?>];
		var img_names = [<?php for($n=0;$n<count($arrImg[1]);$n++){ echo (($n!=(count($arrImg[1])-1)) ? "\"".$arrImg[1][$n]."\"," : "\"".$arrImg[1][$n]."\"");}?>];
		var img_mex = [<?php for($n=0;$n<count($arrImg[2]);$n++){ echo (($n!=(count($arrImg[2])-1)) ? "\"".$arrImg[2][$n]."\"," : "\"".$arrImg[2][$n]."\"");}?>];
		var img_upload = [<?php for($n=0;$n<count($arrImg[3]);$n++){ echo (($n!=(count($arrImg[3])-1)) ? "\"".$arrImg[3][$n]."\"," : "\"".$arrImg[3][$n]."\"");}?>];
		if(document.getElementById("selectimg").value!="null"){
			var imgcont = document.getElementById("imgcontainer");
			imgcont.style.visibility="visible";
			imgcont.innerHTML = "<br/><br/><br/><font color=yellow>Name:</font> " + img_names[document.getElementById("selectimg").value] +"<br/><font color=yellow>Testo:</font> " + img_mex[document.getElementById("selectimg").value] + "<br/><font color=yellow>Upload:</font> " + img_upload[document.getElementById("selectimg").value] + "<br/><br/><img style=\"border-radius:15px;width:100%;height:50%;\" src=\""+img_links[document.getElementById("selectimg").value]+"\" />";
		}
	}
	
	function view_mex(){
		var urname = "<?php echo $_SESSION['username']; ?>";
		var mex_date = [<?php for($n=0;$n<count($arrMex[4]);$n++){ echo (($n!=(count($arrMex[4])-1)) ? "\"".$arrMex[4][$n]."\"," : "\"".$arrMex[4][$n]."\"");}?>];
		var mex_group = [<?php for($n=0;$n<count($arrMex[1]);$n++){ echo (($n!=(count($arrMex[1])-1)) ? "\"".$arrMex[1][$n]."\"," : "\"".$arrMex[1][$n]."\"");}?>];
		var mex_text =[<?php for($n=0;$n<count($arrMex[0]);$n++){ echo (($n!=(count($arrMex[0])-1)) ? "\"".$arrMex[0][$n]."\"," : "\"".$arrMex[0][$n]."\"");}?>];
		var mex_mitt =[<?php for($n=0;$n<count($arrMex[3]);$n++){ echo (($n!=(count($arrMex[3])-1)) ? "\"".$arrMex[3][$n]."\"," : "\"".$arrMex[3][$n]."\"");}?>];
		if(document.getElementById("mexslist").value!="null"){
			var mexcont = document.getElementById("mexcontainer");
			mexcont.style.visibility="visible";
			var mex_list = [];
			var mex_mitts = [];
			var mex_dates = [];
			var group = document.getElementById("mexslist").value;
			for(var i=0;i<mex_group.length;i++){
				if(group == mex_group[i]){
					mex_list.push(mex_text[i]);
					mex_mitts.push(mex_mitt[i]);
					mex_dates.push(mex_date[i]);
				}				
			}
			mexcont.innerHTML = "<br/><br/>";
			for(var i=0; i<mex_list.length; i++){
				mexcont.innerHTML += "<div style=\"border:2px solid #0F0;width:100%;\">[ "+(i+1)+" ]<br/><span style=\"position:relative;left:5px;\"><font color=yellow>Mittente:</font> " + ((mex_mitts[i]==urname) ? "Tu" : mex_mitts[i]) +"<br/><font color=yellow>Data Invio:</font> "+ mex_dates[i] + "<br/><br/>" + mex_list[i] + "<br/><br/></span></div>";
			}
		}
	}

	function buildMenu(n){
		hideAll(n,0);
		var menu = document.getElementById("menu" + n.toString());
		menu.style.visibility = 'visible';
	}
	
	
	function noMenu(n){
		var menu = document.getElementById("menu" + n.toString());
		menu.style.visibility = 'hidden';
	}
	
	
	function buildOption(n){
		hideAll(n,1);
		var opt = document.getElementById("opt" + n.toString());
		opt.style.visibility = 'visible';
	}
	
	
	function hideAll(n,z){	
		for(var i=0;i<=3;i++){
			if(n == i){
				continue;
			}
			var menu = document.getElementById("menu" + i.toString());
			menu.style.visibility = 'hidden';
		}
		if(z == 1){
			for(var i=1;i<=13;i++){
				if(n == i){
					continue;
				}
				var opt = document.getElementById("opt" + i.toString());
				opt.style.visibility = 'hidden';
			}
		}
		hide_img_textarea();
	}
	
	function show_img_textarea(){
		var textarea = document.getElementById("textAreaImgMex");
		textarea.style.visibility="visible";
	}
	
	function hide_img_textarea(){
		var textarea = document.getElementById("textAreaImgMex");
		textarea.style.visibility="hidden";
	}
	
	function hide_img_container(){
		var imgcont = document.getElementById("imgcontainer");
		imgcont.style.visibility="hidden";
	}
	
	function hide_mex_container(){
		var imgcont = document.getElementById("mexcontainer");
		imgcont.style.visibility="hidden";
	}
	
	function hide_post_textarea(){
		var textarea = document.getElementById("PostTextArea");
		textarea.style.visibility="hidden";
	}
	
	function show_post_textarea(){
		var textarea = document.getElementById("PostTextArea");
		textarea.style.visibility="visible";
	}
	
<?php
	if($arrPosts){
?>
	function hide_posts(){
		var maxposts = <?php if(isset($maxposts)){ echo $maxposts; } else { echo false; } ?>;
		if(maxposts){
			for(var i=0; i<=maxposts; i++){
				try{
					var postgroup = document.getElementById("postgroup"+i);
					postgroup.style.visibility="hidden";
				} 
				catch(Exception){}
			}
		}		
	}
	

	function show_post(n){
		var postgroup = document.getElementById("postgroup"+n);
		postgroup.style.visibility="visible";
		var postop = document.getElementById("postgroup"+n+"D").offsetTop;
		var height = document.getElementById("postgroup"+n+"D").offsetHeight;
		var pos = postop + height;
		pos = pos.toString();
		postgroup.style.top = pos + "px";
		var str = postop.toString() + "-" + height.toString();
		hide_other_posts(n);
	}
	
<?php
	}
?>
	
</script>