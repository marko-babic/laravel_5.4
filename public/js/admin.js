function checkDelete(id) {
    if (confirm('Really delete?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.ticket_delete + '/' + id,
            success: function(result) {
                location.reload();
            },
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
    }
}

function screenshotAction(id, action, text) {
    if (confirm('Really ' + text + ' ?')) {
        $.ajax({
            type: action,
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.action_screenshot + '/' + id,
            success: function(result) {
                $('#scr-modal').fadeOut(1000, 'swing');
                $('img[data-id=' + id + ']').fadeOut();
            },
            error: function () {
                alert("Nop, something wrong.")
            }
        });
    }
}

function removePost(id){
    if (confirm('Do you really want to delete this post?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.remove_post + '/' + id,
            success: function(result) {
                location.reload();
            }
        });
    }
}

function markAsRead(id) {
    $.ajax({
        type: "PUT",
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        data: {id: id},
        url: ajax_admin_url.mark_as_read,
        success: function () {
            $('[data-notification=' + id + ']').fadeOut();
        }
    });
}

function markAll() {
    $.ajax({
        type: "PUT",
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        data: {id: 'all'},
        url: ajax_admin_url.mark_as_read,
        success: function (xhr) {
            $('#notification-placeholder').html('');
        },
        error: function (xhr) {
            alert(xhr.responseText);
        }
    });
}

function navRemove(id) {
    if (confirm('Do you really want to remove this item?')) {
        $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': csrf_token
            },
            url: ajax_admin_url.navbar + '/' + id,
            success: function() {
                location.reload();
            },
            error: function(xhr) {
                alert(xhr.responseText);
            },
        });
    }
}

$(document).on('ready', function () {

    var nav_id = 0;

    tinymce.init({
        selector: "textarea",
        height: "400",
        forced_root_block : "",
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        }
    });

    $(document).on("click", '.ad-screen', function () {
        var caption = $('#caption');
        var action = this.id;
        var id = caption.data('imgid');

        if (action === 'approve') {
            screenshotAction(id, 'PUT', action);
        } else if (action === 'deny') {
            screenshotAction(id, 'DELETE', action);
        }
    });

    $(document).on("click",'.note-read',function () {
        markAsRead($(this).parent().data('notification'));
    });

    $('.nav-edit').click(function(){
        let action = $(this).data('action');
        let id = $(this).parent().data('nav');

        if(action == 'edit') {
            $('#nav_description').val($(this).parent().text().trim());
            $('#nav_shortcode').val($(this).parent().data('nav_short'));
            $('#nav_navbar').val($(this).parent().data('nav_nav'));
            $('#nav_btn').text('Save');
            nav_id = id;
        } else {
            navRemove(id);
        }
    });

    $(document).on('click', '#markall', function(){
       markAll();
       // updateNotificationsData();
    });

    $('.navbar-add-form').submit(function(event){
        let desc = $('#nav_description').val();
        let short = $('#nav_shortcode').val();
        let nav = $('#nav_navbar').val();
        let type = 'POST';
        let url;

        if(nav_id > 0) {
            type = 'PUT';
            url = ajax_admin_url.navbar + '/' + nav_id;
        } else {
            url = ajax_admin_url.navbar;
        }

        if (confirm('Are you sure?')) {
            $.ajax({
                type: type,
                headers: {'X-CSRF-TOKEN': csrf_token},
                url: url,
                data: {description: desc, navbar: nav, shortcode: short},
                success: function(result) {
                    location.reload(true);
                },
                error: function(xhr) {
                    alert(xhr.responseText);
                }
            });
        }

        return false;
    });
});