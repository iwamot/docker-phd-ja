(function(){
    new Suggest.Local('filename', 'file_suggest', list, {
        dispMax: 10,
        ignoreCase: false,
        highlight: true
    });

    if (!document.getElementById('editor')) {
        return;
    }

    var editor = ace.edit('editor', {
        fontSize: 14,
        minLines: 40,
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
