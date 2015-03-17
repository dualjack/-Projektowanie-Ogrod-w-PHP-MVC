<?php
	
	if( isset( $_POST['submit'] )) { // -- jeśli jest informacja o "submit"
		
		print_r($_POST);
		
		if(empty($_POST['mail']) or empty($_POST['text'])) {
			
			
			
		} else {
		
			// Formatowanie nagłówków
			$naglowki = "Reply-to: {$_POST['mail']}  < {$_POST['mail']} >".PHP_EOL;
			$naglowki .= "From: {$_POST['mail']}  < {$_POST['mail']} >".PHP_EOL;
			$naglowki .= "MIME-Version: 1.0".PHP_EOL;
			$naglowki .= "Content-type: text/html; charset=utf-8".PHP_EOL; 

			// Formowanie treści
			$wiadomosc = "<html> 
			<head> 
			  <title>Kontakt z klientem</title> 
			</head>
			<body>
			  {$_POST['text']}
			</body>
			</html>";


			if(mail('kontakt@', 'Kontakt', $wiadomosc, $naglowki))
			{
				
				
			  
			} else {
				
				
				
			}
		}
		
	}
?>
