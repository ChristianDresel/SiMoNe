<?php
$timestart=time();
error_reporting(E_ALL);
ini_set ('display_errors', 'On');
ini_set('default_socket_timeout', 4);
echo "run";
include("/var/www/html/simone/config.php");
function check_regex($wert)
{
	if (preg_match("/^([a-zA-Z0-9öäüßÖÄÜß?!,.:_() \n\r-]+)$/is", $wert))
	{
		return true;
	}
}
function set_err($msg, $prio, $device, $id)
{
	if (!check_regex($prio) OR !check_regex($msg) OR !check_regex($device))
	{
		echo "injection";
		//Funktion ruft sich selbst auf, sicherstellen das sie nicht wieder im Injectionzweig landet!!
		set_err('Injection detect', 3, 'no data', $id);
		echo "<br><br>$id<br>$prio<br$msg<br>$device";
	}
	else
	{
		$ergebnis1 = mysqli_query($GLOBALS["db"], "SELECT workid FROM fail WHERE workid = '$id'");
		while($row1 = mysqli_fetch_object($ergebnis1))
		{
			$vorhanden = 1;
		}
		$time = time();
		if ($vorhanden == 1)
		{
			$aendern = "UPDATE fail Set time = '$time', msg = '$msg', prio = '$prio', device = '$device', active = '1' WHERE workid = '$id'";
			$update = mysqli_query($GLOBALS["db"], $aendern);
		}
		else
		{
			$eintrag = "
				INSERT INTO fail (msg, prio, device, timefirst, time, active, workid)
				VALUES ('$msg', '$prio', '$device', '$time', '$time', '1', '$id')";
			$eintragen = mysqli_query($GLOBALS["db"], $eintrag);
		}
	}
}
$ergebnis = mysqli_query($db, "SELECT id, url FROM work WHERE id != '1'");
while($row = mysqli_fetch_object($ergebnis))
{
	$header = get_headers($row->url, 1); 
	echo $header[0];
	if ($header[0] == "")
	{
		set_err('No Connection', 3, 'no data', $row->id);
	}
	else
	{
		if ($header[0] == "HTTP/1.1 200 OK")
		{
			$handle = file_get_contents($row->url);
	       		$xml = new SimpleXMLElement($handle);
			if ($xml[0] != "green")
			{
				set_err($xml->msg, $xml->prio, $xml->device, $row->id);
			}
		}
		else
		{
			$headersend = str_replace("/", "", $header[0]);
			set_err("$headersend error", 3, 'no data', $row->id); 
		}
	}
}
$timeges = time() - $timestart;
	echo $timeges;
$aendern = "UPDATE status Set wert = '$timeges' WHERE was = 'scriptlaufzeit'";
$update = mysqli_query($GLOBALS["db"], $aendern);
if ($timeges > 45 AND $timeges < 50)
{
	set_err("Cron Simone Scriptlaufzeit $timeges", 1, "Cron", 1);
}
if ($timeges >= 50 AND $timeges < 55)
{
        set_err("Cron Simone Scriptlaufzeit $timeges", 2, "Cron", 1);
}
if ($timeges >= 55)
{
        set_err("Cron Simone Scriptlaufzeit $timeges", 3, "Cron", 1);
}

?>
