<?
#	LR DESIGN - CMS SYSTEM
#	Built: 10-Feb-2010   /  Created by: Robert van Klooster

#	Database functions
	defined('LR_ACCESS') or die('Geen directe toegang mogelijk!');

	class Template{
		
		protected 	$options = array('template_dir' => '/templates/', 'extract' => true);
		protected 	$vars = array();
		public 		$dirs = array();

		public function __construct($options = array()){
			foreach($this->options as $option_key => $value){
				if(!empty($options[$option_key])){
					$this->options[$option_key] = $options[$option_key];
				}
			}
		}
	
		public function assign($key,$value){
			$this->vars[(string)$key] = $value;
		}
		
		public function __set($key,$value){        
			$this->assign($key,$value);
		}
		
		public function get_var($key,$default=null){
			$return = $default;
			if(isset($this->vars[(string)$key])){
				$return = $this->vars[(string)$key];
			}
			return $return;
		}
		
		public function get_vars(){
			return $this->vars;
		}
		
		public function __get($key){
			return $this->get_var($key);
		}
		
		public function fetch($file){ 
		
			$dir = str_replace($_SERVER['DOCUMENT_ROOT'],"",$this->options['template_dir']);
			$files = $_SERVER['DOCUMENT_ROOT'].$dir.(string)$file;
			
			if(file_exists($files)){
				ob_start();
				if($this->options['extract']){
					extract($this->vars);
				}
				include $files;
				return ob_get_clean();
			}
			else die(ErrorReporing::Message("De template `".$dir.$file."` is niet gevonden."));
		}
		
		public function display($file){
			echo $this->fetch($file);
		}
		
		public function content($file){
			return $this->fetch($file);
		}
	}

?>