<?php
if(isset($_POST["token"])) $port=$_POST["token"];
$host=gethostbyname(php_uname('n'));
echo "<html><head><script>";
echo "var port = ".json_encode($port)." ;"; 
if(isset($_POST["nick"])) echo "var nick = ".json_encode($_POST['nick'])." ;";
echo "</script>";
?>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<body style="overflow: hidden;">
	<script>
	var conn = new WebSocket('ws://'+window.location.hostname+':'+port);
	var msg;
	conn.onopen = function(e) {
		$("#messages").append('<div class="list-group-item list-group-item-success list-group-item-action flex-column align-items-start w-100">welcome <b>'+nick+'</b>!</div>');
		conn.send(nick);
		document.getElementById("sender").disabled=false;
	};
	conn.onmessage = function(msg) {
		$("#messages").append('<div class="list-group-item list-group-item-action flex-column align-items-start w-100">'+msg.data+'</div>');
	};
	conn.onerror = function(err) {
		$("#messages").append('<div class="list-group-item list-group-item-danger list-group-item-action flex-column align-items-start w-100">Connect impossible</div>');
		document.getElementById("sender").disabled=true;
	};
	function sendMessage(txt) {  
		msg = {
		'nick':nick,
		'message':txt
		};
		conn.send(JSON.stringify(msg));       
		$("#tekst").val('');
	} 
	</script>
	<div class="container-fluid">
		<div class="row justify-content-center align-items-center h-100">
			<div class='col-12 col-lg-6'>
				<div class='card text-white bg-primary h-100 mh-100'>
					<div class="card-header">Room nr <?php echo $port . " user: ". $_POST["nick"]; ?></div>
					<div class="card-body">
						<div class='list-group w-100 h-100 mh-100' id='messages' style="overflow: auto;">

						</div>
					</div>
					<div class="card-footer">
						<div class="input-group">
							<textarea name='tekst' class="form-control" id="tekst" formmethod='post' rows='2' cols='80' placeholder='Send message...' style="resize: none; overflow: auto;" onkeyup="if(event.keyCode==13) sendMessage(this.value);"></textarea>
							<div class="input-group-append">
							<button class="btn btn-success" formmethod="post" rows='4' id="sender" name="wyslij" onclick="sendMessage(document.getElementById('tekst').value);" disabled>Send</button>
							</div>
						</div>
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