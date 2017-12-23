$(function() {
    $.getJSON(
        'get-json-tree',
        'id='+$('#save-btn').attr('data-menuid'),
        function(data) {
            $('#loading').addClass('hidden');
            $('#menu-tree').tree({
                dragAndDrop: true,
                autoOpen: 1,
                data: data,
                rtl: true
            });
        }
    );
    $('#menu-tree').bind(
        'tree.select',
        function(event) {
            form = $('#update-item-form');
            form.trigger('reset');
            if (event.node) {
                form.parents('.panel').removeClass('hidden');
                var node = event.node;
                form.find('.id').val(node.id);
                form.find('.title').val(node.name);
                if(node.hasOwnProperty('url')){
                    form.find('.url').val(node.url).attr('disabled', false)
                        .parent('.form-group').removeClass('hidden');
                }else{
                    form.find('.url').attr('disabled', 'true')
                        .parent('.form-group').addClass('hidden');
                }
            }
            else {
                form.parents('.panel').addClass('hidden')
                form.trigger('reset');
            }
        }
    );
});
$('#save-btn').on('click', function(e){
    e.preventDefault();
    $.ajax({
        url: $(this).attr('href'),
        type: 'POST',
        data: $('#menu-tree').tree('toJson'),
        contentType: 'application/json; charset=utf-8'
    });
});
$('#update-item-form').on('beforeSubmit', function(e) {
    $(this).parents('.panel').addClass('hidden');
    $('#menu-tree').tree(
        'updateNode',
        $('#menu-tree').tree('getNodeById', $(this).find('.id').val()),
        {
            url: $(this).find('.url').val(),
            name: $(this).find('.title').val(),
        }
    );
    $(this).trigger('reset');
    return false;
});
$('#remove-item').on('click', function(e) {
    var result = confirm('این لینک به همراه زیر شاخه هایش حذف شود؟');
    if (result) {
        $(this).parents('.panel').addClass('hidden');
        var id = $('#update-item-form').find('.id').val();
        var node = $('#menu-tree').tree('getNodeById', id);
        $('#menu-tree').tree('removeNode', node);
    }
});
$('#link-item-form').on('beforeSubmit', function(e) {
    node = {
        url: $(this).find('.url').val(),
        name: $(this).find('.title').val(),
        type: 'link',
        id: Math.random().toString(36).substr(2, 5)
    };
    $('#menu-tree').tree('appendNode', node);
    $(this).trigger('reset');
    return false;
});
