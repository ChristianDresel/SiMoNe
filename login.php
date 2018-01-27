<?php
include("/var/www/html/simone/config.php");
if ($_POST['Passwort'] == $login)
{
	echo "pw richtig";
	$string = md5(rand(0,1000)+time());
	$zeitakt = time();
        $eintrag = "INSERT INTO login (loginstring, angelegt) VALUES ('$string', '$zeitakt')";
        $eintragen = mysqli_query($GLOBALS["db"], $eintrag);
	setcookie("login", $string); 
	echo $_COOKIE['login'];
}
?>
<form action="login.php" method="post">
<input type="password" size="17" name="Passwort">
<input type="submit" value="OK">
</form>
<a href="index.php">index</a><br />
<a href="login.php">Login</a><br>
