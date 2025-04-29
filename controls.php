<?php

    require "log.php";

    $log = new Log;

    if (isset($_GET["submit"])) {

        $log->deleting_all_logs();
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="controls.php" method="get">
        <input type="submit" name="submit" value="Alles Löschen">
    </form>

    <form action="controls.php" method="get">
        <br>
        <input type="submit" name="delete_submit" value="Refresh"><br><br>
        <?php 

            foreach ($log->loading_log() as $single_log) {

                echo $single_log . "<br>";
            }

        ?>
    </form>
</body>
</html>