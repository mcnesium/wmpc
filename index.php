<?php

if ( isset($_POST['mpc']) ) {

    $post = escapeshellarg($_POST['mpc']);

    echo '<pre>';var_dump($post);echo '</pre>';
    shell_exec('mpc clear && mpc load streams/di.fm/'.$post.' && mpc play');

}

$lsdi = explode( "\n", shell_exec('ls -1 /mnt/crypt/musik/streams/di.fm/') );

?>

<form action="index.php" method="post">
<select name="mpc">
    <?php
        foreach ($lsdi as $stream) {
            echo '<option value="'.$stream.'">'.$stream.'</option>';
        }
    ?>
</select>
<input type="submit" value="send">
</form>
