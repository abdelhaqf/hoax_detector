<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php	
	
	if(isset($_POST['submit'])){
	$nim = $_POST['nim'];
	$nim = htmlspecialchars($nim);
	$nim = htmlentities($nim);
	$nim = strip_tags($nim);
	
	
	$firstname = $_POST['firstname'];
	$firstname = htmlspecialchars($firstname);
	$firstname = htmlentities($firstname);
	$firstname = strip_tags($firstname);

	
	$lastname = $_POST['lastname'];
	$lastname = htmlspecialchars($lastname);
	$lastname = htmlentities($lastname);
	$lastname = strip_tags($lastname);
	
	
	$desc = $_POST['desc']; 
	$desc = htmlspecialchars($desc);
	$desc = htmlentities($desc);
	$desc = strip_tags($desc);
	
	
	
	$conn = new PDO('mysql:host=localhost;dbname=pemweb','user','admin');
	$nim=$conn->quote($nim);
	$firstname=$conn->quote($firstname);
	$lastname=$conn->quote($lastname);
	$desc=$conn->quote($desc);
	$str = "insert into mahasiswa(firstname,lastname,nim,description) values ($firstname,$lastname,$nim,$desc)";
	
	$data = $conn->query($str);
	header('Location: tugas1.php');
	}
	?>
</head>

<body>
</body>
</html>