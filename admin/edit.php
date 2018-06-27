<?php
function can_edit_file($filename) {
    if (preg_match('/\Aja\/.*\.xml\z/', $filename) !== 1) {
        return false;
    } else if (strpos($filename, '../') !== false) {
        return false;
    } else {
        return is_file('en/' . substr($filename, 3));
    }
}

function read_file($filename) {
    if (!can_edit_file($filename)) {
        return false;
    } else if (is_file($filename)) {
        return file_get_contents($filename);
    } else {
        return '';
    }
}

function save_file($filename, $content) {
    if (!can_edit_file($filename)) {
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

    $content = preg_replace('/(\r\n|\r|\n)/', "\n", $content);

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

function show_title() {
    echo('Edit');
}

function show_content() {
    chdir('/opt/phd-ja/source');

    $command = @$_POST['command'];
    $filename = @$_POST['filename'];
    $content = @$_POST['content'];

    $open_info = '';
    $open_error = '';
    $save_info = '';
    $save_error = '';

    switch ($command) {
    case 'open':
        $content = read_file($filename);
        if ($content === '') {
            $open_info = 'No lines but it is not an error. You can be the first translator for this file!';
        } else if ($content === false) {
            $open_error = 'You can not edit the file.';
        }
        break;
    case 'save':
        if (save_file($filename, $content)) {
            $save_info = 'Saved.';
        } else {
            $save_error = 'Could not save the file.';
        }
        break;
    default:
        $command = '';
        break;
    }
?>
<?php if ($save_info !== '') { ?>
    <p class="alert alert-info"><?php echo(htmlspecialchars($save_info)); ?></p>
<?php } else if ($save_error !== '') { ?>
    <p class="alert alert-danger"><?php echo(htmlspecialchars($save_error)); ?></p>
<?php } ?>
<form action="edit.php" method="POST">
    <div class="form-group">
        <label>File (e.g. "ja/faq/build.xml")</label>
        <input type="text" id="filename" class="form-control input-flat" name="filename" value="<?php echo(htmlspecialchars($filename)); ?>" autocomplete="off">
        <div id="file_suggest"></div>
<?php if ($open_info !== '') { ?>
        <p class="text-info"><?php echo(htmlspecialchars($open_info)); ?></p>
<?php } else if ($open_error !== '') { ?>
        <p class="text-danger"><?php echo(htmlspecialchars($open_error)); ?></p>
<?php } ?>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info btn-flat" name="command" value="open">Open</button>
    </div>
<?php if ($command !== '' && $open_error === '') { ?>
    <div class="form-group">
        <pre id="editor" class="form-control input-flat"><?php echo(htmlspecialchars($content)); ?></pre>
        <textarea id="editor_text" name="content"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" id="save" class="btn btn-info btn-flat" name="command" value="save">Save</button>
    </div>
<?php } ?>
</form>
<?php
}

function show_scripts() {
?>
<script src="lib/ace/src-min/ace.js" defer></script>
<script src="lib/suggest/suggest.js" defer></script>
<script src="js/filelist.js" defer></script>
<script src="js/edit.js" defer></script>
<?php
}

require('templates/common.tpl');
