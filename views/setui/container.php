<ul>
<?php

if (is_array($content))
{
	foreach ($content as $item)
	{
		echo $item;
	}
}
else
{
	echo $content;
}
?>
</ul>
