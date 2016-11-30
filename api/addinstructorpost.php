<?php 

include_once('database.php');


$firstname = $_POST['first_name'];
$lastname =  $_POST['last_name'];
$email = $_POST['email'];
$qualification = $_POST['qualification'];
$coursedata = array_filter($_POST['course']);
$courses =  array_filter($coursedata);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['instructorid'])){
	$instructorid = $_POST['instructorid'];
	$sql = "UPDATE instructors SET first_name = '$firstname',last_name = '$lastname',email='$email',qualification='$qualification' WHERE id='$instructorid'";
     if ($conn->query($sql) === TRUE) {
        foreach($courses as $course){
            if(!empty(trim($course))){
            $query_parts[] = $course;
            }
        }
        $queryvalue = mysql_real_escape_string(implode(',', $query_parts)); 
        $selectquery = "SELECT * FROM instructor_courses where instructor_id = ".$instructorid;
        $result = $conn->query($selectquery);
        if ($result->num_rows > 0) { 
            $query = "UPDATE instructor_courses SET course_id = '$queryvalue' WHERE instructor_id = '$instructorid'"; 
            if ($conn->query($query) === TRUE) {
              $result = 'success';
           } else {
              $result = $conn->error;
           }
        }else{
             $query = "INSERT INTO instructor_courses (`instructor_id`, `course_id`) VALUES ('$instructorid', '".$queryvalue."')";
             if ($conn->query($query) === TRUE) {
                  $result = 'success';
               } else {
                  $result = $conn->error;
               } 
        }

      /* $deletesql = "DELETE FROM instructor_courses WHERE instructor_id ='$instructorid'";
       $conn->query($deletesql);
       $query = 'INSERT INTO instructor_courses (`instructor_id`, `course_id`) VALUES ';
       $query_parts = array();
       foreach($courses as $course){
           if(!empty(trim($course))){
            $query_parts[] = "('" . $instructorid . "', '" . $course . "')";
            }
       }
       $query .= implode(',', $query_parts);
       if ($conn->query($query) === TRUE) {
          $result = 'success';
       } else {
          $result = $conn->error;
       } */

    } else {
        $result = $conn->error;
    }
}else if(isset($_GET['delete'])){
	$sql = "DELETE FROM instructors WHERE id = ".$_GET['delete'];
     if ($conn->query($sql) === TRUE) {
       $deleteid = $_GET['delete'];
       $deletesql = "DELETE FROM instructor_courses WHERE instructor_id ='$deleteid'";
       $conn->query($deletesql);
       $result = 'success';
    } else {
        $result = $conn->error;
    }
}else{	
	$sql = "INSERT INTO instructors (first_name, last_name, email, qualification) VALUES ('$firstname', '$lastname', '$email', '$qualification')";
    if ($conn->query($sql) === TRUE) {
       $last_id = $conn->insert_id;


        $query_parts = array();
       foreach($courses as $course){
            if(!empty(trim($course))){
            $query_parts[] = $course;
            }
       }
        $queryvalue = mysql_real_escape_string(implode(',', $query_parts)); 
    
       $query = "INSERT INTO instructor_courses (`instructor_id`, `course_id`) VALUES ('$last_id', '".$queryvalue."')";
       if ($conn->query($query) === TRUE) {
          $result = 'success';
       } else {
          $result = $conn->error;
       } 

       
      /* $query = 'INSERT INTO instructor_courses (`instructor_id`, `course_id`) VALUES ';
       $query_parts = array();
       foreach($courses as $course){
            if(!empty(trim($course))){
             $query_parts[] = "('" . $last_id . "', '" . $course . "')";
            }
       }
       $query .= implode(',', $query_parts); 
       if ($conn->query($query) === TRUE) {
          $result = 'success';
       } else {
          $result = $conn->error;
       } */
    } else {
        $result = $conn->error;
    }
}


mysqli_close($conn);


$url = getBaseUrl().'instructors.php';

header('Location: ' . $url);

exit;

?> 