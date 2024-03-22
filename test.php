<?php
$seed = 1000000000;
$random_values = array("randomValue1", "cheese", "the_moon");

$state = $seed;
function nextFloat() {
	global $state;
	$m = 0x80000000;
	$a = 1103515245;
	$c = 12345;
	$state = ($a * $state + $c) % $m;
	return $state / ($m - 1);
}

foreach ($random_values as $var_name) {
    $$var_name = nextFloat();
}

echo $randomValue1.PHP_EOL;
echo $cheese.PHP_EOL;
echo $the_moon.PHP_EOL;