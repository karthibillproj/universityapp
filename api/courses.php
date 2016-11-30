<?php 

include_once('database.php');

$sql = "SELECT * FROM courses";

$result = $conn->query($sql);
$students = array();
if ($result->num_rows > 0) { 

   
   while($row = $result->fetch_assoc()) {

      $editurl = getBaseUrl().'editcourse.php?id='.$row['id'];
      $deleteurl = getBaseUrl().'addcourse.php?delete='.$row['id'];
       $course['coursename'] = $row['coursename'];
       $course['duration'] = $row['duration'];
       $course['edit'] = $editurl;
       $course['delete'] = $deleteurl;
       $courses[] = $course;
  
    }  
  

} 

$conn->close(); 
echo json_encode($courses); exit;

?>
