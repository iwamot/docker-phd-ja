<?php
header('X-Accel-Buffering: no');

switch (@$_POST['command']) {
case 'Update source':
    $command = 'sudo ../scripts/phd-update 2>&1';
    break;
case 'Configure PhD':
    $command = 'sudo ../scripts/phd-configure 2>&1';
    break;
case 'Build documentation':
    $command = 'sudo ../scripts/phd-build 2>&1';
    break;
default:
    http_response_code(403);
    echo('Forbidden');
    exit;
}

ob_implicit_flush(1);
chdir('/opt/phd-ja/source');
echo('<pre>');
system($command);
echo('</pre>');
