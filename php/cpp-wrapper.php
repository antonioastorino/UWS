<?php declare(strict_types=1);
// compile cpp project
shell_exec("make");
// execute and print result
echo "<p>" . shell_exec("[ \"$?\" = \"0\" ] && ./hello") . "</p>";
?>

