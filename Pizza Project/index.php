<?php 
	
	include('config/db_connect.php');

	//write query for all pizzers
	$sql = 'SELECT title, ingredients, id FROM pizzers ORDER BY created_at';

	//make query & get result 
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an query
	$pizzers = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//free result from memory
	mysqli_free_result($result);

	//close connection
	mysqli_close($conn);

	//explode(',', $pizzers[0]['ingredients']);

   ?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Pizzers!</h4>

	<div class="container">
		<div class="row">

			<?php foreach ($pizzers as $pizzers) { ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo($pizzers['title']); ?></h6>
							<ul>
								<?php foreach(explode(',', $pizzers['ingredients']) as $ing){ ?>
									<li><?php echo ($ing) ?></li>
							<?php } ?>
							</ul>
						</div>
						<div class="card-action right-align">
						<a class="brand-text" href="details.php?id=<?php echo $pizzers['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php } ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>
	
</html>