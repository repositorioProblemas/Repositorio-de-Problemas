<?php
echo '[';
$c = count($this->data);
$i = 0;
foreach($this->data as $tag) {
	$t = $tag['Tag']['tag'];
	echo "[\"{$t}\",\"{$t}\",null,\"<div style=\\\"text-align: left; padding-left: 5px;\\\">{$t}</div>\"";
	echo "]";	
	if($i+1 < $c)
		echo ",";	
	$i++;
}

echo ']';
?>