<?php 

include_once('database.php');

if(isset($_GET['delete'])){
  $deletesql = "DELETE FROM courses WHERE id = ".$_GET['delete'];
   $conn->query($deletesql);
}


$sql = "SELECT * FROM courses";

$result = $conn->query($sql);
$students = array();
if ($result->num_rows > 0) { 

   $baseurl = str_replace("api","#", getBaseUrl());
      
   while($row = $result->fetch_assoc()) {

      $editurl = $baseurl.'editcourse/'.$row['id'];
      $deleteurl = $baseurl.'addcourse.php?delete='.$row['id'];
       $course['id'] = $row['id'];
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
