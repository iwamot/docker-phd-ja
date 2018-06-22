<?php
chdir('/opt/phd-ja/source');

function en_source_file_exists($filename) {
    if (strpos($filename, '../') !== false) {
        return false;
    } else {
        return is_file('en/' . substr($filename, 3));
    }
}

function open_source_file($filename) {
    if (!en_source_file_exists($filename)) {
        return false;
    } else if (is_file($filename)) {
        return file_get_contents($filename);
    } else {
        return '';
    }
}

function save_source_file($filename, $content) {
    if (!en_source_file_exists($filename)) {
        return false;
    }

    $descriptorspec = array(
        0 => array('pipe', 'r'),
        1 => array('pipe', 'w')
    );
    $proc = proc_open('sudo ../scripts/phd-save ' . $filename . ' 2>&1', $descriptorspec, $pipes);
    if (!is_resource($proc)) {
        return false;
    }

    fwrite($pipes[0], $content);
    fclose($pipes[0]);

    $out = stream_get_contents($pipes[1]);
    fclose($pipes[1]);

    $status = proc_get_status($proc);
    proc_close($proc);

    if ($status['exitcode'] === 0) {
        return true;
    } else {
        trigger_error($out, E_USER_WARNING);
        return false;
    }
}

$command = @$_POST['command'];
$filename = @$_POST['filename'];
$content = @$_POST['content'];
$info = '';
$error = '';

switch ($command) {
case 'open':
    if (($content = open_source_file($filename)) === false) {
        $error = 'Could not edit the file.';
    }
    break;
case 'save':
    if (save_source_file($filename, $content)) {
        $info = 'Saved.';
    } else {
        $error = 'Could not save the file.';
    }
    break;
default:
    $command = '';
    break;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>phd-ja admin</title>
<meta charset="UTF-8">
<style>
.info {color: green;}
.error {color: red;}
</style>
</head>
<body>
<form action="file.php" method="POST">
<p>
<input type="text" name="filename" value="<?php echo(htmlspecialchars($filename)); ?>" size="60">
<input type="submit" name="command" value="open">
</p>

<?php if ($info !== '') { ?>
<p class="info"><?php echo(htmlspecialchars($info)); ?></p>
<?php } else if ($error !== '') { ?>
<p class="error"><?php echo(htmlspecialchars($error)); ?></p>
<?php } ?>

<?php if ($command !== '') { ?>
<p><input type="submit" name="command" value="save"></p>
<textarea name="content" cols="100" rows="30"><?php echo(htmlspecialchars($content)); ?></textarea>
<p><input type="submit" name="command" value="save"></p>
</form>
<?php } ?>
</body>
</html>
