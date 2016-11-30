<?php 

include_once('database.php');

$sql = "SELECT * FROM students";

$result = $conn->query($sql);
$students = array();
if ($result->num_rows > 0) { 

   
   while($row = $result->fetch_assoc()) {

  		$editurl = getBaseUrl().'editstudent.php?id='.$row['id'];
  		$deleteurl = getBaseUrl().'addstudentpost.php?delete='.$row['id'];
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
