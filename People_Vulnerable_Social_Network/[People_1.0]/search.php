<?php
	session_start();
	include("db_functions.php");
	if(!isset($_SESSION['username'])){
		header("location: 404.html");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Risultati Ricerca </title>
		<style>
			#tbl{
				width:500px;
				color:white;
			}
		</style>
	</head>
	<body style="background-color:black;">
		<div style="position:absolute;top:1%;bottom:80%;right:2%;left:2%;background-color:yellow;border-radius:50px;">
			<center> <br/>
				<h1 style="color:#57F;"> <<~ PeoPle ~>> </h1> 
			</center>
		</div>
		<center> <br/><br/><br/><br/>
		<span style="color:white;"> Pattern Di Ricerca:
			<?php
				echo $_POST['srcuser'];
			?>
		</span> <br/> <br/>
<?php
	if(isset($_POST['searchuser'])){
		$usersId = search_pattern($_POST['srcuser']);
		$usersInfo = array();
		$usersPictures = array();
		if($usersId){
			foreach($usersId as $v){
				array_push($usersInfo,get_info_user(get_name_from_id($v)));
				array_push($usersPictures,get_user_profile_picture(get_name_from_id($v)));
			}
?>
			<div style="position:absolute; top:22%; right:15%;height:100%;left:15%; background-color:#57F; border-radius:15px;">
				<span style="color:white;font-size:20px;"> Risultati: </span> <br/> <br/> </center>
				<span style="font-size:15px;position:absolute;top:20%;left:20%;"> <br/><br/>
				<table>
					<?php
						echo "<tr><td style=\"color:yellow;\">Username</td><td style=\"color:yellow;\">Name</td><td style=\"color:yellow;\">Surname</td><td style=\"color:yellow;\">Img</td></tr><tr><td><br/></td><td><br/></td></tr>"; 
						for($i=0;$i<count($usersInfo);$i++){
							echo "<tr><td id=\"tbl\"><a style=\"color:black;\" href=\"otheruser.php?username=".$usersInfo[$i]['username']."\" >".$usersInfo[$i]['username'] ."</a></td><td id=\"tbl\">" . $usersInfo[$i]['first_name'] . "</td><td id=\"tbl\">" . $usersInfo[$i]['last_name'] . "</td><td id=\"tbl\"><a href=\"otheruser.php?username=".$usersInfo[$i]['username']."\" ><img style=\"border:1px solid white;width:100px;height:100px;border-radius:25px;z-index:1;\" src=\"".$usersPictures[$i]."\" /></a> </td> </tr>";
						}
					?>
				</table>
				</span>
			</div>
<?php
		}
		else{
?>	
			<br/><br/><br/>
			<span style="color:#F00;font-size:25px;"> Nessun Risultato Trovato </span>
			</center>
<?php				
		}
	}
	else{
		$_SESSION['Message'] = "Prego Settare Tutti I Campi";
			header("location: userpage.php");
	}
?>
	</body>
</html>