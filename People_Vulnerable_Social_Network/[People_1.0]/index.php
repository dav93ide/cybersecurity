<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			.-* LogIn *-.
		</title>
		<link href="MoreStyle.css" rel="stylesheet" type="text/css">
	</head>
	<body onload="makeSelects()">
		<div style="position:absolute;top:1%;bottom:80%;right:2%;left:2%;background-color:black;border-radius:50px;">
			<center> <br/>
				<h1 style="color:#57F;"> &lt;&lt;~ PeoPle ~>> </h1> 
			</center>
		</div>
		<div style="position:absolute; top:22%; bottom:1%; right:2%; left:2%; background-color:black; border-radius:50px;">
			<div style="position:absolute;top:15%;bottom:15%;right:15%;left:15%;background-color:#55F;border-radius:25px;color:white;">
				<?php
					if(!isset($_GET['reg'])){
				?>	
						<center>
							<h1 style="color:#FFF;font-family:Arial;"> Welcome! </h1>
							Benvenuti Nel Nostro Social Network! <br/> <br/>
							Non Sei Ancora Iscritto? Cosa Aspetti Aggiungiti Subito Alla Nostra Community! <br/> <br/> <br/>
							<button style="border:none;background:none;color:yellow;font-size:30px;" id="voidButton" onclick="location.href='index.php?reg=true'"> Registrati Subito </button> <br/> <br/> <br/> <br/>
							<?php
								if(isset($_SESSION['Message'])){
									echo $_SESSION['Message'];
									unset($_SESSION['Message']);
								}
							?>
						</center>
				<?php
					} else{
				?>
						<form name="form01" action="check.php" method="POST">
							<br/> 
							<span style="position:absolute; right:60%; color:white;" > Username: </span>
							<input style="border-radius:25px; position:absolute; left:45%;" maxlength=30 type="text" name="reguser" placeholder="Insert Username" required /> <br/><br/>
							<span style="position:absolute; right:60%; color:white;" > Password (Min 6): </span>
							<input style="border-radius:25px; position:absolute; left:45%;" type="password" name="regpass" placeholder="Insert Password" required /> <br/><br/>
							<span style="position:absolute; right:60%; color:white;" > E-Mail: </span>
							<input style="border-radius:25px; position:absolute; left:45%;" maxlength=50 type="EMAIL" name="regmail" placeholder="Insert Email" required /> <br/><br/>
							<span style="position:absolute; right:60%; color:white;" > First Name: </span>
							<input style="border-radius:25px; position:absolute; left:45%;" maxlength=30 type="text" name="regname" placeholder="First Name" required /> <br/><br/>
							<span style="position:absolute; right:60%; color:white;" > Last Name: </span>
							<input style="border-radius:25px; position:absolute; left:45%;" maxlength=30 type="text" name="regsurname" placeholder="Last Name" required /> <br/><br/>
							<span style="position:absolute; right:60%; color:white;" > Sesso: </span>
							<input style="border-radius:25px; position:absolute; left:45%;" type="RADIO" name="sex" value="m" required /> <span style="position:absolute; left:48%;color:black;" > Maschio </span>
							<input style="border-radius:25px; position:absolute; left:55%;" type="RADIO" name="sex" value="f" required /> <span style="position:absolute; left:58%;color:black;" > Femmina </span> <br/><br/>
							<span style="position:absolute; right:60%; color:white;" > Data Di Nascita (dd/mm/yyyy): </span>
							<SELECT style="border-radius:25px; position:absolute; left:45%;" NAME="day" >
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</SELECT>
							<SELECT style="border-radius:25px; position:absolute; left:55%;" NAME="month" onchange="change_day()">
								<option value="01">01</option>
								<option value="02">02</option>
								<option value="03">03</option>
								<option value="04">04</option>
								<option value="05">05</option>
								<option value="06">06</option>
								<option value="07">07</option>
								<option value="08">08</option>
								<option value="09">09</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</SELECT>
							<SELECT style="border-radius:25px; position:absolute; left:65%;" NAME="year" onchange="change_day()">
								<option value="1900">1900</option>
								<option value="1901">1901</option>
								<option value="1902">1902</option>
								<option value="1903">1903</option>
								<option value="1904">1904</option>
								<option value="1905">1905</option>
								<option value="1906">1906</option>
								<option value="1907">1907</option>
								<option value="1908">1908</option>
								<option value="1909">1909</option>
								<option value="1910">1910</option>
								<option value="1911">1911</option>
								<option value="1912">1912</option>
								<option value="1913">1913</option>
								<option value="1914">1914</option>
								<option value="1915">1915</option>
								<option value="1916">1916</option>
								<option value="1917">1917</option>
								<option value="1918">1918</option>
								<option value="1919">1919</option>
								<option value="1920">1920</option>
								<option value="1921">1921</option>
								<option value="1922">1922</option>
								<option value="1923">1923</option>
								<option value="1924">1924</option>
								<option value="1925">1925</option>
								<option value="1926">1926</option>
								<option value="1927">1927</option>
								<option value="1928">1928</option>
								<option value="1929">1929</option>
								<option value="1930">1930</option>
								<option value="1931">1931</option>
								<option value="1932">1932</option>
								<option value="1933">1933</option>
								<option value="1934">1934</option>
								<option value="1935">1935</option>
								<option value="1936">1936</option>
								<option value="1937">1937</option>
								<option value="1938">1938</option>
								<option value="1939">1939</option>
								<option value="1940">1940</option>
								<option value="1941">1941</option>
								<option value="1942">1942</option>
								<option value="1943">1943</option>
								<option value="1944">1944</option>
								<option value="1945">1945</option>
								<option value="1946">1946</option>
								<option value="1947">1947</option>
								<option value="1948">1948</option>
								<option value="1949">1949</option>
								<option value="1950">1950</option>
								<option value="1951">1951</option>
								<option value="1952">1952</option>
								<option value="1953">1953</option>
								<option value="1954">1954</option>
								<option value="1955">1955</option>
								<option value="1956">1956</option>
								<option value="1957">1957</option>
								<option value="1958">1958</option>
								<option value="1959">1959</option>
								<option value="1960">1960</option>
								<option value="1961">1961</option>
								<option value="1962">1962</option>
								<option value="1963">1963</option>
								<option value="1964">1964</option>
								<option value="1965">1965</option>
								<option value="1966">1966</option>
								<option value="1967">1967</option>
								<option value="1968">1968</option>
								<option value="1969">1969</option>
								<option value="1970">1970</option>
								<option value="1971">1971</option>
								<option value="1972">1972</option>
								<option value="1973">1973</option>
								<option value="1974">1974</option>
								<option value="1975">1975</option>
								<option value="1976">1976</option>
								<option value="1977">1977</option>
								<option value="1978">1978</option>
								<option value="1979">1979</option>
								<option value="1980">1980</option>
								<option value="1981">1981</option>
								<option value="1982">1982</option>
								<option value="1983">1983</option>
								<option value="1984">1984</option>
								<option value="1985">1985</option>
								<option value="1986">1986</option>
								<option value="1987">1987</option>
								<option value="1988">1988</option>
								<option value="1989">1989</option>
								<option value="1990">1990</option>
								<option value="1991">1991</option>
								<option value="1992">1992</option>
								<option value="1993">1993</option>
								<option value="1994">1994</option>
								<option value="1995">1995</option>
								<option value="1996">1996</option>
								<option value="1997">1997</option>
								<option value="1998">1998</option>
								<option value="1999">1999</option>
								<option value="2000">2000</option>
								<option value="2001">2001</option>
								<option value="2002">2002</option>
								<option value="2003">2003</option>
								<option value="2004">2004</option>
								<option value="2005">2005</option>
								<option value="2006">2006</option>
								<option value="2007">2007</option>
								<option value="2008">2008</option>
								<option value="2009">2009</option>
								<option value="2010">2010</option>
								<option value="2011">2011</option>
								<option value="2012">2012</option>
								<option value="2013">2013</option>
								<option value="2014">2014</option>
								<option value="2015">2015</option>
								<option value="2016">2016</option>
							</SELECT>
							<br/> <br/>
							<SELECT style="border-radius:25px; position:absolute; left:5%;" name="secretquestion" required>
								<option VALUE="q1"> Nome Del Tuo Animale Domestico </option>
								<option VALUE="q2"> Nome Del Tuo Libro Preferito </option>
								<option VALUE="q3"> Data Dell'Evento Pi&ugrave Importante Della Tua Vita </option>
								<option VALUE="q4"> Nome Della Tua Canzone Preferita </option>
								<option VALUE="q5"> Un Codice PIN Alfanumerico Segreto </option>
								<option VALUE="q6"> Nome Del Tuo Film Preferito </option>
							</SELECT>
							<input style="border-radius:25px; position:absolute; right:5%; width:300px;" type="text" name="secretanswer" placeholder="Risposta Segreta" maxlength=50 required />
							<br/> <br/> <br/>
							<center>
								<input style="width:100px;height:50px;border-radius:25px;background-color:yellow;"type="SUBMIT" value="Iscriviti" name="reg" />
							</center>
						</form>
				<?php
					}
				?>
			</div>
		</div>
		<div style="position:absolute;top:25%;right:5%;left:50%;border-radius: 50px;">
			<form style="position:absolute;right:1%;" action="check.php" method="POST">
				<input type="text" placeholder="Insert Username" name="username" required />
				<input type="password" placeholder="Insert Password" name="password" required /><br/>
				<input style="position:absolute;right:0%;" type="SUBMIT" name="log" value="Accedi" />
			</form>
		</div>
	</body>
</html>

<script type="text/javascript">
	function change_day(){
		var value = document.form01.month.value;
		switch(value){
			case "01":
			case "03":
			case "05":
			case "07":
			case "08":
			case "10":
			case "12":
				document.form01.day.options.length = 28;
				document.form01.day.options[28] = new Option("29","29",false,false)
				document.form01.day.options[29] = new Option("30","30",false,false)
				document.form01.day.options[30] = new Option("31","31",false,false)
			break;
			case "02":
				if((document.form01.year.value % 4) == 0){
					document.form01.day.options.length = 29;
					document.form01.day.options[28] = new Option("29","29",false,false)
				}
				else{
					document.form01.day.options.length = 28;
				}				
			break;
			case "04":
			case "06":
			case "09":
			case "11":
				document.form01.day.options.length = 28;
				document.form01.day.options[28] = new Option("29","29",false,false)
				document.form01.day.options[29] = new Option("30","30",false,false)	
			break;
		}
	}
</script>