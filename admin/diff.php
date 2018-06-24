<?php
function show_title() {
    echo('Diff');
}

function show_content() {
?>
<button id="exec" type="button" class="btn btn-info btn-flat m-b-10 m-l-5" data-command="diff">Show diff</button>
<?php
}

function show_scripts() {
?>
<script src="js/exec.js" defer></script>
<?php
}

require('templates/common.tpl');
