<?php

/**
 * 2013-12-20 - Jesse L Quattlebaum (psyjoniz@gmail.com)
 * Example of use for Timer.class.php
 */

require_once('Timer.class.php');

$sURL = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . (false !== strpos($_SERVER['REQUEST_URI'], '?') ? strtok($_SERVER['REQUEST_URI'], '?') : $_SERVER['REQUEST_URI']);
$sErrorMessage = false;

try {
	$oTimer = new Timer('page');
	$oTimer->start('forloop');
	$y = 0;
	for($x = 0; $x < 5000000; $x++)
	{
		$y = $x + $y;
		$md5 = md5($y);
	}
	$aTimer_forloop = $oTimer->stop('forloop');
	$oTimer->start('forloop2');
	$y = 0;
	for($x = 0; $x < 5000000; $x++)
	{
		$y = $x + $y;
		$md5 = md5($y);
	}
	$aTimer_forloop2 = $oTimer->stop('forloop2');
	$aTimer_page = $oTimer->stop('page');
} catch(Exception $exception) {
	$sErrorMessage = $exception->getMessage();
}

echo('Timer | <a href="' . $sURL . '">Refresh</a><hr />');

if(false !== $sErrorMessage) {
?>
<fieldset style="background-color: #ffeeee; border: 1px solid #000000;">
	<legend style="background-color: #ffaaaa; padding: 2px; border: 1px solid #000000;">&nbsp;Error&nbsp;</legend>
	<?php echo($sErrorMessage); ?>
</fieldset>
<br />
<?php
}
?>
<fieldset style="border: 1px solid #000000;">
	<legend style="background-color: #00ffff; padding: 2px; border: 1px solid #000000;">&nbsp;Data&nbsp;</legend>
	<table>
		<tr>
			<td>forloop :</td><td><?php echo($aTimer_forloop['elapsed']); ?></td>
		</tr>
		<tr>
			<td>forloop2 :</td><td><?php echo($aTimer_forloop2['elapsed']); ?></td>
		</tr>
		<tr>
			<td>page :</td><td><?php echo($aTimer_page['elapsed']); ?></td>
		</tr>
	</table>
</fieldset>
