<?php 

include_once('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 $id = $_REQUEST['id'];
  $sql = "SELECT instructors.id id, instructors.first_name first_name, instructors.last_name last_name, instructors.email email, instructors.qualification qualification, instructor_courses.course_id course_id  FROM instructors LEFT JOIN instructor_courses on instructors.id = instructor_courses.instructor_id where instructors.id = ".$id; 


$result = $conn->query($sql);
$student = array();
if ($result->num_rows > 0) { 
   $student = array();
 while($row = $result->fetch_assoc()) {
 	   $instructor['instructorid'] = $row['id'];
 	   $instructor['first_name'] = $row['first_name'];
       $instructor['last_name'] = $row['last_name'];
       $instructor['email'] = $row['email'];
       $instructor['qualification'] = $row['qualification'];
       $instructor['course_id'] = $row['course_id'];
    } 

  }
$conn->close(); 
echo json_encode($instructor); exit;
?>