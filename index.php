<?php


if ( isset($_POST['mpc']) ) {
    echo '<pre>';var_dump($_POST['mpc']);echo '</pre>';
    shell_exec('mpc clear && mpc load streams/di.fm/'.$_POST['mpc'].'.m3u && mpc play');
}

?>

<form action="index.php" method="post">
<input type="text" id="mpc" name="mpc" value="">
<input type="submit" value="send">
</form>
