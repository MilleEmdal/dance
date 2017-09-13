<?php
include 'dbcon/dbcon.php';
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	<h1>Stilart details</h1>
	<ul>
<?php
	$sid = filter_input(INPUT_GET, 'sid', FILTER_VALIDATE_INT) 
		or die('Missing/illegal sid parameter');		
	
	require_once('dbcon/dbcon.php');
	$sql = 'SELECT stilart.name , details.info FROM details INNER JOIN stilart ON details.fk_stilartID = stilart.stilartID ';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('i', $sid);
	$stmt->execute();
	$stmt->bind_result($sid, $saname, $info);
	while ($stmt->fetch()){
		echo '<li><p>
        '.$saname.'<br>Description: '.$info.'</p></li>'.PHP_EOL;
	}
?>
	</ul>
</body>
</html>