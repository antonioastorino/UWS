<?php declare(strict_types=1);
# The following code works if
#    a. user www-data and group webmasters are created
#    b. the working folder is owned by them

// compile cpp project
shell_exec("make");
// execute and print result
echo "<p>" . shell_exec("[ \"$?\" = \"0\" ] && ./hello") . "</p>";
?>

