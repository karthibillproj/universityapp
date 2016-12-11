<?php 

include_once('database.php');

if(isset($_GET['delete'])){
  $sql = "DELETE FROM instructors WHERE id = ".$_GET['delete'];
    if ($conn->query($sql) === TRUE) {
       $deleteid = $_GET['delete'];
       $deletesql = "DELETE FROM instructor_courses WHERE student_id ='$deleteid'";
       $conn->query($deletesql);
       $result = 'success';
    }
  }


$sql = "SELECT * FROM instructors";

$result = $conn->query($sql);
$instructors = array();
if ($result->num_rows > 0) { 

   $baseurl = str_replace("api","#", getBaseUrl());
   while($row = $result->fetch_assoc()) {

      $editurl =  $baseurl.'editinstructor/'.$row['id'];
      $deleteurl =  $baseurl.'deleteinstructor/'.$row['id'];
       $instructor['id'] = $row['id'];
       $instructor['first_name'] = $row['first_name'];
       $instructor['last_name'] = $row['last_name'];
       $instructor['email'] = $row['email'];
       $instructor['qualification'] = $row['qualification'];
       $instructor['edit'] = $editurl;
       $instructor['delete'] = $deleteurl;
       $instructors[] = $instructor;
  
    }  
  

} 

$conn->close(); 
echo json_encode($instructors); exit;

?>
