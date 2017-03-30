$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    var ids = $('#forms :input[id]').map(function() {
        return this.id;
    }).get();

    //define url
    var url = window.location.href;
    var str = $('#page-title').text();

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
        changePageTitle('Create ' + str);
        changeButtonTitle('Save changes');

        $('#btn-save').val("add");
        $('#forms').trigger("reset");
        $('#modals').modal('show');
    });

    //edit form task
    $('#table').on('click', '.btn-edit', function(e) {
        e.preventDefault();

        // if checkbox is exists checked, remove all checked
        if($("input[type=checkbox]").is(':checked')) {
            $('input[type=checkbox]').removeAttr('checked', false);
        }

        var id = $(this).attr('data-value');

        changePageTitle('Update ' + str);
        changeButtonTitle('Update changes');

        $.get(url + '/' + id + '/edit', function(data) {

            $.map(ids, function(val) {

                if($('#'+val).is('select')) {
                    if(jQuery.inArray(1, data[val]) !== -1){
                        $('#' + val).val(data[val]);
                    } else {
                        $('#' + val).removeAttr('multiple');
                        $('#' + val).chosen().val(data[val])
                    }
                    //update data with jquery choosen
                    // $('#' + val).trigger('chosen:updated');
                }

                // show data except to use checkbox input
                if($('#'+val).is('*:not(input:checkbox)')) {
                    $('#' + val).val(data[val]);
                }
            });

            //check if data permission is exists
            if(data.perms) {
                $.each(data.perms, function(key, value) {
                    if(Object.keys(value).length > 1) {
                        $.each(value, function(k, v) {
                            if(jQuery.inArray(key+'_'+v.toLowerCase(), ids) !== -1) {
                                $('#' + key+'_'+v.toLowerCase()).prop('checked', true);
                                $('#' + key).prop('checked', true);
                            }
                        });
                    } else {
                        $.each(value, function(k, v) {
                            $('#' + v.toLowerCase()).prop('checked', true);
                        });
                    }
                });
            }

            $('#btn-save').val("update");
            $('#modals').modal('show');
        });
    });

    //save or update task
    $('#btn-save').click(function() {
        //define new url & define method default
        var urls = url;
        var method = 'POST';
        var datas = perm = newData = {};

        //collect data
        var id = $('#id').val();

        //get value from checkbox input
        var checkedValues = $('input:checkbox:checked').map(function() {
            if(this.value !== 'on') {
                return this.value;
            }
        }).get();

        if(checkedValues) {
            perm['permission_id'] = checkedValues;
        }

        $.map(ids.slice(1), function(str) {
            if($("#"+str).is('*:not(input:checkbox)')) {
                datas[str] = $('#' + str).val();
            }
        });

        newData = (checkedValues) ? $.merge( perm, datas) : datas;

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
                    text: 'Your '+ str.toLowerCase() + ' has been ' + messages + '!',
                    theme: 'relax',
                    type: 'success',
                    timeout: 2000
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
                        text: 'Your ' + str.toLowerCase() + ' has been deleted!',
                        theme: 'relax',
                        type: 'success',
                        timeout: 2000
                    });

                    $('#delete-modals').modal('hide');
                }
            });
        });
    });
});
