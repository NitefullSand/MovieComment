<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>建立数据库表</title>
</head>

<body>
<?php
//connect to MySQL
$db=mysqli_connect('localhost','root','wzj196310') or die ('Unable to connect.Check your connection parameters.');
//create the main database if it doesn't already exist
$sql='create database if not exists moviesite';
mysqli_query($db,$sql) or die(mysqli_error($db));
//make sure our recently created database is the active one
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
//create the movie table
$sql='create table movie(
movie_id	integer unsigned not null auto_increment,
movie_name	varchar(255)	not null,
movie_type	tinyint	not null default 0,
movie_year	smallint unsigned not null default 0,
movie_leadactor integer unsigned not null default 0,
movie_director integer unsigned not null default 0,

primary key(movie_id),
key movie_type(movie_type,movie_year)
)
engine=myisam';
//mysqli_query($db,$sql) or die (mysqli_error($db));

//create the movietype table
$sql='create table movietype(
	movietype_id	tinyint unsigned not null auto_increment,
	movietype_label	varchar(100)	not null,
	primary key(movietype_id)
)
engine=myisam';
//mysqli_query($db,$sql) or die (mysqli_error($db));
//create the people table
$sql='create table people(
people_id	integer unsigned not null auto_increment,
people_fullname	varchar(255)	not null,
people_isactor	tinyint(1) unsigned not null default 0,
people_isdirector	tinyint(1) unsigned not null default 0,

primary key(people_id)
)
engine=myisam';
//mysqli_query($db,$sql) or die (mysqli_error($db));
echo 'Movie database successfully created!';
?>
</body>
</html>
