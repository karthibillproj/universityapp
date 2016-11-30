<?php 

include_once('database.php');


$coursename = $_POST['coursename'];
$duration =  $_POST['duration'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['courseid'])){
	$courseid = $_POST['courseid'];
	$sql = "UPDATE courses SET coursename = '$coursename',duration = '$duration' WHERE id='$courseid'";
}else if(isset($_GET['delete'])){
	$sql = "DELETE FROM courses WHERE id = ".$_GET['delete'];
}else{	
	$sql = "INSERT INTO courses (coursename, duration) VALUES ('$coursename', '$duration')";
}


    if ($conn->query($sql) === TRUE) {
       $result = 'success';
    } else {
        $result = $conn->error;
    }


mysqli_close($conn);

$url = getBaseUrl().'courses.php';

header('Location: ' . $url);

exit;

?> 