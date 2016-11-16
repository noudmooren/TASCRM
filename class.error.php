<?
#	LR DESIGN - CMS SYSTEM
#	Built: 10-Feb-2010   /  Created by: Robert van Klooster

#	Error functions
	defined('LR_ACCESS') or die('Geen directe toegang mogelijk!');
	
#	Create error
	class ErrorReporing{
	
		static function Message($message, $Query = false){
			
			echo '<html>';
				echo '<head>';
					echo '<title>An error has occurred on '.$_SERVER['HTTP_HOST'].'</title>';
					echo '<style type="text/css">';
						echo 'body{ background:#FBFBFB; color:#333; font-family:Tahoma, Geneva, sans-serif; font-size:12px; }';
					echo '</style>';
				echo '</head>';
				echo '<body>';
					echo '<div style="padding:20px; color:#333; border:1px solid #e1e1e1; background:#eee; margin:50px auto 0; width:750px; font-size:20px">';
						echo 'Error';
					echo '</div>';
					echo '<div style="padding:20px; text-align:left; background:white; border-left:1px solid #e1e1e1; margin:0px auto 0; border-right:1px solid #e1e1e1; border-bottom:1px solid #e1e1e1; width:750px;">';
						echo '<p><b>The following error occurred in the system:</b></p><p style="font-family:\'Courier New\', Courier, monospace; font-size:11px;">';
						echo $message."<br><br>";
						echo $Query;
						echo '</p>';
					echo '</div>';
				echo '</body>';
			echo '</html>';
		}

	#	Page not found	
		static function PageNotFound($Error = false){
			
			$Website = new Website();
			$Website->TraceWebsiteInfo();
			
			//header("HTTP/1.1 404 Not Found");
			
			$TemplateDir = array('template_dir' => $_SERVER['DOCUMENT_ROOT'].'/websites/'.$Website->getWebsiteAlias().'/','extract' => true);
			
			$Template = new Template($TemplateDir);
			$Template->Assign('Error',$Error);
			$Template->Assign('Website',$Website);
			
			if($Website->get404page() == "true"){
				die($Template->Display("custom.error.php"));
			}
			else{		
				die($Error);
			}
		}
	}
