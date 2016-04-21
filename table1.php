<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>创建表格，链接各个表</title>
</head>

<body>
<?php
//take in the id of a director and return his/her full name
function get_director($director_id)
{
	global $db;
	$sql='select people_fullname from people where people_id=' . $director_id;
    $result=mysqli_query($db,$sql) or die(mysqli_error(db));
    $row=mysqli_fetch_assoc($result);
    extract($row);
 return $people_fullname;
}
//take in the id of a lead actor and return his/her full name 
function get_leadactor($leadactor_id)
{
	global $db;
	$sql='select people_fullname from people where people_id=' . $leadactor_id;
    $result=mysqli_query($db,$sql) or die(mysqli_error(db));
    $row=mysqli_fetch_assoc($result);
    extract($row);
 return $people_fullname;
}
//take in the id of a movie type and return the meaningful textual
//description
function get_movietype($type_id)
{
	global $db;
	$sql='select movietype_label from movietype where movietype_id=' . $type_id;
    $result=mysqli_query($db,$sql) or die(mysqli_error(db));
    $row=mysqli_fetch_assoc($result);
    extract($row);
 return $movietype_label;
}

$db=mysqli_connect('localhost','root','wzj196310') or die ('Unable to connect.Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
//retrieve information
$sql='select movie_id,movie_name,movie_year,movie_director,movie_leadactor,movie_type from movie order by movie_name ASC,movie_year DESC';
$result=mysqli_query($db,$sql) or die(mysqli_error($db));
//determine number of rows in returned result
$num_movies=mysqli_num_rows($result); 

$table = <<<ENDHTML
<div style="text-align:center;">
<h2>Movie Review Database</h2>
<table border="1" cellpadding="2" cellspacing="2" style="width:70%;margin-left:auto;margin-right:auto;">
	<tr>
    	<th>Movie Title</th>
        <th>Year of Release</th>
        <th>Movie Director</th>
        <th>Movie Lead Actor</th>
        <th>Movie Type</th>
    </tr>
ENDHTML;

//Loop through the results
while($row=mysqli_fetch_assoc($result))
{
	extract($row);
	$director=get_director($movie_director);
	$leadactor=get_leadactor($movie_leadactor);
	$movietype=get_movietype($movie_type);
$table .= <<<ENDHTML
	<tr>
		<td><a href="movie_details.php?movie_id=$movie_id" title="Click here to find out more about $movie_name">$movie_name</a></td>
		<td>$movie_year</td>
		<td>$director</td>
		<td>$leadactor</td>
		<td>$movie_type</td>
	</tr>
ENDHTML;
}
 
$table .= <<<ENDHTML
  
</table>
<p>$num_movies Movies</p>
</div>
ENDHTML;
echo $table;
?>
</body>
</html>

