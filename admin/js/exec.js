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
        str = str.replace(/\033\[(01?);(0|31|32|33|35|36)m([\S\s]*?)\033\[(?:0;0)?m/g, function(match, p1, p2, p3) {
            var classes = [];
            if (p1 == '01') {
                classes.push('ansi_bold');
            }
            switch (p2) {
            case '31':
                classes.push('ansi_red');
                break;
            case '32':
                classes.push('ansi_green');
                break;
            case '33':
                classes.push('ansi_yellow');
                break;
            case '35':
                classes.push('ansi_magenta');
                break;
            case '36':
                classes.push('ansi_cyan');
                break;
            }
            return '<span class="' + classes.join(' ') + '">' + p3 + '</span>';
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
