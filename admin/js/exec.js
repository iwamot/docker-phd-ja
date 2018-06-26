(function(){
    function format(str) {
        str = str.replace(/[&<>"]/g, function(match) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
            }[match];
        });
        str = str.replace(/\033\[(01;3[1235])m(.*)\033\[m/g, function(match, p1, p2) {
            var klass;
            switch (p1) {
            case '01;31':
                klass = 'php_error';
                break;
            case '01;33':
                klass = 'user_error';
                break;
            case '01;32':
                klass = 'phd_info';
                break;
            case '01;35':
                klass = 'phd_warning';
                break;
            }
            return '<span class="' + klass + '">' + p2 + '</span>';
        });
        return str;
    }

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
            terminal.innerHTML = format(this.responseText) + '\n<span class="status">Executing...</span>';
            scrollTo(0, document.body.scrollHeight);
        });
        req.addEventListener('loadend', function(){
            var terminal = document.getElementById('terminal');
            if (this.responseText == '') {
                terminal.innerHTML = '<span class="status">Not changed</span>';
            } else {
                terminal.innerHTML = format(this.responseText) + '\n<span class="status">Finished</span>';
            }
            scrollTo(0, document.body.scrollHeight);
        });
        req.send('command=' + command);
    }

    document.getElementById('exec').addEventListener('click', function(){
        exec(this.dataset.command);
    });
})();
