<!DOCTYPE html>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WMPC</title>

<?php

    // config
    $streamdir = 'streams';
    $streamnames = array(
        'di.fm',
        'radiotunes.com',
        'jazzradio.com',
        'rockradio.com'
    );

    // put available stream playlist files in array
    foreach ($streamnames as $streamname) {
        $ls[$streamname] = explode( "\n", shell_exec('mpc ls '.$streamdir.'/'.$streamname.' | cut -d "/" -f 3 | sort' ) );
    }

?>


<form id="form" action="index.php" method="post" onchange="this.submit()">
    <?php foreach ($streamnames as $streamname) : ?>
        <select name="<?php echo $streamname ?>" style="width:100%;height:30px;margin-bottom: 20px;">
        <option value=""><?php echo $streamname ?></option>
        <?php
            // add option for each playlistfile
            foreach ($ls[$streamname] as $playlist) {
                echo '<option value="'.$playlist.'">'.$playlist.'</option>';
            }
        ?>
        </select>
    <?php endforeach; ?>
    <button name="stop" value="stop">Stop</button>
</form>


<?php

    foreach ($_POST as $postvar => $value) {

        if ($value == 'stop') {
            shell_exec('mpc stop');
        }
        else if ($value != '') {
            // execute shell command to play the selected stream
            shell_exec('mpc clear && mpc load '.$streamdir.'/'.str_replace('_','.',escapeshellarg($postvar)).'/'.escapeshellarg($value).' && mpc play');

            break;
        }
    }

?>

<p><?php echo shell_exec('mpc current'); ?></p>
