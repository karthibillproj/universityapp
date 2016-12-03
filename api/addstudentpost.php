<?php 

include_once('database.php');



if(!empty($_POST) || !empty($_GET['delete'])){

if(!empty($_POST)){
	$firstname = $_POST['first_name'];
	$lastname =  $_POST['last_name'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$courses = array_filter($_POST['course']);
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['studentid'])){
	$coursedata = $courses;
	$courses = array();
	foreach($coursedata as $course){
		$courses[] = $course['id'];
	}
	$studentid = $_POST['studentid'];
	$sql = "UPDATE students SET first_name = '$firstname',last_name = '$lastname',email='$email',dob='$dob' WHERE id='$studentid'";
	 if ($conn->query($sql) === TRUE) {
	 	foreach($courses as $course){
	   		if(!empty(trim($course))){
	        $query_parts[] = $course;
	    	}
	    }
		$queryvalue = mysql_real_escape_string(implode(',', $query_parts)); 
		$selectquery = "SELECT * FROM student_courses where student_id = ".$studentid;
		$result = $conn->query($selectquery);
		if ($result->num_rows > 0) { 
			$query = "UPDATE student_courses SET course_id = '$queryvalue' WHERE student_id = '$studentid'";
			if ($conn->query($query) === TRUE) {
		      $result = 'success';
		   } else {
		      $result = $conn->error;
		   }
		}else{
			 $query = "INSERT INTO student_courses (`student_id`, `course_id`) VALUES ('$studentid', '".$queryvalue."')";
			   if ($conn->query($query) === TRUE) {
			      $result = 'success';
			   } else {
			      $result = $conn->error;
			   }
		}
    } else {
        $result = $conn->error;
    }
}else if(isset($_GET['delete'])){
	$sql = "DELETE FROM students WHERE id = ".$_GET['delete'];
	  if ($conn->query($sql) === TRUE) {
	   $deleteid = $_GET['delete'];
	   $deletesql = "DELETE FROM student_courses WHERE student_id ='$deleteid'";
       $conn->query($deletesql);
       $result = 'success';
    } else {
        $result = $conn->error;
    }
}else{	

	$sql = "INSERT INTO students (first_name, last_name, email, dob) VALUES ('$firstname', '$lastname', '$email', '$dob')";
	  if ($conn->query($sql) === TRUE) {
       $last_id = $conn->insert_id;

        $query_parts = array();
	   foreach($courses as $course){
	   		if(!empty(trim($course))){
	        $query_parts[] = $course;
	    	}
	   }
		$queryvalue = mysql_real_escape_string(implode(',', $query_parts)); 
    
	   $query = "INSERT INTO student_courses (`student_id`, `course_id`) VALUES ('$last_id', '".$queryvalue."')";
	   if ($conn->query($query) === TRUE) {
	      $result = 'success';
	   } else {
	      $result = $conn->error;
	   } 


    } else {
        $result = $conn->error;
    }
}

mysqli_close($conn);

}
// response if there are errors
	if ($result != 'success') {

		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $result;
	} else {

		// if there are no errors, return a message
		$data['success'] = true;
		$data['message'] = 'Student added successfully!';
	}

	// return all our data to an AJAX call
	echo json_encode($data);

?> 