<?php
	require_once("userClass.php");  /* iterpiams reklaings fails (klase) kuriam yra useriai, be jo negaletumem naudot funkciju zemiau tokiu kaip $Users->get_user_pass(), nes sitam faile aprasyta yr visks */
?>
<!doctype html>
<html>
<head>
	<link href="style.css" rel="stylesheet"/> <!-- iterpiams stiliaus fails -->
</head>
<body>
	<div class="login">
		<h1>Prisijungimas</h1> <!-- heading 1 (didziausias) --> 
		<?php 
			
			if(isset($_POST["submit"])) { /* tikrinama ar paspaustas mygtukas submit turi reiksme, jei jo, tai ir kiti ivedimo laukai tures */
				
				if(!empty($_POST["email"]) && !empty($_POST["pass"])){ /* jei netuscias email ir slaptazodis, veiksmas vyksta */
					$email = $_POST["email"]; /* duomenys gauti is ivedimo laukelio pavadinimu email */
					$pass = $_POST["pass"]; /* duomenys gauti is ivedimo laukelio pavadinimu pass */
					
					if(password_verify($pass, $Users->get_user_pass($email))) { /* php funkcija, tikrinanti ar ivesto slaptazodzio hash tinka su issaugoto slaptazodzio */
						echo "<div class=\"alert\" id=\"success\">Prisijungta</div>";
					}
					else { /* priesingu atveju sitas vyksta */
						echo "<div class=\"alert\" id=\"error\">Neteisingi duomenys</div>"; /* echo tai tipo spausdint teksta */
					}
					
				}
				else {
					echo "<div class=\"alert\" id=\"error\">Neįvesti duomenys</div>";
				}
			}
		?>
		<form method="post" action="?">
			<input type="email" placeholder="Elektroninis paštas" name="email"/><br/>
			<input type="password" placeholder="Slaptažodis" name="pass"/><br/>
			<input type="submit" value="Prisijungti" name="submit"/>
		</form>
	</div>
</body>
</html>