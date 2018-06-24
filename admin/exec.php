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
        $line = preg_replace_callback(
            '/(.*)\033\[(01;3[1235])m(.*)\033\[m(.*)/',
            function ($matches) {
                switch ($matches[2]) {
                case '01;31':
                    $class = 'php_error';
                    break;
                case '01;33':
                    $class = 'user_error';
                    break;
                case '01;32':
                    $class = 'phd_info';
                    break;
                case '01;35':
                    $class = 'phd_warning';
                    break;
                }
                return $matches[1] . '<span class="' . $class . '">' . $matches[3] . '</span>' . $matches[4];
            },
            $line
        );
        echo($line);
    }
    pclose($fp);
}
