<?php 

include_once('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM courses";

$result = $conn->query($sql);
$coursedata = array();
if ($result->num_rows > 0) { 
   $coursedata = array();
 while($row = $result->fetch_assoc()) {
 		$coursename['id'] = $row['id'];
 		$coursename['coursename'] = $row['coursename'];
   		$coursedata[] = $coursename;
    } 

  }
$conn->close(); 
echo json_encode($coursedata); exit;
?>