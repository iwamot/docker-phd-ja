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
?>
<!DOCTYPE html>
<html>
<head>
<title>phd-ja admin</title>
<style>
.admin_info {color: #5555ff; font-weight: bold;}
pre {
    font-family: "Courier New", monospace;
    background-color: black;
    color: white;
    padding: 1em;
    min-height: 10em;
}
.php_error {color: #ff5555; font-weight: bold;}
.user_error {color: #ffff55; font-weight: bold;}
.phd_info {color: #55ff55; font-weight: bold;}
.phd_warning {color: #ff55ff; font-weight: bold;}
</style>
</head>
<body>
<pre>
<?php
chdir('/opt/phd-ja/source');
$fp = popen($command, 'r');
if ($fp) {
    while (($line = fgets($fp)) !== false) {
        $line = htmlspecialchars($line);
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
?>
</pre>
<p class="admin_info">Done!</p>
</body>
</html>
