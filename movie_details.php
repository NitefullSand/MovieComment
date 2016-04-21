<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
//take in the id of a director and return his/her full name
function get_director($director_id)
{
	global $db;
    $sql='select people_fullname from people where people_id=' . $director_id;
    $result=mysqli_query($db,$sql) or die(mysqli_error($db));
    $row=mysqli_fetch_assoc($result);
    extract($row);
  return $people_fullname;
}
//take in the id of a director and return his/her full name 
function get_leadactor($leadactor_id)
{
	global $db;
    $sql='select people_fullname from people where people_id=' . $leadactor_id;
    $result=mysqli_query($db,$sql) or die(mysqli_error($db));
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
//function to calculate if a movie made a profit,loss or just broke even
function calculate_differences($takings,$cost)
{
	$difference=$takings-$cost;
	
     if($difference>0)
    {
        $color='green';
        $difference='$' . $difference . 'million';
    }
	elseif($difference<0)
    {
    	$color='red';
        $difference='$' . abs($difference) . 'million';
    }
    
    
	else
    {
        $color='blue';
        $difference='broke even';
    }
    return '<span style="color:' . $color . ';">' . $difference . '</span>';
 }
//connect to MySQL
$db=mysqli_connect('localhost','root','wzj196310') or die ('Unable to connect.Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
//retrieve information
$sql='select movie_name,movie_year,movie_director,movie_leadactor,movie_type,movie_running_time,movie_cost,movie_takings 
	from movie where movie_id=' . $_GET['movie_id'];
    $result=mysqli_query($db,$sql) or die(mysqli_error($db));
  	$row=mysqli_fetch_assoc($result);
	
$movie_name=$row['movie_name'];
$movie_director=get_director($row['movie_director']);
$movie_leadactor=get_leadactor($row['movie_leadactor']);
$movie_year=$row['movie_year'];
$movie_running_time=$row['movie_running_time'] . ' mins';
$movie_takings='$' . $row['movie_takings'] . ' million';
$movie_cost='$' . $row['movie_cost'] . 'million';
$movie_health=calculate_differences($row['movie_takings'],$row['movie_cost']);

//display the information
echo <<<ENDHTML
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<div style="text-align:center;">
<h2>$movie_name</h2>
<h3><em>Details</em></h3>
<table cellspacing="2" cellpadding="2" style="width:70%; margin-left:auto;margin-right:auto;">
<tr>
<td><strong>Title</strong></td>
<td>$movie_name</td>
<td><strong>Release Year</strong></td>
<td>$movie_year</td>
</tr>
<tr>
<td><strong>Movie_Director</strong></td>
<td>$movie_director</td>
<td><strong>Cost</strong></td>
<td>$movie_cost</td>
</tr>
<tr>
<td><strong>Lead Actor</strong></td>
<td>$movie_leadactor</td>
<td><strong>Takings</strong></td>
<td>$movie_takings</td>
</tr>
<tr>
<td><strong>Running Time</strong></td>
<td>$movie_running_time</td>
<td><strong>Health</strong></td>
<td>$movie_health</td>
</tr>
</table>
</div>
</body>
</html>
ENDHTML;
?>