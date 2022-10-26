<?php 

	include('config/db_connect.php');

	// write query for all pizzas
	$sql = 'SELECT title, details, id FROM tickets ORDER BY created_at';

	// get the result set (set of rows)
	$result = mysqli_query($conn, $sql);

	// fetch the resulting rows as an array
	$tickets = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free the $result from memory (good practise)
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);


?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Tickets!</h4>

	<div class="container">
		<div class="row">

			<?php foreach($tickets as $ticket): ?>

				<div class="col s6 m4">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($ticket['title']); ?></h6>
							<ul class="grey-text">
								<?php foreach(explode(',', $ticket['details']) as $det): ?>
									<li><?php echo htmlspecialchars($det); ?></li>
								<?php endforeach; ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="details.php?id=<?php echo $ticket['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

			<?php if (!$tickets) : ?>
				<h5><?php echo "There are no tickets right now! Grab a cup of coffee and wait for 'em!" ?></h4>
		<?php endif ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>