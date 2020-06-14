<?php declare(strict_types=1);

// global variables
$x = 100;

function testGlobal() {
	$GLOBALS['x']++;
	echo "<p>Global x = " . $GLOBALS['x'] . "</p>";
}

$greeting = "Hello from PHP!";
echo "<p>" . $greeting . "</p>";
// compile
shell_exec("make");
// execute and print result
echo shell_exec("[ \"$?\" = \"0\" ] && ./hello");
testGlobal();
?>

