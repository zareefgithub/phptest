	<?php require_once __DIR__ .'\includes\autoload.php'; ?>

	<div class="container" style="margin: 0 auto; max-width:1000px; min-height:600px; height: 700px;">

		<div class="form">
			<form method="POST" action="includes/process.php">
				Name : <input type="text" name="name" /><br>
				Email : <input type="text" name="email" /><br>
				Password : <input type="password" name="password" /><br>
				Phone Number : <input type="text" name="phone" /><br>
				<input type="submit" name="submit" value="Proceed">
			</form>
		</div>
	</div>

