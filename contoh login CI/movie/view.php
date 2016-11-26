<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	echo $style; 
?>
</head>

<body>
	<?php echo $navbar ?>
   <div class="container">
   <?php 
   $line=$query->row_array();
   if(isset($line))
	{echo "<h1>". $line['title'] ."</h1>";
	echo "<hr>";
	echo "<p>";
	echo "Release  : ". $line['year'];
	echo "<br>Director : " . $line['director'] . "<br>";
	echo "<img src='". base_url("uploads"). "/" . $line['image'] . "'>";
	 
	}
   ?>
   
	</div> <!-- /container -->
	<?php echo $footer ?>
	
	<?php echo $script ?>
</body>
</html>