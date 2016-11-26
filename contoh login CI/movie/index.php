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
			<p align='right'><button onclick=window.location.href='<?php echo base_url("index.php/Movie/insert");?>' class='btn btn-primary'> <span class='glyphicon glyphicon-plus-sign' aria-hidden='true'></span>Movie</button></p>
		<?php
		echo "<table class='table table-striped table-bordered' id='example' >";
		echo    "<thead>
				<tr>
					<td></td>
					<td>Title</td>
					<td>Year</td>
					<td>Director</td>
					<td>Action</td>

				</tr>
				</thead>";
		echo    "<tfoot>
				<tr>
					<td></td>
					<td>Title</td>
					<td>Year</td>
					<td>Director</td>
					<td>Action</td>

				</tr>
				</tfoot>";
		foreach($query->result() as $line)
			{
			echo "<tr>";
			echo "<td>";
				echo $line->id;
			echo "</td>";
			echo "<td>";
				echo $line->title;
			echo "</td>";
			echo "<td>";
				echo $line->year;
			echo "</td>";
			echo "<td>";
				echo $line->director;
			echo "</td>";
			echo "<td>";
				
				echo "<a href='".base_url("index.php/Movie/view")."/".$line->id."' class='btn btn-info'><span class='glyphicon glyphicon-search' aria-hidden='true'></span></a>";
				echo "<a href='".base_url("index.php/Movie/edit")."/".$line->id."' class='btn btn-warning'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a>";
			echo "</td>";
			
			echo "</tr>";
			}
		echo "</table>";
	

	?>
	<div class="row">
		<div class="col-md-12"><?php echo $crud['output'];?></div>
	</div>	
    </div> <!-- /container -->
	<?php echo $footer ?>
	
	<?php echo $script ?>
</body>
</html>