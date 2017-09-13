<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	<h1>Images uploaded to the system</h1>
        <a href="imgF.php">Go back</a>
	
<?php
	require_once('dbcon.php');
	$sql = 'SELECT url FROM img';
	$stmt = $link->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($id, $url);
	
	while($stmt->fetch()){ ?>
		
	<h2><?=$id?>: <?=$url?></h2>
	<img src="<?=$url?>" width="100px" />
<?php } ?>
</body>
</html>