<?php 

include_once('database.php');

$sql = "SELECT * FROM instructors";

$result = $conn->query($sql);
$instructors = array();
if ($result->num_rows > 0) { 

   
   while($row = $result->fetch_assoc()) {

      $editurl = getBaseUrl().'editinstructor.php?id='.$row['id'];
      $deleteurl = getBaseUrl().'addinstructor.php?delete='.$row['id'];
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
