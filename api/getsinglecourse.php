<?php 

include_once('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$courseid = $_GET['id'];

	$sql = "SELECT * FROM courses WHERE id = ".$courseid;


$result = $conn->query($sql);
$coursedata = array();
if ($result->num_rows > 0) { 
   $coursedata = array();
 while($row = $result->fetch_assoc()) {
 		$coursename['id'] = $row['id'];
 		$coursename['coursename'] = $row['coursename'];
    $coursename['duration'] = $row['duration'];
    } 

  }
$conn->close(); 
echo json_encode($coursename); exit;
?>