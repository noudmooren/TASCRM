<?
#	System functions
	defined('SYSTEMACCESS') or die('Geen directe toegang mogelijk!');
#	Create error	
	function error($message,$query = false)
	{
		echo '<html>';
		echo '<head>';
		echo '<title>Error message</title>';
		echo '<style type="text/css">';
		echo 'body{ background-color:#FC6; font-family:Verdana, Geneva, sans-serif; font-size:12px; }';
		echo '</style>';
		echo '</head>';
		echo '<body>';
		echo '<center>';
		echo '<div style="padding:10px; background-color:red; width:800px; font-weight:bold; color:white">';
		echo 'ERROR MESSAGE';
		echo '</div>';
		echo '<div style="padding:10px; text-align:left; background-color:white; width:800px; font-family:courier new">';
		echo '<p><b>Please contact LR Design about this problem:</b></p>';
		echo '<p>'.$message.'</p>';
		if($query):
			echo '<hr>';
			echo '<p><b>Query error</b><p>';
			echo '<p>'.$query.'</p>';
		endif;
		echo '</div>';
		echo '</center>';
		echo '</body>';
		echo '</html>';
		
	}
#pietjepuk2