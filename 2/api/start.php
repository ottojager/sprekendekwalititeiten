<?php
// file called to start the game
session_start();
if ($_SESSION['player_id'] == 9 && isset($_SESSION['game_id'])) {
	//TODO: add check for minimum amount of players
	$game = $_SESSION['game_id'];
	$json = (array)json_decode(file_get_contents("../games/$game.json"));
	$json['game_started'] = true;

	// Create card stack
	// TODO: change this once we have a more central database
	$db = mysqli_connect('localhost', 'root');
	if (!$db) {
		$db = mysqli_connect('localhost', 'root', 'r00t');
	}
	mysqli_select_db($db, "kwaliteitenspel");
	$sql = "SELECT * FROM cards";
	$result = mysqli_query($db, $sql);
	$card_stack = array();
	while ($card = mysqli_fetch_assoc($result)) {
	    $card_stack[] = $card['name'];
	}
	shuffle($card_stack);

	// create player card stacks
	foreach($json['players'] => $key) {
		$json['players'][$key]['stack'] = array();
	}
	$json['card_stack'] = $card_stack;
	file_put_contents("../games/$game.json", json_encode($json));
} else {
	header('HTTP/1.1 403 Forbidden');
}
?>