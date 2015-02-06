<!DOCTYPE html>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex">
<title>WMPC</title>

<?php

    // get available streams
    $lsdi = explode( "\n", shell_exec('ls -1 /mnt/crypt/musik/streams/di.fm/') );

?>

<form id="form" action="index.php" method="post" onchange="this.submit()">
    <select name="mpc" style="width:100%;">
        <option>Choose…</option>
        <?php
            // list available streams
            foreach ($lsdi as $stream) {
                echo '<option value="'.$stream.'">'.$stream.'</option>';
            }
        ?>
    </select>
</form>

<?php

if ( isset($_POST['mpc']) ) {

    // escape post variable
    $post = escapeshellarg($_POST['mpc']);

    // execute shell command to play the selected stream
    shell_exec('mpc clear && mpc load streams/di.fm/'.$post.' && mpc play');

    ?>
    <script type="text/javascript">
        (function(){
            // preselect former selected stream after page has reloaded
            var option = document.querySelector('select[name="mpc"] option[value="'+<?php echo $post; ?>+'"]');
            if(option){
                option.selected = true;
            }
        })();
    </script>
    <?php

}

?>
