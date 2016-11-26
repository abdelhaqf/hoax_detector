<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	echo $style; 
?>
</head>

<body>
	<?php echo $navbar ?>
    
		<form class='form-horizontal' action='<?php echo base_url("index.php/Movie/add_movie");?>' method='post' enctype="multipart/form-data">
			<div class='form-group'>
				<label class ='control-label col-sm-2'>Title</label>
				<div class='col-sm-5'>
					<input type='text' class='form-control' name='title'>
				</div>	
			</div>
			<div class='form-group'>
				<label class ='control-label col-sm-2' >Year</label>
				<div class='col-sm-5'>
                	<input type='number' class='form-control input-no-spinner' style="-moz-appearance: textfield" name='year'>
				</div>	
			</div>
	
			<div class='form-group'>
				<label class ='control-label col-sm-2' >Director</label>
				<div class='col-sm-5'>
					<input type='text' class='form-control' name='director'>
				</div>
			</div>
			<div class='form-group'>
				<label class ='control-label col-sm-2' >Poster</label>
				<div class='col-sm-5'>
					<input type='file' class='form-control' name='poster'> 
				</div>
			</div>
			

				<p align='center'>
				<button type='submit' class='btn btn-primary' name='submit'>Submit</button>
				<a href='<?php echo base_url("index.php/Movie");?>'><button type="button"   class='btn btn-default' ;  >Cancel</button></a></p>
		</form>
		
	<?php echo $footer ?>
	<?php echo $script ?>
</body>
</html>