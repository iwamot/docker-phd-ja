<?php
function show_title() {
    echo('phd-ja admin');
}

function show_content() {
?>
<p>"phd-ja admin" is a web interface for <a href="https://github.com/iwamot/docker-phd-ja/" target="_blank">docker-phd-ja.</a></p>
<p>It will help us contribute to PHP.</p>
<?php
}

function show_scripts() {
}

require('templates/common.tpl');
