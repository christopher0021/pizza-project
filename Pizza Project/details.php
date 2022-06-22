<?php 

	include('config/db_connect.php');

	if (isset($_POST['delete'])) {
		
		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM pizzers WHERE id = $id_to_delete";

		if (mysqli_query($conn, $sql)) {
		//success
		header('location: index.php');
		} {
		//failure
		echo 'query error: ' . mysqli_error($conn);
		}
	}

	// check GET request id param
	if (isset($_GET['id'])) {

		$id = mysqli_real_escape_string($conn, $_GET['id']);

		//make sql
		$sql = "SELECT * FROM pizzers WHERE id = $id";

		//get the query result
		$result = mysqli_query($conn, $sql);

		//fetch result in array format
		$pizzers = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

}

 ?>

 <!DOCTYPE html>
 <html>

 	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if ($pizzers): ?>

			<h4><?php echo ($pizzers['title']); ?></h4>
			<p>Created by: <?php echo ($pizzers['email']); ?></p>
			<p><?php echo date($pizzers['created_at']); ?></p>
			<h5>Ingredients: </h5>
			<p><?php echo ($pizzers['ingredients']); ?></p>

			<!-- Delete Form -->

			<form>
				<input type="hidden" name="id_to_delete" value="<?php echo $pizzers['id'] ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>	

		<?php else: ?>
			<h5>no pizzers here!</h5>
		<?php endif; ?>	

	</div>

 	<?php include('templates/footer.php'); ?>


 </html>