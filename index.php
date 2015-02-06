<!DOCTYPE html>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>WMPC</title>
<?php

if ( isset($_POST['mpc']) ) {

    // escape post variable
    $post = escapeshellarg($_POST['mpc']);

    // execute shell command to play the selected stream
    shell_exec('mpc clear && mpc load streams/di.fm/'.$post.' && mpc play');

}

?>

<?php

    // get available streams
    $lsdi = explode( "\n", shell_exec('ls -1 /mnt/crypt/musik/streams/di.fm/') );

?>

<form action="index.php" method="post">
    <select name="mpc">
        <?php
            // list available streams
            foreach ($lsdi as $stream) {
                echo '<option value="'.$stream.'">'.$stream.'</option>';
            }
        ?>
    </select>
    <input type="submit" value="send">
</form>
