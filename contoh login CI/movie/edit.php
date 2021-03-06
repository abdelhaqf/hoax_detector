<!DOCTYPE html>
<html lang="en">
<head>
<?php 
	echo $style; 
?>
</head>

<body>
	<?php echo $navbar ?>
    <?php $line = $query->row_array(); ?>
		<form class='form-horizontal' action='<?php echo base_url("index.php/Movie/edit_movie");?>' method='post'  enctype="multipart/form-data">
			<input type='hidden' class='form-control' name='id' value="<?php echo $line['id']; ?>">
            <div class='form-group'>
				<label class ='control-label col-sm-2'>Title</label>
				<div class='col-sm-5'>
					<input type='text' class='form-control' name='title' value="<?php echo $line['title'];?>">
				</div>	
			</div>
			<div class='form-group'>
				<label class ='control-label col-sm-2' >Year</label>
				<div class='col-sm-5'>
                	<input type='number' class='form-control onput-no-spinner' name='year' value="<?php echo $line['year'];?>" style="-moz-appearance: textfield">
				</div>	
			</div>
	
			<div class='form-group'>
				<label class ='control-label col-sm-2' >Director</label>
				<div class='col-sm-5'>
					<input type='text' class='form-control' name='director' value="<?php echo $line['director'];?>" >
				</div>
			</div>
            <div class='form-group'>
				<label class ='control-label col-sm-2' >Current Poster</label>
				<div class='col-sm-5'>
					<img src="<?php echo base_url("uploads") ."/". $line['image'];?>"> 
				</div>
			</div>
			<div class='form-group'>
				<label class ='control-label col-sm-2' >New Poster</label>
				<div class='col-sm-5'>
					<input type='file' class='form-control' name='poster'> 
				</div>
			</div>
			

				<p align='center'>
				<button type='submit' class='btn btn-primary' name='submit'>Submit</button>
				<a href='<?php echo base_url("index.php/Movie"). "/" . $line['image'];?>'><button type="button"   class='btn btn-default' ;  >Cancel</button></a></p>
		</form>
		
	<?php echo $footer ?>
	<?php echo $script ?>
</body>
</html>