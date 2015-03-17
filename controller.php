<?php

/*	To jest plik z podstawowymi funkcjami potrzebnymi do funkcjonowania strony.
 * 	$db to obiekt połączenia MySQL metodą PDO.
 */

class site {
	
	// ----------- ##
	// ZMIENNE
	// ----------- ##
	
	static $url = "main";								// domyślna główna strona
	static $page_title = "Strona domowa Kazimiery";		// domyslny tytuł strony
	
	
	// ----------- ##
	// FUNKCJE
	// ----------- ##
	
	static function start() {
		
		ob_start();
		
		// jeśli jest jakiś adres w formie /x/y/z
		if(isset($_GET['url'])){
			
			self::$url = explode('/' , $_GET['url']);
			
		} else {
		
			self::$url = array(self::$url);
			
		}
		
	}
	
	static function end() {
		
		$pageContents = ob_get_contents (); // Pobierz całą stronę do string'a
		
		ob_end_clean (); // Wyczyść OB

		echo str_replace ('<!-- TITLE -->' , self::$page_title , $pageContents);
		
	}
	
	static function back($notification = NULL){
		if(isset($_SESSION['last'])){ // Jeśli była poprzednia strona
			$url = $_SESSION['last'];
		} else { $url = "/"; } // Jeśli nie była określona
		
		header("Location: {$url}");
	}
	
	static function title($title){
		
		// zmodyfikuj domyslną nazwę w obiekcie
		self::$page_title = $title;
	}
	
	static function errors(){
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
	
	static function url($x){
		
		// jeśli istnieje taka część adresu
		if(isset(self::$url[$x])) return self::$url[$x];

	}
	
	static function notification(){
		if(isset($_SESSION['nf'])) { // Jeśli w sesji jest notyfikacja

			$nf = explode('|',$_SESSION['nf']); // np. powiadomienie|green
			
			if(isset($nf[1])) $style = 'color:'.$nf[1]; else $style = NULL;
			
			echo '<div class="notify rounded-5px" style="'.$style.'">'.$nf[0].'</div>';
			
			unset($_SESSION['nf']);
		}
	}
	
	static function load_controller($id){
		
		// - ładowanie kontrolerów
		$controller = 'elements/controllers/'.$id.'.php';
		if(file_exists($controller)) include $controller;
	}
	
	static function load_page($id){
		
		// - ładowanie kontekstu
		$content = 'elements/pages/'.$id.'.php';
		if(file_exists($content)) include $content;
		else self::error(404);
	}
	
	static function load_template($id,$sub) {
		
		if($sub == NULL) $sub = "index";
		
		$folder = 'elements/templates/'.$id;
		$template = $folder.'/'.$sub.'.html';
		$engine = $folder.'/'.$sub.'.php';
		
		if(file_exists($folder)) {
		
			// --------
			// HTML
			// --------
		
			if(file_exists($template)) {
				
				include($template);
				
			}
			
			// --------
			// PHP
			// --------
			
			$template = array(); // stwórz tablicę na potrzebę sekcji "PREPARE"
			
			if(file_exists($engine)) {
				
				include($engine);
				
			}
			
			// --------
			// PREPARE
			// --------
			
			$pageContents = ob_get_contents(); // Pobierz całą stronę do string'a
			ob_end_clean(); 					// Wyczyść zawartość strony
			
			foreach($template as $name => $pattern) {
				
				$pageContents = str_replace ("<!-- {$name} -->" , $pattern , $pageContents);
				
			}
			
			echo $pageContents;					// Zwróć przetworzoną stronę
			
			
			
			
		}
		
	}
	
	static function counter_start(){
		return microtime(); // Włącz stoper
	}
	
	static function counter_stop($time){
		return round(microtime()-$time, 3); // Zatrzymaj stoper
	}
	
	static function error($error_type) {
		
		header("Location: /{$error_type}");
		
	}
	
}


class mysql {
	
	#---
	public static $host="";
	public static $user="root";
	public static $pass="Mocher94";
	public static $dbname="test";
	
	public static $db; // nośnik z połączeniem
	#---
	
	static function db_connect(){
		
		### połączaenie z bazą danych - MySQL
		$db=new PDO('mysql:host='.self::$host.';dbname='.self::$dbname,self::$user,self::$pass);
		$db->query("SET NAMES utf8");
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		### ---
		
		mysql::$db = $db;
		
	}
	
	static function db(){
		return mysql::$db;
	}
	
}

class visible {
	
	static function set_default_access(){
		
		// zdefiniuj domyślną wartość autoryzacji
		if(!isset($_SESSION['admin_auth'])) $_SESSION['admin_auth'] = FALSE;
	}
	
	// np. $obiekt->admin("Tego nie zobaczy gość");
	static function admin($html){
		if($_SESSION['admin_auth'] == TRUE)
		{
			echo $html;
		}
	}
		
	static function guest($html){
		if($_SESSION['admin_auth'] == FALSE)
		{
			echo $html;
		}
	}
	
}

function menu($sub) {
	
	if(site::url(0) == $sub) echo 'active';
	
}


?>
