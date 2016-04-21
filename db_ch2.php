<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>给表格添加数据</title>
</head>

<body>
<?php
//connect to MySQL
$db=mysqli_connect('localhost','root','wzj196310') or die ('Unable to connect.Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
//alter the movie table to include running time,cost and taking fields
$sql='alter table movie add column(
	movie_running_time 		Tinyint unsigned 	null,
	movie_cost				DECIMAL(4,1)		null,
	movie_takings			DECIMAL(4,1)		null)';
	mysqli_query($db,$sql) or die (mysqli_error($db));
//insert new data into the movie table for each movie
$sql='update movie set movie_running_time=101,movie_cost=81,movie_takings=242.6
	where movie_id=1';
	mysqli_query($db,$sql) or die (mysqli_error($db));
$sql='update movie set movie_running_time=89,movie_cost=10,movie_takings=10.8
	where movie_id=2';
	mysqli_query($db,$sql) or die (mysqli_error($db));
$sql='update movie set movie_running_time=134,movie_cost=NULL,movie_takings=33.2
	where movie_id=3';
	mysqli_query($db,$sql) or die (mysqli_error($db));
	echo'Movie database successfully updated!';
?>
</body>
</html>
