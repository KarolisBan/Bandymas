<?php	
	require_once("header.php");
	require_once("config/database.php");
	require_once("user.php");
?>
<!doctype html>
<html>
<head>
	<link href="style.css?t=<?php echo time(); ?>" rel="stylesheet"/> <!-- iterpiams stiliaus fails -->
</head>
<body>
	<div class="login">
	
		<?php if(!$logged) { ?>
		
		<h1>Prisijungimas</h1> <!-- heading 1 (didziausias) --> 
		<?php 
			
			if(isset($_POST["submit"])) { /* tikrinama ar paspaustas mygtukas submit turi reiksme, jei jo, tai ir kiti ivedimo laukai tures */
				
				if(!empty($_POST["email"]) && !empty($_POST["pass"])){ /* jei netuscias email ir slaptazodis, veiksmas vyksta */
					
					$user = $Users->GetBy("email", $_POST["email"]);
					
					if($user && password_verify($_POST["pass"], $user->pass)) { /* php funkcija, tikrinanti ar ivesto slaptazodzio hash tinka su issaugoto slaptazodzio */
						echo "<div class=\"alert\" id=\"success\">Prisijungta</div>";
						
						$_SESSION["login"] = array();
						$_SESSION["login"]["email"] = $_POST["email"];
						$_SESSION["login"]["pass"] = $_POST["pass"];
						
						header("Location: index.php");
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
		
		<?php } else { ?>
			
			<?php if($ID == "") { ?>
				<h1>Esate prisijungęs, <?php echo $user->email ?></h1>
				<a href="?id=change_password">Keisti slaptažodį</a><br/>
				<a href="?id=logout">Atsijungti</a>
			<?php } ?>
			
			<?php if($ID == "change_password") { ?>
				<h1>Slaptažodžio keitimas</h1>
				
				<?php
				if(isset($_POST["submit"])) { /* tikrinama ar paspaustas mygtukas submit turi reiksme, jei jo, tai ir kiti ivedimo laukai tures */
					
					if(!empty($_POST["pass"]) && !empty($_POST["newpass"])){ /* jei netuscias email ir slaptazodis, veiksmas vyksta */
						$pass = $_POST["pass"]; /* duomenys gauti is ivedimo laukelio pavadinimu email */
						$newpass = $_POST["newpass"]; /* duomenys gauti is ivedimo laukelio pavadinimu pass */
						
						if($pass === $newpass) { /* php funkcija, tikrinanti ar ivesto slaptazodzio hash tinka su issaugoto slaptazodzio */
							if(strlen($pass)> 5) {
								echo "<div class=\"alert\" id=\"success\">Slaptažodis pakeistas</div>";
								$newpass = password_hash($newpass, PASSWORD_DEFAULT);
								$Database->query("UPDATE users SET pass = '$newpass' WHERE ID = '".$user->ID."'");
								$_SESSION["login"]["pass"] = $pass;
							}
							else {
								echo "<div class=\"alert\" id=\"error\">Per trumpas</div>"; /* echo tai tipo spausdint teksta */
							}
						}
						else { 
							echo "<div class=\"alert\" id=\"error\">Nesutampa</div>"; /* echo tai tipo spausdint teksta */
						}
						
					}
					else {
						echo "<div class=\"alert\" id=\"error\">Neįvesti duomenys</div>";
					}
				}
				?>
				
				<form method="post" action="?id=change_password">
					<input type="password" placeholder="Įveskite naują slaptažodį" name="pass"/><br/>
					<input type="password" placeholder="Pakartokite slaptažodį" name="newpass"/><br/>
					<input type="submit" value="Atnaujinti" name="submit"/>
				</form>
			<?php } ?>
			
			<?php if($ID == "logout") {
				// kodas istrint sesijai cia
				$_SESSION["login"] = NULL;
				// sita palikti apacioj
				header("Location: ?id=");
			} ?>
			
			<?php if($ID != "") { echo "<a class='footer_link' href='?id='>Pagrindinis</a>"; } ?>
			
		<?php } ?>
		
	</div>
</body>
</html>