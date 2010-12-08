<?php

$directory_ankifiles = './ankifiles';

if(!isset($_GET['file']) && $h = opendir($directory_ankifiles))
{
	echo "Files:<br /><br />";
	
	while (false !== ($file = readdir($h)))
	{
		if($file != '.' && $file != '..')
			echo '<a href="'.$_SERVER['PHP_SELF'].'?file='.$file.'">'.
				$file.'</a><br />';
	}
	
	closedir($h);
	exit;
}

$file = str_replace('..', '', $_GET['file']);
$file = str_replace('/',  '', $file);
$file = str_replace('\\', '', $file);

$content = file_get_contents($directory_ankifiles.'/'.$file);

$lines = explode("\n", $content);
foreach($lines as $line)
{
	echo '<div class="line">';
	$vars = explode("\t", $line);
	foreach($vars as $i => $var)
	{
		if($i == 0)
			echo '<div class="question">'.$var.'</div>';
		elseif($i == 1)
			echo '<div class="answer">'.$var.'</div>';
		elseif($i == 2)
			echo '<div class="tags">'.$var.'</div>';
		else
			echo '<div>'.$var.'</div>';
	}
	echo '</div>'.chr(10);
}
