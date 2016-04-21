<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>数据库表中插入数据</title>
</head>

<body>
<?php
//connect to MySQL
$db=mysqli_connect('localhost','root','wzj196310') or die ('Unable to connect.Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

//insert data into movie table 
$sql='insert into movie(
	movie_id,movie_name,movie_type,movie_year,movie_leadactor,movie_director)
    values
    (1,"Bruce Almighty",5,2003,1,2),
    (2,"Office Space",5,1999,5,6),
    (3,"Grand Canyon",2,1991,4,3)';
mysqli_query($db,$sql) or die(mysql_error($db));
    
//insert data into the movietype table
$sql='insert into movietype
(movietype_id,movietype_label)
values
(1,"Sci Fi"),
(2,"Drama"),
(3,"Adventure"),
(4,"war"),
(5,"Comedy"),
(6,"Horror"),
(7,"Action"),
(8,"Kids")';
mysqli_query($db,$sql) or die(mysqli_error($db));

//insert data into the people table
$sql='insert into people
	(people_id,people_fullname,people_isactor,people_isdirector)
    values
    	(1,"Jim Carrey",1,0),
        (2,"Tom Shadyac",0,1),
        (3,"Lawrence",0,1),
        (4,"Kevin Kline",1,0),
        (5,"Ron Livingston",1,0),
        (6,"Mike Judge",0,1)';
mysqli_query($db,$sql) or die(mysqli_error($db));
echo 'Data inserted successfully!';
?>
</body>
</html>
