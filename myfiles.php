<?
#	LR CMS Version 5.0
#	Create date jan-2010

#	Module function file
	define('SYSTEMACCESS', true);

#	System functions
	require_once("../configuration.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?=$cms_config->sitename?></title>
        <link type="text/css" rel="stylesheet" href="../template/css/style.css" />
        <link type="text/css" rel="stylesheet" href="css/style.css" />  
        
        <script type="text/javascript">
		function selectImage(file)
		{
			parent.document.getElementById('filename').value = file;
		}
		</script>
              
    </head>
    <body style="background-color:#FFF">
	<div style="width:896px; padding:2px; overflow-y:scroll; overflow-x:hidden; height:489px">
<?
	$imagebasedir = '../files/';
	$browsedirs = true;
	$supportedextentions = array('gif','png','jpeg','jpg','pdf','doc','xls','ppt','pps','mp3','avi','mpg','mpeg','wma','docx','xlsx','pptx','ppsx','txt');
	$filetypes = array('png'=>'image-png.png','jpeg'=>'image-jpeg.png','jpg'=>'image-jpeg.png','gif'=>'image-gif.png','pdf'=>'application-pdf.png',
	'xls'=>'application-vnd.ms-excel.png','doc'=>'application-msword.png','ppt'=>'application-vnd.ms-powerpoint.png','pps'=>'application-vnd.ms-powerpoint.png');

	if((substr($imagebaseurl, -1, 1)!='/') && $imagebaseurl!='') $imagebaseurl = $imagebaseurl.'/';
	if((substr($imagebasedir, -1, 1)!='/') && $imagebasedir!='') $imagebasedir = $imagebasedir.'/';
	$leadon = $imagebasedir;
	if($leadon=='.') $leadon = '';
	if((substr($leadon, -1, 1)!='/') && $leadon!='') $leadon = $leadon.'/';
	$startdir = $leadon;

	if($_GET['dir']):
		if(substr($_GET['dir'], -1, 1)!='/'):
			$_GET['dir'] = $_GET['dir'].'/';
		endif;
		
		$dirok = true;
		$dirnames = explode('/', $_GET['dir']);
		for($di=0; $di<sizeof($dirnames); $di++):
			if($di<(sizeof($dirnames)-2)):
				$dotdotdir = $dotdotdir.$dirnames[$di].'/';
			endif;
		endfor;
		
		if(substr($_GET['dir'], 0, 1)=='/'):
			$dirok = false;
		endif;
	
		if($_GET['dir'] == $leadon):
			$dirok = false;
		endif;
		
		if($dirok):
			$leadon = $_GET['dir'];
		endif;
	endif;

	$opendir = $leadon;
	if(!$leadon) $opendir = '.';
	if(!file_exists($opendir)):
		$opendir = '.';
		$leadon = $startdir;
	endif;

	clearstatcache();
	
	if($handle = opendir($opendir)):
		while(false !== ($file = readdir($handle))):
			if($file == "." || $file == "..") continue;
			if(@filetype($leadon.$file) == "dir"):
				if(!$browsedirs) continue;
				$n++;
				$dirs[$n] = $file."/";
			else:
				$n++;
				$files[$n] = $file;
			endif;
		endwhile;
		closedir($handle); 
	endif;
	
	@natcasesort($dirs); 
	@natcasesort($files);
	$dirs = @array_values($dirs);
	$files = @array_values($files);
	
	$class = 'b';
	if($dirok):
?>
        <div class="myfilesitem">
            <a href="?filemanager=on&dir=<?=urlencode($dotdotdir)?>&id=<?=$_GET['id']?>">
                <img src="images/agua-folder-open.png" alt="Folder" border="0" />
                <span>..</span>
            </a>
        </div>
<?
		if($class=='b') $class='w';
		else $class = 'b';
	endif;
	
	$arsize = sizeof($dirs);
	for($i=0;$i<$arsize;$i++):
		$dir = substr($dirs[$i], 0, strlen($dirs[$i]) - 1);
?>
		<div class="myfilesitem">
       		<a href="?filemanager=on&dir=<?=urlencode($leadon.$dirs[$i])?>&id=<?=$_GET['id']?>">
            	<img src="images/agua-folder.png" alt="<?=$dir?>" border="0" />
                <span><?=$dir?></span>
            </a>
       	</div>
<?
		if($class=='b') $class='w';
		else $class = 'b';	
	endfor;
					
	$arsize = sizeof($files);
	for($i=0;$i<$arsize;$i++):
	
		$icon = 'application-text.png';
		$ext = strtolower(substr($files[$i], strrpos($files[$i], '.')+1));
		
		if(in_array($ext, $supportedextentions)):
							
			$thumb = '';
			if($filetypes[$ext]):
				$icon = $filetypes[$ext];
			endif;
							
			$filename = $files[$i];
			
			if(strlen($filename)>43):
				$filename = ($files[$i]);
			endif;
							
			$fileurl = $leadon.$files[$i];
			$filedir = str_replace($imagebasedir, "", $leadon);
					
			if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp'):
				list($width, $height) = getimagesize($imagebasedir.$filedir.$filename);
			endif;					
?>
            <div class="myfilesitem">
            	<a style="cursor:pointer" onClick="selectImage('/files/<?=addslashes($imagebaseurl.$filedir.$filename)?>')">
                	<? 	if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' || $ext == 'bmp'):
                    	    if($width < 60):
                        	    echo '<img src="'.$imagebasedir.$filedir.$filename.'">';
                            elseif($width > $height):
                                echo '<img src="'.$imagebasedir.$filedir.$filename.'" width="60px">';
                            else:
                                echo '<img src="'.$imagebasedir.$filedir.$filename.'" height="60px">';
                            endif;
                        else:
                   	?>
                        	<img src="images/<?=$icon?>" border="0" />
                    <? 	endif; ?>
                    <span><?=$filename?></span>
              	</a>
          	</div>
<?
			$total_map = $total_map+filesize($imagebasedir.$filedir.$filename);
			if($class=='b') $class='w';
			else $class = 'b';	
		endif;
	endfor;	
?>
</div>
    </body>
</html>
