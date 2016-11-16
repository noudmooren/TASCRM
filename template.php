<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	Template functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	require_once("error.php");
	
#	Create lay-out	
	function layout($template, &$systemconfig)
	{
		ob_start();
			if(file_exists($template.'/template.php')):
				require_once($template.'/template.php');
			else:
				die(error('Template "'.$template.'" doesn\'t exists!'));
			endif;
			$lay_out = ob_get_contents();
		ob_end_clean();
		
		$layout = striptags($lay_out, array('system', 'system:include'), TRUE);
		$string = array("/\<system:include (.*?)\=\"(.*?)\"\ (.*?)\=\"(.*?)\"\ (.*?)\=\"(.*?)\"\ (.*?)\=\"(.*?)\" \\/\>/is" 
						=> "[ [\$1=\$2/][\$3=\$4/][\$5=\$6/][\$7=\$8/] /]");
		$layout = preg_replace(array_keys($string), array_values($string), $layout);
		$layout = preg_split("/\[\ (.*?)\ \/\]/is",$layout,-1, PREG_SPLIT_DELIM_CAPTURE);
		array_walk($layout, 'trim_value');
		
		foreach($layout as $codes):
			if(!empty($codes)):
				$code = preg_split("/\[(.*?)\/\]/is", $codes, -1, PREG_SPLIT_DELIM_CAPTURE);
				$type = str_replace('type=', '', $code[1]);
				$position = str_replace('position=', '', $code[3]);
				$systemmodule = str_replace('systemmodule=', '', $code[5]);
				$style = str_replace('style=', '', $code[7]);
				$html_str_1 = '<system:include type="'.$type.'" position="'.$position.'" systemmodule="'.$systemmodule.'" style="'.$style.'" />';
				$html_str_2 = '<system:include type="'.$type.'" position="'.$position.'" systemmodule="'.$systemmodule.'" style="'.$style.'">';
				if($type == 'module'):
					$type = 'systemmodule';
				endif;
				$systemstring = $type.'/'.$systemmodule.'/view/manager.php';
				ob_start();
					if(file_exists('systemmodule/index.php')):
						require('systemmodule/index.php');
					else:
						die(error('Module index file doesn\'t exists!'));
					endif;
					$replace_html = ob_get_contents();
				ob_end_clean();
				$lay_out = str_replace($html_str_1, $replace_html, $lay_out);
				$lay_out = str_replace($html_str_2, $replace_html, $lay_out);
			endif;
		endforeach;
		echo $lay_out;
	}
?>