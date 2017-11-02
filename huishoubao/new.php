<?php
function Sum($n){
	$a = 0;
	if($n>1){
		$a=Sum($n-1)+$n;
		echo "$n<br>";
	}
	return $a;
}
echo Sum(10);
?>