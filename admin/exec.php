<?php
switch (@$_POST['command']) {
case 'diff':
    $command = '../scripts/phd-diff 2>&1';
    break;
case 'revert':
    $command = 'sudo ../scripts/phd-revert 2>&1';
    break;
case 'update':
    $command = 'sudo ../scripts/phd-update 2>&1';
    break;
case 'build':
    $command = 'sudo ../scripts/phd-build 2>&1';
    break;
default:
    http_response_code(403);
    echo('Forbidden');
    exit;
}

header('X-Accel-Buffering: no');
ob_implicit_flush(1);

chdir('/opt/phd-ja/source');
$fp = popen($command, 'r');
if ($fp) {
    while (($line = fgets($fp)) !== false) {
        echo($line);
    }
    pclose($fp);
}
