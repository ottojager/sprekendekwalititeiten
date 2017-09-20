<?php
session_start();
if (isset($_POST['makeLobbyButton'])) {
	if (strlen($_POST['name']) >= 3) {
		// generate game id
		$id = '';
		for ($i = 0; $i != 3; $i++) {
			$id .= chr(mt_rand(65, 90)); // random uppercase ASCII character
		}

		$game = array(
			'game_id' => $id,
			'leader_name' => $_POST['name'],
			'players' => array(),
			'game_started' => false,
		);

		file_put_contents("./games/$id.json", json_encode($game));

		$_SESSION['player_id'] = 9;
		$_SESSION['game_id'] = $id;
		header('Location: lobby.php');
	} else {
		$error = 'Naam moet minimaal 3 characters bevaten.';
	}
}
?>
<!DOCTYPE html>
<html lang="nl=NL">
	<head>
		<title>Speelvorm 2</title>
		<link rel="stylesheet" href="css/cr_stylesheet.css" type="text/css">
		<link rel="icon" sizes="16x16" type="image/png" href="css/Rainbow_placeholder.png">
	</head>
	<body>
		<div>
<?php
			if (isset($error)) {
				echo "<p>$error</p>";
			}
			?>
			<form method="post">
				<h1>Kwaliteitenspel</h1>
				<div id="formstyle">
					<label>Naam:</label>
					<input type="text" name="name">
					<input type="submit" value="Maak Lobby" name="makeLobbyButton">
				</div>
			</form>
		</div>
	</body>
</html>
