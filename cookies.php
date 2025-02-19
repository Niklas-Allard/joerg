<?php

$value = file_get_contents("cookies_message.txt");

setcookie("path", $value, time() + 3600 * 24, "/"); // Gültig für 1 Stunde

echo "finished";

?>