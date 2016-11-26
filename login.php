<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<?php
	session_start();
	$_SESSION['error']="";
	if(isset($_POST['submit']))
	{
		
		if(isset($_POST['email']) && isset($_POST['password']))
		{
			
			$conn = new PDO('mysql:host=localhost;dbname=pemweb','user','admin');
			$e=$_POST['email'];
			$email = htmlspecialchars($e);
			$email = htmlentities($email);
			$email = strip_tags($email);
			$email=$conn->quote($email);
			$pass= $_POST['password'];
			$stmt=$conn->prepare("select password,salt from login where email = $email limit 1");
			$stmt->execute();$row=$stmt->fetch();
			$pass_salt=$pass . $row["salt"];
			$hash=md5($pass_salt);
			
			if(strcmp($row["password"],$hash)==0)
			{
				$_SESSION['sign']='true';
				header("Location: tugas1.php"); 
				
			}
			else
			{
				$_SESSION['error']='Email or Password Invalid';
				header("Location: tugas1.php");
			}
			
			
		}
		
		
	}
	
	






?>



</head>

<body>
</body>
</html>