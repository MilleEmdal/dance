<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){

	if($cmd == 'rename_stilart') {
		$sid = filter_input(INPUT_POST, 'sid', FILTER_VALIDATE_INT) 
			or die('Missing/illegal sid parameter');
		$saname = filter_input(INPUT_POST, 'saname') 
			or die('Missing/illegal saname parameter');
		
		require_once('dbcon/dbcon.php');
		$sql = 'UPDATE stilart SET name=? WHERE stilartID=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('si', $saname, $sid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Changed stileart name to '.$saname;
		}
		else {
			echo 'Could not change the name of the stilart';
		}	
	}
}
?>

<hr>


<?php
	if (empty($sid)){
		$sid = filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT) 
			or die('Missing/illegal sid parameter');	
	}
	require_once('dbcon/dbcon.php');
	$sql = 'SELECT name FROM stilart WHERE stilartID=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('i', $sid);
	$stmt->execute();
	$stmt->bind_result($saname);
	while($stmt->fetch()){} 
?>

<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Rename stilart</legend>
    	<input name="sid" type="hidden" value="<?=$sid?>" />
    	<input name="saname" type="text" value="<?=$saname?>" />
    	<button name="cmd" type="submit" value="rename_stilart">Save new name</button>
	</fieldset>
</form>
</p>
<hr>
<a href="index.php">View all stilearts</a>

</body>
</html>