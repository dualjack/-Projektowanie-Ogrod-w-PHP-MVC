<!DOCTYPE html>

<?php

	// --------------------
	// URUCHOMIENIE WITRYNY
	// --------------------
	
	require_once('controller.php');
	
	site::start();						# zainicjowanie sesji
	site::errors(); 					# wyświetlanie błedów
	#mysql::db_connect();				# połącz z bazą danych
	site::notification();				# wyświetlanie powiadomienia z adresu
	
?>

<html>
	
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="icon" type="image/x-icon" href="/elements/images/icon.png">
		<link rel="stylesheet" type="text/css" href="/elements/styles/main.css" />
		<script type="text/javascript" src="/elements/libraries/jquery-2.0.2.min.js"></script>
		<script type="text/javascript" src="/elements/libraries/main.js"></script>
	</head>
	
	<title>Strona domowa Kazimiery</title>
	
	<body>
		
		
		<div class="head">
			
			<div class="banner">
				<div class="center">
				
					<img class="logo" src="/elements/images/logo.png">
				
				</div>
			</div>
			
			<div class="menu">
				<div class="center">
				
					<ul>
						<a href="/" class="home <?php menu('main')?>">&nbsp;</a>
						<a href="/about" class="<?php menu('about')?>">O mnie</a>
						<a href="/offert" class="<?php menu('offert')?>">Oferta</a>
						<a href="/gallery" class="<?php menu('gallery')?>">Galeria</a>
						<a href="/contact" class="<?php menu('contact')?>">Kontakt</a>
					</ul>
				
				</div>
			</div>
		
		</div>
			
		<div class="site_wrapper">

			<?php

				$page = site::url(0); # pobierz pierwszą część adresu
				$sub = site::url(1); # pobierz podstronę
				
				site::load_controller($page);
				
				site::load_template($page,$sub);
				
				site::end();
				
			?>
			
		</div>
		
		<div class="main_footer center">
		
			<div class="info">
				
				<!-- Usunięcie tego fragmentu jest naruszeniem naszej umowy i 
				w tym wypadku zastrzegam sobie prawo do usunięcia strony -->
				<a href="http://dualjack.p.ht">Website engine created by Jakub Kuranda. <br/> All rights reserved. Copyright 2013 K.Białka.</a>
			
			</div>
		
		</div>

	</body>

</html>
