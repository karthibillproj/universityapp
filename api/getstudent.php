<?php 

include_once('database.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 $id = $_REQUEST['id'];
 $sql = "SELECT students.id id, students.first_name first_name, students.last_name last_name, students.email email, students.dob dob, student_courses.course_id course_id  FROM students LEFT JOIN student_courses on students.id = student_courses.student_id where students.id = ".$id; 

$result = $conn->query($sql);
$student = array();
if ($result->num_rows > 0) { 
   $student = array();
 while($row = $result->fetch_assoc()) {
 	   $student['studentid'] = $row['id'];
 	   $student['first_name'] = $row['first_name'];
       $student['last_name'] = $row['last_name'];
       $student['email'] = $row['email'];
       $student['dob'] = $row['dob'];
       $student['course_id'] = $row['course_id'];
    } 

  }
$conn->close(); 
echo json_encode($student); exit;
?>