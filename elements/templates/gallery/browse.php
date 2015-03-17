<?php

	$folder = site::url(2); 						# trzeci człon adresu = nazwa folderu
	$path = "elements/gallery_photos/{$folder}";	# sciezka do folderu
	
	if(file_exists( $path."/folder.txt" )) {
		
		$folder_info = file_get_contents( $path."/folder.txt" );	# opis folderu
		
		$template['GALLERY_DESCRIPTION'] = $folder_info;
		
	}
	
	if(file_exists( $path )) {
	
		// utwórz tablicę plików w folderze (pomiń kropki)
		$list = array_diff( scandir($path), array('..', '.','folder.txt','thumbnails') );
		
		natsort($list); # sortuj w sposób naturalny
		
		
		foreach( $list as $file ) {
			
			echo "<a href='/{$path}/{$file}' rel='lightbox[gallery]>'><img class='gallery_image' src='/{$path}/thumbnails/{$file}'></a>";
			
		}
		
	} else {
		
		echo "Folder <span style='color:red'>{$path}</span> nie istnieje!";
		
	}

?>
