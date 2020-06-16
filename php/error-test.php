<?php
echo "<p>Remember to disable error printing in /etc/php/<php_version>/apache2/conf.d/custom.ini before publishing!</p>";
// purposely generate a fatal error by calling a non-existing function
load();
?>