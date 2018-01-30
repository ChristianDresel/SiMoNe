<?php
echo '<meta http-equiv="refresh" content="30; URL=index.php">';
//error_reporting(E_ALL);
//ini_set ('display_errors', 'On');
include("/var/www/html/simone/config.php");
if (is_numeric($_GET["quit"]))
{
	$cookie = $_COOKIE["login"];
	$ergebnis = mysqli_query($db, "SELECT * FROM login WHERE loginstring = '$cookie'");
	while($row = mysqli_fetch_object($ergebnis))
	{
		$login=1;
	}
	if($login == 1)
	{
		$quitid= $_GET["quit"];
		$ergebnis = mysqli_query($db, "SELECT * FROM fail WHERE workid = '$quitid'");
		while($row = mysqli_fetch_object($ergebnis))
		{
			$timeakt = time();
			$eintrag = "INSERT INTO logbook (msg, prio, device, timefirst, timelast, timequit, workid) VALUES ('$row->msg', '$row->prio', '$row->device', '$row->timefirst', '$row->time', '$timeakt', '$row->workid')";
			$eintragen = mysqli_query($db, $eintrag);	
			$loeschen = "DELETE FROM fail WHERE workid = '$quitid'";
			$loesch = mysqli_query($db, $loeschen);
		}

		echo "quit bitte warten...";
		echo '<meta http-equiv="refresh" content="1; URL=index.php">';
	}
	else
	{
		echo "access denied, Error 1202";
	}
}
?>
<table border="1">
	<tr>
		<td>Fehler ID</td>
		<td>msg</td>
		<td>prio</td>
		<td>device</td>
		<td>erstes auftreten</td>
		<td>zuletzt aufgetreten</td>
		<td>workid</td>
		<td>quittieren</td>
	</tr>
<?php
$ergebnis = mysqli_query($db, "SELECT * FROM fail order by prio DESC");
while($row = mysqli_fetch_object($ergebnis))
{
	$bgcolor="ffffff";
	if ($row->prio == 1)
	{
		$bgcolor="ffffff";
	}
        if ($row->prio == 2)
        {
                $bgcolor="ffff00";
        }
        if ($row->prio == 3)
        {
                $bgcolor="ff0000";
        }
	$datum = date("d.m.Y H:i",$row->time);
	$datumfirst = date("d.m.Y H:i",$row->timefirst);
	echo '<tr bgcolor="'.$bgcolor.'"><td>'.$row->ID.'</td><td>'.$row->msg.'</td><td>'.$row->prio.'</td><td>'.$row->device.'</td><td>'.$datumfirst.'</td><td>'.$datum.'</td><td>'.$row->workid.'</td><td><a href="index.php?quit='.$row->workid.'">quittieren</a></td></tr>';
}
?>
</table>
<br />
<?php
$ergebnis = mysqli_query($db, "SELECT * FROM status WHERE was = 'scriptlaufzeit'");
while($row = mysqli_fetch_object($ergebnis))
{
	$scriptlaufzeit = $row->wert;
}
?>
Scriptlaufzeit des Cronjobs: <?php echo $scriptlaufzeit; ?> Sekunden<br />
<a href="logbook.php">Logbuch</a><br />
<a href="login.php">Login</a><br>
<a href="https://github.com/ChristianDresel/SiMoNe">Code</a>
