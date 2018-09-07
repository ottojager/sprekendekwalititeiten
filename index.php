<!DOCTYPE html>
<html lang="nl=NL">
	<head>
		<meta charset="utf-8">
		<link rel="icon" sizes="16x16" type="image/png" href="bewustwording/Rainbow_placeholder.png">
		<link rel="stylesheet" href="index.css" type="text/css">
		<link rel="stylesheet" href="./stylesheets/header.css" type="text/css">
		<link rel="stylesheet" href="./stylesheets/footer.css" type="text/css">
		<title>Kwaliteitenspel</title>
	</head>
	<body>
		<?php include('header.php') ?>
		<main class="container">
			<div id="topbar"></div>
				<div id="sidetopbar">
					<div id="borderimage"></div>
					<div id="player__name"></div>
				</div>
			<h1>Kwaliteitenspel</h1>
			<h2>Welkom bij het Kwaliteitenspel</h2>
			<p></p>
			<div id="knoppen">
				<a href="./bewustwording">Speel alleen</a>
				<a href="./feedback/join.php">Speel samen</a>
				<a href="./feedback/create.php">Begeleider? Klik hier</a>
			</div>
		</main>
		<?php include('footer.php') ?>
	</body>
</html>
