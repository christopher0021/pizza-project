<?php 

	include('config/db_connect.php');

	$email = $title = $ingredients = '';
	$error = array('email'=>'','title'=>'','ingredients'=>'');

	if(isset($_POST['submit'])){
		if (empty($_POST['email'])){
			$error['email'] = 'email is required <br>';
		}else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$error['email'] = 'email must be valid email address<br>';
			}
		}
		if (empty($_POST['title'])){
			$error['title'] = 'title is required <br>';
		}else{
			$title = $_POST['title'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
				$error['title'] = 'Title must be letters and spaces only<br>';
			}
		}	
		if (empty($_POST['ingredients'])){
			$error['ingredients'] = 'atleast one ingredient is required <br>';
		}else{
			$ingredients = $_POST['ingredients'];
		if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
			$error['ingredients'] = 'ingredients must be a comma separated list<br>';
		}
	}

	if (array_filter($error)) {
		echo '';
	}else{

		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

		//create sql
		$sql ="INSERT INTO pizzers(title,email,ingredients) VALUES('$title','$email','$ingredients')";

		if(mysqli_query($conn,$sql)){

		header('location: index.php');
		} else {
			echo 'query error' . mysqli_error($conn);
		}

	
	}
	
}


 ?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email:</label>
			<input type="text" name="email" value ="<?php echo $email ?>">
			<div class="red-text"><?php echo $error['email']; ?></div>
			<label>Pizzer Title:</label>
			<input type="text" name="title" value ="<?php echo $title ?>">
			<div class="red-text"><?php echo $error['title']; ?></div>
			<label>Ingredients (comma separated):</label>
			<input type="text" name="ingredients" value ="<?php echo $ingredients ?>">
			<div class="red-text"><?php echo $error['ingredients']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"></input>
			</div>
		</form>
	</section>
	<?php include('templates/footer.php'); ?>
	
</html>