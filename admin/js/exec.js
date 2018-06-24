(function(){
    function exec(command) {
        switch (command) {
        case 'revert':
        case 'update':
            if (!confirm('Local changes will be reverted. Are you sure?')) {
                return;
            }
        }

        var req = new XMLHttpRequest();
        req.open('POST', 'exec.php');
        req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        req.addEventListener('loadstart', function(){
            var terminal = document.getElementById('terminal');
            terminal.innerHTML = '<span class="status">Executing...</span>';
            terminal.style.display = 'block';
            scrollTo(0, document.body.scrollHeight);
        });
        req.addEventListener('progress', function(e){
            var terminal = document.getElementById('terminal');
            terminal.innerHTML = this.responseText + '\n<span class="status">Executing...</span>';
            scrollTo(0, document.body.scrollHeight);
        });
        req.addEventListener('loadend', function(){
            var terminal = document.getElementById('terminal');
            if (this.responseText == '') {
                terminal.innerHTML = '<span class="status">Not changed</span>';
            } else {
                terminal.innerHTML = this.responseText + '\n<span class="status">Finished</span>';
            }
            scrollTo(0, document.body.scrollHeight);
        });
        req.send('command=' + command);
    }

    document.getElementById('exec').addEventListener('click', function(){
        exec(this.dataset.command);
    });
})();
