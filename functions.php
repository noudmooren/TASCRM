<?
#	TAS Telefoon Registratie Systeem
#	Built: 11-May-2011   /  Created by: LR Design Websolutions Venray - Robert van Klooster

#	System Get functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
	
	require_once('module.php');
	
	$systemconfig = new systemconfig();
	
	class Log{
		
		static function Add($text, $callid = false, $customerid = false){
			SYSTEMQUERY("
				INSERT INTO
					`log_log`
				SET
					`call_id` 		= '".$callid."',
					`customer_id` 	= '".$customerid."',
					`userid` 		= '".$_SESSION['login']."',
					`comment`		= '".$text."',
					`data` 			= '".@urlencode(@json_encode($_POST))."'",$db,ALL);
		}
	}
	
	
	class Get{
					
		#	Get Template folders
			static function map($item)
			{
				switch($item)
				{
					case js:
						return 'template/js/';
					break;
					case template:
						return 'template/';
					break;
					case images:
						return 'template/images/';
					break;
					case css:
						return 'template/css/';
					break;
				}
			}
			
			static function print_r($item)
			{
				echo '<pre>';
				print_r($item);
				echo '<pre>';
				
			}
			
		#	Get delivery options
			static function __delivery_options__()
			{
				return array("1" => "PER MAIL", "2" => "PER FAX", "3" => "PER TELEFOON");
			}
			
			
			
		#	Get delivery options
			static function __department__()
			{
				return array("1" => "Gesprekken", "2" => "Overige kosten", "5" => "Overige gesprekken", "3" => "Fax/E-mail berichten", "4" => "Agenda beheer", "6" => "Overige agenda");
			}
		
		#	Get Make Array from database data
			static function MakeArray($item)
			{
				$items = explode('&&&&',$item);
				foreach($items as $data):
					$datas = explode('%%%%',$data);
					$array[$datas[0]] = $datas[1];
				endforeach;
				
				array_pop($array);
				
				return $array;				
			}
			
		#	Get Make Array from database data
			static function MakeArray1($item)
			{
				$items = explode('&&&&',$item);
				foreach($items as $data):
					$datas1 = explode('%%%%',$data);
					$datas2 = explode('@@@@',$datas1[1]);
					$datas3 = explode('$$$$',$datas2[0]);
					$array[$datas1[0]][check] = $datas3[1];
					$array[$datas1[0]][code] = $datas3[0];
					$array[$datas1[0]][price] = $datas2[1];
					
				endforeach;
				
				array_pop($array);
				
				return $array;				
			}
		
		#	Get Make Array from database data
			static function MakeArray2($item)
			{
				$items = explode('&&&&',$item);
				foreach($items as $data):
					$datas1 = explode('%%%%',$data);
					$datas2 = explode('@@@@',$datas1[1]);
					$datas3 = explode('$$$$',$datas2[0]);
					if($datas3[1] == 1):
						$array[] = $datas3[0];
					endif;
				endforeach;
				
				return $array;				
			}
		
		#	Get Long date
			static function date($item)
			{
				$months = Lang::Defaults('months');
				$days	= Lang::Defaults('days');
				$dayn	= $days[date('w', strtotime($item))];
				$day	= date('j', strtotime($item));
				$month	= $months[date('n', strtotime($item))-1];
				$year	= date('Y', strtotime($item));
				$date	= $day.' '.$month.' '.$year;
				return $date;
			}
			
			static function specialchars($text)
			{
				$text = htmlspecialchars($text, ENT_QUOTES);
				
				$text = str_replace(array("é", "ê", "ë", "è"), array("&eacute;", "&ecirc;", "&euml;", "&egrave;"), $text);
				$text = str_replace(array("à", "á", "â", "ã", "ä", "å", "æ"), array("&agrave;", "&aacute;", "&acirc;", "&atilde;", "&auml;", "&aring;", "&aelig;"), $text);
				$text = str_replace(array("ì", "í", "î", "ï"), array("&igrave;", "&iacute;", "&icirc;", "&iuml;"), $text);
				$text = str_replace(array("ò", "ó", "ô", "õ", "ö"), array("&ograve;", "&oacute;", "&ocirc;", "&otilde;", "&ouml;"), $text);
				return $text;
			}
			
			static function online()
			{
				
				if($_SESSION['login']):
					SYSTEMQUERY("UPDATE #__login SET last_online='".time()."' WHERE id='".$_SESSION['login']."'",$db,ALL);
				endif;
				
				$onlinetijd = "300";
				foreach(SYSTEMQUERY("SELECT * FROM #__login WHERE active='1' AND owner IN (".App::UserSee().") ORDER BY last_online",$db,SELECT) as $online){
					if($online->last_online + $onlinetijd > time()){
						$data[] = $online->id;						
					}
				}
				
				return $data;
				
			}

		#	Get Short date
			static function date2($item)
			{
				$months = Lang::Defaults('months');
				$days	= Lang::Defaults('days');
				$dayn	= $days[date('w', strtotime($item))];
				$day	= date('j', strtotime($item));
				$month	= $months[date('n', strtotime($item))-1];
				$year	= date('Y', strtotime($item));
				$date	= $dayn.' '.$day.' '.$month;
				return $date;
			}
			
		#	Get Short date
			static function date3($item)
			{
				$months = Lang::Defaults('months');
				$days	= Lang::Defaults('days');
				$dayn	= $days[date('w', strtotime($item))];
				$day	= date('j', strtotime($item));
				$month	= $months[date('n', strtotime($item))-1];
				$year	= date('Y', strtotime($item));
				$date	= $dayn.' '.$day.' '.$month.' '.$year;
				return $date;
			}
			
		#	Get Short date
			static function date4($item)
			{
				$days	= Lang::Defaults('days');
				$dayn	= $days[date('w', strtotime($item))];
				$date	= $dayn;
				return $date;
			}
			
		#	Get Short date
			static function date5($item)
			{
				$daysaf	= Lang::Defaults('daysaf');
				$dayn	= $daysaf[date('w', strtotime($item))];
				$date	= $dayn;
				return $date;
			}
				
		#	Return GET data
			static function data($item){
				return $_GET[$item];
			}
			
			static function Title($item){
				
				$item = stripslashes($item);
				
				$string = str_replace(' ',' ',$item);
				$string = str_replace('~','',$string);
				$string = str_replace('`','',$string);
				$string = str_replace('!','',$string);
				$string = str_replace('@','',$string);
				$string = str_replace('#','',$string);
				$string = str_replace('$','',$string);
				$string = str_replace('%','',$string);
				$string = str_replace('^','',$string);
				$string = str_replace('&','en',$string);
				$string = str_replace('*','',$string);
				$string = str_replace('(','',$string);
				$string = str_replace(')','',$string);
				$string = str_replace('=','',$string);
				$string = str_replace('{','',$string);
				$string = str_replace('[','',$string);
				$string = str_replace(']','',$string);
				$string = str_replace('}','',$string);
				$string = str_replace(';','',$string);
				$string = str_replace(':','',$string);
				$string = str_replace('"','',$string);
				$string = str_replace('\'','',$string);
				$string = str_replace('|','',$string);
				$string = str_replace('?','',$string);
				$string = str_replace('/','',$string);
				$string = str_replace('<','',$string);
				$string = str_replace('>','',$string);
				$string = str_replace(',','',$string);
				$string = str_replace('.','',$string);	
				
				//$string = utf8_encode($string);
				$string = strtr($string, get_html_translation_table(HTML_ENTITIES));
					
				# ë ï ü ö ä
				$string = str_replace('&euml;','e',$string);	
				$string = str_replace('&Euml;','E',$string);
				$string = str_replace('&iuml;','i',$string);
				$string = str_replace('&Iuml;','I',$string);
				$string = str_replace('&uuml;','u',$string);	
				$string = str_replace('&Uuml;','U',$string);
				$string = str_replace('&ouml;','o',$string);
				$string = str_replace('&Ouml;','O',$string);
				$string = str_replace('&auml;','a',$string);
				$string = str_replace('&Auml;','A',$string);
				
				# é í ú ó á
				$string = str_replace('&eacute;','e',$string);	
				$string = str_replace('&Eacute;','E',$string);
				$string = str_replace('&iacute;','i',$string);
				$string = str_replace('&Iacute;','I',$string);
				$string = str_replace('&uacute;','u',$string);	
				$string = str_replace('&Uacute;','U',$string);
				$string = str_replace('&oacute;','o',$string);
				$string = str_replace('&Oacute;','O',$string);
				$string = str_replace('&aacute;','a',$string);
				$string = str_replace('&Aacute;','A',$string);
				
				# è ì ù ò à
				$string = str_replace('&egrave;','e',$string);	
				$string = str_replace('&Egrave;','E',$string);
				$string = str_replace('&igrave;','i',$string);
				$string = str_replace('&Igrave;','I',$string);
				$string = str_replace('&ugrave;','u',$string);	
				$string = str_replace('&Ugrave;','U',$string);
				$string = str_replace('&ograve;','o',$string);
				$string = str_replace('&Ograve;','O',$string);
				$string = str_replace('&agrave;','a',$string);
				$string = str_replace('&Agrave;','A',$string);
				
				# ê î û ô â
				$string = str_replace('&ecirc;','e',$string);	
				$string = str_replace('&Ecirc;','E',$string);
				$string = str_replace('&icirc;','i',$string);
				$string = str_replace('&Icirc;','I',$string);
				$string = str_replace('&ucirc;','u',$string);	
				$string = str_replace('&Ucirc;','U',$string);
				$string = str_replace('&ocirc;','o',$string);
				$string = str_replace('&Ocirc;','O',$string);
				$string = str_replace('&acirc;','a',$string);
				$string = str_replace('&Acirc;','A',$string);
				
				# õ ã
				$string = str_replace('&otilde;','o',$string);
				$string = str_replace('&Otilde;','O',$string);
				$string = str_replace('&atilde;','a',$string);
				$string = str_replace('&Atilde;','A',$string);
				
				//$string = str_replace('---','-',$string);
				//$string = str_replace('--','-',$string);
				
				return $string;
			}
			
		#	Get system function
			static function cmspage()
			{
				switch($_SESSION['login'])
				{
					case false:
						return 'cms_module/cms_login/mod_index.php';
					break;
					case true:
						switch(Get::Data('cms_mod'))
						{
							case true:
								return 'cms_module/'.Get::Data('cms_mod').'/mod_index.php';
							break;
							case false:
								return 'cms_module/index.php';
							break;
						}
					break;
				}
			}
			
			static function UserSee()
			{
				foreach(SYSTEMQUERY("SELECT * FROM `#__login` WHERE `id`='".$_SESSION['login']."'",$db,SELECT) as $user);
				return @explode(',',$user->see);
			}
			
	}

#	Template function
	function striptags($i_html, $i_allowedtags = array(), $i_trimtext = false)
	{
  		if(!is_array($i_allowedtags))
    		$i_allowedtags = !empty($i_allowedtags) ? array($i_allowedtags) : array();
  			$tags = implode('|', $i_allowedtags);

  		if(empty($tags))
    		$tags = '[a-z]+';

  		preg_match_all('@</?\s*('.$tags.')(\s+[a-z_]+=(\'[^\']+\'|"[^"]+"))*\s*/?>@i', $i_html, $matches);

  		$full_tags = $matches[0];
  		$tag_names = $matches[1];

  		foreach($full_tags as $i => $full_tag):
    		if(!in_array($tag_names[$i], $i_allowedtags))
      		if($i_trimtext)
        		unset($full_tags[$i]);
      		else
        		$i_html = str_replace($full_tag, '', $i_html);
  		endforeach;

  		return $i_trimtext ? implode('', $full_tags) : $i_html;
	}

#	Trim function
	function trim_value(&$value) 
	{ 
    	$value = trim($value); 
	}
	
?>
