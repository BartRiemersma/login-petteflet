<?php




if (count($nodata) > 0) : ?>
	<div class="error">
		<?php foreach ($nodata as $nodata) : ?>
			<p><?php echo $nodata ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>


<?php
if (count($errors) > 0) : ?>
	<div class="error">
		<?php foreach ($errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif


 ?>
