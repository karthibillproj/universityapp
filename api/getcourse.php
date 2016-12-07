<?php 

include_once('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET['studentid'])){
	$studentid = $_GET['studentid'];
	$selectquery = "SELECT course_id from student_courses where student_id = ".$studentid;
	$result = $conn->query($selectquery);
	if($result->num_rows > 0) { 
 while($row = $result->fetch_assoc()) {
 		$courseid = $row['course_id'];
    } 

  }
	 $sql = "SELECT * FROM courses WHERE id IN (".$courseid.")"; 
}else{
	$sql = "SELECT * FROM courses";
}

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