(function(){
    if (!document.getElementById('editor')) {
        return;
    }

    var editor = ace.edit('editor', {
        fontSize: 14,
        maxLines: 40,
        mode: 'ace/mode/xml',
        tabSize: 1,
        theme: 'ace/theme/monokai',
        useSoftTabs: true,
        wrap: true,
    });

    document.getElementById('save').addEventListener('click', function(){
        document.getElementById('editor_text').textContent = editor.getValue();
    });
})();
