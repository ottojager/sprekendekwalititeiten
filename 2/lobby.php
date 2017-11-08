<?php
session_start();

if (!isset($_SESSION['game_id'])) {
	header('location: ./');
}
$game = $_SESSION['game_id'];
$json = json_decode(@file_get_contents("./games/$game.json"), true);
if (!(bool)$json) { // if $json actually has content
	@unlink("../games/$game.json"); // delete the empty file if one were to exist
	header('Location: ./delete.php'); // send the user to delete.php to have their session cleared
}
?>
<!DOCTYPE html>
<html lang="nl=NL">
	<head>
		<title>Lobby - Feedback - Kwaliteitenspel</title>
		<script src="api/js/std.js"></script>

		<?php
		// java script only needed for the game leader
		if ($_SESSION['player_id'] == 11) {
		?>
			<script>
				function start_game() {
					var xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							window.location.href = 'game.php';
						}
					};
					xhttp.open("GET", "http://localhost/kwal-spel/2/api/start.php", true);
					xhttp.send();
				}
				</script>
		<?php } // end of leader only javascript ?>

		<script>
			var id = <?php echo $_SESSION['player_id']; ?>;

			window.setInterval(function(){
				start_update();
				if (game_info["game_started"] == true) {
					window.location.href = 'game.php';
				}

				if (game_info['players'][id] == []) { // when the user doesn't "exist"
					window.location.href = './';
				}

				//document.getElementById("leader").innerHTML = game_info["leader_name"];
				var list = document.getElementById("player_list");
				list.innerHTML = '';
				game_info["players"].forEach(function(item, index){
					var child = document.createElement('li');
					child.innerHTML = item['name'];

					<?php if ($_SESSION['player_id'] == 11) { ?>
						var button = document.createElement('button');
						button.onclick = function() {
							var xhttp = new XMLHttpRequest();
							xhttp.open("GET", "http://localhost/kwal-spel/2/api/kick.php?p="+index, false);
							xhttp.send();
						}
						button.innerHTML = 'X';
						child.appendChild(button);
					<?php } ?>

					list.appendChild(child);
				});

				// these never update and are thus not needed
				//document.getElementById("game_id").innerHTML = game_info['game_id'];
				//document.getElementById("leader").innerHTML = 'Leider: ' + game_info['leader_name'];
				//document.getElementById("player_list").innerHTML = game_info[""];
			}, 3000);
		</script>
	<link rel="stylesheet" href="css/lobby_stylesheet.css" type="text/css">
	<link rel="icon" sizes="16x16" type="image/png" href="css/Rainbow_placeholder.png">
	</head>
	<body>
		<div id="main">
			<h2 id="game_id">Spel code:</h2>
			<?php
			echo '<p>'.$json['game_id'].'</p>';
			echo '<p id="leader">Leider: '.$json['leader_name'].'</p>';
			echo '<ol id="player_list">';
			foreach ($json['players'] as $key => $value) {
				if ($_SESSION['player_id'] == 11) {
					echo '<li>'.$value['name'].'<button onclick="alert(\''.$key.'\')">X</button></li>';
				} else {
					echo '<li>'.$value['name'].'</li>';
				}
			}
			echo '</ol>';
			?>
		<?php
		if ($_SESSION['player_id'] == 11) {
			?><button onclick="start_game()">Start spel</button><?php
		}
		?>
		</div>
	</body>
</html>
