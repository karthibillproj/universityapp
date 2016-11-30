<?php 

include_once('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM courses";

$result = $conn->query($sql);

if ($result->num_rows > 0) { 
   $coursedata = array();
 while($row = $result->fetch_assoc()) {
 		$id = $row['id'];
 		$coursename = $row['coursename'];
   		$coursedata[$id] = $coursename;
    } 

  } else {
     $coursedata =  "0 results";
  }
$conn->close(); 
?>