<?php 

include_once('database.php');

$sql = "SELECT * FROM students";

$result = $conn->query($sql);
$students = array();
if ($result->num_rows > 0) { 

  $baseurl = str_replace("api","#", getBaseUrl());
   
   while($row = $result->fetch_assoc()) {

  		$editurl = $baseurl.'editstudent/'.$row['id'];
  		$deleteurl = $baseurl.'deletestudent/'.$row['id'];
       $student['first_name'] = $row['first_name'];
       $student['last_name'] = $row['last_name'];
       $student['email'] = $row['email'];
       $student['dob'] = $row['dob'];
       $student['edit'] = $editurl;
       $student['delete'] = $deleteurl;
       $students[] = $student;
  
    }  
 	

} 

$conn->close(); 
echo json_encode($students); exit;

?>
