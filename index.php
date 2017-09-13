<?php
include 'dbcon/dbcon.php';
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Dance</title>
</head>

<body>

<?php
if($cmd = filter_input(INPUT_POST, 'cmd')){

	if($cmd == 'add_stilart') {
		$saname = filter_input(INPUT_POST, 'saname') 
			or die('Missing/illegal saname parameter');
		
		require_once('dbcon/dbcon.php');
		$sql = 'INSERT INTO stilart (name) VALUES (?)';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('s', $saname);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Added '.$saname.' as stileart number '.$stmt->insert_id;
		}
		else {
			echo 'Could not create the new stilart!!!';
		}	
	}
	elseif($cmd == 'del_stilart') {
		$cid = filter_input(INPUT_POST, 'sid', FILTER_VALIDATE_INT) 
			or die('Missing/illegal sid parameter');
		
		//require_once('dbcon.php');
		$sql = 'DELETE FROM stilart WHERE stilartID=?';
		$stmt = $link->prepare($sql);
		$stmt->bind_param('i', $sid);
		$stmt->execute();
		
		if($stmt->affected_rows > 0){
			echo 'Deleted stilart number '.$sid;
		}
		else {
			echo 'Could not delete stilart '.$sid;
		}
	}
	else {
		die('Unknown cmd: '.$cmd);
	}
}
?>


	<h1>Stilart</h1>
	<ul>
<?php
	//require_once('dbcon/dbcon.php');
	
	$sql = 'SELECT stilartID, name FROM stilart';
	$stmt = $link->prepare($sql);
	// $stmt->bind_param();  not needed - no placeholders....
	$stmt->execute();
	$stmt->bind_result($sid, $saname);
	
	while($stmt->fetch()){      
//		echo '<li><a href=”filmlist.php?categoryid='.$cid.'”>'.$nam.'</a>';
//		echo '<a href=”renamecategory.php?categoryid='.$cid.'”>Rename</a>';
//		echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
//		echo '<input type="hidden" name="cid" value="'.$cid.'" />';
//		echo '<button name="cmd" type="submit" value="del_category">Delete</button>';
//		echo '</form></li>'.PHP_EOL;
?>
            <li><a href="details.php?stilartID=<?=$sid?>"><?=$saname?></a> : 
                <a href="renamestilart.php?sid=<?=$sid?>">rename</a>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<input type="hidden" name="sid" value="<?=$sid?>" />
		<button name="cmd" type="submit" value="del_stilart">Delete</button>
	</form>
</li>
<?php
	}	
?>
	</ul>
	<hr>

	<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Create new stilart</legend>
    	<input name="saname" type="text" placeholder="Stilart" required />
		<button name="cmd" type="submit" value="add_stilart">Create</button>
	</fieldset>
</form>
</p>

<a href="imagesite/imgF.php">Billede galleri</a>
	
</body>
</html>