$(document).ready(function() {
    var ids = $('#forms :input[name]').map(function() {
        return this.name;
    }).get();

    //define url
    var url = window.location.href;

    //change page title
    function changePageTitle(page_title) {
        $('.modal-title').text(page_title);
    }

    //change button title
    function changeButtonTitle(button_title) {
        $('#btn-save').text(button_title);
    }

    //reload datatable ajax
    function reload_table() {
        $('#table').DataTable().ajax.reload(null, false);
    }

    //create new task
    $('#btn-new').click(function() {
        changePageTitle('Create Task');
        changeButtonTitle('Save changes');
        $('#btn-save').val("add");
        $('#forms').trigger("reset");
        $('#modals').modal('show');
    });

    //edit form task
    $('#table').on('click', '.btn-edit', function() {
        var id = $(this).attr('data-value');

        var str = $('#page-title').text();
        changePageTitle('Update ' + str);
        changeButtonTitle('Update changes');

        $.get(url + '/' + id + '/edit', function(data) {
        	
            $.map(ids, function(val) {
                $('#' + val).val(data[val]);
            });
            $('#btn-save').val("update");
            $('#modals').modal('show');
        });
    });

    //save or update task
    $('#btn-save').click(function() {
        //define new url & define method default
        var urls = url;
        var method = 'POST';

        //collect data
        var id = $('#id').val();

        var datas = {};
        $.map(ids.slice(1), function(str) {
            datas[str] = $('#' + str).val();
        });

        //get value button
        var button = $('#btn-save').val();

        // //check if update 
        if (button == 'update') {
            method = 'PUT';
            urls += '/' + id;
        }

        $.ajax({
            type: method,
            url: urls,
            data: datas,
            dataType: 'json',
            success: function(data) {
                reload_table();
                var messages = (button == 'add') ? 'created' : messages = 'updated';
                var nt = noty({
                    text: 'Your task has been ' + messages + '!',
                    theme: 'relax',
                    type: 'success',
                    timeout: 1000
                });

                $('#forms').trigger("reset");
                $('#modals').modal('hide');
            }
        });
    });

    $('#table').on('click', '.btn-delete', function() {
        $('#delete-modals').modal('show');
        var id = $(this).attr('data-value');

        $('#yes-delete').click(function() {
            $.ajax({
                type: "DELETE",
                url: url + '/' + id,
                success: function(data) {
                    reload_table();
                    var n = noty({
                        text: 'Your task has been deleted!',
                        theme: 'relax',
                        type: 'success',
                        timeout: 1000
                    });

                    $('#delete-modals').modal('hide');
                }
            });
        });
    });
});