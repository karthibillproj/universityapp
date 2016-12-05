<?php 

include_once('database.php');

if(isset($_GET['delete'])){
  $sql = "DELETE FROM students WHERE id = ".$_GET['delete'];
    if ($conn->query($sql) === TRUE) {
       $deleteid = $_GET['delete'];
       $deletesql = "DELETE FROM student_courses WHERE student_id ='$deleteid'";
       $conn->query($deletesql);
       $result = 'success';
    }
  }

$sql = "SELECT * FROM students";

$result = $conn->query($sql);
$students = array();
if ($result->num_rows > 0) { 

  $baseurl = str_replace("api","#", getBaseUrl());
   
   while($row = $result->fetch_assoc()) {

  		$editurl = $baseurl.'editstudent/'.$row['id'];
  		$deleteurl = $baseurl.'deletestudent/'.$row['id'];
       $student['id'] = $row['id'];
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
