<?php
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
include("/var/www/html/simone/config.php");
if (is_numeric($_GET["quit"]))
{
	// Authentification muss noch anders gelöst werden....
	if($_GET["pw"] == "abc")
	{
		$quitid= $_GET["quit"];
		$ergebnis = mysqli_query($db, "SELECT * FROM fail WHERE workid = '$quitid'");
		while($row = mysqli_fetch_object($ergebnis))
		{
			$timeakt = time();
			$eintrag = "INSERT INTO logbook (msg, prio, device, timelast, timequit, workid) VALUES ('$row->msg', '$row->prio', '$row->device', '$row->time', '$timeakt', '$row->workid')";
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
		<td>time</td>
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
	echo '<tr bgcolor="'.$bgcolor.'"><td>'.$row->ID.'</td><td>'.$row->msg.'</td><td>'.$row->prio.'</td><td>'.$row->device.'</td><td>'.$datum.'</td><td>'.$row->workid.'</td><td><a href="index.php?quit='.$row->workid.'">quittieren</a></td></tr>';
}
?>
</table>
<br />
Scriptlaufzeit des Cronjobs: <?php echo "folgt.." ?><br />
<a href="logbook.php">Logbuch</a><br />
Login
