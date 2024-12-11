<!DOCTYPE html>

<html>
	<head>
		<title>
			OtherUserpage
		</title>
		<link href="MoreStyle.css" rel="stylesheet" type="text/css">
	</head>
	<body style="background-color:black" onload="hideMenu();hideOptions();hide_img_container();hide_post_textarea();hide_posts();">
	
<?php
	session_start();
	if(isset($_GET['username']) AND isset($_SESSION['username'])){
		if($_GET['username'] == $_SESSION['username']){
			$_SESSION['Message'] = "Non Puoi Visitare La Tua Stessa Pagina Se Sei Loggato";
			header("location: userpage.php");
			$ret = true;
		}
		else{
			$username = $_GET['username'];
			?>
				<a href="userpage.php" style="position:absolute;left:1%;top:1%;color:yellow;" > R<br/>E<br/>T<br/>U<br/>R<br/>N </a>
			<?php
		}	
	}
	else{
		if(!isset($_SESSION['username'])){
			header("location: 404.html");
		}
		else{
			header("location: userpage.php");
		}
	}
	include("db_functions.php");
	if(!check_locked($username,$_SESSION['username'])){
?>
		<div style="position:absolute;top:18%;left:5%;right:45%;background-color:#22F;border-radius:5px;">
				<!-- BACHECA -->
				<center>
					<font style="color:#0F0;border:2px solid black;font-size:25px;background-color:black;" > Bacheca Utente </font>
				</center>
			<form style="position:absolute;top:1%;left:1%;" action="options.php" method="POST">
				<input id="optionsSubmitButton" type="SUBMIT" name="addpost" value="Aggiungi Post" onmouseover="show_post_textarea()"/> <br/>
				<textarea maxlength=1000 id="PostTextArea" style="width:250px;height:100px;border-radius:5px;" name="posttext" onmouseleave="hide_post_textarea()"></textarea>		
				<input type="hidden" value="<?php echo $username; ?>" name="otheruser" />
				<input type="hidden" value="otheruser.php?username=<?php echo $username;?>" name="returnlink" />
			</form>
			<?php
				$arrPosts = get_posts($username);
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
									<input type="hidden" value="<?php echo $username; ?>" name="otheruser" />
									<input type="hidden" value="otheruser.php?username=<?php echo $username;?>" name="returnlink" />
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
										
										<input type="hidden" value="<?php echo $username; ?>" name="otheruser" />
										<input type="hidden" value="otheruser.php?username=<?php echo $username;?>" name="returnlink" />
										<input type="hidden" value="<?php echo $arrPosts[2][$i]; ?>" name="postgroup" />
										
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
				if(check_follower($_SESSION['username'],$username)){
					$follower = true;
			?>
				<span style="position:absolute;top:3%;right:18%;color:white;"> Sei Un Follower Di Questo Utente </span>
			<?php
				}
				else{
					$follower = false;
			?>
				<span style="position:absolute;top:3%;right:18%;color:white;"> Non Sei Un Follower Di Questo Utente </span>
			<?php
				}
				if(isset($_SESSION['Message']) && !isset($ret)){
			?>
				<span style="position:absolute;top:75%;left:5%;color:white;"> <?php echo $_SESSION['Message']; ?> </span>
			<?php
					unset($_SESSION['Message']);
				}
			?>
			<img src="<?php echo get_user_profile_picture($username); ?>" style="position:absolute;left:85%;width:150px;height:150px;border-radius:25px;z-index:1;border:1px solid white;" />
			<p style="position:absolute;right:18%;top:3%;color:#22F;"> <?php echo $username; ?> </p>
			<?php
				if(isset($_SESSION['username'])){
					if($_SESSION['username'] != $username){
			?>	
			<button style="position:absolute;left:5%;top:10%;background:none;border:none;color:#22F;" onmouseover="buildMenu()"> Options </button>
			<div id="menu0" style="z-index:1;border-radius:25px;position:absolute;left:5%;top:10%;width:100px;height:300px;background-color:#000" onmouseleave="hideMenu()"> 
				<center> <br/> <br/>
					<form action="options.php" method="POST">
					<?php
						if(!$follower){
					?>
						<input type="SUBMIT" id="menuButton" name="followuser" value="Segui" /> <br/> <br/>
					<?php
						} else {
					?>
						<input type="SUBMIT" id="menuButton" name="delFllw" value="Non Seguire" /> <br/> <br/>
					<?php
						}
					?>
						<input type="hidden" name="fllwuser" value="<?php echo $username;?>"/>
						<?php
							if(!check_locked($_SESSION['username'],$username)){
						?>
						<input type="SUBMIT" id="menuButton" name="lock" value="Blocca" /> <br/><br/>
						<?php
							}
							else{
						?>
						<input type="SUBMIT" name="block" id="menuButton" value="Sblocca"/> <br/><br/>
						<?php
							}
						?>
						<input type="hidden" name="fllwrList" value="<?php echo $username;?>"/>
						<input type="hidden" name="lockuser" value="<?php echo $username;?>"/>
						<input type="hidden" name="returnlink" value="otheruser.php?username=<?php echo $username;?>" />
					</form>
					<button id="menuButton" onclick="hideOptions();buildOption(1)" > Invia Messaggio </button> <br/> <br/>
					<button id="menuButton" onclick="hideOptions();buildOption(2)"> Vedi Album </button> <br/> <br/>
				</center>
			</div>
			<?php
					}
				}
			?>
		</div>
		<?php
			if(isset($_SESSION['username'])){
				if($_SESSION['username'] != $username){
		?>	
		<div style="border-radius:15px;position:absolute;top:18%;left:60%;width:30%;;height:76%;background-color:#925;">
			<div class="divOptions" id="opt1" >
				<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;">Invia Nuovo Messaggio</span> <br/><br/>
				<form action="options.php" method="POST">
					Nome Utente: <?php echo $username;?>
					<input type="hidden" name="usersendmex" value="<?php echo $username;?>" /><br/><br/>
					<TEXTAREA NAME="messagetext" style="width:250px;height:100px;"></TEXTAREA><br/><br/>
					<input type="SUBMIT" id="optionsSubmitButton" name="sendnewmex" value="INVIA" />
					<input type="hidden" name="returnlink" value="otheruser.php?username=<?php echo $username;?>"/>
				</form>
				</center>
			</div>
			<div class="divOptions" id="opt2" >
				<center> <br/> <span style="color:#FFF;font-family:Arial;font-size:20px;"> Album Immagini </span>
					<?php
						if(check_follower($_SESSION['username'],$username)){
					?>
					<select id="selectimg" name="select_img" onchange="view_img()" >
					<option value="null"></option>
					<?php
						$arrImg = get_user_imgs($username);
						for($i=0;$i<count($arrImg[1]);$i++){
								echo "<option value=\"$i\">".$arrImg[1][$i]."</option>";
							}
					?>
					</select>
					<?php
						}
						else{
							echo "<br/><br/>Non Puoi Vedere Le Immagini Se Prima Non Segui Questo Utente!";
						}
					?>
				</center>
			</div>
			<?php
					}
				}
			?>
		</div>
		<span style="color:white;">
			<div id="imgcontainer" style="border:3px solid white;border-radius:5px;position:absolute;top:18%;left:5%;width:50%;background-color:#000;height:100%;" onmouseleave="hide_img_container()">				
			</div>
		</span>
	</body>
</html>
<script type="text/javascript">
	<?php
		if(check_follower($_SESSION['username'],$username)){
	?>
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
	<?php
		}
	?>
	
	function buildMenu(){
		var menu = document.getElementById("menu0");
		menu.style.visibility = 'visible';
	}
	
	function hideMenu(){
		var menu = document.getElementById("menu0");
		menu.style.visibility = 'hidden';
	}
	
	function hideOptions(){
		for(var i=1;i<=2;i++){
			var opt = document.getElementById("opt" + i.toString());
			opt.style.visibility = 'hidden';
		}
	}
	
	function buildOption(n){
		var opt = document.getElementById("opt" + n.toString());
		opt.style.visibility = 'visible';
	}
	
	function hide_img_container(){
		var imgcont = document.getElementById("imgcontainer");
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

<?php
	}
	else{
?>	
	<center>
	<span style="color:#0F0;"> Sorry Dude <br/></span>
	<span style="color:yellow;"> This User Has Blocked You ): </span>
	</center>
	</body>
</html>
<?php
	}
?>