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

echo '<style>

table { border-collapse:collapse; }

.line
{
	height: 30px;
}

.question
{
	font-size: 1.5em;
	border: 1px dashed gray;	
}

.answer
{
	font-size: 1.3em;
	left: 50px;
	border: 1px dashed gray;
}

.tags
{
	font-size: 1em;
	color: gray;
	border: 1px dashed gray;
}

</style>';

$file = str_replace('..', '', $_GET['file']);
$file = str_replace('/',  '', $file);
$file = str_replace('\\', '', $file);

$content = file_get_contents($directory_ankifiles.'/'.$file);

echo '<table>'.chr(10).chr(10);
$lines = explode("\n", $content);
foreach($lines as $line)
{
	$vars = explode("\t", $line);
	
	
	echo '<tr><td class="question">';
	if(isset($vars[0]))
		echo $vars[0];
	else
		echo '&nbsp;';
	echo '</td></tr><tr><td class="answer">';
	if(isset($vars[1]))
		echo $vars[1];
	else
		echo '&nbsp;';
	echo '</td></tr>';
	if(isset($vars[2]) && !empty($vars[2]))
		echo '<tr><td class="tags">'.$vars[2].'</td></tr>';
	
	echo '<tr class="line">&nbsp;</tr>'.chr(10);
}
echo '</table>';
