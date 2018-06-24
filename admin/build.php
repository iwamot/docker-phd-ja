<?php
function show_title() {
    echo('Build');
}

function show_content() {
?>
<button type="button" id="exec" class="btn btn-info btn-flat m-b-10 m-l-5" data-command="build">Build</button>
<?php
}

function show_scripts() {
?>
<script src="js/exec.js" defer></script>
<?php
}

require('templates/common.tpl');
