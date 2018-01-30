<?php
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
include("/var/www/html/simone/config.php");
?>
<table border="1">
	<tr>
		<td>Fehler ID</td>
		<td>Fehlermeldung</td>
		<td>Priorität</td>
		<td>Device</td>
		<td>Erstes auftreten</td>
		<td>letztes auftreten</td>
		<td>Quittiert am</td>
		<td>workid</td>
	</tr>
<?php
$ergebnis = mysqli_query($db, "SELECT * FROM logbook order by timequit DESC");
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
	$datumlast = date("d.m.Y H:i",$row->timelast);
	$datumquit = date("d.m.Y H:i",$row->timequit);
	$datumfirst = date("d.m.Y H:i",$row->timefirst);
	echo '<tr bgcolor="'.$bgcolor.'"><td>'.$row->ID.'</td><td>'.$row->msg.'</td><td>'.$row->prio.'</td><td>'.$row->device.'</td><td>'.$datumfirst.'</td><td>'.$datumlast.'</td><td>'.$datumquit.'</td><td>'.$row->workid.'</td></tr>';
}
?>
</table>
<br />
Scriptlaufzeit des Cronjobs: <?php echo "folgt.." ?><br />
<a href="index.php">index</a><br />
<a href="login.php">Login</a><br>

