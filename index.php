<html>
	<head>
		<meta charset="utf-8">
		<title>Communicator</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center h-100">
				<div class='col-12 col-lg-6'>
					<div class='card text-white bg-primary'>
						<div class="card-header"><h3>Communicator</h3></div>
						<div class="card-body">
							<form action="chat.php" method="post" target="_blank">
							<input type="text" class="form-control" id="nick" name="nick" placeholder="enter a your nick" minlength="3" maxlength="20"/>
							<input type="number" class="form-control" id="token" name="token" placeholder="enter a chat token"/>						
							<input class="btn btn-success col-12" type="submit" value="go into a room"/><br>
							</form>
						</div>
						<div class="card-footer">
						<p id="alert"></p>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	</body>
</html>